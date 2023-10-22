<?php
     //在php.ini 改upload_max_filesize = 10M 跟 post_max_size = 80M 更改上傳檔案的限制

    header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Origin:*");
    header("Content-Type: application/json");
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(200);
        exit;
    }
    try {
        // require_once("../../../connect_chd103g3.php");
        require_once("../../connect_chd103g3.php");
        $itinerary_no = isset($_POST["itinerary_no"]) ? $_POST["itinerary_no"] : null;
        $photo_noData = isset($_POST["photo_noData"]) ? $_POST["photo_noData"] : null;
        $itinerary_pic = isset($_POST["itinerary_pic"]) ? $_POST["itinerary_pic"] : null;
        $planet_name = isset($_POST["planet_name"]) ? $_POST["planet_name"] : null;
        $planet_subtitle = isset($_POST["planet_subtitle"]) ? $_POST["planet_subtitle"] : null;
        $content_title = isset($_POST["content_title"]) ? $_POST["content_title"] : null;
        $introduction = isset($_POST["introduction"]) ? $_POST["introduction"] : null;
        $itinerary_day = isset($_POST["itinerary_day"]) ? $_POST["itinerary_day"] : null;
 
        // echo $itinerary_no . "\n", 
        //     $photo_noData . "\n", 
        //     $itinerary_pic . "\n", 
        //     $planet_name . "\n", 
        //     $planet_subtitle . "\n",  
        //     $content_title . "\n", 
        //     $introduction . "\n", 
        //     $itinerary_day . "\n";
        //     exit();

        // 更新資料庫
        // $fileCount = count($_FILES['ProcessimageFile']['tmp_name']);

      
            // if($_POST["itinerary_no"] == 1){
            //     $uploadDir = '../../../PlanetVoyager/src/assets/image/itinerary_combo/';
            // }else if($_POST["itinerary_no"] == 2){
            //     $uploadDir = '../../../PlanetVoyager/src/assets/image/itinerary_moon/';
            // }else if($_POST["itinerary_no"] == 3){
            //     $uploadDir = '../../../PlanetVoyager/src/assets/image/itinerary_moon2/';
            // }else if($_POST["itinerary_no"] == 4){
            //     $uploadDir = '../../../PlanetVoyager/src/assets/image/itinerary_mars1/';
            // }else if($_POST["itinerary_no"] == 5){
            //     $uploadDir = '../../../PlanetVoyager/src/assets/image/itinerary_mars2/';
            // }else if($_POST["itinerary_no"] == 6){
            //     $uploadDir = '../../../PlanetVoyager/src/assets/image/itinerary_venus/';
            // }else if($_POST["itinerary_no"] == 7){
            //     $uploadDir = '../../../PlanetVoyager/src/assets/image/itinerary_venus1/';
            // }
            // if ($_SERVER['HTTP_HOST'] == "localhost" || $_SERVER['HTTP_HOST'] == "127.0.0.1") {

            //     if($_POST["itinerary_no"] == 1){
            //         $uploadDir = '../../../PlanetVoyager/src/assets/image/itinerary_combo/';
            //     }else if($_POST["itinerary_no"] == 2){
            //         $uploadDir = '../../../PlanetVoyager/src/assets/image/itinerary_moon/';
            //     }else if($_POST["itinerary_no"] == 3){
            //         $uploadDir = '../../../PlanetVoyager/src/assets/image/itinerary_moon2/';
            //     }else if($_POST["itinerary_no"] == 4){
            //         $uploadDir = '../../../PlanetVoyager/src/assets/image/itinerary_mars1/';
            //     }else if($_POST["itinerary_no"] == 5){
            //         $uploadDir = '../../../PlanetVoyager/src/assets/image/itinerary_mars2/';
            //     }else if($_POST["itinerary_no"] == 6){
            //         $uploadDir = '../../../PlanetVoyager/src/assets/image/itinerary_venus/';
            //     }else if($_POST["itinerary_no"] == 7){
            //         $uploadDir = '../../../PlanetVoyager/src/assets/image/itinerary_venus1/';
            //     }
            // } else {
                $uploadDir = '../../PlanetVoyager/img/';
            // }
          
            $arr = json_decode($_POST['photo_noData'], true); //$arr[0]["itinerary_pic"]
            // $arr = json_decode($_POST['photo_noData']); //$arr[0]->itinerary_pic
            // var_dump($_FILES); exit();
            for ($i = 0; $i < 18; $i++) {
                $temp = "ProcessimageFile$i";

                if(isset($_FILES[$temp])) {

                    $fileName = $arr[$i]['itinerary_pic'];
                    $targetFilePath = $uploadDir . $fileName;
                
                    move_uploaded_file($_FILES[$temp]['tmp_name'], $targetFilePath);
                    echo $targetFilePath;
                    echo $_FILES[$temp]['tmp_name'] ,"-->";
                    echo $fileName, "@@";
            
                }else{
                    echo $i;
                }
                
            }
            
                

            // 更新文件并扩展SQL语句
        // }
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