<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json"); 

try {
	// require_once("../../../connect_chd103g3.php");
	require_once("../../connect_chd103g3.php");
    //存圖片

	//執行sql指令
	$sql = "update faq set question=:question, question_ans=:question_ans where faq_no=:faq_no";

	$products = $pdo->prepare($sql);
    $products->bindValue(":faq_no", $_POST["faq_no"]);
	$products->bindValue(":question", $_POST["question"]);
	$products->bindValue(":question_ans", $_POST["question_ans"]);
	// $products->bindValue(":news_image", $_FILES["news_image"]['tmp_name']);
	// $products->bindValue(":news_content", $_POST["news_content"]);
	$products->execute();

	echo "異動成功~";

} catch (PDOException $e) {
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
	// echo "系統暫時不能正常運行，請稍後再試<br>";	
}
?>
