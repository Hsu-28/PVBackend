<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json"); 

try {
		// if ( $_FILES["news_image"]["error"] === 0) {
		// 	//-----------------決定好資料夾的路徑
		// 	$dir = "../../../PlanetVoyager/src/assets/image/index/";
		// 	$to = $dir . $filename;
		// 	//exit($to);
		// 	if( !file_exists($dir) ){
		// 		mkdir($dir);
		// 	}
					
		// 	$from = $_FILES["news_image"]["tmp_name"];
	
		// 	$filename = $_FILES["news_image"]["name"]; //加上副檔名的檔名 650aad4a96a29.ico
	
		// 	$to = $dir . $filename;
		// 	copy($from, $to);
		// } else {
		// 	$fileName = "";
		// }
		// require_once("../../../connect_chd103g3.php");
		require_once("../../connect_chd103g3.php");

		if (isset($_FILES['news_imageFile']) && $_FILES['news_imageFile']['error'] === UPLOAD_ERR_OK) {
			// $uploadDir = "../../../PlanetVoyager/src/assets/image/index/"; //指定文件存储位置
			// if ($_SERVER['HTTP_HOST'] == "localhost" || $_SERVER['HTTP_HOST'] == "127.0.0.1") {
			// 	$uploadDir = '../../../PlanetVoyager/src/assets/image/index/';
			// } else {
				$uploadDir = '../../PlanetVoyager/img/';
			// }
			
			$fileName = $_POST["news_image"];
			$targetFilePath = $uploadDir . $fileName;
	
			// 更新文件并扩展SQL语句
			move_uploaded_file($_FILES['news_imageFile']['tmp_name'], $targetFilePath);
		}
	
	//執行sql指令
	$sql = "update news set news_title=:news_title, news_image=:news_image,
	news_date=:news_date, news_content=:news_content where news_no=:news_no";

	$products = $pdo->prepare($sql);
    $products->bindValue(":news_no", $_POST["news_no"]);
	$products->bindValue(":news_title", $_POST["news_title"]);
	$products->bindValue(":news_image",$_POST["news_image"]);
	$products->bindValue(":news_date", $_POST["news_date"]);
	$products->bindValue(":news_content", $_POST["news_content"]);
	$products->execute();

	echo "異動成功~";

} catch (PDOException $e) {
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
	// echo "系統暫時不能正常運行，請稍後再試<br>";	
}
