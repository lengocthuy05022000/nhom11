<?php
    header("COntent-Type:application/json; charset=UTF-8");
    header("Access-Control_Allow-Method;POST");

    include_once('../config/database.php');
    include_once('../objects/product.php');

    $database= new Database();
    $db=$database->getConnection();

    $product=new Product($db);
    //lấy dữ liệu
    $data=json_decode(file_get_contents('php://input'));

    if(!empty($data->name)&& ! empty($data->description)&& !empty($data->category_id))
    {
        $product->name =$data->name;
        $product->price=$data->price;
        $product->description=$data->description;
        $product->category_id=$data->category_id;
        if($product->create){
            http_response_code(201);
            echo json_encode(array("Thông báo"=>"Đã tạo thành công "));
        }
        else{
            http_build_query(503);
            echo json_encode(array("Thông Báo"=>"Lỗi"));
        }
    }else{
        http_response_code(400);
        echo json_encode(array("Thông báo"=>"Lỗi đầu vào"));
    }
?>