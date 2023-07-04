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
    <html lang="en" dir="ltr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../plugins/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <link rel="stylesheet" href="../plugins/style.css">
        <!-- include sweet alert!-->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
        <script src="../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="../../node_modules/sweetalert2/dist/sweetalert2.min.css">
        <!-- Boxicons CDN Link -->
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        
        
        <script src="https://kit.fontawesome.com/b23c38ddca.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <!-- ช่องค้นหา หน้าpage  -->
        <link rel="stylesheet" type="text/css" href="../plugins/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="../plugins/js/jquery.dataTables.js"></script>


      

        <title>เอกสารซ่อมอุปกรณ์</title>
    </head>

    <body>
        
    <?php if (!isset($_SESSION['user_level'])) header("location: ../login/loginn.php");  ?>
        <section class="home-section">
        <div style ="background-color:#81559d;box-shadow: 5px 5px #4a4a4a;">
            <div class="text" style ="font-size:30px;color:white;">เอกสารซ่อมอุปกรณ์</div style="padding:30px;"></div>
        </div><br>

        <?php   date_default_timezone_set('asia/bangkok');
                $day_take = date('Y-m-d');
                $user_level = $_SESSION['user_level'];
        ?>
        <div style="padding:20px">
        
            <div style="border-style: ridge;">
            <div style= "background-color:#81559d;">
                <label style="padding-left:30px;font-size:18px;color:white;margin-top:30">ค้นหาข้อมูล</label>
            </div><br>

            <form action="send_user.php" method="POST">
                <div style="margin-left: 35%;">
                        <label style="margin-left:25px">ตั้งเเต่วันที่</label></label>
                        <input type="date"  name="date_s" value="<?php echo $day_take;?>" style="margin-left:5px">

                        <label style="margin-left:10px">ถึงวันที่</label></label>
                        <input type="date" name="date_e" value="<?php echo $day_take;?>"  style="margin-left:5px">
                        <br><br>
                        <div style="margin-left:130px;">
                            <button type="submit" name="search_day" class="btn btn-primary"
                                style="margin-left:25px">ค้นหา</button>
                            <button type="submit" name="search_total" class="btn btn-success"
                                style="margin-left:25px">ดูทั้งหมด</button>
                        </div>
                        
                    </div><br>
            </form>
            </div><br>
            <table class="table" id="data_table">
                <thead>
                    <tr>
                        <th style="text-align: center;">ลำดับ</th>
                        <th style="text-align: center;">วันที่ตรวจสอบ</th>
                        <th style="text-align: center;">ชื่ออุปกรณ์</th>
                        <th style="text-align: center;">เลขครุภัณฑ์</th>
                        <th style="text-align: center;">หน่วยงาน</th>
                        <th style="text-align: center;">หมายเหตุ</th>
                        <th style="text-align: center;">สถานะการตรวจสอบ</th>
                        <th style="text-align: center;">ข้อมูลผู้แจ้งซ่อม</th>
                        <th style="text-align: center">พิมพ์</th>
                        </tr>
                </thead>
                <tbody>
            
                    <?php 
        $user_level=$_SESSION['user_level'];
        $user = $_SESSION['user'];
        $username=$_SESSION['username'];
        if($user_level == "ช่างคอมพิวเตอร์"){
            $sql =  "SELECT repair_tools.*,notify_repair.* FROM repair_tools LEFT JOIN notify_repair ON repair_tools.noti_repair_id = notify_repair.id WHERE (edit_fixx='ซ่อมสำเร็จ' OR edit_fixx='แทงชำรุด') AND type_work = 'ศูนย์คอมพิวเตอร์';";
            $result_total = mysqli_query($conn,$sql);
            $num = 1;
        }else if($user_level == "ช่างซ่อมบำรุงทั่วไป"){
            $sql =  "SELECT repair_tools.*,notify_repair.* FROM repair_tools LEFT JOIN notify_repair ON repair_tools.noti_repair_id = notify_repair.id WHERE (edit_fixx='ซ่อมสำเร็จ' OR edit_fixx='แทงชำรุด') AND type_work = 'ศูนย์ซ่อมบำรุง'";
            $result_total = mysqli_query($conn,$sql);
            $num = 1;
        }else if($user_level == "ช่างเครื่องมือแพทย์"){
            $sql = "SELECT repair_tools.*,notify_repair.* FROM repair_tools LEFT JOIN notify_repair ON repair_tools.noti_repair_id = notify_repair.id WHERE (edit_fixx='ซ่อมสำเร็จ' OR edit_fixx='แทงชำรุด') AND type_work = 'ศูนย์เครื่องมือแพทย์ฯ'";
            $result_total = mysqli_query($conn,$sql);
            $num = 1; 
        }else if($user_level == "แอดมิน"){
                $sql =  "SELECT repair_tools.*,notify_repair.* FROM repair_tools LEFT JOIN notify_repair ON repair_tools.noti_repair_id = notify_repair.id WHERE edit_fixx='ซ่อมสำเร็จ' OR edit_fixx='แทงชำรุด' AND type_work = 'แอดมิน'";
                 $result_total = mysqli_query($conn,$sql);
                 $num = 1; 
    
        }else{
            echo "<script type='text/javascript'>";
            echo "window.location = 'menu.php'; ";
            echo "alert('ไม่อนุญาติให้ทำรายการ');";
            echo "</script>";
        }
        if(isset($_POST['search_total'])){
            if (mysqli_num_rows($result_total) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($result_total)) {
                    $status_repair = $row['status_repair'];
                    $user = $_SESSION['user'];
                    $username = $row['username'];
                    ?>
                    <tr>
                    <td style ='text-align:center;'><?php echo $num ?></td> 
                                    <td style ='text-align:center;'><?php echo $row['date_check'] ?></td>
                                    <td style ='text-align:center;'><?php echo $row['noid'] ?></td>
                                    <td style ='text-align:center;'><?php echo $row['tools_name']  ?></td>
                                    <td style ='text-align:center;'><?php echo $row['customer'] ?></td>
                                    <td style ='text-align:center;'><?php echo $row['problem'] ?></td>
                                    <td style ='text-align:center;'><?php echo $row['edit_fixx'] ?></td>  
                                    <td style='text-align:center;margin-bottom:30px' >
                                        <button onclick="a5('<?php echo $row['username']?>');" type="submit" class="btn btn-link" data-toggle="modal" data-target="#myModal" ><span class='fa-solid fa-rectangle-list fa-2x' style='color:black'></span></button>
                                    </td>
                                    <td style ='text-align:center;;margin-top:30px'>
                                        <a onclick="print('<?php echo $row['id'] ?>','<?php echo $user ?>')" helf='#'>
                                            <span class='fa-solid fa-print fa-2x' style='color:black'></span>
                                        </a>
                                    </td>
                          <?php 
              $num++;
                      }
            }else{

            }mysqli_close($conn);



        }else if(isset($_POST['search_day'])){
            $date_s = $_POST['date_s'];
            $date_e = $_POST['date_e'];
            if($user_level == "ช่างคอมพิวเตอร์"){
                $sql =  "SELECT repair_tools.*,notify_repair.* FROM repair_tools LEFT JOIN notify_repair ON repair_tools.noti_repair_id = notify_repair.id WHERE `date_check` BETWEEN '$date_s' AND '$date_e' AND (edit_fixx='ซ่อมสำเร็จ' OR edit_fixx='แทงชำรุด') AND type_work = 'ศูนย์คอมพิวเตอร์';";
                $result_total = mysqli_query($conn,$sql);
                $num = 1;
            }else if($user_level == "ช่างซ่อมบำรุงทั่วไป"){
                $sql =  "SELECT repair_tools.*,notify_repair.* FROM repair_tools LEFT JOIN notify_repair ON repair_tools.noti_repair_id = notify_repair.id WHERE `date_check` BETWEEN '$date_s' AND '$date_e' AND (edit_fixx='ซ่อมสำเร็จ' OR edit_fixx='แทงชำรุด') AND type_work = 'ศูนย์ซ่อมบำรุง'";
                $result_total = mysqli_query($conn,$sql);
                $num = 1;
            }else if($user_level == "ช่างเครื่องมือแพทย์"){
                $sql = "SELECT repair_tools.*,notify_repair.* FROM repair_tools LEFT JOIN notify_repair ON repair_tools.noti_repair_id = notify_repair.id WHERE `date_check` BETWEEN '$date_s' AND '$date_e' AND (edit_fixx='ซ่อมสำเร็จ' OR edit_fixx='แทงชำรุด') AND type_work = 'ศูนย์เครื่องมือแพทย์ฯ'";
                $result_total = mysqli_query($conn,$sql);
                $num = 1; 
            }else if($user_level == "แอดมิน"){
                    $sql =  "SELECT repair_tools.*,notify_repair.* FROM repair_tools LEFT JOIN notify_repair ON repair_tools.noti_repair_id = notify_repair.id WHERE `date_check` BETWEEN '$date_s' AND '$date_e' AND edit_fixx='ซ่อมสำเร็จ' OR edit_fixx='แทงชำรุด' AND type_work = 'แอดมิน'";
                     $result_total = mysqli_query($conn,$sql);
                     $num = 1; 
        
            }else{
                echo "<script type='text/javascript'>";
                echo "window.location = 'menu.php'; ";
                echo "alert('ไม่อนุญาติให้ทำรายการ');";
                echo "</script>";
            }

            if (mysqli_num_rows($result_total) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($result_total)) {
                    $status_repair = $row['status_repair'];
                    $user = $_SESSION['user'];
                    $username = $row['username'];
                    ?>
                    <tr>
                        
                    <td style ='text-align:center;'><?php echo $num ?></td> 
                                    <td style ='text-align:center;'><?php echo $row['date_check'] ?></td>
                                    <td style ='text-align:center;'><?php echo $row['noid'] ?></td>
                                    <td style ='text-align:center;'><?php echo $row['tools_name']  ?></td>
                                    <td style ='text-align:center;'><?php echo $row['customer'] ?></td>
                                    <td style ='text-align:center;'><?php echo $row['problem'] ?></td>
                                    <td style ='text-align:center;'><?php echo $row['edit_fixx'] ?></td>  
                                    <td style='text-align:center;margin-bottom:30px' >
                                        <button onclick="a5('<?php echo $row['username']?>');" type="submit" class="btn btn-link" data-toggle="modal" data-target="#myModal" ><span class='fa-solid fa-rectangle-list fa-2x' style='color:black'></span></button>
                                    </td>
                                    <td style ='text-align:center;;margin-top:30px'>
                                        <a onclick="print('<?php echo $row['id'] ?>','<?php echo $user ?>')" helf='#'>
                                            <span class='fa-solid fa-print fa-2x' style='color:black'></span>
                                        </a>
                                    </td>
                          <?php 
              $num++;
                      }
            }else if(mysqli_num_rows($result) == 0){/// ถ้าไม่มีข้อมูลให้เเสดง ข้อความว่า ไม่มีมีข้อมูลในฐานการแจ้งซ่อม ///
                echo   "<tr>";
                    
                echo    "</tr>" ;  
            }else{

            }mysqli_close($conn);
                        
            }else {
                if (mysqli_num_rows($result_total) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result_total)) {
                        $user = $_SESSION['user'];
                        ?>
                              <tr>
                                    <td style ='text-align:center;'><?php echo $num ?></td> 
                                    <td style ='text-align:center;'><?php echo $row['date_check'] ?></td>
                                    <td style ='text-align:center;'><?php echo $row['noid'] ?></td>
                                    <td style ='text-align:center;'><?php echo $row['tools_name']  ?></td>
                                    <td style ='text-align:center;'><?php echo $row['customer'] ?></td>
                                    <td style ='text-align:center;'><?php echo $row['problem'] ?></td>
                                    <td style ='text-align:center;'><?php echo $row['edit_fixx'] ?></td>  
                                    <td style='text-align:center;margin-bottom:30px' >
                                        <button onclick="a5('<?php echo $row['username']?>');" type="submit" class="btn btn-link" data-toggle="modal" data-target="#myModal" ><span class='fa-solid fa-rectangle-list fa-2x' style='color:black'></span></button>
                                    </td>
                                    <td style ='text-align:center;;margin-top:30px'>
                                        <a onclick="print('<?php echo $row['id'] ?>','<?php echo $user ?>')" helf='#'>
                                            <span class='fa-solid fa-print fa-2x' style='color:black'></span>
                                        </a>
                                    </td>
                                    <?php 
                        $num++;
                                }
                }else{
    
                }mysqli_close($conn);
            }
            
        
        
        ?>

        <script>
            function print(id,user) {
                Swal.fire({
                    title: 'ใบส่ซ่อม',
                    text: "คุณต้องพิมพ์เอกสารใบซ่อมหรือไม่",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'ยกเลิก',
                    confirmButtonText: 'ยืนยัน'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'ทำการส่งเรื่องให้เรียบร้อย!',
                            '',
                            'success'
                        )
                        setTimeout(function() {
                            window.location = "exportPDF.php?print=" + id +"&user="+ user;
                        }, 1000);

                    }
                })
                }
        </script>
        <script>
        $(document).ready( function () {
            $('#data_table').DataTable();
        } );
        </script>
                </tbody>
            </table>
            </div>
            
        </section>
        <div class="modal fade" id="myModal" role="dialog">
            <div id ='modal-div'></div>
        </div> 
    </body>
        <script>
                function a5(text){
                    $( "#modal-div" ).load('modal.php?show_user='+text);
                }    
        </script>
    <style>
        table, td{
                border: 2px solid black;
                background-color: white;
                
        }
        th{
                text-align: center;
                background-color: #adc2ef;
                border: 2px solid black;
                color: black;
        }
</style>
    </html>