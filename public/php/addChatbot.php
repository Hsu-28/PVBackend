<?php 
try {
    // 引入連線工作的檔案
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header("Content-Type: application/json"); 
    // require_once("../../../connect_chd103g3.php");
    require_once("../../connect_chd103g3.php");

    $chat_no = $_POST['chat_no'];
    $keyword = $_POST['keyword'];
    $chat_ans = $_POST['chat_ans'];

    // 使用反引號括住表名和欄位名
    $sql = "INSERT INTO `chatbot` (`chat_no`, `keyword`, `chat_ans`)
            VALUES (:chat_no, :keyword, :chat_ans)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':chat_no', $chat_no);
    $stmt->bindParam(':keyword', $keyword);
    $stmt->bindParam(':chat_ans', $chat_ans);
    $stmt->execute();
}
catch (Exception $e) {
    echo "錯誤行號 : ", $e->getLine(), "<br>";
    echo "錯誤原因 : ", $e->getMessage(), "<br>";
}
?>