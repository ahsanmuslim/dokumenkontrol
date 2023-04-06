<?php
namespace Teckindo\DokumenKontrol\Controller;

use Teckindo\DokumenKontrol\App\Controller;

class ShareDocumentController extends Controller
{
    public function index()
    {
        $data['userlogin'] = $this->model('User')->getUser();
        $data['menu'] = $this->model('Menu')->getMenuActive($data['userlogin']['username']);
        $data['title'] = APP_NAME . " - Document";
        $data['surat'] = $this->model('Document')->getShareDocument($data['userlogin']['kd_divisi']);
        $this->view('Templates/header', $data);
        $this->view('ShareDocument/index', $data);        
        $this->view('Templates/footer');
    }

}