<?php

use Teckindo\DokumenKontrol\App\Database;

class Document 
{
    private $db;
    private $table = "dc_dokumen";

    public function __construct()
    {
        $this->db = new Database();
    }

    //Ambil semu data dokumen
    public function getDokumenAll()
    {
        $query = "SELECT * FROM  dc_dokumen as a
        JOIN dc_divisi as b ON a.kd_divisi=b.kd_divisi 
        JOIN dc_jenis_surat as c ON a.jenis_surat=c.kd_jenis";

		$this->db->query($query);
		return $this->db->resultSet();
    }

    //Ambil semu data dokumen
    public function getDokumenAllByDivisi($kd_divisi)
    {
        $query = "SELECT * FROM  dc_dokumen as a
        JOIN dc_divisi as b ON a.kd_divisi=b.kd_divisi 
        JOIN dc_jenis_surat as c ON a.jenis_surat=c.kd_jenis
        WHERE a.kd_divisi =:kd_divisi";

        $this->db->query($query);
        $this->db->bind('kd_divisi', $kd_divisi);
        return $this->db->resultSet();
    }

    public function getDokumenByJenis($url_menu)
    {
        $query = "SELECT * FROM  dc_dokumen as a
        JOIN dc_divisi as b ON a.kd_divisi=b.kd_divisi 
        JOIN dc_jenis_surat as c ON a.jenis_surat=c.kd_jenis
        WHERE c.url_menu=:url_menu";

		$this->db->query($query);
        $this->db->bind('url_menu', $url_menu);
		return $this->db->resultSet();
    }

    public function getDokumenByJenisByDivisi($url_menu, $kd_divisi)
    {
        $query = "SELECT * FROM  dc_dokumen as a
        JOIN dc_divisi as b ON a.kd_divisi=b.kd_divisi 
        JOIN dc_jenis_surat as c ON a.jenis_surat=c.kd_jenis
        WHERE c.url_menu=:url_menu AND a.kd_divisi =:kd_divisi";

		$this->db->query($query);
        $this->db->bind('url_menu', $url_menu);
        $this->db->bind('kd_divisi', $kd_divisi);
		return $this->db->resultSet();
    }

    public function getShareDocument($kd_divisi)
    {
        $query = "SELECT a.no_surat, a.kd_divisi, a.tanggal_surat, a.perihal, a.asal_surat, b.nama_divisi, c.jenis, d.kd_divisi AS distribusi  
        FROM  dc_dokumen AS a JOIN dc_divisi as b ON a.kd_divisi=b.kd_divisi 
        JOIN dc_jenis_surat as c ON a.jenis_surat=c.kd_jenis 
        JOIN dc_distribusi_dokumen AS d ON a.no_surat=d.no_surat
        WHERE d.kd_divisi =:kd_divisi AND a.kd_divisi <> :kd_divisi";

		$this->db->query($query);
        $this->db->bind('kd_divisi', $kd_divisi);
		return $this->db->resultSet();
    }

    public function cekNomorSurat($nosurat)
    {
        $query = "SELECT count(id) FROM " . $this->table . " WHERE no_surat = '$nosurat'";
        $this->db->query($query);
        return $this->db->numRow();
    }

    public function getDokumenInfo($no_surat)
    {
        $query = "SELECT a.*, b.nama_divisi, c.jenis, d.nama_user as create_by, e.nama_user as update_by
        FROM  dc_dokumen as a
        JOIN dc_divisi as b ON a.kd_divisi=b.kd_divisi 
        JOIN dc_jenis_surat as c ON a.jenis_surat=c.kd_jenis
        JOIN dc_user as d ON a.id_user=d.id_user
        LEFT JOIN dc_user as e ON a.updated_by=e.id_user 
        WHERE no_surat =:no_surat";

        $this->db->query($query);
		$this->db->bind('no_surat', $no_surat);
		return $this->db->Single();
    }

    public function getDetailDokumen($no_surat)
    {
        $query = "SELECT * FROM  dc_detail_dokumen WHERE no_surat =:no_surat";

        $this->db->query($query);
		$this->db->bind('no_surat', $no_surat);
		return $this->db->resultSet();
    }

    public function getNamaFileDetail($no_surat)
    {
        $query = "SELECT nama_file FROM  dc_detail_dokumen WHERE no_surat =:no_surat";

        $this->db->query($query);
		$this->db->bind('no_surat', $no_surat);
		return $this->db->resultSet();
    }

    public function getNamaFile($no_surat)
    {
        $query = "SELECT nama_file FROM  dc_dokumen WHERE no_surat =:no_surat";

        $this->db->query($query);
		$this->db->bind('no_surat', $no_surat);
		return $this->db->Single();
    }

    public function getDetailShare($no_surat)
    {
        $query = "SELECT a.kd_divisi, b.nama_divisi FROM  dc_distribusi_dokumen as a JOIN dc_divisi as b ON a.kd_divisi=b.kd_divisi 
        WHERE no_surat =:no_surat";

        $this->db->query($query);
		$this->db->bind('no_surat', $no_surat);
		return $this->db->resultSet();
    }


    public function getDokumenAkses($no_surat)
    {
        $query = "SELECT no_surat, kd_divisi FROM  dc_distribusi_dokumen WHERE no_surat =:no_surat";

        $this->db->query($query);
		$this->db->bind('no_surat', $no_surat);
		return $this->db->resultSet();
    }

    public function getDokumenByName($nama_file)
    {
        $query = "SELECT * FROM  dc_detail_dokumen WHERE nama_file =:nama_file";

        $this->db->query($query);
		$this->db->bind('nama_file', $nama_file);
		return $this->db->Single();
    }
    
    public function getJenisByUrl($url_menu)
    {
        $query = "SELECT * FROM dc_jenis_surat WHERE url_menu=:url_menu";

        $this->db->query($query);
        $this->db->bind('url_menu', $url_menu);
        return $this->db->Single();
    }

    public function saveData($data, $added)
    {
        //simpan ke tabel dokumen
        $query = "INSERT INTO " . $this->table . " 
        (no_surat, kd_divisi, type, jenis_surat, asal_surat, tanggal_surat, perihal, lampiran, kepada, keterangan, nama_file, file_path, id_user, created_at, size, revisi) 
        VALUES  
        (:no_surat, :kd_divisi, :type, :jenis_surat, :asal_surat, :tanggal_surat, :perihal, :lampiran, :kepada, :keterangan, :nama_file, :file_path, :id_user, now(), :size, 0)";

        $this->db->query($query);
        $this->db->bind('no_surat', $data['nosurat']);
        $this->db->bind('kd_divisi', $data['divisi']);
        $this->db->bind('type', $data['type']);
        $this->db->bind('jenis_surat', $data['jenis']);
        $this->db->bind('asal_surat', $data['asalsurat']);
        $this->db->bind('tanggal_surat', $data['tanggal']);
        $this->db->bind('perihal', $data['perihal']);
        $this->db->bind('lampiran', $data['lampiran']);
        $this->db->bind('kepada', $data['kepada']);
        $this->db->bind('keterangan', $data['ket']);
        $this->db->bind('nama_file', $added['nama_file']);
        $this->db->bind('file_path', 'file/pdf');
        $this->db->bind('id_user', $added['id_user']);
        $this->db->bind('size', $added['ukuran_file']);
        $this->db->execute();

        //simpan ke tabel distribusi Dokumen
        foreach ($data['akses'] as $val) {
            $query = "INSERT INTO dc_distribusi_dokumen (no_surat, kd_divisi) VALUES (:no_surat, :kd_divisi)";
    
            $this->db->query($query);
            $this->db->bind('no_surat', $data['nosurat']);
            $this->db->bind('kd_divisi', $val);
            $this->db->execute();
        }

        //simpan ke tabel detail dokumen
        $query = "INSERT INTO dc_detail_dokumen 
        (no_surat, tanggal_revisi, revisi, id_user, status, nama_file, file_path, size)
        VALUES 
        (:no_surat, now(), 0, :id_user, :status, :nama_file, :file_path, :size)";

        $this->db->query($query);
        $this->db->bind('no_surat', $data['nosurat']);
        $this->db->bind('nama_file', $added['nama_file']);
        $this->db->bind('file_path', 'file/pdf');
        $this->db->bind('id_user', $added['id_user']);
        $this->db->bind('status', 'aktif');
        $this->db->bind('size', $added['ukuran_file']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateDokumen($data, $added)
    {
        $query = "UPDATE " . $this->table . " SET 
                    kd_divisi =:kd_divisi,
                    type =:type,
                    jenis_surat =:jenis_surat,
                    asal_surat =:asal_surat,
                    tanggal_surat =:tanggal_surat,
                    perihal =:perihal,
                    lampiran =:lampiran,
                    kepada =:kepada,
                    keterangan =:keterangan,
                    updated_at = now(),
                    updated_by =:id_user,
                    size =:size,
                    nama_file =:nama_file,
                    revisi =:revisi
					WHERE no_surat =:no_surat";

        $this->db->query($query);
        $this->db->bind('kd_divisi', $data['divisi']);
        $this->db->bind('type', $data['type']);
        $this->db->bind('jenis_surat', $data['jenis']);
        $this->db->bind('asal_surat', $data['asalsurat']);
        $this->db->bind('tanggal_surat', $data['tanggal']);
        $this->db->bind('perihal', $data['perihal']);
        $this->db->bind('lampiran', $data['lampiran']);
        $this->db->bind('kepada', $data['kepada']);
        $this->db->bind('keterangan', $data['ket']);
        $this->db->bind('id_user', $added['id_user']);
        $this->db->bind('size', $added['ukuran_file']);
        $this->db->bind('nama_file', $added['nama_file']);
        $this->db->bind('revisi', $added['revisi']);
        $this->db->bind('no_surat', $data['nosurat']);
        $this->db->execute();


        //delete akses lama & update akses baru ke tabel distribusi Dokumen
        $query = " DELETE FROM dc_distribusi_dokumen WHERE no_surat =:no_surat ";

		$this->db->query($query);
		$this->db->bind('no_surat', $data['nosurat']);
		$this->db->execute();

        foreach ($data['akses'] as $val) {
            $query = "INSERT INTO dc_distribusi_dokumen (no_surat, kd_divisi) VALUES (:no_surat, :kd_divisi)";
    
            $this->db->query($query);
            $this->db->bind('no_surat', $data['nosurat']);
            $this->db->bind('kd_divisi', $val);
            $this->db->execute();
        }

        //simpan ke tabel detail dokumen
        $query = "INSERT INTO dc_detail_dokumen 
        (no_surat, tanggal_revisi, revisi, id_user, status, nama_file, file_path, size)
        VALUES 
        (:no_surat, now(), :revisi, :id_user, :status, :nama_file, :file_path, :size)";

        $this->db->query($query);
        $this->db->bind('no_surat', $data['nosurat']);
        $this->db->bind('nama_file', $added['nama_file']);
        $this->db->bind('file_path', 'file/pdf');
        $this->db->bind('id_user', $added['id_user']);
        $this->db->bind('size', $added['ukuran_file']);
        $this->db->bind('revisi', $added['revisi']);
        $this->db->bind('status', 'revisi');
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateInfo($data, $added)
    {
        $query = "UPDATE " . $this->table . " SET 
                    kd_divisi =:kd_divisi,
                    type =:type,
                    jenis_surat =:jenis_surat,
                    asal_surat =:asal_surat,
                    tanggal_surat =:tanggal_surat,
                    perihal =:perihal,
                    lampiran =:lampiran,
                    kepada =:kepada,
                    keterangan =:keterangan,
                    updated_at = now(),
                    updated_by =:id_user
					WHERE no_surat =:no_surat";

        $this->db->query($query);
        $this->db->bind('kd_divisi', $data['divisi']);
        $this->db->bind('type', $data['type']);
        $this->db->bind('jenis_surat', $data['jenis']);
        $this->db->bind('asal_surat', $data['asalsurat']);
        $this->db->bind('tanggal_surat', $data['tanggal']);
        $this->db->bind('perihal', $data['perihal']);
        $this->db->bind('lampiran', $data['lampiran']);
        $this->db->bind('kepada', $data['kepada']);
        $this->db->bind('keterangan', $data['ket']);
        $this->db->bind('id_user', $added['id_user']);
        $this->db->bind('no_surat', $data['nosurat']);
        $this->db->execute();

        //delete akses lama & update akses baru ke tabel distribusi Dokumen
        $query = " DELETE FROM dc_distribusi_dokumen WHERE no_surat =:no_surat ";

        $this->db->query($query);
        $this->db->bind('no_surat', $data['nosurat']);
        $this->db->execute();

        foreach ($data['akses'] as $val) {
            $query = "INSERT INTO dc_distribusi_dokumen (no_surat, kd_divisi) VALUES (:no_surat, :kd_divisi)";
    
            $this->db->query($query);
            $this->db->bind('no_surat', $data['nosurat']);
            $this->db->bind('kd_divisi', $val);
            $this->db->execute();
        }

        return $this->db->rowCount();
    }

    public function saveShare($data)
    {
        //delete akses lama & update akses baru ke tabel distribusi Dokumen
        $query = " DELETE FROM dc_distribusi_dokumen WHERE no_surat =:no_surat ";

        $this->db->query($query);
        $this->db->bind('no_surat', $data['nosurat']);
        $this->db->execute();

        foreach ($data['akses'] as $val) {
            $query = "INSERT INTO dc_distribusi_dokumen (no_surat, kd_divisi) VALUES (:no_surat, :kd_divisi)";
    
            $this->db->query($query);
            $this->db->bind('no_surat', $data['nosurat']);
            $this->db->bind('kd_divisi', $val);
            $this->db->execute();
        }

        return $this->db->rowCount();
    }

    public function deleteData ($data): int
	{
		$query = " DELETE FROM " . $this->table . " WHERE no_surat =:no_surat ";

		$this->db->query($query);
		$this->db->bind('no_surat', $data['no_surat']);
		$this->db->execute();

        $query = " DELETE FROM dc_detail_dokumen WHERE no_surat =:no_surat ";

		$this->db->query($query);
		$this->db->bind('no_surat', $data['no_surat']);
		$this->db->execute();

        $query = " DELETE FROM dc_distribusi_dokumen WHERE no_surat =:no_surat ";

		$this->db->query($query);
		$this->db->bind('no_surat', $data['no_surat']);
		$this->db->execute();

		return $this->db->rowCount();
	}

}