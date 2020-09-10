<?php

use App\Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $result = $this->model('JadwalModel')->show('get_active_jadwal');
        $data['idJadwal'] = $result['id'];
        
        /**
         * get sesi active and jadwal active
         */
        $result = $this->model('SesiModel')->show('get_active');
        if(!is_null($result))
        {
            if($result['auto_active'] == "active"){
                if($this->countdown($result['waktu_mulai'])):
                    if($this->countdown($result['waktu_selesai'], 60) == false)
                        $data['sesi'] = Helper::null_checker($result);
                endif;
            } else {
                $data['sesi'] = Helper::null_checker($result);
            }
        }

        
        // $this->view('load/index',[],'self');
        $data['tpq'] = $this->model('TpqModel')->create();
        $this->view('home/index',$data,'peserta');
    }

    public function submitData()
    {
        // filter nama
        $nama = strtolower($_POST['presensi_nama']); // small word
        $nama = ucwords($nama); // uppercase every first alphabet
        $nama = trim($nama);
        $nama = explode(' ',$nama); // explode to array
        $nama = preg_replace("/[^a-zA-Z]/", "", $nama); // check thread character
        $nama = preg_replace("/\s+/","",$nama);
        $nama = implode( ' ',$nama); // implode to string

        $postData = [
            'nama'=>$nama,
            'jenis_kelamin'=>$_POST['presensi_jeniskelamin'],
            'idTpq'=>$_POST['presensi_tpq'],
            'idJadwal'=>$_POST['presensi_idJadwal']
        ];
        // var_dump($postData);


        // Filter empty
        if(empty($postData['nama']) || is_null($postData['jenis_kelamin']))
        {
            Flasher::setFlash('Kolom harus diisi semua cuy', false);
            header('location:'.BASEURL);
            return false;
        }


        $res = $this->model('PesertaModel')->show('filtering',$postData);
        // var_dump($res);
        // die();

        if($res===null)
        {
            $res = $this->model('PesertaModel')->store($postData);
            if($res===true)
            {
                Flasher::setFlash("Berhasil",true);
            }else{
                Flasher::setFlash('Gagal',false);
            }
        }else{
            Flasher::setFlash("Hanya satu kali absen",false);
        }

        header('location:'.BASEURL);
    }

    /**
     *  Count Down Timer
     * 
     * @param Int $Time
     * @param Int $SpendTime && (minute)
     * 
     * @return Boolean
     */
    
    public function countdown($time, $spendTime = 0)
    {
        date_default_timezone_set("Asia/Jakarta");

        $spendTime = $spendTime * 60;
        
        $resDate = strtotime($time) + $spendTime;
        $now = strtotime('now');

        $distance = $resDate - $now;
        // var_dump($distance);

        if($distance < 1)
        {
            return true;
        } else {
            return false;
        }
    }
}
