<?php 
try {
    // 引入連線工作的檔案
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header("Content-Type: application/json"); 
    require_once("../../../connect_chd103g3.php");
    if (isset($_FILES['news_image']) && $_FILES['news_image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = "../../../PlanetVoyager/src/assets/image/index/"; //指定文件存储位置
        $fileName = $_FILES['news_image']['name'];
        $targetFilePath = $uploadDir . $fileName;

        // 更新文件并扩展SQL语句
        move_uploaded_file($_FILES['news_image']['tmp_name'], $targetFilePath);
    }

    $news_title = $_POST['news_title'];
    $news_image = $fileName;
    $news_date = $_POST['news_date'];
    $news_content = $_POST['news_content'];

    // 使用反引號括住表名和欄位名
    $sql = "INSERT INTO `news` ( `news_title`, `news_image`, `news_date`, `news_content`)
            VALUES ( :news_title, :news_image, :news_date, :news_content )";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':news_title', $news_title);
    $stmt->bindParam(':news_image', $news_image);
    $stmt->bindParam(':news_date', $news_date);
    $stmt->bindParam(':news_content', $news_content);
    $stmt->execute();
}
catch (Exception $e) {
    echo "錯誤行號 : ", $e->getLine(), "<br>";
    echo "錯誤原因 : ", $e->getMessage(), "<br>";
}
?>
