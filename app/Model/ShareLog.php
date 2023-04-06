<?php

use Teckindo\DokumenKontrol\App\Database;

class ShareLog 
{

    private $db;
    private $table = "dc_share_log";

    public function __construct()
    {
        $this->db = new Database();
    }


    //Ambil data karywan dari DB firmanindonesia.h_karyawan
    public function getDataNomorHPKaryawan()
    {
        $query = "SELECT a.nik, a.nama, a.no_telp, a.status  
        FROM firman_indonesia.h_karyawan AS a 
        WHERE a.no_telp <> '' AND a.no_telp <> '-' AND a.status = 'aktif'
        ORDER BY a.nama";

        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getNomor($nama)
    {
        $query = "SELECT a.no_telp FROM  firman_indonesia.h_karyawan as a WHERE a.nama =:nama";

        $this->db->query($query);
        $this->db->bind('nama', $nama);
        return $this->db->Single();
    }


    //Ambil data karywan dari DB firmanindonesia.h_karyawan
    public function getDataEmailKaryawan()
    {
        $query = "SELECT a.nik, a.nama, a.email, a.status  
        FROM firman_indonesia.h_karyawan AS a 
        WHERE a.email <> '' AND a.email <> '-' AND a.status = 'aktif'
        ORDER BY a.nama";

        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getLogShare($no_surat, $id_user)
    {
        $query = "SELECT a.jenis, a.tanggal, a.penerima, a.pengirim, a.keterangan, a.via, a.no_surat, b.nama_user   
        FROM dc_share_log AS a JOIN dc_user as b ON a.pengirim=b.id_user  
        WHERE a.no_surat =:no_surat AND a.pengirim =:id_user 
        ORDER BY a.tanggal DESC";

        $this->db->query($query);
        $this->db->bind('no_surat', $no_surat);
        $this->db->bind('id_user', $id_user);
        return $this->db->resultSet();
    }
    
    
    //Simpan log share Via email / WA ke table dc_share_log
    public function saveLogWAShare($data)
    {
        //simpan ke tabel detail dokumen
        $query = "INSERT INTO " . $this->table . " 
        (tanggal, no_surat, pengirim, penerima, via, keterangan, jenis)
        VALUES 
        (now(), :no_surat, :pengirim, :penerima, :via, :keterangan, :jenis)";

        $this->db->query($query);
        $this->db->bind('no_surat', $data['nosurat']);
        $this->db->bind('pengirim', $data['pengirim']);
        $this->db->bind('penerima', $data['penerima']);
        $this->db->bind('via', $data['via']);
        $this->db->bind('keterangan', $data['keterangan']);
        $this->db->bind('jenis', $data['jenis']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    //Simpan log share Via email / WA ke table dc_share_log
    public function saveLogEmailShare($data)
    {
        //simpan ke tabel shre log
        foreach ($data as $d) {            
            $query = "INSERT INTO " . $this->table . " 
            (tanggal, no_surat, pengirim, penerima, via, keterangan)
            VALUES 
            (now(), :no_surat, :pengirim, :penerima, :via, :keterangan)";
    
            $this->db->query($query);
            $this->db->bind('no_surat', $d['nosurat']);
            $this->db->bind('pengirim', $d['pengirim']);
            $this->db->bind('penerima', $d['penerima']);
            $this->db->bind('via', $d['via']);
            $this->db->bind('keterangan', $d['keterangan']);
    
            $this->db->execute();
        }

        return $this->db->rowCount();
    }

}