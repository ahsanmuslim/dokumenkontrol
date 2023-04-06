<?php

use Teckindo\DokumenKontrol\App\Database;

class Role 
{
    private $db;
    private $table = 'dc_role'
;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getRoleAll()
    {
        $query = "SELECT * FROM ". $this->table;

		$this->db->query($query);
		return $this->db->resultSet();
    }

    public function getRoleInfo($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id =:id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function checkRole($role)
    {
        $query = "SELECT count(id) FROM " . $this->table . " WHERE role =:role";
        $this->db->query($query); 
		$this->db->bind ( 'role', $role );

		return $this->db->numRow();
    }

    public function checkRoleAkses($id)
    {
        $query = "SELECT count(role) FROM dc_user WHERE role=:id";
        $this->db->query($query); 
		$this->db->bind ( 'id', $id );

		return $this->db->numRow();
    }

    public function saveData($data)
    {
        $query = "INSERT INTO " . $this->table . "(id, role) VALUES (:id, :role)";

        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        $this->db->bind('role', $data['role']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateData($data)
    {
        $query = "UPDATE " . $this->table . " SET role =:role WHERE id =:id";

        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        $this->db->bind('role', $data['role']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteData ($data): int
	{   
        //Hapus di user_acces
        $query = " DELETE FROM dc_user_acces WHERE role =:id ";
		$this->db->query($query);
		$this->db->bind('id', $data['id']);
		$this->db->execute();

        //Hapus di tabel role
		$query = " DELETE FROM " . $this->table . " WHERE id =:id ";
		$this->db->query($query);
		$this->db->bind('id', $data['id']);
		$this->db->execute();

		return $this->db->rowCount();
	}

    public function countAccess($role, $controller)
    {
        $query = "SELECT a.role, c.role, a.controller, b.url FROM dc_user_acces as a
        JOIN dc_controller as b ON b.id=a.controller 
        JOIN dc_role as c ON c.id=a.role 
        WHERE a.role =:role AND b.url =:controller";
        $this->db->query($query);
        $this->db->bind('role', $role);
        $this->db->bind('controller', $controller);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getAccessInfo($role, $controller)
    {
        $query = "SELECT a.role AS id_role, b.role, a.controller, a.create_data, a.update_data, a.delete_data, a.print_data, a.import_data
        FROM dc_user_acces as a JOIN dc_role as b ON b.id=a.role 
        WHERE a.role =:role AND a.controller=:controller";

        $this->db->query($query);
        $this->db->bind('role', $role);
        $this->db->bind('controller', $controller);
        return $this->db->single();
    }

    public function updateAksesData($role, $controller, $count, $createlist, $updatelist, $deletelist, $printlist, $importlist)
    {
        $query = "DELETE FROM dc_user_acces WHERE role =:role";
        $this->db->query($query);
        $this->db->bind('role', $role);
        $this->db->execute();

        for ($i = 0; $i < $count; $i++) {
            $query = "INSERT INTO dc_user_acces (id, role, controller)  VALUES ( NULL, :role, :controller)";
            $this->db->query($query);
            $this->db->bind('role', $role);
            $this->db->bind('controller', $controller[$i]);
            $this->db->execute();
        }

        if (!empty($createlist)) {
            foreach ($createlist as $cl) :
                $query = "UPDATE dc_user_acces SET 
                        create_data = 1
                        WHERE role =:role AND controller =:controller";
                $this->db->query($query);
                $this->db->bind('role', $role);
                $this->db->bind('controller', $cl);
                $this->db->execute();
            endforeach;
        }

        if (!empty($updatelist)) {
            foreach ($updatelist as $ul) :
                $query = "UPDATE dc_user_acces SET 
                        update_data = 1
                        WHERE role =:role AND controller =:controller";
                $this->db->query($query);
                $this->db->bind('role', $role);
                $this->db->bind('controller', $ul);
                $this->db->execute();
            endforeach;
        }

        if (!empty($deletelist)) {
            foreach ($deletelist as $dl) :
                $query = "UPDATE dc_user_acces SET 
                        delete_data = 1
                        WHERE role =:role AND controller =:controller";
                $this->db->query($query);
                $this->db->bind('role', $role);
                $this->db->bind('controller', $dl);
                $this->db->execute();
            endforeach;
        }

        if (!empty($printlist)) {
            foreach ($printlist as $pl) :
                $query = "UPDATE dc_user_acces SET 
                        print_data = 1
                        WHERE role =:role AND controller =:controller";
                $this->db->query($query);
                $this->db->bind('role', $role);
                $this->db->bind('controller', $pl);
                $this->db->execute();
            endforeach;
        }

        if (!empty($importlist)) {
            foreach ($importlist as $il) :
                $query = "UPDATE dc_user_acces SET 
                        import_data = 1
                        WHERE role =:role AND controller =:controller";
                $this->db->query($query);
                $this->db->bind('role', $role);
                $this->db->bind('controller', $il);
                $this->db->execute();
            endforeach;
        }


        return $this->db->rowCount();
    }

}