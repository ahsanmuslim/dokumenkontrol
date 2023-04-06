<?php
namespace Teckindo\DokumenKontrol\Helper;


use Firebase\JWT\JWT;
use Teckindo\DokumenKontrol\App\Controller;
use function Teckindo\DokumenKontrol\Config\App;

class Session extends Controller
{
    private static $SECRET_KEY = "qwertyuiopljhgffsazxcvb";

    public function jwtlogin(string $username, string $password): bool
    {
        $data = $this->model('User')->cekUserLogin($username, $password);
        if(! empty($data)){
            //Set username session
            $_SESSION['username'] = $username;

            //setting payload JWT
            $payload = [
                "username" => $data['username'],
                "role" => $data['role'],
                // "id_login" => Uuid::uuid1()->toString()
                "id_login" => bin2hex(random_bytes(16))
            ];

            //panggil Env Session Lifetime
            $app = App();

            //generate JWT, set cookie option dan simpan JWT di Cookie
            $jwt = JWT::encode($payload, self::$SECRET_KEY, 'HS256');
            $option = [
                // "expires" => time()+ $app['lifetime'],
                "httponly" => true,
                "secure" => false,
                "path" => "",
                "domain" => ""
            ];
            setcookie("TRACKER-APPS", $jwt, $option);

            //simpan JWT di DB User
            $this->model('User')->simpanJWT($jwt, $username);

            return true;
        } else {
            return false;
        }
    }

    public static function getCurrentSession(): bool
    {

        if(isset($_COOKIE['TRACKER-APPS']) && isset($_SESSION['username']) ){
            $controller = new Controller();

            $userlogin = $controller->model("User")->getUser();

            $jwt = $_COOKIE['TRACKER-APPS'];

            //cek apakah JWT user login pada Cookie sama dengan JWT active user yang tersimpan di DB
            if(isset($userlogin['jwt'])){
                if($jwt == $userlogin['jwt']){
                    return true;
                }
                return false;
            } else {
                return false;
            }

        } else {
            return false;
        }

        // if(isset($_SESSION['username'])){
        //     return true;
        // } else {
        //     return false;
        // }
    }
}