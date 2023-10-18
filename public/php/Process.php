<?php
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

try {


    require_once("../../../connect_chd103g3.php");
    $sql = "SELECT * FROM itinerary";  

    $query = $pdo->query($sql);
    $itinerary = $query->fetchAll(PDO::FETCH_ASSOC);  
    foreach   ($itinerary as $index => $itinerary){
        $itinerary = explode("\r\n", $itinerary['itinerary_day']);

    }

    echo json_encode($itinerary); //將資料轉成JSON格式並輸出

} catch (PDOException $e) {
    $result = ["error" => true, "msg" => $e->getMessage()];
    echo json_encode($result);
}

?>
