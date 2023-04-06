<?php
namespace Teckindo\DokumenKontrol\Controller;

use Teckindo\DokumenKontrol\App\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $data['userlogin'] = $this->model('User')->getUser();
        $data['menu'] = $this->model('Menu')->getMenuActive($data['userlogin']['username']);
        $data['title'] = APP_NAME . " - Home";
        $data['grafikJenis'] = $this->model('Dashboard')->grafikDokumenByJenis();
        $data['grafikType'] = $this->model('Dashboard')->grafikDokumenByType();
        // var_dump($data['grafikJenis']);
        $this->view('Templates/header', $data);
        $this->view('Home/index', $data);        
        $this->view('Templates/footer');
    }

    public function notfound()
    {
        $data['title'] = APP_NAME . ' - Page Not Found';
        $data['link'] = 'http://' . $_SERVER['HTTP_HOST'] .''. $_SERVER['REQUEST_URI'];
        $this->view('notfound', $data);
    }
}