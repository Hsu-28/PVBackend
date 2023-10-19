<?php
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");

try {
    require_once("../../../connect_chd103g3.php");
    // 更新資料庫

    // if (isset($_FILES['team_memimageFile']) && $_FILES['team_memimageFile']['error'] === UPLOAD_ERR_OK) {
    //     $uploadDir = '../../../PlanetVoyager/src/assets/image/teamMembers/memberSvg/'; //指定文件存储位置
    //     $fileName = $_POST["team_memimage"];
    //     $targetFilePath = $uploadDir . $fileName;

    //     // 更新文件并扩展SQL语句
    //     move_uploaded_file($_FILES['team_memimageFile']['tmp_name'], $targetFilePath);
    // }
    $sql = "INSERT INTO itinerary (planet_name, planet_subtitle, content_title, introduction, itinerary_day) VALUES (:planet_name, :planet_subtitle, :content_title, :introduction, :itinerary_day)";

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(":planet_name", $_POST["planet_name"]);
    $stmt->bindValue(":planet_subtitle", $_POST["planet_subtitle"]);
    $stmt->bindValue(":content_title", $_POST["content_title"]);
    $stmt->bindValue(":introduction", $_POST["introduction"]);
    $stmt->bindValue(":itinerary_day", $_POST["itinerary_day"]);

    $stmt->execute();

    echo "異動成功~";

    // echo json_encode(["message" => "Data updated successfully!"]);

} catch (PDOException $e) {
    echo "錯誤行號 : ", $e->getLine(), "<br>";
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
    // http_response_code(500);
    // echo json_encode(["error" => $e->getMessage()]);
}
    
  

?>
