<?php
namespace Teckindo\DokumenKontrol\Controller;

use Teckindo\DokumenKontrol\Helper\Image;
use Teckindo\DokumenKontrol\App\Controller;
use Teckindo\DokumenKontrol\Helper\Flasher;
use Teckindo\DokumenKontrol\Services\Security;


class ProfileController extends Controller
{
    protected $userlogin;

    public function __construct()
    {
        $this->userlogin = $this->model('User')->getUser();
    }

    public function index():void
    {
        $data['title'] = "Dokumen Kontrol - Profile";
		$data['userlogin'] = $this->userlogin;
        $data['menu'] = $this->model('Menu')->getMenuActive($data['userlogin']['username']);
        $this->view('templates/header', $data);
        $this->view('Profile/index', $data);
        $this->view('templates/footer');
    }

    public function edit():void
    {
        $data['title'] = "Dokumen Kontrol - Profile";
		$data['userlogin'] = $this->userlogin;
        $this->view('templates/header', $data);
        $this->view('Profile/edit', $data);
        $this->view('templates/footer');
    }

    public function update():void
    {
        $data['datauser'] = $this->userlogin;
        $file_lama = $data['datauser']['profile'];

        $upload_gambar = $_FILES['profile']['name'];
        // var_dump(gd_info());

        $respon = Security::verifyToken($_POST);
		if($respon['type']){

            if ($upload_gambar) {

                $ekstensi_std = array('png', 'jpg', 'jpeg', 'gif');
                $nama_file = $upload_gambar;
                $x = explode('.', $nama_file);
                $ekstensi = strtolower(end($x));
                $ukuran = $_FILES['profile']['size'];
                $file_temp = $_FILES['profile']['tmp_name'];

                if (in_array($ekstensi, $ekstensi_std) === true) {
                    if ($ukuran < 2000000) {
                        Image::compress($file_temp, 'img/' . $nama_file , 100);
                        self::simpanGambar($nama_file, $file_lama, $upload_gambar);
                    } else {
                        Image::compress($file_temp, 'img/' . $nama_file , 50);
                        self::simpanGambar($nama_file, $file_lama, $upload_gambar);
                    }
                } else {
                    Flasher::setFlash('Gagal', 'diupdate', 'danger', 'profile', 'Ekstensi gambar tidak sesuai !!');
                    header('Location: ' . BASEURL . '/profile');
                    exit;
                }

            } else {
                if ($this->model('User')->update($_POST, $file_lama) > 0) {
                    Flasher::setFlash('Berhasil', 'diupdate', 'success', 'profile', '');
                    header('Location: ' . BASEURL . '/profile');
                    exit;
                } else {
                    Flasher::setFlash('Gagal', 'diupdate', 'danger', 'profile', '');
                    header('Location: ' . BASEURL . '/profile');
                    exit;
                }
            }
		} else {
			Flasher::setFlash($respon['message'], '', 'danger', '', '');
			header ('Location: ' . BASEURL . '/profile' );
			exit;
		}


    }

    public function simpanGambar($nama_file, $file_lama, $upload_gambar):void
    {
        if ($file_lama != 'default.jpg' && $file_lama != $nama_file) {
            unlink('img/' . $file_lama);
        }
        if ($this->model('User')->update($_POST, $nama_file) > 0 or $upload_gambar) {
            Flasher::setFlash('Berhasil', 'diupdate', 'success', 'profile', '');
            header('Location: ' . BASEURL . '/profile');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'diupdate', 'danger', 'profile', '');
            header('Location: ' . BASEURL . '/profile');
            exit;
        }
    }

    public function getLocation()
    {
        $this->view('Profile/index');
    }




}