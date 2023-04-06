<?php
namespace Teckindo\DokumenKontrol\Controller;

use Teckindo\DokumenKontrol\App\Controller;
use Teckindo\DokumenKontrol\Helper\Flasher;
use Teckindo\DokumenKontrol\Services\Security;

class MenuController extends Controller
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
        $data['title'] = APP_NAME . ' - Menu';
        $data['allmenu'] = $this->model('Menu')->getMenuAll();
        $this->view('Templates/header', $data);
        $this->view('Menu/index', $data);
        $this->view('Templates/footer');
    }

    public function add()
    {
        $data['userlogin'] = $this->userlogin;
        $data['menu'] = $this->model('Menu')->getMenuActive($data['userlogin']['username']);
        $data['title'] = APP_NAME . ' - Menu';
        $this->view('Templates/header', $data);
        $this->view('Menu/add', $data);
        $this->view('Templates/footer');
    }

    public function save()
    {
        $respon = Security::verifyToken($_POST);
		if($respon['type']){
            if ($this->model('Menu')->saveData($_POST) > 0) {
                Flasher::setFlash('Berhasil', 'ditambahkan', 'success', 'menu', '');
                header('Location: ' . BASEURL . '/controller');
                exit;
            } else {
                Flasher::setFlash('Gagal', 'ditambahkan', 'danger', 'menu', '');
                header('Location: ' . BASEURL . '/controller');
                exit;
            }
        } else {
            Flasher::setFlash($respon['message'], '', 'danger', '', '');
			header ('Location: ' . BASEURL . '/controller' );
			exit;
        }
    }

    public function edit($id)
    {
        $data['userlogin'] = $this->userlogin;
        $data['menu'] = $this->model('Menu')->getMenuActive($data['userlogin']['username']);
        $data['controller'] = $this->model('Menu')->getMenuInfo($id);
        $data['title'] = APP_NAME . ' - Menu';
        $this->view('Templates/header', $data);
        $this->view('Menu/edit', $data);
        $this->view('Templates/footer');
    }

    public function update()
    {
        $respon = Security::verifyToken($_POST);
		if($respon['type']){
            if ($this->model('Menu')->updateData($_POST) > 0) {
                Flasher::setFlash('Berhasil', 'diupdate', 'success', 'menu', '');
                header('Location: ' . BASEURL . '/controller');
                exit;
            } else {
                Flasher::setFlash('Gagal', 'diupdate', 'danger', 'menu', '');
                header('Location: ' . BASEURL . '/controller');
                exit;
            }
        } else {
            Flasher::setFlash($respon['message'], '', 'danger', '', '');
			header ('Location: ' . BASEURL . '/controller' );
			exit;
        }
    }
    
    public function delete()
    {
        $respon = Security::verifyToken($_POST);
		if($respon['type']){
            if ($this->model('Menu')->checkMenuAkses($_POST['id']) > 0) {
                Flasher::setFlash('Tidak bisa', 'dihapus', 'danger', 'menu', 'Menu sudah digunakan.');
                header('Location: ' . BASEURL . '/controller');
                exit;
            } elseif( $this->model('Menu')->deleteData($_POST) > 0 ){
                Flasher::setFlash('Berhasil', 'dihapus', 'success', 'menu', '');
				header ('Location: ' . BASEURL . '/controller' );
				exit;
			} else {
				Flasher::setFlash('gagal', 'dihapus', 'danger', '', '');
				header ('Location: ' . BASEURL . '/controller' );
				exit;
			}
		} else {
			Flasher::setFlash($respon['message'], '', 'danger', '', '');
			header ('Location: ' . BASEURL . '/controller' );
			exit;
		}
    }
    
}