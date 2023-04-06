<?php
namespace Teckindo\DokumenKontrol\Controller;

use Teckindo\DokumenKontrol\App\Controller;
use Teckindo\DokumenKontrol\Helper\Flasher;
use Teckindo\DokumenKontrol\Services\Security;

class UserController extends Controller
{
    private $userlogin;

    public function __construct()
    {
        $this->userlogin = $this->model('User')->getUser();
    }
    public function index()
    {
        // phpinfo(); exit;
        $data['userlogin'] = $this->userlogin;
        $data['menu'] = $this->model('Menu')->getMenuActive($data['userlogin']['username']);
        $data['title'] = APP_NAME . ' - User';
        $data['user'] = $this->model('User')->getUserAll();
        $this->view('Templates/header', $data);
        $this->view('User/index', $data);
        $this->view('Templates/footer');
    }
    
    public function add()
    {
        $data['userlogin'] = $this->userlogin;
        $data['menu'] = $this->model('Menu')->getMenuActive($data['userlogin']['username']);
        $data['title'] = APP_NAME . ' - User';
        $data['divisi'] = $this->model('Divisi')->getDivisiAll();
        $data['role'] = $this->model('Role')->getRoleAll();
        $this->view('Templates/header', $data);
        $this->view('User/add', $data);
        $this->view('Templates/footer');
    }
    
    public function save()
    {
        $username = $_POST['username'];
        $data['userlogin'] = $this->userlogin;

        $respon = Security::verifyToken($_POST);
		if($respon['type']){
            if ($this->model('User')->cekUsername($_POST) > 0) {
                Flasher::setFlash('Gagal', 'ditambahkan', 'danger', 'user', 'username ' . $username . ' sudah ada di Database !');
                header('Location: ' . BASEURL . '/user');
                exit;
            } elseif ($this->model('User')->saveData($_POST, $data['userlogin']['id_user']) > 0) {
                Flasher::setFlash('Berhasil', 'ditambahkan', 'success', 'user', '');
                header('Location: ' . BASEURL . '/user');
                exit;
            } else {
                Flasher::setFlash('Gagal', 'ditambahkan', 'danger', 'user', '');
                header('Location: ' . BASEURL . '/user');
                exit;
            }
        } else {
            Flasher::setFlash($respon['message'], '', 'danger', '', '');
			header ('Location: ' . BASEURL . '/user' );
			exit;
        }
    }
    
    public function edit($id_user)
    {
        $data['userlogin'] = $this->userlogin;
        $data['menu'] = $this->model('Menu')->getMenuActive($data['userlogin']['username']);
        $data['role'] = $this->model('Role')->getRoleAll();
        $data['user'] = $this->model('User')->getUserInfo($id_user);
        $data['divisi'] = $this->model('Divisi')->getDivisiAll();
        $data['title'] = APP_NAME . ' - User';
        $this->view('Templates/header', $data);
        $this->view('User/edit', $data);
        $this->view('Templates/footer');
    }

    public function update()
    {
        $respon = Security::verifyToken($_POST);
		if($respon['type']){
            if ($this->model('User')->updateData($_POST) > 0) {
                Flasher::setFlash('Berhasil', 'diupdate', 'success', 'ttd user', '');
                header('Location: ' . BASEURL . '/user');
                exit;
            } else {
                Flasher::setFlash('Gagal', 'diupdate', 'danger', 'ttd user', '');
                header('Location: ' . BASEURL . '/user');
                exit;
            }
        } else {
            Flasher::setFlash($respon['message'], '', 'danger', '', '');
			header ('Location: ' . BASEURL . '/user' );
			exit;
        }
    }

    public function savettd()
    {
        $ttd = file_get_contents($_FILES['file_upload']['tmp_name']);

        $respon = Security::verifyToken($_POST);
		if($respon['type']){
            if ($this->model('User')->updateTTD($_POST, $ttd) > 0) {
                Flasher::setFlash('Berhasil', 'diupdate', 'success', 'user', '');
                header('Location: ' . BASEURL . '/user');
                exit;
            } else {
                Flasher::setFlash('Gagal', 'diupdate', 'danger', 'user', '');
                header('Location: ' . BASEURL . '/user');
                exit;
            }
        } else {
            Flasher::setFlash($respon['message'], '', 'danger', '', '');
			header ('Location: ' . BASEURL . '/user' );
			exit;
        }
    }

    public function delete()
    {
		$respon = Security::verifyToken($_POST);
		if($respon['type']){
            if ($this->model('Transaksi')->checkTransUser($_POST['id_user']) > 0) {
                Flasher::setFlash('Tidak bisa', 'dihapus', 'danger', 'user', 'User melakukan transaksi.');
                header('Location: ' . BASEURL . '/user');
                exit;
			} elseif( $this->model('User')->deleteData($_POST) > 0 ){
                Flasher::setFlash('Berhasil', 'dihapus', 'success', 'user', '');
				header ('Location: ' . BASEURL . '/user' );
				exit;
			} else {
				Flasher::setFlash('gagal', 'dihapus', 'danger', '', '');
				header ('Location: ' . BASEURL . '/user' );
				exit;
			}
		} else {
			Flasher::setFlash($respon['message'], '', 'danger', '', '');
			header ('Location: ' . BASEURL . '/user' );
			exit;
		}
    }
    
}