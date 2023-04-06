<?php
namespace Teckindo\DokumenKontrol\Helper;

use Teckindo\DokumenKontrol\App\Controller;

class Access extends Controller
{
    public function UserAccessCheck() : bool
    {

        //ambil data controller dari PATH INFO
        $url = rtrim($_SERVER['PATH_INFO'],'/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        array_shift($url);
        $controller = $url[0];

        // Ambil data user dari Cookie
        $datauser =  $this->model('User')->getUser();                                                     
        
        //cek akses user 
        if ($this->model('Role')->countAccess($datauser['role'], $controller) > 0 ) {
            return true;
        } else {
            return false;
        }

    }

    public function UserCheckActive($username) : bool 
    {
        if($this->model('User')->checkUserActive($username) > 0){
            return true;
        } else {
            return false;
        }
    }

    public function MenuAccessCheck($controller, $role): bool 
    {
        if($this->model('Role')->countAccess($role, $controller) > 0){
            return true;
        } else {
            return false;
        }
    }

    public function getDetail($id_role)
    {
        $data['controller'] = $this->model('Menu')->getMenuAllActive();

        $detialakses = [];

        foreach ($data['controller'] as $ctr) {
            $aksesinfo = "";
            $aksesinfo = $this->model('Role')->getAccessInfo($id_role, $ctr['id']);

            if(! empty($aksesinfo)){
                $detialakses[] = [
                    "title" => $ctr['title'],
                    "url" => $ctr['url'],
                    "role" => $aksesinfo['id_role'],
                    "controller" => $aksesinfo['controller'],
                    "akses" => "1",
                    "create" => $aksesinfo['create_data'],
                    "update" => $aksesinfo['update_data'],
                    "delete" => $aksesinfo['delete_data'],
                    "print" => $aksesinfo['print_data'],
                    "import" => $aksesinfo['import_data'],
                ];
            } else {
                $detialakses[] = [
                    "title" => $ctr['title'],
                    "url" => $ctr['url'],
                    "role" => $id_role,
                    "controller" => $ctr['id'],
                    "akses" => "0",
                    "create" => "0",
                    "update" => "0",
                    "delete" => "0",
                    "print" => "0",
                    "import" => "0",
                ];
            }

        }
        
        return $detialakses;
    }

}