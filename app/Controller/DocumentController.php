<?php
namespace Teckindo\DokumenKontrol\Controller;


use Teckindo\DokumenKontrol\Helper\Mailer;
use Teckindo\DokumenKontrol\App\Controller;
use Teckindo\DokumenKontrol\Helper\Flasher;
use Teckindo\DokumenKontrol\Services\Security;

class DocumentController extends Controller
{
    public function index()
    {
        $data['userlogin'] = $this->model('User')->getUser();
        $data['menu'] = $this->model('Menu')->getMenuActive($data['userlogin']['username']);
        $data['title'] = APP_NAME . " - Document";
        $data['nomorhp'] = $this->model('ShareLog')->getDataNomorHPKaryawan();
        $data['email'] = $this->model('ShareLog')->getDataEmailKaryawan();
        if($data['userlogin']['role'] == 'ADM' || $data['userlogin']['role'] == 'DR') {
            $data['surat'] = $this->model('Document')->getDokumenAll();
        } else {
            $data['surat'] = $this->model('Document')->getDokumenAllByDivisi($data['userlogin']['kd_divisi']);
        }
        $this->view('Templates/header', $data);
        $this->view('Document/index', $data);        
        $this->view('Templates/footer');
    }

    public function jenis($url_menu)
    {
        $data['userlogin'] = $this->model('User')->getUser();
        $data['menu'] = $this->model('Menu')->getMenuActive($data['userlogin']['username']);
        $data['title'] = APP_NAME . " - Document";
        if($data['userlogin']['role'] == 'ADM' || $data['userlogin']['role'] == 'DR') {
            $data['surat'] = $this->model('Document')->getDokumenByJenis($url_menu);
        } else {
            $data['surat'] = $this->model('Document')->getDokumenByJenisByDivisi($url_menu, $data['userlogin']['kd_divisi']);
        }
        $data['judul'] = $this->model('Document')->getJenisByUrl($url_menu);
        $this->view('Templates/header', $data);
        $this->view('Document/index', $data);        
        $this->view('Templates/footer');
    }

    public function add()
    {
        $data['userlogin'] = $this->model('User')->getUser();
        $data['menu'] = $this->model('Menu')->getMenuActive($data['userlogin']['username']);
        $data['title'] = APP_NAME . " - Add";
        $data['divisi'] = $this->model('Divisi')->getDivisiAll();
        $data['jenis'] = $this->model('Jenis')->getJenisAll();
        $this->view('Templates/header', $data);
        $this->view('Document/add', $data);        
        $this->view('Templates/footer');
    }

    public function detail()
    {
        $data['detail'] = $this->model('Document')->getDokumenInfo($_POST['id']);
        $data['detail_doc'] = $this->model('Document')->getDetailDokumen($_POST['id']);
        $data['share'] = $this->model('Document')->getDetailShare($_POST['id']);
        $this->view('Document/detail', $data);
    }
    
    public function share()
    {
        $data['no_surat'] = $_POST['id'];
        $data['divisi'] = $this->model('Divisi')->getDivisiAll();
        $data['akses'] = $this->model('Document')->getDokumenAkses($_POST['id']);
        $this->view('Document/share', $data);
    }

    
    public function sharewas($no_surat)
    {
        $data['doc'] = $this->model('Document')->getNamaFile($no_surat);

        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'Legal-L', // Set the page format to portrait
            'default_font_size' => 0,
            'default_font' => '',
            'margin_left' => 15,
            'margin_right' => 15,
            'margin_top' => 15,
            'margin_bottom' => 15,
            'margin_header' => 9,
            'margin_footer' => 9
        ]);

        // Set the protection settings for the PDF
        $mpdf->SetProtection(['print'], '12345', '12345');

        // Add a new page to the PDF
        $mpdf->AddPage();

        // Get the total number of pages in the original PDF file
        $totalPages = $mpdf->setSourceFile('file/pdf/' . $data['doc']['nama_file']);
            
        // Loop through each page of the original PDF file and add it to the new PDF file
        for ($i = 1; $i <= $totalPages; $i++) {
            $tplId = $mpdf->importPage($i);
            $mpdf->useTemplate($tplId);
            if ($i < $totalPages) {
                $mpdf->AddPage();
            }
        }

        // Set the name of the encrypted file
        $nama_fileencrypt = $no_surat . '-encrypted.pdf';
        $nama_fileencrypt = str_replace('/', '-', $nama_fileencrypt);

        // Save the new PDF file
        $mpdf->Output($nama_fileencrypt, 'F');


        $sourceFilePath = $nama_fileencrypt;
        $destinationFolderPath = 'file/pdf/encrypted/';
        $fileName = basename($sourceFilePath);
        $destinationFilePath = $destinationFolderPath . $fileName;

        if (copy($sourceFilePath, $destinationFilePath)) {
            unlink($sourceFilePath);
        } 

        $pdfUrl = BASEURL . '/file/pdf/encrypted/' . $nama_fileencrypt;
        $message = 'Please download and view the PDF file at this link: ' . $pdfUrl;
        $encodedMessage = rawurlencode($message);

        header('Location: https://wa.me/?text=' . $encodedMessage);
        exit;
    }

    public function sharewapost()
    {
        // var_dump($_POST); exit;
        $no_surat = $_POST['nosurat'];
        $pagesize = $_POST['pagesize'];
        $password = $_POST['password'];

        $data['doc'] = $this->model('Document')->getNamaFile($no_surat);
        $data['userlogin'] = $this->model('User')->getUser();

        //Logger Share Save t Table 
        $phoneNumber = '';
        if($_POST['jenis'] == 'internal'){
            $phoneNumber = $_POST['nomorhp1'];
            $log = [
                'penerima' => $_POST['namapenerima1'],
                'pengirim' => $data['userlogin']['id_user'],
                'via' => 'whatapps',
                'keterangan' => $_POST['nomorhp1'],
                'nosurat' => $no_surat,
                'jenis' => $_POST['jenis']
            ];
        } else {
            $phoneNumber = $_POST['nomorhp2'];
            $log = [
                'penerima' => $_POST['namapenerima2'],
                'pengirim' => $data['userlogin']['id_user'],
                'via' => 'whatapps',
                'keterangan' => $_POST['nomorhp2'],
                'nosurat' => $no_surat,
                'jenis' => $_POST['jenis']
            ];
        }

        $this->model('ShareLog')->saveLogWAShare($log);

        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => $pagesize, // Set the page format to portrait
            'default_font_size' => 0,
            'default_font' => '',
            'margin_left' => 15,
            'margin_right' => 15,
            'margin_top' => 15,
            'margin_bottom' => 15,
            'margin_header' => 9,
            'margin_footer' => 9
        ]);

        // Set the protection settings for the PDF
        $mpdf->SetProtection(['print'], $password, $password);

        // Add a new page to the PDF
        $mpdf->AddPage();

        // Get the total number of pages in the original PDF file
        $totalPages = $mpdf->setSourceFile('file/pdf/' . $data['doc']['nama_file']);
            
        // Loop through each page of the original PDF file and add it to the new PDF file
        for ($i = 1; $i <= $totalPages; $i++) {
            $tplId = $mpdf->importPage($i);
            $mpdf->useTemplate($tplId);
            if ($i < $totalPages) {
                $mpdf->AddPage();
            }
        }

        // Set the name of the encrypted file
        $nama_fileencrypt = $no_surat . '-encrypted.pdf';
        $nama_fileencrypt = str_replace('/', '-', $nama_fileencrypt);

        // Save the new PDF file
        $mpdf->Output($nama_fileencrypt, 'F');


        $sourceFilePath = $nama_fileencrypt;
        $destinationFolderPath = 'file/pdf/encrypted/';
        $fileName = basename($sourceFilePath);
        $destinationFilePath = $destinationFolderPath . $fileName;

        if (copy($sourceFilePath, $destinationFilePath)) {
            unlink($sourceFilePath);
        } 

        $pdfUrl = BASEURL . '/file/pdf/encrypted/' . $nama_fileencrypt;
        $message = 'Please download and view the PDF file at this link: ' . $pdfUrl;
        $encodedMessage = rawurlencode($message);

        //Untuk kirim WA jika kira yng memilih nomor yang akan di share
        // header('Location: https://wa.me/?text=' . $encodedMessage);

        // jika kirim ke spesific no sesuai yang dpilih di awal
        $phoneNumber = '62' . substr($phoneNumber, 1);
        $phoneNumber = str_replace(' ', '', $phoneNumber);
        $whatsappUrl = 'https://wa.me/' . $phoneNumber . '?text=' . $encodedMessage;

        header('Location: ' . $whatsappUrl);
        exit;
    }

    public function getNomor()
    {
        $nomor = $this->model('ShareLog')->getNomor($_POST['nama']);
        echo json_encode($nomor);
    }

    public function getLogShare()
    {
        $data['userlogin'] = $this->model('User')->getUser();
        $id_user = $data['userlogin']['id_user'];
        $data['logshare'] = $this->model('ShareLog')->getLogShare($_POST['nomor'], $id_user);
        $this->view('Document/logshare', $data);
    }

    public function edit($no_surat)
    {
        $data['userlogin'] = $this->model('User')->getUser();
        $data['menu'] = $this->model('Menu')->getMenuActive($data['userlogin']['username']);
        $data['title'] = APP_NAME . " - Add";
        $data['divisi'] = $this->model('Divisi')->getDivisiAll();
        $data['jenis'] = $this->model('Jenis')->getJenisAll();
        $data['dokumen'] = $this->model('Document')->getDokumenInfo($no_surat);
        $data['akses'] = $this->model('Document')->getDokumenAkses($no_surat);
        $this->view('Templates/header', $data);
        $this->view('Document/edit', $data);        
        $this->view('Templates/footer');
    }

    public function viewer($nama_file)
    {
        $data['title'] = APP_NAME . " - Pdf Viewer";
        $data['nama_file'] = $nama_file;
        $this->view('Document/pdfviewer', $data);        
    }

    public function sendemail()
    {
        // var_dump($_POST); exit;
        
        $penerima = [];
        foreach($_POST['penerima'] as $e){
            $penerima[] = [
                    "email" => $e,
                    "user" => "User"
            ];
        }
            
        $data['userlogin'] = $this->model('User')->getUser();

        $pengirim = $data['userlogin']['id_user'];
        $sender = $data['userlogin']['nama_user'];
        $subject = $_POST['subject'];
        $body = $_POST['body'];
        $lampiran = $_POST['lampiran'];
        $nosurat = $_POST['nomor'];

        $log = [];
        foreach($_POST['penerima'] as $p){
            $log[] = [
                'penerima' => 'User',
                'pengirim' => $pengirim,
                'via' => 'email',
                'keterangan' => $p,
                'nosurat' => $nosurat
            ];
        }

        $this->model('ShareLog')->saveLogEmailShare($log);
        ob_start();
        Mailer::sendEmail($sender, $penerima, $subject, 'Share Document', $body, $lampiran);
        ob_end_flush();
        Flasher::setFlash('Berhasil', 'dikirim via email', 'success', 'document', '');
        // header('Location: ' . BASEURL . '/document');
        echo "<script>window.location.href='".BASEURL."/document';</script>";
        exit();

    }

    public function update()
    {
        $data['userlogin'] = $this->model('User')->getUser();
        $id_user = $data['userlogin']['id_user'];

        $upload_pdf = $_FILES['file_upload']['name'];

        $respon = Security::verifyToken($_POST);
        if($respon['type']){

            //cek apakah file di upload 
            if(empty($upload_pdf)){
                $added = [
                    'id_user' => $id_user
                ];
                if ($this->model('Document')->updateInfo($_POST, $added) > 0) {
                    Flasher::setFlash('Berhasil', 'diupdate', 'success', 'dokumen', '');
                    header('Location: ' . BASEURL . '/document');
                    exit;
                } else {
                    Flasher::setFlash('Gagal', 'diupdate', 'danger', 'document', '');
                    header('Location: ' . BASEURL . '/document');
                    exit;
                }
            } else {
                //cek ekstensi 
                $urutan = $_POST['revisi'] + 1; 
                $ekstensi_std = array('pdf');
                $nama_file = $upload_pdf;
                $nama_filesimpan = $_POST['nosurat'] . '-REVISI-'. sprintf("%02s", $urutan) .'.pdf';
                $nama_filesimpan = str_replace('/', '-', $nama_filesimpan);
                $x = explode('.', $nama_file);
                $ekstensi = strtolower(end($x));
                $ukuran = $_FILES['file_upload']['size'];
                $file_temp = $_FILES['file_upload']['tmp_name'];
                $added = [
                    'id_user' => $id_user,
                    'ukuran_file' => $ukuran,
                    'nama_file' => $nama_filesimpan,
                    'revisi'=> $urutan
                ];

                if (in_array($ekstensi, $ekstensi_std) === true) {
                    if ($ukuran < 2000000) {
                        move_uploaded_file($file_temp, 'file/pdf/' . $nama_filesimpan);

                        if ($this->model('Document')->updateDokumen($_POST, $added) > 0) {
                            Flasher::setFlash('Berhasil', 'diupdate', 'success', 'dokumen', '');
                            header('Location: ' . BASEURL . '/document');
                            exit;
                        } else {
                            Flasher::setFlash('Gagal', 'diupdate', 'danger', 'document', '');
                            header('Location: ' . BASEURL . '/document');
                            exit;
                        }
                    } else {
                        Flasher::setFlash('Gagal', 'diupdate', 'danger', 'document', 'Ukuran gambar terlalu besar !!');
                        header('Location: ' . BASEURL . '/document');
                        exit;
                    }
                } else {
                    Flasher::setFlash('Gagal', 'diupdate', 'danger', 'document', 'Ekstensi file tidak sesuai !!');
                    header('Location: ' . BASEURL . '/document');
                    exit;
                }
            }
            

        } else {
            Flasher::setFlash($respon['message'], '', 'danger', '', '');
			header ('Location: ' . BASEURL . '/document' );
			exit;
        }
    }

    public function saveshare()
    {
        if ($this->model('Document')->saveShare($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'dibagikan', 'success', 'dokumen', '');
            header('Location: ' . BASEURL . '/document');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'dibagikan', 'danger', 'document', '');
            header('Location: ' . BASEURL . '/document');
            exit;
        }
    }


    public function save()
    {
        // var_dump($_POST);
        $data['userlogin'] = $this->model('User')->getUser();
        $id_user = $data['userlogin']['id_user'];

        $respon = Security::verifyToken($_POST);
        if($respon['type']){

            //cek nomor Surat apakah sudah ada di Database
            if( $this->model('Document')->cekNomorSurat($_POST['nosurat']) >0 ){
                Flasher::setFlash('Gagal', 'ditambahkan', 'danger', 'document', 'Nomor sudah ada !!');
                header('Location: ' . BASEURL . '/document');
                exit;
            } else {
                //cek ekstensi 
                $upload_pdf = $_FILES['file_upload']['name'];
                $ekstensi_std = array('pdf');
                $nama_file = $upload_pdf;
                $nama_filesimpan = $_POST['nosurat'] . '-ORIGINAL.pdf';
                $nama_filesimpan = str_replace('/', '-', $nama_filesimpan);
                $x = explode('.', $nama_file);
                $ekstensi = strtolower(end($x));
                $ukuran = $_FILES['file_upload']['size'];
                $file_temp = $_FILES['file_upload']['tmp_name'];
                $added = [
                    'id_user' => $id_user,
                    'nama_file' => $nama_filesimpan,
                    'ukuran_file' => $ukuran
                ];

                if (in_array($ekstensi, $ekstensi_std) === true) {
                    if ($ukuran < 2000000) {
                        move_uploaded_file($file_temp, 'file/pdf/' . $nama_filesimpan);

                        if ($this->model('Document')->saveData($_POST, $added) > 0) {
                            Flasher::setFlash('Berhasil', 'ditambahkan', 'success', 'dokumen', '');
                            header('Location: ' . BASEURL . '/document');
                            exit;
                        } else {
                            Flasher::setFlash('Gagal', 'ditambahkan', 'danger', 'document', '');
                            header('Location: ' . BASEURL . '/document');
                            exit;
                        }
                    } else {
                        Flasher::setFlash('Gagal', 'ditambahkan', 'danger', 'document', 'Ukuran gambar terlalu besar !!');
                        header('Location: ' . BASEURL . '/document');
                        exit;
                    }
                } else {
                    Flasher::setFlash('Gagal', 'ditambahkan', 'danger', 'document', 'Ekstensi file tidak sesuai !!');
                    header('Location: ' . BASEURL . '/document');
                    exit;
                }
            }

        } else {
            Flasher::setFlash($respon['message'], '', 'danger', '', '');
			header ('Location: ' . BASEURL . '/document' );
			exit;
        }
    }

    public function delete()
    {
        $respon = Security::verifyToken($_POST);
		if($respon['type']){
            //Ambil detail nama file & hapus semua file di Drive
            $data['file'] = $this->model('Document')->getNamaFileDetail($_POST['no_surat']);
            foreach ($data['file'] as $f) {
                unlink('file/pdf/' . $f['nama_file'] . '.pdf');
            }

            if( $this->model('Document')->deleteData($_POST) > 0 ){
                Flasher::setFlash('Berhasil', 'dihapus', 'success', 'document', '');
				header ('Location: ' . BASEURL . '/document' );
				exit;
			} else {
				Flasher::setFlash('gagal', 'dihapus', 'danger', '', '');
				header ('Location: ' . BASEURL . '/document' );
				exit;
			}
		} else {
			Flasher::setFlash($respon['message'], '', 'danger', '', '');
			header ('Location: ' . BASEURL . '/document' );
			exit;
		}
    }


}