<?php
include('../../login/server.php');
        /// ทำการลบผู้ใช้งานในระบบ(แอดมิน)
        if(isset($_GET['del'])){
             $username = $_GET['del'];
             $sql = " DELETE from user where username = '$username' ";
             $result = mysqli_query($conn,$sql);
             if($result){
                echo "<script type='text/javascript'>";
                echo "window.location = '../../fontend/admin/index_a.php'; ";
                echo "</script>";
                }
                else{
                echo "<script type='text/javascript'>";
                echo "alert('เกิดข้อผิดพลาดกรุณาลบใหม่อีกครั้ง');";
                echo "window.location = '.././fontend/admin/index_a.php'; ";
                echo "</script>";
            }
        }
        else if(isset($_GET['del_his'])){
            $noti_repair_id = $_GET['del_his'];
             $sql = " DELETE from notify_repair where noti_repair_id = '$noti_repair_id' ";
             $result = mysqli_query($conn,$sql);
             if($result){
                echo "<script type='text/javascript'>";
                echo "alert('ทำการลบข้อมูลเรียบร้อย');";
                echo "window.location = '../../fontend/user/index_history.php'; ";
                echo "</script>";
                }
                else{
                echo "<script type='text/javascript'>";
                echo "alert('เกิดข้อผิดพลาดกรุณาลบใหม่อีกครั้ง');";
                echo "window.location = '../../fontend/user/index_history.php'; ";
                echo "</script>";}
        }else{
        header("location:../../fontend/user/index_a.php");
    }
?>