<?php 
try {
    // 引入連線工作的檔案
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header("Content-Type: application/json"); 
    // require_once("../../../connect_chd103g3.php");
    require_once("../../connect_chd103g3.php");


    $faq_no = $_POST['faq_no'];
    $question = $_POST['question'];
    $question_ans = $_POST['question_ans'];

    // 使用反引號括住表名和欄位名
    $sql = "INSERT INTO `faq` (`faq_no`, `question`, `question_ans`)
            VALUES (:faq_no, :question, :question_ans)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':faq_no', $faq_no);
    $stmt->bindParam(':question', $question);
    $stmt->bindParam(':question_ans', $question_ans);
    $stmt->execute();
}
catch (Exception $e) {
    echo "錯誤行號 : ", $e->getLine(), "<br>";
    echo "錯誤原因 : ", $e->getMessage(), "<br>";
}
?>
