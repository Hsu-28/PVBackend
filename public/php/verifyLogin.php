<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json"); 

if(! isset($_SESSION['memId'])) {
    $response = ["msg" => "未登入"];
    echo json_encode($response);
}else {
    $response = ["msg" => "已登入"];
    echo json_encode($response);
}
?>