<?php
namespace Teckindo\DokumenKontrol\Controller;

use Teckindo\DokumenKontrol\App\Controller;
use Teckindo\DokumenKontrol\Helper\Flasher;
use Teckindo\DokumenKontrol\Services\Security;

class DivisiController extends Controller
{
    private $userlogin;

    public function __construct()
    {
        $this->userlogin = $this->model('User')->getUser();
    }
    public function index()
    {
        $data['userlogin'] = $this->userlogin;
        $data['menu'] = $this->model('Menu')->getMenuActive($data['userlogin']['username']);
        $data['title'] = APP_NAME . " - Divisi";
        $data['divisi'] = $this->model('Divisi')->getDivisiAll();
        $this->view('Templates/header', $data);
        $this->view('Divisi/index', $data);
        $this->view('Templates/footer');
    }

    public function add()
    {
        $data['userlogin'] = $this->userlogin;
        $data['menu'] = $this->model('Menu')->getMenuActive($data['userlogin']['username']);
        $data['title'] = APP_NAME . " - Divisi";
        $this->view('Templates/header', $data);
        $this->view('Divisi/add', $data);
        $this->view('Templates/footer');
    }

    public function save()
    {
        $respon = Security::verifyToken($_POST);
		if($respon['type']){
            if ($this->model('Divisi')->saveData($_POST) > 0) {
                Flasher::setFlash('Berhasil', 'ditambahkan', 'success', 'divisi', '');
                header('Location: ' . BASEURL . '/divisi');
                exit;
            } else {
                Flasher::setFlash('Gagal', 'ditambahkan', 'danger', 'divisi', '');
                header('Location: ' . BASEURL . '/divisi');
                exit;
            }
        } else {
            Flasher::setFlash($respon['message'], '', 'danger', '', '');
			header ('Location: ' . BASEURL . '/divisi' );
			exit;
        }
    }

    public function edit($id_divisi)
    {
        $data['userlogin'] = $this->userlogin;
        $data['menu'] = $this->model('Menu')->getMenuActive($data['userlogin']['username']);
        $data['divisi'] = $this->model('Divisi')->getDivisiInfo($id_divisi);
        $data['title'] = APP_NAME . " - Divisi";
        $this->view('Templates/header', $data);
        $this->view('Divisi/edit', $data);
        $this->view('Templates/footer');
    }

    public function update()
    {
        $respon = Security::verifyToken($_POST);
		if($respon['type']){
            if ($this->model('Divisi')->updateData($_POST) > 0) {
                Flasher::setFlash('Berhasil', 'diupdate', 'success', 'divisi', '');
                header('Location: ' . BASEURL . '/divisi');
                exit;
            } else {
                Flasher::setFlash('Gagal', 'diupdate', 'danger', 'divisi', '');
                header('Location: ' . BASEURL . '/divisi');
                exit;
            }
        } else {
            Flasher::setFlash($respon['message'], '', 'danger', '', '');
			header ('Location: ' . BASEURL . '/divisi' );
			exit;
        }
    }

    public function delete()
    {
		$respon = Security::verifyToken($_POST);
		if($respon['type']){
            if( $this->model('Divisi')->deleteData($_POST) > 0 ){
                Flasher::setFlash('Berhasil', 'dihapus', 'success', 'divisi', '');
				header ('Location: ' . BASEURL . '/divisi' );
				exit;
			} else {
				Flasher::setFlash('gagal', 'dihapus', 'danger', '', '');
				header ('Location: ' . BASEURL . '/divisi' );
				exit;
			}
		} else {
			Flasher::setFlash($respon['message'], '', 'danger', '', '');
			header ('Location: ' . BASEURL . '/divisi' );
			exit;
		}
    }
    
}