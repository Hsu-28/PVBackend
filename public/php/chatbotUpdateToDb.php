<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json"); 

try {
	// require_once("../../../connect_chd103g3.php");
	require_once("../../connect_chd103g3.php");


	//執行sql指令
	$sql = "update chatbot set keyword=:keyword, chat_ans=:chat_ans where chat_no=:chat_no";

	$products = $pdo->prepare($sql);
    $products->bindValue(":chat_no", $_POST["chat_no"]);
	$products->bindValue(":keyword", $_POST["keyword"]);
	$products->bindValue(":chat_ans", $_POST["chat_ans"]);
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
