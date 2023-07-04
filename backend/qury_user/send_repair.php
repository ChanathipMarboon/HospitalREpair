/** 
* *แจกเเจงงานให้เเต่ละฝ่ายของช่างโดยใช้ type_work ในฐานข้อมูล
* ! สำเร็จ
*/
<?php 
    include('../../login/server.php');
    if(isset($_GET['take_fix'])){
        $take_fix = $_GET['take_fix'];
        $user = $_GET['user'];
        date_default_timezone_set('asia/bangkok');
        $date_recive = date('Y-m-d');
        $sql_fix = "INSERT INTO repair_tools (id, noti_repair_id, date_recive, problem, sta_fix, username_e, date_repair, comment, username_check,confirm1,confirm2,confirm3,username_recive,date_check) VALUES (NULL, '$take_fix', '$date_recive', '', '', '','', '', '','y', 'w', 'w','$user','');";
        $result_fix = mysqli_query($conn,$sql_fix);
        $sql_status ="UPDATE notify_repair SET status_repair = 'รับเรื่องแล้ว' WHERE id = $take_fix;";
        $result_update = mysqli_query($conn,$sql_status);
        if($result_fix){
            echo "<script type='text/javascript'>";
            echo "window.location = '../../fontend/index_take.php'; ";
           
            echo "</script>";
            }
            else{
            echo "<script type='text/javascript'>";
            echo "window.location = '../../fontend/index_take.php'; ";
            
            echo "</script>";
        }
    }else{

    }
    if(isset($_GET['install_tools'])){
        $install_tools = $_GET['install_tools'];
        $user = $_GET['user'];
        date_default_timezone_set('asia/bangkok');
        $sql_status ="UPDATE notify_repair SET status_repair = 'ส่งคืนเสร็จสิ้น' WHERE id = $install_tools;";
        $result_update = mysqli_query($conn,$sql_status);
        if($result_fix){
            echo "<script type='text/javascript'>";
            echo "window.location = '../../fontend/send_install.php'; ";
           
            echo "</script>";
            }
            else{
            echo "<script type='text/javascript'>";
            echo "window.location = '../../fontend/send_install.php'; ";
            
            echo "</script>";
        }
    }else{

    }
?>