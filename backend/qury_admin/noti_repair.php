<?php
    session_start();
    include('../../login/server.php');
    if(isset($_POST['save'])){
        $day_take = mysqli_real_escape_string($conn,$_POST['day_take']);
        $tools_name = mysqli_real_escape_string($conn,$_POST['tools_name']);
        $customer = mysqli_real_escape_string($conn,$_POST['customer']);
        $note = mysqli_real_escape_string($conn,$_POST['note']);
        $noid = mysqli_real_escape_string($conn,$_POST['noid']);
        $typeid = mysqli_real_escape_string($conn,$_POST['typeid']);
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $compair_car =array("2310","2320","2340");
        $compair_tools =array("6515","6520","6525","6530");
        $compair_repair =array("3405","3510","3515","3750","3920","4104","4110","4120","4140","4141","4330","4520","4610","5100","5802","5805","5815"
        ,"5820","5835","5965","6115","6710","6720","6730","7100","7101","7109","7110","7135","7195","7290","7310","7320","7420","7910","9925");
        $compair_com = array("7430","7440","7440","7450","7490","7730");
        
                


        if(in_array($typeid,$compair_car,TRUE)){
            $typeid = "ยานยนต์";
        }else if(in_array($typeid,$compair_tools,TRUE)){
            $typeid = "ศูนย์เครื่องมือแพทย์ฯ";
        }else if(in_array($typeid,$compair_repair,TRUE)){
            $typeid = "ศูนย์ซ่อมบำรุง";
        }else if(in_array($typeid,$compair_com,TRUE)){
            $typeid = "ศูนย์คอมพิวเตอร์";
        }else{
            echo "<script>";
			    echo "alert('ไม่พบเครื่องมือ!');";
			    echo "window.location='../../fontend/admin/index_repair.php';";
            echo "</script>";
        }

        
        $sql = "INSERT INTO notify_repair (day_take,tools_name,customer,note,noid,username,type_work,status_repair) VALUES ('$day_take', '$tools_name', '$customer','$note','$noid','$username','$typeid','รอดำเนินการ')";
        mysqli_query($conn,$sql);
        
        echo "<script>";
			    echo "alert('บันทึกแจ้งซ่อมเสร็จสิ้น !');";
			    echo "window.location='../../fontend/admin/index_repair.php';";
        echo "</script>";
        
    }else{
        echo "<script>";
			    echo "alert('เกิดข้อผิดพลาดกรุณาลองใหม่อีกครั้ง !');";
			    echo "window.location='../../fontend/admin/index_repair.php';";
        echo "</script>";
    }
?>