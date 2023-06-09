<?php
namespace Teckindo\DokumenKontrol\Helper;

class Flasher 
{

    public static function setFlash ($pesan, $aksi, $type, $hasil, $error)
    {
        $_SESSION['flash'] = [
            'pesan' => $pesan,
            'aksi' => $aksi,
            'type' => $type,
            'hasil' => $hasil,
            'error' => $error
        ] ;
    }

    public static function Flash ()
    {
        if ( isset($_SESSION['flash'])) {
            echo    '<div class="alert alert-'. $_SESSION['flash']['type'] .'" role="alert">
                        Data '. $_SESSION['flash']['hasil'] .' <strong>'. $_SESSION['flash']['pesan'] .' </strong> '. $_SESSION['flash']['aksi'] .' '.$_SESSION['flash']['error'] .'
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>' 
            ;
            unset($_SESSION['flash']);
        }
    }

    public static function loginFailed ()
    {
        if ( isset($_SESSION['flash'])) {
            echo    '<div class="alert alert-'. $_SESSION['flash']['type'] .'" role="alert">
                        '. $_SESSION['flash']['hasil'] .' <strong>'. $_SESSION['flash']['pesan'] .' </strong> <br>'. $_SESSION['flash']['aksi'] .''.$_SESSION['flash']['error'] .'
                        </button>
                    </div>' 
            ;
            unset($_SESSION['flash']);
        }
    }

    public static function registFlash ()
    {
        if ( isset($_SESSION['flash'])) {
            echo    '<div class="alert alert-'. $_SESSION['flash']['type'] .'" role="alert">
                        Registrasi '. $_SESSION['flash']['hasil'] .' <strong>'. $_SESSION['flash']['pesan'] .' </strong> '. $_SESSION['flash']['aksi'] .' '.$_SESSION['flash']['error'] .'
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>' 
            ;
            unset($_SESSION['flash']);
        }
    }

    public static function forgotFlash ()
    {
        if ( isset($_SESSION['flash'])) {
            echo    '<div class="alert alert-'. $_SESSION['flash']['type'] .'" role="alert">
                        '. $_SESSION['flash']['pesan'] .'
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>' 
            ;
            unset($_SESSION['flash']);
        }
    }

}