<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, X-Requested-With");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
try {
    require_once("../../../connectdb.php"); 

    // 檢查是否接收到 orders_no
    if (isset($_POST['orders_no']))
     {  
        $orders_no = intval($_POST['orders_no']);
        // $orders_no = $_POST['orders_no'];
        if (is_int($orders_no)) {
            echo '$orders_no is an integer';
        } else {
            echo '$orders_no is NOT an integer';
        }


        $sql = "SELECT * FROM passenger WHERE orders_no = :orders_no";
        $stmt = $pdo->prepare($sql);
        
        // 使用參數綁定來避免SQL注入
        $stmt->bindParam(":orders_no", $orders_no);


        if ($stmt->execute()) {
            $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // echo json_encode($orders); 
            //將資料轉成JSON格式並輸出
            if (empty($orders)) {
                echo "No records found!";
            } else {
                echo json_encode($orders);
            }
        } else {
            echo "Error retrieving data.";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
