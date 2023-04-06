<?php

use Teckindo\DokumenKontrol\App\Database;

class Jenis 
{
    private $db;
    private $table = "dc_jenis_surat";

    public function __construct()
    {
        $this->db = new Database();
    }

    //Ambil semu data divisi
    public function getJenisAll()
    {
        $query = "SELECT * FROM ". $this->table;

		$this->db->query($query);
		return $this->db->resultSet();
    }

    public function getJenisInfo($kd_jenis)
    {
        $query = "SELECT * FROM ". $this->table ." WHERE kd_jenis=:kd_jenis";

        $this->db->query($query);
		$this->db->bind('kd_jenis', $kd_jenis);
		return $this->db->Single();
    }

    public function saveData($data)
    {
        $query = "INSERT INTO " . $this->table . " 
        (kd_jenis, jenis, url_menu) 
        VALUES  
        (:kd_jenis, :jenis, :url_menu)";

        $this->db->query($query);

        $this->db->bind('kd_jenis', $data['kd_jenis']);
        $this->db->bind('jenis', $data['jenis']);
        $this->db->bind('url_menu', $data['flag_url']);
        $this->db->execute();
        
        return $this->db->rowCount();
    }
    
    public function updateData($data)
    {
        $query = "UPDATE " . $this->table . " SET 
        jenis =:jenis,
        url_menu =:url_menu
        WHERE kd_jenis =:kd_jenis";
        
        $this->db->query($query);
        
        $this->db->bind('kd_jenis', $data['kd_jenis']);
        $this->db->bind('jenis', $data['jenis']);
        $this->db->bind('url_menu', $data['flag_url']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteData ($data): int
	{
		$query = " DELETE FROM " . $this->table . " WHERE kd_jenis =:kd_jenis ";

		$this->db->query($query);
		$this->db->bind('kd_jenis', $data['kd_jenis']);
		$this->db->execute();

		return $this->db->rowCount();
	}

}