<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json");

try {

	// require_once("../../../connect_chd103g3.php");
	require_once("../../connect_chd103g3.php");

	if (isset($_FILES['carouse_imageFile']) && $_FILES['carouse_imageFile']['error'] === UPLOAD_ERR_OK) {

		// $uploadDir = "../../../PlanetVoyager/src/assets/image/index/"; //指定文件存储位置
		if ($_SERVER['HTTP_HOST'] == "localhost" || $_SERVER['HTTP_HOST'] == "127.0.0.1") {
            $uploadDir = '../../../PlanetVoyager/src/assets/image/index/';
        } else {
            $uploadDir = '../../PlanetVoyager/img/';
        }
		$fileName = $_POST["carouse_image"];
		$targetFilePath = $uploadDir . $fileName;

		// 更新文件并扩展SQL语句
		move_uploaded_file($_FILES['carouse_imageFile']['tmp_name'], $targetFilePath);
	}

	//執行sql指令
	$sql = "update index_carouse set carouse_title=:carouse_title, 
	carouse_image=:carouse_image where carouse_no=:carouse_no";

	$products = $pdo->prepare($sql);
	$products->bindValue(":carouse_no", $_POST["carouse_no"]);
	$products->bindValue(":carouse_title", $_POST["carouse_title"]);
	$products->bindValue(":carouse_image", $_POST["carouse_image"]);
	$products->execute();

	echo "異動成功~";
} catch (PDOException $e) {
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
	// echo "系統暫時不能正常運行，請稍後再試<br>";	
}
