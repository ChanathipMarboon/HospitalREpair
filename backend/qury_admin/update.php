<?php 
    include("../../login/server.php");
    /// อัปเดตข้อมูลสามชิก ///
    if(isset($_POST['update']))
    {
        $firstname = mysqli_real_escape_string($conn,$_POST['firstname']);
        $lastname = mysqli_real_escape_string($conn,$_POST['lastname']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $num_phone = mysqli_real_escape_string($conn,$_POST['num_phone']);
        $user_level = mysqli_real_escape_string($conn,$_POST['user_level']);
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $sql = "UPDATE user SET firstname = '$firstname', lastname= '$lastname' ,num_phone = '$num_phone',email = '$email',user_level = '$user_level'where username = '$username'";
        $result = mysqli_query($conn,$sql);

        if($result)
        {
            header("location:../../fontend/admin/index_a.php");
        }
        else
        {
            header("location:../../fontend/admin/index_a.php");
            echo ' Please Check Your Query ';
        }

    /// อัปเดตข้อมูลการซ่อม///
    } else if(isset($_POST['update_edit'])){
        $id = mysqli_real_escape_string($conn,$_POST['id']);
        $day_take = mysqli_real_escape_string($conn,$_POST['day_take']);
        $tools_name = mysqli_real_escape_string($conn,$_POST['tools_name']);
        $customer = mysqli_real_escape_string($conn,$_POST['customer']);
        $note = mysqli_real_escape_string($conn,$_POST['note']);
        $noid = mysqli_real_escape_string($conn,$_POST['noid']);
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $sql_update_edit = "UPDATE notify_repair SET day_take = '$day_take', tools_name= '$tools_name' ,customer = '$customer',note = '$note',noid = '$noid',username ='$username',status_repair = 'รอดำเนินการ' where id = '$id'";
        $result_edit = mysqli_query($conn,$sql_update_edit);

        if($result_edit)
        {
            header("location:../../fontend/admin/index_history.php");
        }
        else
        {
            header("location:../../fontend/admin/index_history.php");
            echo ' Please Check Your Query ';
        }

    }else{
        header("location:../../fontend/admin/index_a.php");
    }


?>