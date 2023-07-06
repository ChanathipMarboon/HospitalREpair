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
    <script src="https://kit.fontawesome.com/b23c38ddca.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../plugins/style.css">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Boxicons CDN Link -->

    
    <!-- ช่องค้นหา หน้าpage  -->
    <link rel="stylesheet" type="text/css" href="../plugins/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="../plugins/js/jquery.dataTables.js"></script>

    <title>รายการซ่อม</title>
</head>

<body>

<section class="home-section" >
    <?php if (!isset($_SESSION['user_level'])) header("location: ../login/loginn.php");  ?>
    <div style ="background-color:#81559d;box-shadow: 5px 5px #4a4a4a;">
            <div class="text" style="color:white;">รายการซ่อม</div>
        </div>

        <?php   date_default_timezone_set('asia/bangkok');
                $day_take = date('Y-m-d');
                $user_level = $_SESSION['user_level'];
        ?>
        <div style="padding:20px"></div>
        <div style="border-style: ridge;">
            <div style= "background-color:#81559d;">
                <label style="padding-left:30px;font-size:18px;color:white;margin-top:30">ค้นหาข้อมูล</label>
            </div><br>
            
                <form action="repair_all.php" method="POST">
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
        </div>
        <div style="padding:20px;"> 
        <table class="table" id="data_table">
                <thead >
                
                    <th style="text-align: center;">ลำดับ</th>
                    <th style="text-align: center;">วันที่แจ้งซ่อม</th>
                    <th style="text-align: center;">วันที่รับเรื่อง</th>
                    <th style="text-align: center;">ชื่ออุปกรณ์</th>
                    <th style="text-align: center;">เลขครุภัณฑ์</th>
                    <th style="text-align: center;">หน่วยงาน</th>
                    <th style="text-align: center;">สถานะการซ่อม</th>
                    <th style="text-align: center;">หมายเหตุ</th>
                    <th style="text-align: center">รายละเอียด<br>
                    <th style="text-align: center">รับซ่อม<br>
                    <th style="text-align: center">สั่งอะไหล่<br>
                    <th style="text-align: center">ซ่อมเสร็จสิ้น<br>
                    
            </thead>
            <tbody>

                <?php 
        $username=$_SESSION['username'];
        if($user_level == "ช่างคอมพิวเตอร์"){
            $sql =  "SELECT * FROM repair_tools RIGHT JOIN notify_repair ON repair_tools.noti_repair_id = notify_repair.id where  (status_repair ='รับเรื่องแล้ว'OR status_repair='กำลังซ่อม' OR edit_fixx='แก้ไข' )  AND type_work ='ศูนย์คอมพิวเตอร์'  \n". "ORDER BY `notify_repair`.`day_take` DESC;";
            $result_total = mysqli_query($conn,$sql);
            $num = 1;
        }else if($user_level == "ช่างซ่อมบำรุงทั่วไป"){
            $sql =  "SELECT * FROM repair_tools RIGHT JOIN notify_repair ON repair_tools.noti_repair_id = notify_repair.id where  (status_repair ='รับเรื่องแล้ว'OR status_repair='กำลังซ่อม'  OR edit_fixx='แก้ไข' ) AND type_work ='ศูนย์ซ่อมบำรุง' \n". "ORDER BY `notify_repair`.`day_take` DESC;";
            $result_total = mysqli_query($conn,$sql);
            $num = 1;
        }else if($user_level == "ช่างเครื่องมือแพทย์"){
            $sql =  "SELECT * FROM repair_tools RIGHT JOIN notify_repair ON repair_tools.noti_repair_id = notify_repair.id where  (status_repair ='รับเรื่องแล้ว'OR status_repair='กำลังซ่อม' OR edit_fixx='แก้ไข' ) AND type_work ='ศูนย์เครื่องมือแพทย์ฯ' \n". "ORDER BY `notify_repair`.`day_take` DESC;"; 
            $result_total = mysqli_query($conn,$sql);
            $num = 1; 
        }else{
            echo "<script type='text/javascript'>";
            echo "window.location = 'menu.php'; ";
            echo "alert('ไม่อนุญาติให้ทำรายการ');";
            echo "</script>";
        }
    if(isset($_POST['search_total'])){
        $username=$_SESSION['username'];
        if($user_level == "ช่างคอมพิวเตอร์"){
            $sql =  "SELECT * FROM repair_tools RIGHT JOIN notify_repair ON repair_tools.noti_repair_id = notify_repair.id where  (status_repair ='รับเรื่องแล้ว'OR status_repair='กำลังซ่อม' OR edit_fixx='แก้ไข' ) AND type_work ='ศูนย์คอมพิวเตอร์'  \n". "ORDER BY `notify_repair`.`day_take` DESC;";
            $result_total = mysqli_query($conn,$sql);
            $num = 1;
        }else if($user_level == "ช่างซ่อมบำรุงทั่วไป"){
            $sql =  "SELECT * FROM repair_tools RIGHT JOIN notify_repair ON repair_tools.noti_repair_id = notify_repair.id where  (status_repair ='รับเรื่องแล้ว'OR status_repair='กำลังซ่อม' OR edit_fixx='แก้ไข' ) AND type_work ='ศูนย์ซ่อมบำรุง' \n". "ORDER BY `notify_repair`.`day_take` DESC;";
            $result_total = mysqli_query($conn,$sql);
            $num = 1;
        }else if($user_level == "ช่างเครื่องมือแพทย์"){
           $sql =  "SELECT * FROM repair_tools RIGHT JOIN notify_repair ON repair_tools.noti_repair_id = notify_repair.id where  (status_repair ='รับเรื่องแล้ว'OR status_repair='กำลังซ่อม' OR edit_fixx='แก้ไข' ) AND type_work ='ศูนย์เครื่องมือแพทย์ฯ' \n". "ORDER BY `notify_repair`.`day_take` DESC;"; 
            $result_total = mysqli_query($conn,$sql);
            $num = 1; 
        }else{
            echo "<script type='text/javascript'>";
            echo "window.location = 'menu.php'; ";
            echo "alert('ไม่อนุญาติให้ทำรายการ');";
            echo "</script>";
        }

    }else if(isset($_POST['search_day'])){
        $date_s = $_POST["date_s"];
        $date_e = $_POST["date_e"];
        if($user_level == "ช่างคอมพิวเตอร์"){
            $sql =  "SELECT * FROM repair_tools RIGHT JOIN notify_repair ON repair_tools.noti_repair_id = notify_repair.id where  (status_repair ='รับเรื่องแล้ว'OR status_repair='กำลังซ่อม' OR edit_fixx='แก้ไข')   AND type_work ='ศูนย์คอมพิวเตอร์' AND date_recive BETWEEN '$date_s' AND '$date_e' \n". "ORDER BY `notify_repair`.`day_take` DESC;";
            $result_total = mysqli_query($conn,$sql);
            $num = 1;
        }else if($user_level == "ช่างซ่อมบำรุงทั่วไป"){
            $sql =  "SELECT * FROM repair_tools RIGHT JOIN notify_repair ON repair_tools.noti_repair_id = notify_repair.id where  (status_repair ='รับเรื่องแล้ว'OR status_repair='กำลังซ่อม' OR edit_fixx='แก้ไข') AND type_work ='ศูนย์ซ่อมบำรุง' AND date_recive BETWEEN '$date_s' AND '$date_e' \n". "ORDER BY `notify_repair`.`day_take` DESC;";
            $result_total = mysqli_query($conn,$sql);
            $num = 1;
        }else if($user_level == "ช่างเครื่องมือแพทย์"){
           $sql =  "SELECT * FROM repair_tools RIGHT JOIN notify_repair ON repair_tools.noti_repair_id = notify_repair.id where  (status_repair ='รับเรื่องแล้ว'OR status_repair='กำลังซ่อม' OR edit_fixx='แก้ไข') AND type_work ='ศูนย์เครื่องมือแพทย์ฯ' AND date_recive BETWEEN '$date_s' AND '$date_e' \n". "ORDER BY `notify_repair`.`day_take` DESC;";
            $result_total = mysqli_query($conn,$sql);
            $num = 1; 
        

        }else{
            echo "<script type='text/javascript'>";
            echo "window.location = 'menu.php'; ";
            echo "alert('ไม่อนุญาติให้ทำรายการ');";
            echo "</script>";
        }
    }else{}
                if (mysqli_num_rows($result_total) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result_total)) {
                        $status_repair = $row['status_repair'];
                        $repon_per = $_SESSION['user'];?>
                        
                <tr>
                    <td style='text-align:center;'><?php echo $num ?></td>
                    <td style='text-align:center;'><?php echo $row["day_take"];?></td>
                    <td style='text-align:center;'><?php echo $row["date_recive"];?></td>
                    <td style='text-align:center;'><?php echo $row["tools_name"];?></td>
                    <td style='text-align:center;'><?php echo $row["noid"];?></td>
                    <td style='text-align:center;'><?php echo $row["customer"];?></td>
                    <td style='text-align:center;'><?php echo $row["status_repair"];?></td>
                    <td style='text-align:center;color:red'><?php echo $row["edit_fixx"];?></td>
                    <td style='text-align:center;margin-bottom:30px' >
                        <button onclick="a('<?php echo $row['noid']; ?>');" type="submit" class="btn btn-link" data-toggle="modal" data-target="#myModal" ><span class='fas fa-clipboard-list fa-2x ' style='color:black'></span></button>
                    </td>
                    <?php if(($row["status_repair"]=="รับเรื่องแล้ว")||($row["status_repair"]=="กำลังซ่อม")||($row["edit_fixx"]=="แก้ไข")){ ?>
                        <td style='text-align:center;margin-bottom:30px' >
                            <button onclick="a2('<?php echo $row['noti_repair_id']?>','<?php echo $repon_per ?>');" type="submit" class="btn btn-link" data-toggle="modal" data-target="#myModal" ><span class='fa-solid fa-toolbox fa-2x' style='color:black'></span></button>
                        </td>
                    <?php
                    }else{ ?>
                        <td></td>
                    <?php } ?>
                    
                    <td style='text-align:center;margin-bottom:30px' >
                        <button onclick="a3('<?php echo $row['noti_repair_id']?>','<?php echo $repon_per ?>');" type="submit" class="btn btn-link" data-toggle="modal" data-target="#myModal" ><span class='fa-solid fa-rectangle-list fa-2x' style='color:black'></span></button>
                    </td>
                    
                    <?php if(($row["status_repair"]=="กำลังซ่อม")||($row["edit_fixx"]=="แก้ไข")){ ?>
                    <td style ='text-align:center;'><a href='edit.php?update_stafix=<?php echo $row['noti_repair_id'] ;?>' helf='#'><span class='fas fa-edit fa-2x 'style= 'color:black;'></span></a></td>
                    <?php }else{?>
                        <td></td>
                    
                    <?php } ?>
                </tr>
                <?php
                        $num++;
                                }
                }else{
    
                }mysqli_close($conn);
            
        ?>
            </tbody>
        </table>
        </div>

    </section>
    <!-- Modal -->
    
        <div class="modal fade" id="myModal" role="dialog">
            <div id ='modal-div'></div>
        </div>
    <script>
            function a(text){
                $( "#modal-div" ).load('modal.php?id='+text);
            }
            function a2(text,person){
                $( "#modal-div" ).load('modal.php?noti_repair_id='+text,'&person='+person);
            }
            function a3(text,person){
                $( "#modal-div" ).load('modal.php?part_repair='+text,'&person='+person);
            }    
        </script>

        <script>
            $(document).ready( function () {
                $('#data_table').DataTable();
            } );
            
        </script>       
    
</div>
</body>
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