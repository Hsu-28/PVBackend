<?php 
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
// 如果有CORS 錯誤 寫下面if
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

try{
  require_once("../../../connect_chd103g3.php");
  $sql = "select * from `admin` where admin_account=:adminid and admin_psw=:adminpsw"; 
  $admin = $pdo->prepare($sql);
  $admin->bindValue(":adminid", $_POST["adminid"]);
  $admin->bindValue(":adminpsw", $_POST["adminpsw"]);
  $admin->execute();

  if ( $admin->rowCount()=== 0) { //查無此人, 帳密錯誤
    $result = ["error" => true, "msg" => "帳號或密碼錯誤"];
    echo json_encode($result);
  } else { //登入成功

    //自資料庫中取回資料
    $adminRow = $admin->fetch(PDO::FETCH_ASSOC);
    //送出登入者的姓名資料
    $result = ["adminid"=>$adminRow["admin_account"], "adminpsw"=>$adminRow["admin_psw"],"error" => false];
    echo json_encode($result);
  }
} catch (PDOException $e) {
  $result = ["error" => true, "msg" => $e->getMessage()];
	echo json_encode($result);
}

?>