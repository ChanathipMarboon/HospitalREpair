<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="../plugins/css/style.css">

</head>

<body>
    <br>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="img" style="background-image: url(../plugins/images/b-1.jpg);">
                        </div>
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">เข้าสู่ระบบ</h3>
                                </div>


                            </div>
                            <form action="login_db.php" class="signin-form" method="POST">

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

                                <div class="form-group mb-3">
                                    <label class="label" >Username</label>
                                    <input type="text" name="username" class="form-control" placeholder="Username" required >
                                </div>

                                <div class="form-group mb-3">
                                    <label class="label" for="password">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password" required >
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3"
                                        name="login_user">เข้าสู่ระบบ</button>
                                </div>

                                <div class="form-group d-md-flex">
                                    <div class="w-50 text-left">
                                        <label class="checkbox-wrap checkbox-primary mb-0">จำรหัสผ่าน
                                            <input type="checkbox" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="w-50 text-md-right">
                                        <a href="register.php">ลืมรหัสผ่าน</a>
                                    </div>
                                </div>
                            </form>
                            <p class="text-center">คุณได้เป็นสมาชิก? <a href="../login/register.php">สมัครสมาชิก</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>