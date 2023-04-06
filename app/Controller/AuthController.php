<?php
namespace Teckindo\DokumenKontrol\Controller;

use Teckindo\DokumenKontrol\App\Controller;

class AuthController extends Controller
{
    public function blocked()
    {
        $data['title'] = APP_NAME . ' - Access Blocked';
        $data['userlogin'] = $this->model('User')->getUser();
        $data['menu'] = $this->model('Menu')->getMenuActive($data['userlogin']['username']);
        $this->view('Templates/header', $data);
        $this->view('Auth/blocked', $data);
        $this->view('Templates/footer', $data);
    }
}