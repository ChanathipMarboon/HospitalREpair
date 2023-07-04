<?php 
    include('../menu.php'); 
    include('../../login/server.php'); 
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<title> Responsive Sidebar Menu  | CodingLab </title>-->
    <link rel="stylesheet" href="../../plugins/style.css">
    <!-- menu.css -->
    <link rel="stylesheet" href="../plugins/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    
    </script>
    <title>สมัครสมาชิก</title>
</head>

<body>
 <section class="home-section" >
    <div class="header" style ="background-color:#81559d;box-shadow: 5px 5px #4a4a4a;">
        <h2 style="padding:30px;color:white;font-size:30px;">ลงทะเบียนสมาชิก</h2>
    </div><br>

    <form action="../../backend/qury_admin/insertuser.php" method="POST">
        <?php include('../../login/errors.php'); ?>
        <?php if (isset($_SESSION['error'])) : ?>
        <div class="error">
            <h3>
                <?php 
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
            </h3>
        </div>
        <?php endif ?>

        <?php 
            $sql_names = "SELECT DISTINCT department FROM department_all ORDER BY department_all.department ASC";
            $query_names = mysqli_query($conn,$sql_names);
        ?>
        <div style="padding-left:30px;padding-right:30px;padding-top:30px;padding-bottom:30px;background-color:white;margin-left:30px;margin-right:30px">
                <form action="../../backend/qury_admin/insertuser.php" method="POST">
                    <div class="form-group" style="margin-left: 40px;padding-right:20px;" >
                        <label for="test" style="font-size:20px">ชื่อ</label>
                        <input type="text" class="form-control" name="firstname" id="inputAddress"
                            placeholder="กรุณาป้อนชื่อจริง">
                    </div>

                    <div class="form-group" style="margin-left: 40px;padding-right:20px;">
                        <label for="inputAddress2" style="font-size:20px">นามสกุล</label>
                        <input type="text" class="form-control" name="lastname" id="inputAddress2"
                            placeholder="กรุณาป้อนนามสกุลจริง">
                    </div>

                    <div class="form-group" style="margin-left: 40px;padding-right:20px;">
                        <label for="inputAddress2" style="font-size:20px">หมายเลขโทรศัพท์</label>
                        <input type="text" class="form-control" name="num_phone" id="inputAddress2"
                            placeholder="หมายเลขโทรศัพท์">
                    </div>

                    <div class="form-group" style="margin-left: 40px;padding-right:20px;">
                        <label for="inputAddress2" style="font-size:20px">อีเมล์</label>
                        <input type="text" class="form-control" name="email" id="inputAddress2" placeholder="อีเมล์">
                    </div>

                    <div class="form-group" style="margin-left: 40px;padding-right:20px;">
                        <label for="user_level" style="font-size:20px">ระดับงาน</label><br>
                        <select class="form_control" name="user_level" >
                            <option value="" selected disabled>-กรุณาเลือกแผนกที่คุณอยู่-</option>
                            <?php foreach($query_names as $value){ ?>
                            <option value="<?php echo $value['department']?>"><?= $value['department']?></option>
                            <?php  } ?>
                        </select>
                    </div>


                    <div class="form-row" style="margin-left: 35px;padding-right:20px;">
                        <div class="form-group col-md-6" >
                            <label for="inputEmail4" style="font-size:20px">username</label>
                            <input type="text" class="form-control" name="username" id="inputEmail4" placeholder="usrename">
                        </div>
                        <div class="form-group col-md-6" >
                            <label for="inputPassword4" style="font-size:20px">รหัสผ่าน</label>
                            <input type="password" class="form-control" name="password_1" id="inputPassword4"
                                placeholder="Password">
                        </div>
                        <div class="form-group col-md-6" >
                            <label for="inputPassword4" style="font-size:20px">ยืนยันรหัสผ่าน</label>
                            <input type="password" class="form-control" name="password_2" id="inputPassword4"
                                placeholder="Password">
                        </div>
                    </div>

                    <div class="input-group" style="margin-top: 20px;">
                        <button type="submit" style="margin-left:45%" name="reg_admin"
                            class="btn btn-success"
                            onclick="return confirm('ต้องการที่จะลงทะเบียนใช่หรือไม่')">ลงทะเบียน</button>
                        <button type="submit" style="margin-left:2%" name="reg_admin"
                            class="btn btn-danger" onclick="cancer()">ยกเลิก</button>
                    </div>
                </form>
        </div>
        
</section>
</body>

</html>