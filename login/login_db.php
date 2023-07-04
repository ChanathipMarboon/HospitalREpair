<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
<?php 
    session_start();
    include('server.php');
    $errors = array();
    if (isset($_POST['login_user'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);  
    
        if (count($errors) == 0) {
            $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password' ";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result);
                $_SESSION['userid'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['user'] = $row['firstname'] . " " . $row['lastname'];
                $_SESSION['user_level'] = $row['user_level'];
                $_SESSION['status'] = $row['status'];
               

                if($_SESSION['status']== 'อนุมัติ'){
                        if($_SESSION['user_level']=='แอดมิน'){
                            header("Location:../fontend/admin/index_a.php");
                        }
                        if($_SESSION['user_level']!='แอดมิน')
                        header("Location: ../fontend/menu.php");
                }else if(($_SESSION['status']== 'รอการอนุมัติ')||($_SESSION['status']== 'ไม่อนุมัติ')){
                    echo "<script type='text/javascript'>";
                    echo "alert('กรุณารอทางแอดมินทำการอนุมัติ');";
                    echo "window.location = '../login/loginn.php'; ";
                    echo "</script>";
                }

            }else {
                    echo "<script type='text/javascript'>";
                    echo "alert('ชื่อผู้ใช้หรือรหัสผ่านของคุณไม่ถูกต้อง');";
                    echo "window.location = '../login/loginn.php'; ";
                    echo "</script>";
                
            }
        } else {
            echo "<script type='text/javascript'>";
            echo "alert('กรุณาระบุชื่อผู้ใช้เเละรหัสผ่าน');";
            echo "window.location = '../login/loginn.php'; ";
            echo "</script>";
        }
    }else{
            echo "<script type='text/javascript'>";
            echo "alert('เกิดข้อผิดพลาดในการคิวรีข้อมูล');";
            echo "window.location = '../login/loginn.php'; ";
            echo "</script>";
    }
    
?>
