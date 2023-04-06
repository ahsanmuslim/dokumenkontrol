<?php
namespace Teckindo\DokumenKontrol\App;

require_once __DIR__ . '/../Config/config.php';
require_once __DIR__ . '/../Helper/Flasher.php';

class Controller 
{
    //Fungsi untuk memanggil view
    public function view($view, $data = [])
    {
        require_once  __DIR__ . '/../View/'.$view.'.php';
    }

    //Fungsi untuk memanggil model
    public function model($model)
    {
        require_once __DIR__ . '/../Model/'.$model.'.php';
        return new $model;
    }
}