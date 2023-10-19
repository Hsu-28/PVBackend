<?php
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
// 如果有CORS 錯誤 寫下面if
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}
try {


    // require_once("../../../connect_chd103g3.php");
    require_once("../../connect_chd103g3.php");

    $sql = "SELECT * FROM teamintro";  
    $query = $pdo->query($sql);
    $orders = $query->fetchAll(PDO::FETCH_ASSOC);  
    //   echo 'yyy';

    echo json_encode($orders); //將資料轉成JSON格式並輸出

} catch (PDOException $e) {
    $result = ["error" => true, "msg" => $e->getMessage()];
    echo json_encode($result);
}

?>
