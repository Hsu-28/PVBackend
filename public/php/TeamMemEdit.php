<?php
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Content-Type, X-Requested-With, Authorization"); // 允許的請求頭
// 如果有CORS 錯誤 寫下面if
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}
try {
    require_once("../../../connect_chd103g3.php");

      //   如果你使用axios以application/json的形式发送数据，$_POST数组可能是空的
      //   ，因为PHP默认只解析application/x-www-form-urlencoded数据到$_POST数组。这种情况下，你需要从输入流中手动获取和解析JSON数据：
     //  可能不能直接用$_POST
     $data = json_decode(file_get_contents("php://input"), true);

    $team_memno = $data['team_memno'];
    $team_memname = $data['team_memname'];
    $team_memimage = $data['team_memimage'];
    $team_memjob = $data['team_memjob'];
    $team_memexperience = $data['team_memexperience'];

    // 更新資料庫
    $stmt = $pdo->prepare("UPDATE teamintro SET team_memname = :team_memname, team_memimage = :team_memimage, team_memjob = :team_memjob, team_memexperience = :team_memexperience WHERE team_memno = :team_memno");

    $stmt->bindParam(':team_memno', $team_memno);
    $stmt->bindParam(':team_memname', $team_memname);
    $stmt->bindParam(':team_memimage', $team_memimage);
    $stmt->bindParam(':team_memjob', $team_memjob);
    $stmt->bindParam(':team_memexperience', $team_memexperience);

    $stmt->execute();

    echo json_encode(["message" => "Data updated successfully!"]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
    
  

?>
<!-- 
$team_memno = $_POST['team_memno'];
    $team_memname = $_POST['team_memname'];
    $team_memimage = $_POST['team_memimage'];
    $team_memjob = $_POST['team_memjob'];
    $team_memexperience = $_POST['team_memexperience'];
  
    
        
        // 進行查詢
        $stmt = $pdo->prepare("UPDATE teamintro SET team_memname = :team_memname, team_memimage = :team_memimage, team_memjob = :team_memjob, team_memexperience = :team_memexperience WHERE team_memno = :team_memno");
        $stmt->bindParam(':team_memno', $team_memno, );
        $stmt->bindParam(':team_memname', $team_memname, );
        $stmt->bindParam(':team_memimage', $team_memimage, );
        $stmt->bindParam(':team_memjob', $team_memjob, );
        $stmt->bindParam(':team_memexperience', $team_memexperience, );
        $stmt->execute();

        echo json_encode(["message" => "Data updated successfully!"]); -->
