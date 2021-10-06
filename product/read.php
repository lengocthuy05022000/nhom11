<?php
header("Access-Control-Allow-Origin");
header("Content-Type:application/json; charset=UTF-8");

include_once ('../config/database.php');
include_once ('../objects/product.php');

$database=new Database();
$db=$database->getConnection();

$product=new Product($db);

//đọc dữ liệu từ cơ sở dữ liệu
$stmt=$product->read();
$num=$stmt->rowCount();

if($num>0)
{
	$products_arr=array();
	$products_arr["records"]=array();

	while ($row=$stmt->fetch(PDO::FETCH_ASSOC))
	 {
	extract($row);
	$product_item=array(
		"id" => $id,
		"name" => $name,
		"description" => html_entity_decode($description),
		"price" => $price,
		"danhmuc_id" => $danhmuc_id,
		"danhmuc_name" => $danhmuc_name
	);
	array_push($products_arr["records"], $product_item);
	}
	http_response_code(200);
	echo json_encode($products_arr);
	}

?>