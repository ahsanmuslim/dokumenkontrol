<?php

use Teckindo\DokumenKontrol\App\Database;

class PostDocument 
{
    private $db;
    private $table = "dc_post_dokumen";

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllPostDokumen()
    {
        $query = "SELECT * FROM  " . $this->table ." as a
        JOIN dc_header_surat as b ON a.header=b.id
        ORDER by a.create_at DESC";

		$this->db->query($query);
		return $this->db->resultSet();
    }

    public function getPostDokumenByDiv($divisi)
    {
        $query = "SELECT * FROM  " . $this->table ." as a
        JOIN dc_header_surat as b ON a.header=b.id WHERE a.divisi =:divisi 
        ORDER by a.create_at DESC";

		$this->db->query($query);
        $this->db->bind('divisi', $divisi);
		return $this->db->resultSet();
    }

    public function getHeaderSurat()
    {
        $query = "SELECT * FROM  dc_header_surat";

		$this->db->query($query);
		return $this->db->resultSet();
    }

    public function getPostDokumen($no_surat)
    {
        $query = "SELECT a.*, b.nama_perusahaan, b.logo, c.nama_user, c.approval_ttd FROM  dc_post_dokumen as a
        JOIN dc_header_surat as b ON a.header=b.id 
        JOIN dc_user as c ON a.create_by=c.id_user 
        WHERE no_surat =:no_surat";

        $this->db->query($query);
		$this->db->bind('no_surat', $no_surat);
		return $this->db->Single();
    }

    public function getAllLampiran()
    {
        $query = "SELECT no_surat, nama_lampiran FROM dc_lampiran";
        $this->db->query($query);
		return $this->db->resultSet();
    }

    public function getLampiran($no_surat)
    {
        $query = "SELECT no_surat, nama_lampiran FROM dc_lampiran WHERE no_surat=:no_surat";
        $this->db->query($query);
		$this->db->bind('no_surat', $no_surat);
		return $this->db->resultSet();
    }

    public function getPostDokumenByNo($no_surat)
    {
        $query = "SELECT * FROM dc_post_dokumen WHERE no_surat=:no_surat";
        $this->db->query($query);
		$this->db->bind('no_surat', $no_surat);
		return $this->db->Single();
    }

    public function getLastPostDocument($divisi, $jenis)
    {
        $query = "SELECT no_surat FROM dc_post_dokumen 
        WHERE divisi=:divisi AND jenis =:jenis ORDER BY create_at DESC LIMIT 1";
        $this->db->query($query);
		$this->db->bind('divisi', $divisi);
		$this->db->bind('jenis', $jenis);

		return $this->db->Single();
    }

    public function deleteData ($data): int
	{
		$query = " DELETE FROM " . $this->table . " WHERE no_surat =:no_surat ";

		$this->db->query($query);
		$this->db->bind('no_surat', $data['no_surat']);
		$this->db->execute();

        $query = " DELETE FROM dc_lampiran WHERE no_surat =:no_surat ";

		$this->db->query($query);
		$this->db->bind('no_surat', $data['no_surat']);
		$this->db->execute();

		return $this->db->rowCount();
	}


    public function saveData($data, $id_user, $divisi)
    {
        $query = "INSERT INTO " . $this->table . " 
        (no_surat, lokasi, header, perihal, tanggal_surat, salam, isi_surat, revisi, status, create_at, create_by, jenis, divisi) 
        VALUES  
        (:no_surat, :lokasi, :header, :perihal, :tanggal_surat, :salam, :isi_surat, :revisi, :status, now(), :create_by, :jenis, :divisi)";

        $this->db->query($query);

        $this->db->bind('no_surat', $data['nosurat']);
        $this->db->bind('lokasi', $data['lokasi']);
        $this->db->bind('header', $data['header']);
        $this->db->bind('perihal', $data['perihal']);
        $this->db->bind('tanggal_surat', $data['tanggal']);
        $this->db->bind('salam', $data['salam']);
        $this->db->bind('isi_surat', $data['body']);
        $this->db->bind('revisi', 0);
        $this->db->bind('status', 'aktif');
        $this->db->bind('create_by', $id_user);
        $this->db->bind('jenis', $data['jenis']);
        $this->db->bind('divisi', $divisi);

        $this->db->execute();

        foreach ($data['lampiran'] as $val) {
            if(! empty($val)){
                $query = "INSERT INTO dc_lampiran (no_surat, nama_lampiran) VALUES (:no_surat, :lampiran)";
        
                $this->db->query($query);
                $this->db->bind('no_surat', $data['nosurat']);
                $this->db->bind('lampiran', $val);
                $this->db->execute();
            }
        }

        return $this->db->rowCount();
    }

    public function updateData($data, $id_user)
    {
        $query = "UPDATE " . $this->table . " SET 
                    lokasi =:lokasi,
                    header =:header,
                    perihal =:perihal,
                    tanggal_surat =:tanggal_surat,
                    salam =:salam,
                    isi_surat =:isi_surat,
                    updated_by =:updated_by,
                    updated_at = now()
					WHERE no_surat =:no_surat";

        $this->db->query($query);

        $this->db->bind('no_surat', $data['nosurat']);
        $this->db->bind('lokasi', $data['lokasi']);
        $this->db->bind('header', $data['header']);
        $this->db->bind('perihal', $data['perihal']);
        $this->db->bind('tanggal_surat', $data['tanggal']);
        $this->db->bind('salam', $data['salam']);
        $this->db->bind('isi_surat', $data['body']);
        $this->db->bind('updated_by', $id_user);

        $this->db->execute();

        return $this->db->rowCount();
    }



}