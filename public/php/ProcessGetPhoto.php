<?php
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
try {
    require_once("../../../connect_chd103g3.php");

    $itinerary_no = $_POST["itinerary_no"];
    $sql = "SELECT itinerary_pic FROM itinerary_photos WHERE itinerary_no = :itinerary_no ";
    $stmt1 = $pdo->prepare($sql);
    $stmt1->bindParam(":itinerary_no", $itinerary_no);      
    $stmt1->execute();
    $result = $stmt1->fetchAll(PDO::FETCH_ASSOC);

    if ($stmt1->rowCount() == 0) {
        echo json_encode(['error' => true, 'msg' => 'No data found']);
        exit();
    }
    echo json_encode($result); 
    // if (!$result) {
    //     echo json_encode(['error' => true, 'msg' => 'No data found']);
    //     exit();
    // }
    //將資料轉成JSON格式並輸出

} catch (PDOException $e) {
    $result = ["error" => true, "msg" => $e->getMessage()];
    echo json_encode($result);
}

?>
