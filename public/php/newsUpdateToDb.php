<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json"); 

try {
		if ( $_FILES["news_image"]["error"] === 0) {
			//-----------------決定好資料夾的路徑
			$dir = "../../../PlanetVoyager/src/assets/image/index/";
			$to = $dir . $filename;
			//exit($to);
			if( !file_exists($dir) ){
				mkdir($dir);
			}
					
			$from = $_FILES["news_image"]["tmp_name"];
	
			//-----------------決定檔案名稱
			//$fileName = $_FILES["image"]["name"]; //原檔名
			//$filename = uniqid(); //使用uniqid()來當做主檔名 650aad4a96a29
			//$pathInfo = pathinfo($_FILES["image"]["name"]);//取得檔案的資訊放在陣列中
			//$fileExt = $pathInfo["extension"]; //check.ico, smile.gif
			
			$filename = $_FILES["news_image"]["name"]; //加上副檔名的檔名 650aad4a96a29.ico
	
			$to = $dir . $filename;
			copy($from, $to);
		} else {
			$fileName = "";
		}

	require_once("../../../connect_chd103g3.php");
	//執行sql指令
	$sql = "update news set news_title=:news_title, news_image=:news_image,
	news_date=:news_date, news_content=:news_content where news_no=:news_no";

	$products = $pdo->prepare($sql);
    $products->bindValue(":news_no", $_POST["news_no"]);
	$products->bindValue(":news_title", $_POST["news_title"]);
	$products->bindValue(":news_image",$filename);
	$products->bindValue(":news_date", $_POST["news_date"]);
	$products->bindValue(":news_content", $_POST["news_content"]);
	$products->execute();

	echo "異動成功~";

} catch (PDOException $e) {
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
	// echo "系統暫時不能正常運行，請稍後再試<br>";	
}
