<?php
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

try {
    require_once("../../../connect_chd103g3.php");
    
    if (isset($_POST['itinerary_no'])) {  
        $itinerary_no = $_POST['itinerary_no'];

        // $sql = "DELETE FROM orders WHERE itinerary_no = :itinerary_no";
        // $stmt = $pdo->prepare($sql);
        // $stmt->bindParam(':itinerary_no', $itinerary_no);

        // $stmt->execute();
        
        $sql = "DELETE FROM itinerary_photos WHERE itinerary_no = :itinerary_no";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':itinerary_no', $itinerary_no);

        $stmt->execute();


        $sql = "DELETE FROM trip WHERE itinerary_no = :itinerary_no";
        $stmt1 = $pdo->prepare($sql);
        $stmt1->bindParam(':itinerary_no', $itinerary_no);
        $stmt1->execute();

        $sql2 = "DELETE FROM itinerary WHERE itinerary_no = :itinerary_no";
        $stmt2= $pdo->prepare($sql2);
        $stmt2->bindParam(':itinerary_no', $itinerary_no);
        $stmt2->execute();
        echo json_encode(["message" => "Delete successful"]);

    }

   
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


?>
