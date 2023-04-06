<?php
namespace Teckindo\DokumenKontrol\Helper;

use Teckindo\DokumenKontrol\App\Controller;

class AutoNumber extends Controller
{

    public static function getBulanRomawi()
    {
        $bulan = date('n');
        $romans = array(
            'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'
        );
        return $romans[$bulan-1];
    }

    public function autonum($divisi, $jenis): string
    {
        $lastData = $this->model('PostDocument')->getLastPostDocument($divisi, $jenis);

        if(! $lastData){
            $urutan = "001";
        } else {
            $urutan = (int) substr($lastData['no_surat'], -3);
            $urutan++;
        }
        $nomor = $divisi . '-' . $jenis . '-' . self::getBulanRomawi() . '-' . date("y") . '-' . sprintf("%03s", $urutan);

        return $nomor;
    }   
}