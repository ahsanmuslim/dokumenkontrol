<?php

use Teckindo\DokumenKontrol\App\Database;

class Dashboard 
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    //Ambil semu data dokumen
    public function grafikDokumenByJenis()
    {
        $query = "SELECT c.kd_jenis, c.jenis, count(a.no_surat) as qty FROM  dc_dokumen as a
        RIGHT JOIN dc_jenis_surat as c ON a.jenis_surat=c.kd_jenis 
        GROUP BY c.kd_jenis ORDER BY c.kd_jenis ASC";

		$this->db->query($query);
		return $this->db->resultSet();
    }

    public function grafikDokumenByType()
    {
        $query = "SELECT a.type, count(a.no_surat) as qty FROM  dc_dokumen as a
        GROUP BY a.type";

		$this->db->query($query);
		return $this->db->resultSet();
    }

}