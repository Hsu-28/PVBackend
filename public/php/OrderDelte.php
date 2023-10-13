

<?php
try{    
    require_once("../../../connectdb.php");
        // 檢查是否接收到 orders_no
        if(isset($_POST['orders_no'])) {
            $orders_no = $_POST['orders_no'];

            // 使用SQL語句刪除該筆訂單
            $sql = "DELETE FROM your_table_name WHERE orders_no = '$orders_no'";

            if(mysqli_query($conn, $sql)){
                echo "Order deleted successfully!";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
        mysqli_close($conn);
}
?>