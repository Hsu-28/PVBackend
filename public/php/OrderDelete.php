<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, X-Requested-With");
try {
    require_once("../../../connectdb.php"); 

    // 檢查是否接收到 orders_no
    if (isset($_POST['orders_no'])) {
        $orders_no = $_POST['orders_no'];
        echo " $orders_no";
        // 使用SQL語句刪除該筆訂單
        $sql = "DELETE FROM orders WHERE orders_no = :orders_no";
        $stmt = $pdo->prepare($sql);

        // 使用參數綁定來避免SQL注入
        $stmt->bindParam(":orders_no", $orders_no);

        if ($stmt->execute()) {
            echo "Order deleted successfully!";
        } else {
            echo "Error deleting record.";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


?>
