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
    // require_once("../../../connect_chd103g3.php");
    require_once("../../connect_chd103g3.php");

    $data = json_decode(file_get_contents("php://input"), true);
    if (isset($data['news_no'])) {  
        $news_no = $data['news_no'];

        //  //如果要刪除表格有被引用成外來鍵要先刪除引用他的表格的

        $sql = "DELETE FROM news WHERE news_no = :news_no";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':news_no', $news_no, PDO::PARAM_INT);

        $stmt->execute();

        //在刪除orders的
        $sql2 = "DELETE FROM news WHERE news_no = :news_no";
        $stmt2= $pdo->prepare($sql2);
        $stmt2->bindParam(':news_no', $news_no, PDO::PARAM_INT);
        $stmt2->execute();
    
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


?>
