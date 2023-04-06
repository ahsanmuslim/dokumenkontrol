<?php
namespace Teckindo\DokumenKontrol\Services;

use function Teckindo\DokumenKontrol\Config\App;

class Security
{
    public static function csrfToken(): string
    {
        $app = App();
        //Generate Csrf Token & Assign token Session
        // $token = bin2hex(random_bytes(32));
        // $token = md5(uniqid(mt_rand(), true));
        $token = bin2hex(openssl_random_pseudo_bytes(32));
        $_SESSION['token'] = $token;
        $_SESSION["token-expire"] = time() + $app['lifetime']; //token Expired sesuai setting FIle Env

        return $token;
    }

    public static function verifyToken(): array
    {
        if(isset($_POST['csrftoken']) && isset($_SESSION['token']) && $_POST['csrftoken'] == $_SESSION['token'])
        {
            if (time() >= $_SESSION["token-expire"]) {
                unset($_SESSION['token']);
                unset($_SESSION['token-expire']);
                return [
                    'type' => false,
                    'message' => 'Token Anda Expired. Silahkan Reload page !'
                ];
            } else {
                unset($_SESSION['token']);
                unset($_SESSION['token-expire']);
                return [
                    'type' => true,
                    'message' => 'Berhasil'
                ];
            }
        } else {
            unset($_SESSION['token']);
            unset($_SESSION['token-expire']);
            return [
                'type' => false,
                'message' => 'Token Anda Invalid !!'
            ];
        }
    }
}