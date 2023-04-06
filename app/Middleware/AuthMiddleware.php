<?php
namespace Teckindo\DokumenKontrol\Middleware;

use Teckindo\DokumenKontrol\Helper\Access;
use Teckindo\DokumenKontrol\Helper\Flasher;
use Teckindo\DokumenKontrol\Helper\Session;

require_once __DIR__ . '/../Config/config.php';

class AuthMiddleware implements Middleware
{
    public function index(): void
    {
        $akses = new Access();
        if(! Session::getCurrentSession()){
            header('Location: ' . BASEURL . '/');
            Flasher::setFlash('Oppss !!', 'Anda belum login !', 'danger', '', '');
            exit();
        } 
        elseif (! $akses->UserAccessCheck() ) {
            header('Location: ' . BASEURL . '/blocked');
            exit();
        }
    }
}

    

