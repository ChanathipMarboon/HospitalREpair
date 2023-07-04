<?php
include('../../login/server.php');

        /*----admin อนุมัติการเข้าใช้งานของ user----*/
            if(isset($_GET['yupdate'])){
                $username = $_GET['yupdate'];
                $sql = " UPDATE `user` SET status = 'อนุมัติ' WHERE `user`.`username` = '$username'; ";
                $result = mysqli_query($conn,$sql);
                if($result){
                    echo "<script type='text/javascript'>";
                    echo "window.location = '../../fontend/admin/index_a.php';  ";
                    echo "</script>";
                    }
                    else{
                    echo "<script type='text/javascript'>";
                    echo "alert('เกิดข้อผิดพลาดกรุณาลองใหม่อีกครั้ง');";
                    echo "window.location = '../../fontend/admin/index_a.php';  ";
                    echo "</script>";
                }
            }else if(isset($_GET['nupdate'])){
                $username = $_GET['nupdate'];
                $sql = " UPDATE `user` SET status = 'ไม่อนุมัติ' WHERE `user`.`username` = '$username'; ";
                $result = mysqli_query($conn,$sql);
                if($result){
                    echo "<script type='text/javascript'>";
                    echo "window.location = '../../fontend/admin/index_a.php'; ";
                    echo "</script>";
                    }
                    else{
                    echo "<script type='text/javascript'>";
                    echo "window.location = '../../fontend/admin/index_a.php'; ";
                    echo "alert('เกิดข้อผิดพลาดกรุณาลองใหม่อีกครั้ง');";
                    echo "</script>";
                }

            }else{
                echo "window.location = '../../fontend/admin/index_take.php'; ";
            }
?>