<?php 
    include('menu.php');
  if (!isset($_SESSION['user_level'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: ../login/loginn.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['user_level']);
  	header("location: ../login/loginn.php");
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
    <script src="https://kit.fontawesome.com/b23c38ddca.js" crossorigin="anonymous"></script>
    <!-- menu.css -->
    <link rel="stylesheet" href="../plugins/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- sweet alert -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    
    <title>บันทึกแจ้งซ่อม</title>
</head>

<body>
<?php if (!isset($_SESSION['user_level'])) header("location: ../login/loginn.php");  ?>
    <?php 
    $user_level = $_SESSION['user_level'];
    date_default_timezone_set('asia/bangkok');
    $day_take = date('Y/m/d');
    $date_show = date('d-m-Y');
    $names = "";
    $locates = "";
    $noid ="";
    $typeid ="";
    
    $query_namess = "";

    $username=$_SESSION['username'] ;
    ?>

    <section class="home-section">
        <div style ="background-color:#81559d;box-shadow: 5px 5px #4a4a4a;">
            <div class="text" style="color:white;"> แจ้งศูนย์ซ่อมโรงพยาบาลพะเยา</div>
        </div>

        <div style="margin-left:35%;margin-top:50px">
        <form  method="POST">    
                <div class="form-group">
                    <label style="font-size:18px;">วันที่เเจ้งซ่อม</label><br>
                    <input type="text" class="form-control"  value="<?php echo $date_show ?>" style="width: 500px;border: 0px; border-bottom: 1px solid black" readonly>
                </div><br> 
                <div class="form-group">
                    <label style="font-size:18px;">หมายเลขครุภัณฑ์</label><br>
                    <input type="text" name="noid"  style="width: 500px;border: 0px; border-bottom: 1px solid black" id="validationCustom" required>
                </div><br>
                <div style="margin-left:170px">
                     <button type="submit" class="btn btn-success" name="search" >ค้นหา</button>
                    <button type="submit" class="btn btn-danger" name="cancel" style=" margin-left: 10px;">ยกเลิก</button>
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
                    $typeid = $row['typeid'];
                }   

                
            }else if(mysqli_num_rows($query_namess)==0) {
                echo "<script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'warning',
                        text: 'อุปกรณ์นี้ไม่มีเลขครุภัณฑ์ในฐานข้อมูล !!',
                        icon: 'warning',
                        timer: 3000,
                        showConfirmButton: false
                    });
                })
                
            </script>";
            
            }    
            ?>
    <!-- บันทึกการเเจ้งซ่อม !-->
    <form action="../backend/qury_user/noti_repair.php" method="POST">
        <br>
        <input name="day_take" value="<?php echo $day_take ?>" hidden ><br>

        <input type="text" name="username" value="<?php echo $username?>"hidden >

        <input type="text" name="typeid" value="<?php echo $typeid?>" hidden>

        <div class="form-group"> 
            <label >หมายเลขครุภัณฑ์</label><br>
            <input type="text" name="noid" value="<?php echo $noid?>" readonly  style="width: 500px ;border: 0px; border-bottom: 1px solid black;">
        </div>
        
        <div class="form-group"> 
            <label >อุปกรณ์ส่งซ่อม</label><br>
            <input type="text" name="tools_name" value="<?php echo $names?>"  readonly style="width: 500px ;border: 0px; border-bottom: 1px solid black;">
        </div>

        <div class="form-group">
            <label >หน่วยงาน</label><br>
            <input type="text" name="customer" value="<?php echo $locates?>" readonly style="width: 500px; border: 0px; border-bottom: 1px solid black">
        </div>

        <div class="form-group">
            <label >หมายเหตุ/อาการเสีย</label><br>
            <input type="text" name="note" style="width: 500px;border: 0px; border-bottom: 1px solid black">
        </div>

        <button type="submit" class="btn btn-primary" name="save" style="margin-left:185px">บันทึกแจ้งซ่อม</button>
            <?php
            ///  ยกเลิกการค้นหาข้อมูล ///
        }else if(isset($_POST['cancel'])){
        $noid = '';
        $names = '';
        $locates = '';
        $typeid ='';
        }else{
            
    }
?>
    
    </form>

    </div>
    </div>
</div>
</section>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</html>