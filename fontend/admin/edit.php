<?php 
    include('../menu.php');
    include('../../login/server.php');
  if(isset($_SESSION['user_level'])) {
  	$_SESSION['msg'] = "You must log in first";
  }
  if(isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['user_level']);
  	header("location: ../../login/loginn.php");
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
    <link rel="stylesheet" href="../../plugins/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../table.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="../../plugins/style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <title>แก้ไขข้อมูลผู้ใช้งาน</title>
</head>
<?php 
            $sql_names = "SELECT DISTINCT department FROM department_all ORDER BY department_all.department ASC";
            $query_names = mysqli_query($conn,$sql_names);
        ?>
<body>

    <?php if (!isset($_SESSION['user_level'])) header("location: ../../login/loginn.php");  ?>
    <section class="home-section">
        <div style="margin-left:50px">
            <div class="text">เเก้ไขข้อมูล</div>
            <form method="POST" action="../../backend/qury_admin/update.php">
                <div hidden>
                    <label hidden>username</label><br>
                    <input type="text" name="username" value="<?php echo $username ?>" hidden><br><br>
                </div>
                <div class="form-group">
                    <label>ชื่อ</label><br>
                    <input type="text" name="firstname" value="<?php echo $firstname ?>"
                        style="width: 25% ;border: 0px; border-bottom: 1px solid black;"><br><br>
                </div>
                <div class="form-group">
                    <label>นามสกุล</label><br>
                    <input type="text" name="lastname" value="<?php echo $lastname ?>"
                        style="width: 25% ;border: 0px; border-bottom: 1px solid black;"><br><br>
                </div>

                <div class="form-group">
                    <label>email</label><br>
                    <input type="text" name="email" value="<?php echo $email ?>"
                        style="width: 25% ;border: 0px; border-bottom: 1px solid black;"><br><br>
                </div>

                <div class="form-group">
                    <label>เบอร์โทรศัพท์</label><br>
                    <input type="text" name="num_phone" value="<?php echo $num_phone ?>"
                        style="width: 25% ;border: 0px; border-bottom: 1px solid black;"><br><br>
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
    <!-- menu.css -->
    <link rel="stylesheet" href="../../plugins/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>แก้ไขข้อมูลผู้ใช้งาน</title>
</head>

<body>
    <?php if (!isset($_SESSION['user_level'])) header("location: ../../login/loginn.php");  ?>
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
        <div class="text">แจ้งศูนย์ซ่อมโรงพยาบาลพะเยา</div>
        <div style=" margin-left: 150px;">


            <form method="POST">
                <div>
                    <label>หมายเลขครุภัณฑ์</label><br>
                    <input type="text" name="noid" id="noid" value="<?php echo $noid ?>">
                </div><br>
                <button type="submit" class="btn btn-primary" name="search" style=" margin-left: 20px;">ค้นหา</button>
                <button type="submit" class="btn btn-primary" name="cancel" style=" margin-left: 10px;">ยกเลิก</button>
                <br>
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
        }else{
            
    }
?>
            <!-- บันทึกการเเจ้งซ่อม !-->
            <form action="../../backend/qury_admin/update.php" method="POST">
                <br>
                <div class=form-group>
                    <label>วันที่แจ้งซ่อม</label><br>
                    <input type="date" name="day_take" value="<?php echo $day_take; ?>" readonly >
                </div>

                <input type="text" name="id" value="<?php echo $id ?>" hidden>

                <input type="text" name="username" value="<?php echo $username?>" hidden>

                <div class=form-group>
                    <label>หมายเลขครุภัณฑ์</label><br>
                    <input type="text" name="noid" value="<?php echo $noid?>" >
                </div>
                <div class=form-group>
                    <label>อุปกรณ์ส่งซ่อม</label><br>
                    <input type="text" name="tools_name" value="<?php echo $names?>" >
                </div>

                <div class=form-group>
                    <label>หน่วยงาน</label><br>
                    <input type="text" name="customer" value="<?php echo $locates?>" >
                </div>

                <div class="form-group">
                    <label>หมายเหตุ/อาการเสีย</label><br>
                    <input type="text" name="note">
                </div>

                <button type="submit" class="btn btn-primary" name="update_edit">บันทึกแจ้งซ่อม</button>
            </form>

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

}else{

} ?>