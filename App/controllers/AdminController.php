<?php
use App\Core\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        if(!isset($_SESSION['presensi_adminsession'])){
            header('location:'.BASEURL.'auth');
            return FALSE;
        }
        require 'Admin/Jadwal.php';
        // $jadwal = new \Admin\Jadwal;

        require 'Admin/Sesi.php';
        // $sesi = new \Admin\Sesi;
    }

    public function index()
    {
        /**
         * Tampil semua sesi
         */
        // $result = $this->model('SesiModel')->create();
        // $data['sesi'] = Helper::null_checker($result);

        /**
         * Tampil sesi belum aktif
         */
        $result = $this->model('SesiModel')->show('set_active');
        $data['set_sesi'] = Helper::null_checker($result);

        /**
         * Tampil Data Admin
         */
        // $result = $this->model('SuperadminModel')->show();
        // $data['dataadmin'] = Helper::null_checker($result);

        // get id Jadwal
        $res = $this->model('JadwalModel')->show('get_active_jadwal');
        $data['jadwal'] = Helper::null_checker($res);

        /**
         * Show session ready to activated
         */
        // $result = $this->model('SesiModel')->show('get_active');
        // $data['activated'] = Helper::null_checker($result);


        $this->view('admin/index',$data,'admin');
    }

    /**
     * Jadwal Page
     * ----------------------------------------------------------
     */
    public function jadwal($param = null)
    {
        $jadwal = new \Admin\Jadwal;
        switch ($param) {
            case 'set':
                if(isset($_POST['presensi_tanggal'])):
                    $data = ['tanggal'=>$_POST['presensi_tanggal']];
                    $jadwal->__setJadwal($data);
                else:
                    header('location:'.BASEURL.'admin/jadwal');
                endif;

                break;
            case 'aktivasi':
                if(isset($_POST['id'])):
                    $jadwal->__setActive($_POST['id']);
                else:
                    header('location:'.BASEURL.'admin/jadwal');
                endif;
                
                break;
            case 'nonaktif':
                if(isset($_POST['id'])):
                    $jadwal->__setInactive($_POST['id']);
                else:
                    header('location:'.BASEURL.'admin/jadwal');
                endif;

                break;
            case 'delete':
                if(isset($_POST['id'])):
                    $jadwal->delete($_POST['id']);
                else:
                    header('location:'.BASEURL.'admin/jadwal');
                endif;

                break;
            default:
                $jadwal->index();
                break;
        }
    }

    /**
     * Sesi Page
     * ----------------------------------------------------------
     */
    public function sesi($param = null)
    {
        $sesi = new \Admin\Sesi;
        switch ($param) {
            case 'set':
                if(isset($_POST['presensi_sesi']) && $_POST['presensi_jadwal']):
                    $data = [
                        'sesi' => $_POST['presensi_sesi'],
                        'idJadwal' => $_POST['presensi_jadwal'],
                        'waktu_mulai' => $_POST['presensi_waktu_mulai'] ,
                        'waktu_selesai' => $_POST['presensi_waktu_selesai']
                    ];
                    $sesi->__setSesi($data);
                endif;

                break;
            case 'aktivasi':
                if(isset($_POST['id'])):
                    $sesi->__setActive($_POST['id']);
                endif;
                break;
            case 'nonaktif':
                if(isset($_POST['id'])):
                    $sesi->__setInactive($_POST['id']);
                endif;
                break;
            case 'setAuto':
                if(isset($_POST['id'])):
                    $sesi->__setAuto($_POST['id']);
                endif;
                break;
            case 'delete':
                if(isset(($_POST['id']))):
                    $sesi->delete(($_POST['id']));
                endif;
                break;
            
            default:
                $sesi->index();
                break;
        }
    }

    public function countdown_jadwal()
    {

        // mengatur time zone untuk WIB.
        date_default_timezone_set("Asia/Jakarta");

        $res = $this->model('SesiModel')->show("auto_sesi");
        if($res != null){
            $dateNow = mktime(date("H"), date("i"), date("s"),date("d"), date("m"), date("y"));
            // foreach ($res as $d) {
                // date
                $day = self::dateCreateFormat($res['tanggal'],'d');
                $month = self::dateCreateFormat($res['tanggal'],'m');
                $year = self::dateCreateFormat($res['tanggal'],'y');

                // time start
                $hour_start = self::dateCreateFormat($res['waktu_mulai'],'H');
                $min_start = self::dateCreateFormat($res['waktu_mulai'],'i');
                $sec_start = self::dateCreateFormat($res['waktu_mulai'],'s');

                // time end
                $hour_end = self::dateCreateFormat($res['waktu_selesai'],'H');
                $min_end = self::dateCreateFormat($res['waktu_selesai'],'i');
                $sec_end = self::dateCreateFormat($res['waktu_selesai'],'s');

                $dateSesiStart = mktime($hour_start,$min_start,$sec_start,$day,$month,$year);
                $dateSesiEnd = mktime($hour_end,$min_end,$sec_end,$day,$month,$year);

                $setTimer = self::timer_zone($dateSesiStart,$dateNow);
                $time = $setTimer['day']+$setTimer['hour']+$setTimer['minute']+$setTimer['sec'];
                echo $setTimer['day']." hari ".$setTimer['hour'].":".$setTimer['minute'].":".$setTimer['sec'];
                if($time < 0){
                    $sesi = new \Admin\Sesi;
                    $sesi->__setActive($res['id']);
                }else{
                    echo "Akan Berlangsung </br>";
                }

                // echo "Sesi Akan dimulai dalam :".$setTimer['day'].' hari '.$setTimer['hour'].':'.$setTimer['minute'].':'.$setTimer['sec'] ;

            // }
        }
        
        // mencari mktime untuk current time
        // $selisih2 = mktime(date("H"), date("i"), date("s"), date("d"), date("m"), date("Y"));
    }

    public function dateCreateFormat($date,$format)
    {
        $date = date_create($date);
        return date_format($date,$format);
    }

    public function timer_zone($start,$now)
    {
        // different second from date sesi to date now
        $secDiff = $start - $now;

        // day
        $date['day'] = floor($secDiff / 86400);

        // hour
        $left = $secDiff % 86400;
        $date['hour'] = floor($left / 3600);

        // minute
        $left = $left % 3600;
        $date['minute'] = floor($left/60);

        $left = $left % 60;
        $date['sec'] = floor($left);
        return $date;
    }
}
