<?php
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
// header("Access-Control-Allow-Headers: Content-Type, X-Requested-With, Authorization"); // 允許的請求頭
// 如果有CORS 錯誤 寫下面if
// if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
//     http_response_code(200);
//     exit;
// }
try {
    require_once("../../../connect_chd103g3.php");

   

    // 更新資料庫

    if (isset($_FILES['team_memimageFile']) && $_FILES['team_memimageFile']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../../../PlanetVoyager/src/assets/image/teamMembers/memberSvg/'; //指定文件存储位置
        $fileName = $_POST["team_memimage"];
        $targetFilePath = $uploadDir . $fileName;

        // 更新文件并扩展SQL语句
        move_uploaded_file($_FILES['team_memimageFile']['tmp_name'], $targetFilePath);
    }
    $sql="UPDATE teamintro SET team_memname = :team_memname, team_memimage = :team_memimage, team_memjob = :team_memjob, team_memexperience = :team_memexperience WHERE team_memno = :team_memno";

    // $sql="UPDATE teamintro SET team_memname = :team_memname,  team_memjob = :team_memjob, team_memexperience = :team_memexperience WHERE team_memno = :team_memno";
    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(":team_memno", $_POST["team_memno"]);
    $stmt->bindValue(":team_memname", $_POST["team_memname"]);
   
    // $stmt->bindValue(":team_memimage", $_POST["team_memimage"]);
    $stmt->bindValue(":team_memimage", $_POST["team_memimage"]);
    $stmt->bindValue(":team_memjob", $_POST["team_memjob"]);
    $stmt->bindValue(":team_memexperience", $_POST["team_memexperience"]);
    
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
