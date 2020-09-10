<?php
namespace Admin;

use App\Core\Controller;
use \Helper as Helper;
use \Flasher as Flasher;

class Sesi extends Controller
{
    private $data;

    public function index()
    {
        $result = $this->model('SesiModel')->create();
        $data['sesi'] = Helper::null_checker($result);

        $result = $this->model('JadwalModel')->create();
        $data['jadwal'] = Helper::null_checker($result); 

        $this->view('admin/sesi',$data,'admin');       
    }

    public function __setSesi(Array $data)
    {
        if(isset($_SESSION['presensi_adminsession'])){
            
            $res = $this->model('SesiModel')->store($data);

            if($res===true){
                Flasher::setFlash('Berhasil membuat sesi',true);
            }else{
                Flasher::setFlash('Gagal membuat sesi',false);
            }
        }
        header('location:'.BASEURL.'admin/sesi');
    }

    public function __setActive(String $id)
    {
        if(isset($_SESSION['presensi_adminsession'])){
            $res = $this->model('SesiModel')->update($id,['status'=>2]);
            if($res!==true) echo "gagal";
        }
        // header('location:'.BASEURL.'admin');
    }

    public function __setInactive(String $id)
    {
        if(isset($_SESSION['presensi_adminsession'])){
            $res = $this->model('SesiModel')->update($id,['status'=>1]);
            if($res!==true):
                echo "gagal";
            else:
                echo "berhasil";
            endif;
        }
    }

    public function __setAuto(String $id)
    {
        if(isset($_SESSION['presensi_adminsession'])){
            $res = $this->model('SesiModel')->show('byId',$id);

            // check last status
            $autoActive = $res['auto_active']=='inactive' ? 'active' : 'inactive';
            $status = $res['auto_active']=='inactive' ? 2 : 1;
            $data = [
                'auto_active'=>$autoActive,
                'status'=>$status
            ];

            $res = $this->model('SesiModel')->update($id,$data);
            if($res!==true){
                echo "isn't switch";
            }
        }
    }

    public function delete(String $id)
    {
        if(isset($_SESSION['presensi_adminsession']))
        {
            $condition = ['id'=>$id];
            $res = $this->model('SesiModel')->destroy($condition);
            if($res!==true)
            {
                echo "isn't delete jadwal";
            }
        }
    }
}
