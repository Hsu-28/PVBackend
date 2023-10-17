<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json"); 

try {
	require_once("../../../connectdb.php");

    //存圖片

	//執行sql指令
	$sql = "update news set news_title=:news_title, news_image=:news_image,
	news_date=:news_date, news_content=:news_content where news_no=:news_no";

	$products = $pdo->prepare($sql);
    $products->bindValue(":news_no", $_POST["news_no"]);
	$products->bindValue(":news_title", $_POST["news_title"]);
	$products->bindValue(":news_image", $_POST["news_image"]);
	$products->bindValue(":news_date", $_POST["news_date"]);
	$products->bindValue(":news_content", $_POST["news_content"]);
	$products->execute();

	echo "異動成功~";

} catch (PDOException $e) {
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
	// echo "系統暫時不能正常運行，請稍後再試<br>";	
}
?>
