<?php
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// 如果有CORS 錯誤，處理OPTIONS請求
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

try {
    require_once("../../../connect_chd103g3.php");

    $admin_status = $_POST['admin_status'];
    $admin_account = $_POST['admin_account'];

    // 更新管理員狀態
    $sql = "UPDATE `admin` SET `admin_status` = :admin_status WHERE `admin_account` = :admin_account";
    $update_stmt = $pdo->prepare($sql);
    $update_stmt->bindValue(":admin_status", $admin_status);
    $update_stmt->bindValue(":admin_account", $admin_account);
    $update_stmt->execute();
    
    $msg = "修改成功";
} catch (PDOException $e) {
    echo "系統暫時不能正常運行，請稍後再試<br>";
}

$pdo = null;
?>