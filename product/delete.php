<?php
header("Access-Control_Allow-Origin");
header("Content-Type:application/json; charset=UTF-8");
header("Access-Control_Allow-Method;POST");
header("Access-Control-Max-Age:3600");
header("Access-Control-Allow-Header:Content-Type, Access-Control-Allow-Header,Authorization, X-Requested-With");
include_once('../config/database.php');
include_once('../objects/product.php');
$database=new database();
$db=$database->getConnection();
$product=new product($db);
//lấy id sản phẩm
$data=json_decode(file_get_contents("php://input"));
$product->id=$data->id; //id bị xóa
if($product->delete()){
    http_response_code(200);
    echo json_encode(
        array("Thông báo"=>"Sẩn phẩm đã xóa")
    );
}
else{
    http_response_code(503);
    echo json_encode(
        array("Thông báo"=>"Không thể xóa sẩn phẩm")
    );

}
?>