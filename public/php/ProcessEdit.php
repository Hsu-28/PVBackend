<?php
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");

try {
    require_once("../../../connect_chd103g3.php");
    // 更新資料庫
    $fileCount = count($_FILES['ProcessimageFile']['tmp_name']);

    if (isset($_FILES['ProcessimageFile']) && $_FILES['ProcessimageFile']['error'] === UPLOAD_ERR_OK) {
        if($_POST["itinerary_no"]== 1){
            $uploadDir = '../../../PlanetVoyager/src/assets/image/itinerary_combo/';
        }else if($_POST["itinerary_no"] == 2){
            $uploadDir = '../../../PlanetVoyager/src/assets/image/itinerary_moon';
        }else if($_POST["itinerary_no"] == 3){
            $uploadDir = '../../../PlanetVoyager/src/assets/image/itinerary_moon2';
        }else if($_POST["itinerary_no"] == 4){
            $uploadDir = '../../../PlanetVoyager/src/assets/image/itinerary_mars1';
        }else if($_POST["itinerary_no"] == 5){
            $uploadDir = '../../../PlanetVoyager/src/assets/image/itinerary_mars2';
        }else if($_POST["itinerary_no"] == 6){
            $uploadDir = '../../../PlanetVoyager/src/assets/image/itinerary_venus';
        }else if($_POST["itinerary_no"] == 7){
            $uploadDir = '../../../PlanetVoyager/src/assets/image/itinerary_venus1';
        }
       
       
     

            $sql = "SELECT itinerary_pic FROM itinerary_photos WHERE itinerary_no = :itinerary_no "
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":itinerary_no", $_POST["itinerary_no"]);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            echo  $result;
        //     for ($i = 0; $i < $fileCount; $i++) {
        //     $targetFilePath = $uploadDir . $fileName;
        //     move_uploaded_file($_FILES['ProcessimageFile']['tmp_name'], $targetFilePath);

        // }
          
       
        // $fileName = $_POST["team_memimage"];
        // $targetFilePath = $uploadDir . $fileName;

        // 更新文件并扩展SQL语句
        // move_uploaded_file($_FILES['ProcessimageFile']['tmp_name'], $targetFilePath);
    }
    $sql = "UPDATE itinerary SET planet_name = :planet_name, planet_subtitle = :planet_subtitle, content_title = :content_title, introduction = :introduction, itinerary_day = :itinerary_day WHERE itinerary_no = :itinerary_no";

    // $sql="UPDATE teamintro SET team_memname = :team_memname,  team_memjob = :team_memjob, team_memexperience = :team_memexperience WHERE team_memno = :team_memno";
    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(":planet_name", $_POST["planet_name"]);
    $stmt->bindValue(":planet_subtitle", $_POST["planet_subtitle"]);
    $stmt->bindValue(":itinerary_no", $_POST["itinerary_no"]);

    // $stmt->bindValue(":team_memimage", $_POST["team_memimage"]);
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
