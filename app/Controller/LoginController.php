<?php
namespace Teckindo\DokumenKontrol\Controller;

use Teckindo\DokumenKontrol\App\Controller;
use Teckindo\DokumenKontrol\Helper\Access;
use Teckindo\DokumenKontrol\Helper\Flasher;
use Teckindo\DokumenKontrol\Helper\Session;

class LoginController extends Controller 
{ 
    public function index() : void
    {
        if(Session::getCurrentSession()){
            header('Location: ' . BASEURL . '/home');
        } else {
            $data['title'] = "Dokumen Kontrol - Login";
            $this->view('Auth/login', $data);
        }
    }

    public function login() : void
    {
        $username = $_POST['username'];
        $password = sha1($_POST['password']);
        
        $session = new Session();
        $akses = new Access();
        if(! $akses->UserCheckActive($username)){
            Flasher::setFlash('Login Gagal !!', 'User tidak Aktif', 'danger', '', '');
            header('Location: ' . BASEURL . '/');
        } elseif($session->jwtlogin($username, $password)) {
            header('Location: ' . BASEURL . '/home');
        } else {
            Flasher::setFlash('Login Gagal !!', 'Username / password Anda salah', 'danger', '', '');
            header('Location: ' . BASEURL . '/');
        }
    }

    public function logout() : void
    {
        //hapus JWT di DB, Hapus Cookie dan Hapus Session
        $this->model("User")->hapusJWT();
        setcookie("TRACKER-APPS", "", time() - 60);
        session_destroy();
        header('Location: ' . BASEURL . '/');
    }
}