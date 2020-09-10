<?php

use App\Core\Controller;

class AuthController extends Controller
{
    public function __construct()
    {
        if(isset($_SESSION['presensi_adminsession']))
        {
            header('location:'.BASEURL.'admin');
        }
    }
    public function index()
    {
        $this->view('authentication/index',[],'self');
        if(isset($_SESSION['presensi_wrong'])){
            unset($_SESSION['presensi_wrong']);
        }
    }

    public function authorization()
    {
        // $pass = "presensionlineasramappgjakartapusatadminlogin";
        $res = $this->model('SuperadminModel')->auth($_POST['presensi_password']);
        // var_dump($res);die();
        if(is_null($res)){
            $_SESSION['presensi_wrong'] = true;
        }else{
            $_SESSION['presensi_adminsession'] = $res['id'];
            $_SESSION['presensi_adminnama'] = $res['nama'];
        }
        header('location:'.BASEURL.'admin');
    }

    public function __unsetAuthorize()
    {
        unset($_SESSION['presensi_adminsession']);
        session_destroy();

        header('location:'.BASEURL.'admin');
    }
    
}
