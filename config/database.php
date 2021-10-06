<?php 
class Database{
private $host="localhost";
private $db_name="ql_banhang";
private $username ="root";
private $password ="";
public $conn;
//phuong thuc
public function getConnection(){
	$this->conn=null;
	try{
		$this->conn=new PDO("mysql:host=".$this->host.";dbname=".$this->db_name,$this->username,$this->password);
		$this->conn->exec("set names utf8 ");
	} catch(PDOException $exception){
		echo "Loi ket noi";
	}
	return $this->conn;
 }
}
?>