<?php 
header('Access-Control-Allow-Origin:*');
header("Content-Type:application/json;charset=utf-8");
try{
    require_once("./connect.php"); 

    $sql = "select * from chatbot";
    $chatbot = $pdo->query($sql);
    $result = $chatbot->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo json_encode($result);
    } else {
        echo json_encode(array("message" => "沒有數據"));
    }

}catch(PDOException $e){
    echo "錯誤行號 : ", $e->getLine(), "<br>";
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
}

?>