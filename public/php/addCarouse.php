<?php 
try {
    // 引入連線工作的檔案
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header("Content-Type: application/json"); 
    require_once("../../../connect_chd103g3.php");
    if (isset($_FILES['carouse_image']) && $_FILES['carouse_image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = "../../../PlanetVoyager/src/assets/image/index/"; //指定文件存储位置
        $fileName = $_FILES['carouse_image']['name'];
        $targetFilePath = $uploadDir . $fileName;

        // 更新文件并扩展SQL语句
        move_uploaded_file($_FILES['carouse_image']['tmp_name'], $targetFilePath);
    }

    $carouse_title = $_POST['carouse_title'];
    $carouse_image = $fileName;


    // 使用反引號括住表名和欄位名
    $sql = "INSERT INTO `index_carouse` ( `carouse_title`, `carouse_image`)
            VALUES ( :carouse_title, :carouse_image )";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':carouse_title', $carouse_title);
    $stmt->bindParam(':carouse_image', $carouse_image);
    $stmt->execute();
}
catch (Exception $e) {
    echo "錯誤行號 : ", $e->getLine(), "<br>";
    echo "錯誤原因 : ", $e->getMessage(), "<br>";
}
?>
