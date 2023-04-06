<?php
namespace Teckindo\DokumenKontrol\Controller;

use Teckindo\DokumenKontrol\App\Controller;
use Teckindo\DokumenKontrol\Helper\Flasher;
use Teckindo\DokumenKontrol\Services\Security;

class JenisController extends Controller
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
        $data['title'] = APP_NAME . ' - Jenis';
        $data['jenis'] = $this->model('Jenis')->getJenisAll();
        $this->view('Templates/header', $data);
        $this->view('Jenis/index', $data);
        $this->view('Templates/footer');
    }

    public function add()
    {
        $data['userlogin'] = $this->userlogin;
        $data['menu'] = $this->model('Menu')->getMenuActive($data['userlogin']['username']);
        $data['title'] = APP_NAME . ' - Jenis';
        $this->view('Templates/header', $data);
        $this->view('Jenis/add', $data);
        $this->view('Templates/footer');
    }

    public function save()
    {
        $respon = Security::verifyToken($_POST);
		if($respon['type']){
            if ($this->model('Jenis')->saveData($_POST) > 0) {
                Flasher::setFlash('Berhasil', 'ditambahkan', 'success', 'jenis', '');
                header('Location: ' . BASEURL . '/jenis');
                exit;
            } else {
                Flasher::setFlash('Gagal', 'ditambahkan', 'danger', 'jenis', '');
                header('Location: ' . BASEURL . '/jenis');
                exit;
            }
        } else {
            Flasher::setFlash($respon['message'], '', 'danger', '', '');
			header ('Location: ' . BASEURL . '/jenis' );
			exit;
        }
    }

    public function edit($id_jenis)
    {
        $data['userlogin'] = $this->userlogin;
        $data['menu'] = $this->model('Menu')->getMenuActive($data['userlogin']['username']);
        $data['jenis'] = $this->model('Jenis')->getJenisInfo($id_jenis);
        $data['title'] = APP_NAME . ' - Jenis';
        $this->view('Templates/header', $data);
        $this->view('Jenis/edit', $data);
        $this->view('Templates/footer');
    }

    public function update()
    {
        $respon = Security::verifyToken($_POST);
		if($respon['type']){
            if ($this->model('Jenis')->updateData($_POST) > 0) {
                Flasher::setFlash('Berhasil', 'diupdate', 'success', 'jenis', '');
                header('Location: ' . BASEURL . '/jenis');
                exit;
            } else {
                Flasher::setFlash('Gagal', 'diupdate', 'danger', 'jenis', '');
                header('Location: ' . BASEURL . '/jenis');
                exit;
            }
        } else {
            Flasher::setFlash($respon['message'], '', 'danger', '', '');
			header ('Location: ' . BASEURL . '/jenis' );
			exit;
        }
    }

    public function delete()
    {
		$respon = Security::verifyToken($_POST);
		if($respon['type']){
            if( $this->model('Jenis')->deleteData($_POST) > 0 ){
                Flasher::setFlash('Berhasil', 'dihapus', 'success', 'jenis', '');
				header ('Location: ' . BASEURL . '/jenis' );
				exit;
			} else {
				Flasher::setFlash('gagal', 'dihapus', 'danger', '', '');
				header ('Location: ' . BASEURL . '/jenis' );
				exit;
			}
		} else {
			Flasher::setFlash($respon['message'], '', 'danger', '', '');
			header ('Location: ' . BASEURL . '/jenis' );
			exit;
		}
    }
    
}