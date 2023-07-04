<?php 
    include('menu.php');
    include('../login/server.php');
  if(isset($_SESSION['user_level'])) {
  	$_SESSION['msg'] = "You must log in first";
  }
  if(isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['user_level']);
  	header("location: ../login/loginn.php");
  }
?>
<?php
    if (isset($_GET['update'])) {
        $username = $_GET['update'];
        $sql_edit = "SELECT * FROM `user` where username = '$username'";
        $resultt = mysqli_query($conn,$sql_edit);
        while($row = mysqli_fetch_array($resultt)){
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $email = $row['email'];
            $num_phone = $row['num_phone'];
            $username = $row['username'];
            $password = $row['password'];
            $user_level = $row['user_level'];
            $status = $row['status'];
        }    
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../plugins/css/bootstrap.min.css">
    <link rel="stylesheet" href="../table.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="../plugins/style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <title>แก้ไขข้อมูลผู้ใช้งาน</title>
</head>
<?php 
            $sql_names = "SELECT DISTINCT department FROM department_all ORDER BY department_all.department ASC";
            $query_names = mysqli_query($conn,$sql_names);
        ?>
<body>

    <?php if (!isset($_SESSION['user_level'])) header("location: ../login/loginn.php");  ?>
    <section class="home-section">
        <div style="margin-left:50px">
            <div class="text">เเก้ไขข้อมูล</div>
            <form method="POST" action="../backend/qury_user/update.php">
                <div hidden>
                    <label hidden>username</label><br>
                    <input type="text" name="username" value="<?php echo $username ?>" hidden><br><br>
                </div>
                <div class="form-group">
                    <label>ชื่อ</label><br>
                    <input type="text" name="firstname" value="<?php echo $firstname ?>" style="width: 25% ;border: 0px; border-bottom: 1px solid black;"><br><br>
                </div>
                <div class="form-group">
                    <label>นามสกุล</label><br>
                    <input type="text" name="lastname" value="<?php echo $lastname ?>" style="width: 25% ;border: 0px; border-bottom: 1px solid black;"><br><br>
                </div>

                <div class="form-group">
                    <label>email</label><br>
                    <input type="text" name="email" value="<?php echo $email ?>" style="width: 25% ;border: 0px; border-bottom: 1px solid black;"><br><br>
                </div>

                <div class="form-group">
                    <label>เบอร์โทรศัพท์</label><br>
                    <input type="text" name="num_phone" value="<?php echo $num_phone ?>" style="width: 25% ;border: 0px; border-bottom: 1px solid black;"><br><br>
                </div>

                <div class="form-group" style="margin-bottom:30px;">
                <label for="user_level">ระดับงาน</label><br>
                <select class="form_control" name="user_level">
                    <option value="" selected disabled>-กรุณาเลือกแผนกที่คุณอยู่-</option>
                    <?php foreach($query_names as $value){ ?>
                    <option value="<?php echo $value['department']?>"><?= $value['department']?></option>
                    <?php  } ?>
                </select>
            </div>

                <button type="submit" class="btn btn-primary" name="update"
                    onclick="return confirm('ต้องการที่จะบันทึกข้อมูลหรือไม่')">อัปเดต</button>
        </div>
        </form>
        </div>
    </section>
</body>

</html>



<?php
/// แก้ไขข้อมูลการซ่อม /// 
    } else if (isset($_GET['update_repair'])) {
        $id = $_GET['update_repair'];
        $sql_edit = "SELECT * FROM `notify_repair` where id = '$id'";
        $resultt = mysqli_query($conn,$sql_edit);
        while($row = mysqli_fetch_array($resultt)){
            $day_take = $row['day_take'];
            $customer = $row['customer'];
            $tools_name = $row['tools_name'];
            $note = $row['note'];
            $noid = $row['noid'];
            $username = $row['username'];
            $id = $row['id'];
        }
    
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
   
    
    <title>แก้ไขข้อมูลแจ้งซ่อม</title>
</head>

<body>
    <?php if (!isset($_SESSION['user_level'])) header("location: ../login/loginn.php");  ?>
    <?php 
    $sql_names = "SELECT DISTINCT noid FROM deprecia";
    $query_names = mysqli_query($conn,$sql_names);

    date_default_timezone_set('asia/bangkok');
    $day_take = date('Y-m-d');
    $names = "";
    $locates = "";
    $query_namess = "";

    $username=$_SESSION['username'] ;
    ?>

    <section class="home-section">
            <div style ="background-color:#81559d;box-shadow: 5px 5px #4a4a4a;">
                <div class="text" style ="font-size:30px;color:white;">แจ้งศูนย์ซ่อมโรงพยาบาลพะเยา</div style="padding:30px;"></div>
            </div><br>
        

            <div style="margin-left:35%;margin-top:50px">
            <form method="POST">
                <div class="form-group">
                    <label  style="font-size:18px;">หมายเลขครุภัณฑ์</label><br>
                    <input type="text" name="noid" id="noid" value="<?php echo $noid ?>" style="width: 500px; ;border: 0px; border-bottom: 1px solid black">
                </div><br>

                <div style="margin-left:130px;">
                            <button type="submit" name="search_day" class="btn btn-primary"
                                style="margin-left:25px">ค้นหา</button>
                            <button type="submit" name="search_total" class="btn btn-danger"
                                style="margin-left:25px">ยกเลิก</button>
                </div>
               
            </form>

            <?php
        /// ค้นหาเลขครุภัณฑ์ ///
        if(isset($_POST['search'])){ 
            
            $noid = $_POST['noid'];
            $noid =str_replace("_"," ",$noid);
            $sql_noid = "SELECT * FROM `deprecia` WHERE `noid` = '$noid';";
            $query_namess = mysqli_query($conn,$sql_noid);
            if(mysqli_num_rows($query_namess)==1){
                while($row = mysqli_fetch_array($query_namess)){
                    $names = $row['names'];
                    $locates = $row['locates'];   
                    $noid = $row['noid'];   
                }
                
            }else if(mysqli_num_rows($query_namess)==0) {
                echo "<script>";
			    echo "alert('อุปกรณ์นี้ไม่มีเลขครุภัณฑ์ในฐานข้อมูล !');";
			    echo "window.location='index_repair.php';";
          	    echo "</script>";
            }    
            ///  ยกเลิกการค้นหาข้อมูล ///
        }else if(isset($_POST['cancel'])){
        $noid = '';
        $names = '';
        $locates = '';
        $tools_name = '';
        $customer = '';
        $note = '';
        }else{
            
    }
?>
            <!-- บันทึกการเเจ้งซ่อม !-->
            <form action="../backend/qury_user/update.php" method="POST">
                <br>
                <div class=form-group>
                    <label  style="font-size:18px;">วันที่แจ้งซ่อม</label><br>
                    <input type="date" name="day_take" value="<?php echo $day_take; ?>" readonly  style="width: 500px;border: 0px; border-bottom: 1px solid black;">
                </div>

                <input type="text" name="id" value="<?php echo $id ?>" hidden  style="width: 500px;border: 0px; border-bottom: 1px solid black;">

                <input type="text" name="username" value="<?php echo $username?>" hidden  style="width: 500px;border: 0px; border-bottom: 1px solid black;">

                <div class=form-group>
                    <label  style="font-size:18px;">หมายเลขครุภัณฑ์</label><br>
                    <input type="text" name="noid" value="<?php echo $noid?>"  style="width: 500px;border: 0px; border-bottom: 1px solid black;">
                </div>
                <div class=form-group>
                    <label  style="font-size:18px;">อุปกรณ์ส่งซ่อม</label><br>
                    <input type="text" name="tools_name" value="<?php echo $tools_name?>"  style="width: 500px;border: 0px; border-bottom: 1px solid black;">
                </div>

                <div class=form-group>
                    <label  style="font-size:18px;">หน่วยงาน</label><br>
                    <input type="text" name="customer" value="<?php echo $customer?>"  style="width: 500px;border: 0px; border-bottom: 1px solid black;">
                </div>

                <div class="form-group">
                    <label  style="font-size:18px;">หมายเหตุ/อาการเสีย</label><br>
                    <input type="text" name="note"  value="<?php echo $note ?>"style="width: 500px;border: 0px; border-bottom: 1px solid black;">
                </div>

                <button type="submit" class="btn btn-primary" name="save" style="margin-left:185px">บันทึกแจ้งซ่อม</button>
            </form>

        </div>
        </div>
        </div>
    </section>
</body>

</html>

<!-- ยกเลิกการซ่อมโดยใช้การเปลี่ยน *สถานะการซ่อม* = ยกเลิกการซ่อม -!>
<?php 
    }else if(isset($_GET['cancel'])){
        $id = $_GET['cancel'];
        $update_cancel = "UPDATE notify_repair SET status_repair = 'ยกเลิก' where id = '$id'";
        $result_cancel = mysqli_query($conn,$update_cancel);
        if($result_cancel)
        {
            echo "<script type='text/javascript'>";
                    echo "alert('ระบบได้ทำการยกเลิกการซ่อมเรียบร้อย');";
                    echo "window.location = 'index_history.php'; ";
            echo "</script>";
        }
        else
        {
            echo "<script type='text/javascript'>";
                    echo "alert('เกิดข้อผิดพลาดในข้อมูล');";
                    echo "window.location = 'index_history.php'; ";
            echo "</script>";
        }

}else if(isset($_GET['update_stafix'])){
    $date_repairend = date('Y-m-d');
    $id = $_GET['update_stafix'];
    $update_stafix = "UPDATE repair_tools SET edit_fixx ='สำเร็จ' ,date_repairend='$date_repairend' WHERE noti_repair_id ='$id'";
    $update_status = "UPDATE notify_repair SET status_repair ='รอตรวจสอบ'  WHERE id ='$id'";
    $result_status = mysqli_query($conn,$update_status); 
    $result_success = mysqli_query($conn,$update_stafix); 
    if($result_success)
        {
            echo "<script type='text/javascript'>";
                    echo "alert('ระบบได้ทำการสถานะการซ่อมเสร็จสิ้น');";
                    echo "window.location = 'repair_all.php'; ";
            echo "</script>";
        }
        else
        {
            echo "<script type='text/javascript'>";
                    echo "alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล');";
                    echo "window.location = 'repair_all.php'; ";
            echo "</script>";
        }
}else{} ?>