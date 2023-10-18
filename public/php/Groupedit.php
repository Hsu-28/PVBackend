<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json"); 

try {
    require_once("../../../connect_chd103g3.php");

$itinerary_no = $_POST["itinerary_no"];
$training_date = $_POST["training_date"];
$trip_date = $_POST["trip_date"];
$pass = $_POST["pass"];
$waiting_people = $_POST["waiting_people"];
$signup_num = $_POST["signup_num"];
$max_num = $_POST["max_num"];
$trip_no = $_POST["trip_no"];

    // 执行 SQL 指令
    $sql = "INSERT INTO trip (itinerary_no, training_date, trip_date) VALUES (:itinerary_no, :training_date, :trip_date)"; 
    $sql = "UPDATE trip
            SET itinerary_no = :itinerary_no,
            training_date = :training_date,
            trip_date = :trip_date,
            pass = :pass,
            waiting_people = :waiting_people,
            signup_num = :signup_num,
            max_num = :max_num
            WHERE
            trip_no = :trip_no";




    $editjourney = $pdo->prepare($sql);
    $editjourney->bindValue(":itinerary_no", $itinerary_no );
    $editjourney->bindValue(":training_date", $training_date);
    $editjourney->bindValue(":trip_date", $trip_date);
    $editjourney->bindValue(":pass", $pass);
    $editjourney->bindValue(":waiting_people", $waiting_people);
    $editjourney->bindValue(":signup_num", $signup_num);
    $editjourney->bindValue(":max_num", $max_num);
    $editjourney->bindValue(":trip_no", $trip_no);
    
   
    
    $editjourney->execute();


    

    echo "更新成功~";

} catch (PDOException $e) {
    echo "錯誤行號 : ", $e->getLine(), "<br>";
    echo "錯誤原因 : ", $e->getMessage(), "<br>";
    // echo "系統暫時不能正常運行，請稍後再試<br>";	
}
?>
