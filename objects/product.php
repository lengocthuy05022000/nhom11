<?php
class Product
{
    private $conn;
    private $table_name = "t_sanpham";
    public $id, $name, $description, $price, $danhmuc_id, $danhmuc_name;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = "SELECT dm.name as danhmuc_name,sp.id,sp.name,sp.description,sp.price,sp.danhmuc_id 
    FROM " . $this->table_name . " as sp
    left join t_danhmuc as dm on sp.danhmuc_id = dm.id
    order by sp.name ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=?";//xóa theo id
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    //Insert

    function Insert() {
    	$query="INSERT INTO".$this->table_name."
    	SET name=:name, price=:price,description=:description, category_id=:category_id";
    	$stmt=$this-> conn->prepare($query);

    	$this->name=htmlspecialchars(strip_tags($this->name));
    	$this->price=htmlspecialchars(strip_tags($this->price));
    	$this->description=htmlspecialchars(strip_tags($this->description));
    	$this->category_id=htmlspecialchars(strip_tags($this->category_idprice));

    	$stmt->bindParam(" :name.", $this->name);
    	$stmt->bindParam(" :price", $this->price);
    	$stmt->bindParam(" :description", $this->description);
    	$stmt->category_id(" :category_id", $this->category_id);

    	if($stmt->execute()) {
    		return true;
    	}
    	
    	return false;

    }
     //update

    function update() {
    	$query="update".$this->table_name."
    	SET name=:name, price=:price,description=:description, category_id=:category_id";
    	$stmt=$this-> conn->prepare($query);

    	$this->name=htmlspecialchars(strip_tags($this->name));
    	$this->price=htmlspecialchars(strip_tags($this->price));
    	$this->description=htmlspecialchars(strip_tags($this->description));
    	$this->category_id=htmlspecialchars(strip_tags($this->category_idprice));
        $stmt->bindParam(" :id.", $this->id);
    	$stmt->bindParam(" :name.", $this->name);
    	$stmt->bindParam(" :price", $this->price);
    	$stmt->bindParam(" :description", $this->description);
    	$stmt->category_id(" :category_id", $this->category_id);

    	if($stmt->execute()) {
    		return true;
    	}
    	
    	return false;

    }
}
?>