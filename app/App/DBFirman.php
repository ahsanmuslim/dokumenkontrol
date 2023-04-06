<?php
namespace Teckindo\DokumenKontrol\App;

require_once __DIR__ . '/../Config/config.php';

use PDO;
use PDOException;
use function Teckindo\DokumenKontrol\Config\Conn2;

class DBFirman 
{
    //database handler & statement
    private $dbh;
    private $stmt;

    public function __construct()
    {
		$koneksi = Conn2();
        //data source name
        $dsn = 'mysql:host='. $koneksi['host'] . ';port=' . $koneksi['port'] . ';dbname=' . $koneksi['name'];

		//variable option untuk optimasi koneksi ke database 
		$option = [
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		];

        //membuat object PDO
		try {
			$this->dbh = new PDO ($dsn, $koneksi['user'] , $koneksi['pass'] , $option );
		} catch (PDOException $e) {
			die ($e->getMessage());
		}
    }

    public function query ($query) 
	{
		$this->stmt = $this->dbh->prepare($query);
	}


	public function bind ( $param , $value , $type = null )
	{
		if ( is_null($type) ){
			switch (true) {
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;
				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;
				default :
					$type = PDO::PARAM_STR;
			}
		}

	$this->stmt->bindValue ( $param, $value, $type );

	}


	public function execute ()
	{
		$this->stmt->execute();
	}


	public function resultSet ()
	{
		$this->execute();
		return $this->stmt->fetchAll (PDO::FETCH_ASSOC);
	}


	public function single ()
	{
		$this->execute();
		return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}


	public function rowCount ()
	{
		return $this->stmt->rowCount();
	}

	public function numRow ()
	{
		$this->execute();
		$count = $this->stmt->fetch(PDO::FETCH_NUM);
		return reset($count);
	}


}