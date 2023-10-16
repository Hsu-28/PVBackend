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
    require_once("../../../connectdb.php"); 

    $data = json_decode(file_get_contents("php://input"), true);
 
    // if (isset($_POST['orders_no'])) {  
    //     $orders_no = $_POST['orders_no'];
    if (isset($data['orders_no'])) {  
        $orders_no = $data['orders_no'];
        
        // 使用 JOIN 進行查詢
        $stmt = $pdo->prepare("SELECT * FROM  passenger WHERE orders_no = :orders_no");
        $stmt->bindParam(':orders_no', $orders_no, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        echo json_encode($result); 
    } else {
        http_response_code(400); 
        echo json_encode(["error" => "No orders_no provided!"]);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
// header("Access-Control-Allow-Origin:*");
// header("Content-Type: application/json");

// try {
//     require_once("../../../connectdb.php");
//     $sql = "SELECT * FROM  passenger ";  
//     $query = $pdo->query($sql);
//     $orders = $query->fetchAll(PDO::FETCH_ASSOC);  
//     //   echo 'yyy';

//     echo json_encode($orders); //將資料轉成JSON格式並輸出

// } catch (PDOException $e) {
//     $result = ["error" => true, "msg" => $e->getMessage()];
//     echo json_encode($result);
// }
?>