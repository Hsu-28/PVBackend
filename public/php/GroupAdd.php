<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json"); 

try {
    require_once("../../../connect_chd103g3.php");

    $itinerary_no  = $_POST["itinerary_no"];
    $training_date = $_POST["training_date"];
    $trip_date = $_POST["trip_date"];

    // 执行 SQL 指令
    $sql = "INSERT INTO trip (itinerary_no, training_date, trip_date) VALUES (:itinerary_no, :training_date, :trip_date)";

    $addjourney = $pdo->prepare($sql);
    $addjourney->bindValue(":itinerary_no", $itinerary_no );  // 注意这里不要有空格
    $addjourney->bindValue(":training_date", $training_date);
    $addjourney->bindValue(":trip_date", $trip_date);
    
    $addjourney->execute();

    echo "新增成功~";

} catch (PDOException $e) {
    echo "錯誤行號 : ", $e->getLine(), "<br>";
    echo "錯誤原因 : ", $e->getMessage(), "<br>";
    // echo "系統暫時不能正常運行，請稍後再試<br>";	
}
?>
