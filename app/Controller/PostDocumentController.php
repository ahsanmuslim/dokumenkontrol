<?php
namespace Teckindo\DokumenKontrol\Controller;

use Mpdf\Mpdf;
use Dompdf\Dompdf;
use Teckindo\DokumenKontrol\App\Controller;
use Teckindo\DokumenKontrol\Helper\AutoNumber;
use Teckindo\DokumenKontrol\Helper\Flasher;
use Teckindo\DokumenKontrol\Services\Security;

class PostDocumentController extends Controller
{
    public function index()
    {
        $data['userlogin'] = $this->model('User')->getUser();
        $data['menu'] = $this->model('Menu')->getMenuActive($data['userlogin']['username']);
        $data['title'] = APP_NAME . " - Post Dokumen";

        $id_divisi = $data['userlogin']['kd_divisi'];
        $divisi = $this->model('Divisi')->getAliasDivisi($id_divisi);
        $data['post'] = $this->model('PostDocument')->getPostDokumenByDiv($divisi['alias']);
        $data['lampiran'] = $this->model('PostDocument')->getAllLampiran();
        $this->view('Templates/header', $data);
        $this->view('Post/index', $data);        
        $this->view('Templates/footer');
    }

    public function add()
    {
        $data['userlogin'] = $this->model('User')->getUser();
        $data['menu'] = $this->model('Menu')->getMenuActive($data['userlogin']['username']);
        $data['title'] = APP_NAME . " - Create";
        $data['header'] = $this->model('PostDocument')->getHeaderSurat();
        $data['jenis'] = $this->model('Jenis')->getJenisAll();
        $this->view('Templates/header', $data);
        $this->view('Post/add', $data);        
        $this->view('Templates/footer');
    }
    

    public function edit($no_surat)
    {
        $data['userlogin'] = $this->model('User')->getUser();
        $data['menu'] = $this->model('Menu')->getMenuActive($data['userlogin']['username']);
        $data['title'] = APP_NAME . " - Edit";
        $data['header'] = $this->model('PostDocument')->getHeaderSurat();
        $data['postdokumen'] = $this->model('PostDocument')->getPostDokumenByNo($no_surat);
        $this->view('Templates/header', $data);
        $this->view('Post/edit', $data);        
        $this->view('Templates/footer');
    }
    public function detail($no_surat)
    {
        $data['title'] = APP_NAME . " - Print";
        $data['surat'] = $this->model('PostDocument')->getPostDokumen($no_surat);
        $data['lampiran'] = $this->model('PostDocument')->getLampiran($no_surat);
        $this->view('Post/detail', $data);        
    }
    
    public function getNomorSurat()
    {
        $auto = new AutoNumber();

        $data['userlogin'] = $this->model('User')->getUser();
        $id_divisi = $data['userlogin']['kd_divisi'];
        $divisi = $this->model('Divisi')->getAliasDivisi($id_divisi);
        $nomor = $auto->autonum($divisi['alias'], $_POST['jenis']);

        echo json_encode($nomor);
    }

    public function archive($no_surat)
    {
        
        // Create a new Dompdf instance
        $dompdf = new Dompdf();
        
        ob_start();
        $data['title'] = APP_NAME . " - Print";
        $data['surat'] = $this->model('PostDocument')->getPostDokumen($no_surat);
        $data['lampiran'] = $this->model('PostDocument')->getLampiran($no_surat);
        $this->view('Post/detail', $data); 
        $html =ob_get_contents();
        ob_get_clean();

        $dompdf->loadHtml($html);

        // (Optional) Set Dompdf options, such as paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the PDF
        $dompdf->render();

        // Set the PDF filename
        $filename = 'document.pdf';

        // Set the PDF output options
        $options = [
        'compress' => true,
        'Attachment' => false,
        ];

        // Output the PDF as a string
        $pdf_content = $dompdf->output($options);

        // Send the PDF to the browser for download
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Length: ' . strlen($pdf_content));
        echo $pdf_content;
        exit;
    }

    public function save()
    {
        // var_dump($_POST); exit;
        $data['userlogin'] = $this->model('User')->getUser();
        $id_user = $data['userlogin']['id_user'];
        $id_divisi = $data['userlogin']['kd_divisi'];
        $divisi = $this->model('Divisi')->getAliasDivisi($id_divisi);

        $respon = Security::verifyToken($_POST);
		if($respon['type']){
            if ($this->model('PostDocument')->saveData($_POST, $id_user, $divisi['alias']) > 0) {
                Flasher::setFlash('Berhasil', 'ditambahkan', 'success', 'dokumen baru', '');
                header('Location: ' . BASEURL . '/postdocument');
                exit;
            } else {
                Flasher::setFlash('Gagal', 'ditambahkan', 'danger', 'dokumen baru', '');
                header('Location: ' . BASEURL . '/postdocument');
                exit;
            }
        } else {
            Flasher::setFlash($respon['message'], '', 'danger', '', '');
			header ('Location: ' . BASEURL . '/postdocument' );
			exit;
        }
    }

    public function update()
    {
        $data['userlogin'] = $this->model('User')->getUser();
        $id_user = $data['userlogin']['id_user'];

        $respon = Security::verifyToken($_POST);
		if($respon['type']){
            if ($this->model('PostDocument')->updateData($_POST, $id_user) > 0) {
                Flasher::setFlash('Berhasil', 'diupdate', 'success', 'post dokumen', '');
                header('Location: ' . BASEURL . '/postdocument');
                exit;
            } else {
                Flasher::setFlash('Gagal', 'diupdate', 'danger', 'post dokumen', '');
                header('Location: ' . BASEURL . '/postdocument');
                exit;
            }
        } else {
            Flasher::setFlash($respon['message'], '', 'danger', '', '');
			header ('Location: ' . BASEURL . '/postdocument' );
			exit;
        }
    }

    public function delete()
    {
        $respon = Security::verifyToken($_POST);
		if($respon['type']){
            if( $this->model('PostDocument')->deleteData($_POST) > 0 ){
                Flasher::setFlash('Berhasil', 'dihapus', 'success', 'postdocument', '');
				header ('Location: ' . BASEURL . '/postdocument' );
				exit;
			} else {
				Flasher::setFlash('gagal', 'dihapus', 'danger', '', '');
				header ('Location: ' . BASEURL . '/postdocument' );
				exit;
			}
		} else {
			Flasher::setFlash($respon['message'], '', 'danger', '', '');
			header ('Location: ' . BASEURL . '/postdocument' );
			exit;
		}
    }



}