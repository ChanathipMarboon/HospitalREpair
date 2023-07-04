<?php 
    include('../menu.php');
  if (!isset($_SESSION['user_level'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: ../../login/loginn.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['user_level']);
  	header("location: ../../login/loginn.php");
  }
?>
<!DOCTYPE html>
    <html lang="en" dir="ltr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../plugins/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <link rel="stylesheet" href="../../plugins/style.css">
        <!-- Boxicons CDN Link -->
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        
        <!-- ช่องค้นหา หน้าpage  -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

        <!-- include bootstrap !-->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title>ประวัติการแจ้งซ่อมทั้งหมด</title>
    </head>

    <body>

        <?php if (!isset($_SESSION['user_level'])) header("location: ../../login/loginn.php");  ?>


        <section class="home-section" >
        <div style ="background-color:#81559d;box-shadow: 5px 5px #4a4a4a;">
            <div class="text" style ="font-size:30px;color:white;">ประวัติการแจ้งซ่อมทั้งหมด</div><br>
        </div>
    </div style="padding:30px;">
        <?php   date_default_timezone_set('asia/bangkok');
                $day_take = date('Y-m-d');

        ?>
        
        <div style="padding:20px">
        
            <div style="border-style: ridge;">
            <div style= "background-color:#81559d;">
                <label style="padding-left:30px;font-size:18px;color:white;margin-top:30">ค้นหาข้อมูล</label>
            </div><br>
            
                <form action="index_history.php" method="POST">
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
            

            <table class="table"  id="data_table">
                <thead >
                    
                        <th style ='text-align:center;'>ลำดับ</th>
                        <th style ='text-align:center;'>วันที่แจ้งซ่อม</th>
                        <th style ='text-align:center;'>ชื่ออุปกรณ์</th>
                        <th style ='text-align:center;'>เลขครุภัณฑ์</th>
                        <th style ='text-align:center;'>สถานที่ทำการแจ้งซ่อม</th>
                        <th style ='text-align:center;'>หมายเหตุ</th>
                        <th style ='text-align:center;'>สถานะการซ่อม</th>
                        <th style ='text-align:center;'>รายละเอียด</th>
                        <th style ='text-align:center;'>แก้ไขข้อมูล</th>
                        <th style ='text-align:center;'>ยกเลิกการซ่อม</th>
                    
                </thead>
                <tbody>

        <?php 
        $username=$_SESSION['username'];
        $sql =  "SELECT * FROM `notify_repair` where   NOT status_repair ='ยกเลิก'  \n". "ORDER BY `notify_repair`.`day_take` DESC;";
        $result_total = $conn->query($sql);
        $num = 1;

        if(isset($_POST['search_total'])){
            
            if (mysqli_num_rows($result_total) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($result_total)) {
                    $status_repair = $row['status_repair'];
                ?>
                 <!-- ช่องค้นหา หน้าpage  -->
                <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
                <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
                        <tr>
                            <td><?php echo $num ;?></td>
                            <td style ='text-align:center;'><?php echo $row["day_take"] ;?></td>
                            <td style ='text-align:center;'><?php echo $row["tools_name"] ;?></td>
                            <td style ='text-align:center;'><?php echo $row["noid"] ;?></td>
                            <td style ='text-align:center;'><?php echo $row["customer"] ;?></td>
                            <td style ='text-align:center;'><?php echo $row["note"] ;?></td> 
                            <td style ='text-align:center;'><?php echo $status_repair;?></td>
                            <td><a href='detail.php?detail=<?php echo $row['id'];?>' ><span class='fas fa-edit fa-2x' style='color:black;'></span></a></td>
                            <<?php if($status_repair=="รอดำเนินการ"){?>
                            <td style ='text-align:center;'><a href='edit.php?update_repair=<?php echo $row['id'];?>' ><span class='fas fa-edit fa-2x' style='color:black;'></span></a></td>
                            <td style ='text-align:center;'><a href='edit.php?cancel=<?php echo $row['id'];?>' onclick="return confirm('ยืนยันที่จะยกเลิกการซ่อมใช่หรือไม่')"><span class='fas fa-trash-alt fa-2x ' style='color:black;'></span></a></td>
                            <?php }else{?>
                                <td></td>
                                <td></td>
                                <?php }?>
                        </tr>
                <?php
                    
                    $num++;
                            }
            }else{

            }mysqli_close($conn);

        }else if(isset($_POST['search_day'])){
            $date_s = $_POST['date_s'];
            $date_e = $_POST['date_e'];
            $sql = "SELECT * FROM `notify_repair` where day_take BETWEEN '$date_s' AND '$date_e'AND NOT status_repair ='ยกเลิก'";
            $result = $conn->query($sql);
            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                    $status_repair = $row['status_repair'];
                    ?>
                     <!-- ช่องค้นหา หน้าpage  -->
                    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
                    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
                            <tr>
                                <td><?php echo $num ;?></td>
                                <td style ='text-align:center;'><?php echo $row["day_take"] ;?></td>
                                <td style ='text-align:center;'><?php echo $row["tools_name"] ;?></td>
                                <td style ='text-align:center;'><?php echo $row["noid"] ;?></td>
                                <td style ='text-align:center;'><?php echo $row["customer"] ;?></td>
                                <td style ='text-align:center;'><?php echo $row["note"] ;?></td> 
                                <td style ='text-align:center;'><?php echo $status_repair;?></td>
                                <td><a href='detail.php?detail=<?php echo $row['id'];?>' ><span class='fas fa-edit fa-2x' style='color:black;'></span></a></td>
                                <?php if($status_repair=="รอดำเนินการ"){?>
                                <td style ='text-align:center;'><a href='edit.php?update_repair=<?php echo $row['id'];?>' ><span class='fas fa-edit fa-2x' style='color:black;'></span></a></td>
                                <td style ='text-align:center;'><a href='edit.php?cancel=<?php echo $row['id'];?>' onclick="return confirm('ยืนยันที่จะยกเลิกการซ่อมใช่หรือไม่')"><span class='fas fa-trash-alt fa-2x ' style='color:black;'></span></a></td>
                                <?php }else{?>
                                <td></td>
                                <td></td>
                                <?php }?>
                            </tr> 
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
                        $status_repair = $row['status_repair'];
                ?>

                    <!-- ช่องค้นหา หน้าpage  -->
                    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
                    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
                        <tr>
                            <td><?php echo $num ;?></td>
                            <td style ='text-align:center;'><?php echo $row["day_take"] ;?></td>
                            <td style ='text-align:center;'><?php echo $row["tools_name"] ;?></td>
                            <td style ='text-align:center;'><?php echo $row["noid"] ;?></td>
                            <td style ='text-align:center;'><?php echo $row["customer"] ;?></td>
                            <td style ='text-align:center;'><?php echo $row["note"] ;?></td> 
                            <td style ='text-align:center;'><?php echo $status_repair;?></td>
                            <td style ='text-align:center;'><a href='detail.php?detail=<?php echo $row['id'];?>' ><span class='fas fa-edit fa-2x' style='color:black;'></span></a></td>
                            <?php if($status_repair=="รอดำเนินการ"){?>
                            <td style ='text-align:center;'><a href='edit.php?update_repair=<?php echo $row['id'];?>' ><span class='fas fa-edit fa-2x' style='color:black;'></span></a></td>
                            <td style ='text-align:center;'><a href='edit.php?cancel=<?php echo $row['id'];?>' onclick="return confirm('ยืนยันที่จะยกเลิกการซ่อมใช่หรือไม่')"><span class='fas fa-trash-alt fa-2x ' style='color:black;'></span></a></td>
                            <?php }else{?>
                                <td></td>
                                <td></td>
                                <?php }?>
                        </tr> 
                <?php
                    
                    $num++;
                            }
                }else{
    
                }mysqli_close($conn);
            }
            
        
        
        ?>
                </tbody>
            </table>
            </div>
        </section>
        <script>
            $(document).ready( function () {
                 $('#data_table').DataTable();
            } );
        </script>
        
    </body>
    <style>
        table, td{
                border: 1px solid black;
                background-color: white;
                
        }
        th{
                text-align: center;
                background-color: #adc2ef;
                border: 1px solid black;
                color: black;
        }
</style>
    </html>