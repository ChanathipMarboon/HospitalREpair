<?php 
    session_start();
    include('server.php'); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <div class="header">
        <h2 style="margin-left: 150px;margin-bottom:30px;">ลงทะเบียนสมาชิก</h2>
    </div>

    <form action="register_db.php" method="POST">
        <?php include('errors.php'); ?>
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

        <form action="register_db.php" method="POST">

            <div class="form-group" style="margin-left: 200px;">
                <label for="test">ชื่อ</label>
                <input type="text" class="form-control" name="firstname" id="inputAddress"
                    placeholder="กรุณาป้อนชื่อจริง">
            </div>

            <div class="form-group" style="margin-left: 200px;">

                <label for="inputAddress2">นามสกุล</label>
                <input type="text" class="form-control" name="lastname" id="inputAddress2"
                    placeholder="กรุณาป้อนนามสกุลจริง">
            </div>

            <div class="form-group" style="margin-left: 200px;">
                <label for="inputAddress2">หมายเลขโทรศัพท์</label>
                <input type="text" class="form-control" name="num_phone" id="inputAddress2"
                    placeholder="หมายเลขโทรศัพท์">
            </div>

            <div class="form-group" style="margin-left: 200px;">
                <label for="inputAddress2">อีเมล์</label>
                <input type="text" class="form-control" name="email" id="inputAddress2" placeholder="อีเมล์">
            </div>

            <div class="form-group" style="margin-left: 200px;">
                <label for="user_level">ระดับงาน</label><br>
                <select class="form_control" name="user_level">
                    <option value="" selected disabled>-กรุณาเลือกแผนกที่คุณอยู่-</option>
                    <?php foreach($query_names as $value){ ?>
                    <option value="<?php echo $value['department']?>"><?= $value['department']?></option>
                    <?php  } ?>
                </select>
            </div>


            <div class="form-row">
                <div class="form-group col-md-6" style="margin-left: 200px;">
                    <label for="inputEmail4">username</label>
                    <input type="text" class="form-control" name="username" id="inputEmail4" placeholder="usrename">
                </div>
                <div class="form-group col-md-6" style="margin-left: 200px;">
                    <label for="inputPassword4">รหัสผ่าน</label>
                    <input type="password" class="form-control" name="password_1" id="inputPassword4"
                        placeholder="Password">
                </div>
                <div class="form-group col-md-6" style="margin-left: 200px;">
                    <label for="inputPassword4">ยืนยันรหัสผ่าน</label>
                    <input type="password" class="form-control" name="password_2" id="inputPassword4"
                        placeholder="Password">
                </div>
            </div>

            <div class="input-group">
                <button type="submit" style="margin-left: 200px;background-color:rgb(00, 00, 128);" name="reg_user"
                    class="btn btn-primary"
                    onclick="return confirm('ต้องการที่จะลงทะเบียนใช่หรือไม่')">ลงทะเบียน</button>
                <button type="submit" style="margin-left: 20px;background-color:rgb(00, 00, 128);" name="reg_user"
                    class="btn btn-primary" onclick="cancer()">ยกเลิก</button>
            </div>
            <p style="margin-left: 200px;">Already a member?
                <a href="login.php">Sign in</a>
            </p>

        </form>

</body>

</html>