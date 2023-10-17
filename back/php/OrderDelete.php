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
    if (isset($data['orders_no'])) {  
        $orders_no = $data['orders_no'];

        //  //如果要刪除表格有被引用成外來鍵要先刪除引用他的表格的

        $sql = "DELETE FROM passenger WHERE orders_no = :orders_no";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':orders_no', $orders_no, PDO::PARAM_INT);

        $stmt->execute();

        //在刪除orders的
        $sql2 = "DELETE FROM orders WHERE orders_no = :orders_no";
        $stmt2= $pdo->prepare($sql2);
        $stmt2->bindParam(':orders_no', $orders_no, PDO::PARAM_INT);
        $stmt2->execute();
      
    }

    // // 檢查是否接收到 orders_no
    // if (isset($_POST['orders_no'])) {
    //     $orders_no = intval($_POST['orders_no']);
    //     // $orders_no = $_POST['orders_no'];
    //     echo " $orders_no";
    //     // 使用SQL語句刪除該筆訂單
    //     $sql = "DELETE FROM orders WHERE orders_no = :orders_no";
    //     $sql = "DELETE FROM passenger WHERE orders_no = :orders_no";
    //     $stmt = $pdo->prepare($sql);

    //     // 使用參數綁定來避免SQL注入
    //     $stmt->bindParam(":orders_no", $orders_no);

    //     if ($stmt->execute()) {
    //         echo "Order deleted successfully!";
    //     } else {
    //         echo "Error deleting record.";
    //     }
    // }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


?>
