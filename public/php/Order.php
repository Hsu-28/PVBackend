<?php

header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");

try {
    require_once("../../../connectdb.php");
    $sql = "SELECT * FROM orders"; 
    $query = $pdo->query($sql);
    $orders = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($orders); //將資料轉成JSON格式並輸出
} catch (PDOException $e) {
    $result = ["error" => true, "msg" => $e->getMessage()];
    echo json_encode($result);
}
?>
<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");

try {
    require_once("../../../connectdb.php"); 

    // 檢查是否接收到 orders_no
    if (isset($_POST['orders_no'])) {
        $orders_no = $_POST['orders_no'];

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
