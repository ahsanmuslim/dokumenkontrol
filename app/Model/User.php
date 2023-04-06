<?php

use Teckindo\DokumenKontrol\App\Database;

class User 
{
    private $table = "dc_user";
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getUserAll()
    {
        $query = "SELECT a.id_user, a.nama_user, a.username, a.alias, b.role, a.is_active, c.nama_divisi, a.tgl_register  FROM dc_user as a 
        JOIN dc_role as b ON b.id=a.role 
        JOIN dc_divisi as c ON a.kd_divisi=c.kd_divisi 
        ORDER BY b.role ASC";

		$this->db->query($query);
		return $this->db->resultSet();
    }

    //get detail info User
    public function getUserInfo($id_user)
    {
        $query = "SELECT * FROM ". $this->table . " WHERE id_user=:id_user";
        $this->db->query ($query); 
        $this->db->bind ( 'id_user', $id_user );
        return $this->db->single();
    }

    public function getUser()
    {
        $username = $_SESSION['username'];
        $query = "SELECT * FROM " .$this->table. " WHERE username =:username";
        $this->db->query($query);
        $this->db->bind('username', $username);
        return $this->db->single();
    }

    public function checkUserActive($username)
    {
        $query = "SELECT count(id_user) FROM " . $this->table . " WHERE username =:username AND is_active=1";
        $this->db->query($query);
        $this->db->bind('username',$username);
        return $this->db->numRow();
    }

    public function cekUserLogin(string $username, string $password)
    {
        $cekdata = "SELECT * FROM ".$this->table." WHERE username =:username AND password =:password AND is_active=1";
        $this->db->query($cekdata);

        $this->db->bind('username',$username);
        $this->db->bind('password',$password);

        $this->db->execute();
        return $this->db->single();
    }

    public function simpanJWT(string $jwt, string $username): void
    {
        $query = "UPDATE " . $this->table . " SET jwt =:jwt WHERE username =:username";
        $this->db->query($query);

        $this->db->bind("username", $username);
        $this->db->bind("jwt", $jwt);
        $this->db->execute();
    }

    public function hapusJWT(): void
    {
        $username = $_SESSION['username'];
        $query = "UPDATE " . $this->table . " SET jwt = NULL WHERE username =:username";
        $this->db->query($query);

        $this->db->bind("username", $username);
        $this->db->execute();
    }

    public function update($data, $nama_file)
    {
        $query = "UPDATE c SET 
                    nama_user =:namauser,
                    profile =:profile
                    WHERE id_user =:id_user";

        $this->db->query($query);

        $this->db->bind('id_user', $data['id_user']);
        $this->db->bind('namauser', $data['namauser']);
        $this->db->bind('profile', $nama_file);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function cekUsername()
    {
        $username = $_POST['username'];
        $query = "SELECT count(id_user) FROM " . $this->table . " WHERE username = '$username'";
        $this->db->query($query);
        return $this->db->numRow();
    }

    public function saveData($data, $create_by)
    {
        $id_user = bin2hex(random_bytes(8));

        $query = "INSERT INTO " . $this->table . " 
        (id_user, username, nama_user, alias, role, password, tgl_register, profile, is_active, create_by, kd_divisi)
        VALUES  
        (:id_user, :username, :namauser, :alias, :role, :password, NOW(), 'default.jpg', :is_active, :create_by, :kd_divisi)";

        $this->db->query($query);

        $this->db->bind('id_user', $id_user);
        $this->db->bind('username', $data['username']);
        $this->db->bind('namauser', $data['namauser']);
        $this->db->bind('alias', $data['alias']);
        $this->db->bind('role', $data['role']);
        $this->db->bind('password', SHA1($data['password']));
        $this->db->bind('is_active', $data['status']);
        $this->db->bind('create_by', $create_by);
        $this->db->bind('kd_divisi', $data['kd_divisi']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateData($data)
    {
        $query = "UPDATE " . $this->table . " SET 
                    nama_user =:namauser,
                    role =:role,
                    alias =:alias,
					is_active =:status,
					kd_divisi =:kd_divisi 
					WHERE id_user =:id_user";

        $this->db->query($query);

        $this->db->bind('id_user', $data['id_user']);
        $this->db->bind('namauser', $data['namauser']);
        $this->db->bind('role', $data['role']);
        $this->db->bind('alias', $data['alias']);
        $this->db->bind('status', $data['status']);
        $this->db->bind('kd_divisi', $data['kd_divisi']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateTTD($data, $ttd)
    {
        $query = "UPDATE " . $this->table . " SET 
                    approval_ttd =:ttduser
					WHERE id_user =:id_user";

        $this->db->query($query);

        $this->db->bind('id_user', $data['id_user']);
        $this->db->bind('ttduser', $ttd);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteData ($data): int
	{
		$query = " DELETE FROM " . $this->table . " WHERE id_user =:id_user ";

		$this->db->query($query);
		$this->db->bind('id_user', $data['id_user']);
		$this->db->execute();

		return $this->db->rowCount();
	}

}