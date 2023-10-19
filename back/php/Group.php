<?php

header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");

try {
    // require_once("../../../connect_chd103g3.php");
    require_once("../../connect_chd103g3.php");
    $sql = "SELECT *
    FROM trip
    JOIN itinerary ON trip.itinerary_no = itinerary.itinerary_no;
     "; 
    $query = $pdo->query($sql);
    $orders = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($orders); //將資料轉成JSON格式並輸出
} catch (PDOException $e) {
    $result = ["error" => true, "msg" => $e->getMessage()];
    echo json_encode($result);
}
?>
