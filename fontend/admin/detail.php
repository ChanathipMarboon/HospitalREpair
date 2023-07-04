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
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- include bootstrap !-->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <link rel="stylesheet" href="plugins/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <link rel="stylesheet" href="../../plugins/style.css">
        

        
    <title></title>
</head>
<?php if (!isset($_SESSION['user_level'])) header("location: ../../login/loginn.php");  ?>
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

                        <?php 
                            if (isset($_GET['detail'])){
                            $id = $_GET['detail'];
                            $sql_detail = "SELECT * FROM `notify_repair` where id = '$id'";
                            $result = mysqli_query($conn,$sql_detail);
                            while($row = mysqli_fetch_array($result)){
                                $username = $row['username'];
                                $day_take = $row['day_take'];
                                $customer = $row['customer'];
                                $tools_name = $row['tools_name'];
                                $note = $row['note'];
                                $noid = $row['noid'];
                                $type_work = $row['type_work'];
                        }  
                            $sql_repair = "SELECT * FROM `repair_tools` where noti_repair_id = '$id'";  
                            $resultt = mysqli_query($conn,$sql_repair);
                            while($row = mysqli_fetch_array($resultt)){
                                $username_e = $row['username_e'];
                                $date_repair = $row['date_repair'];
                                $date_recive = $row['date_recive'];
                                $username_check = $row['username_check'];
                               
                             
                        }  
                        } 
                        $day_take=date('d/m/Y');
                        ?>


<body>
<section class="home-section" >
    <h3 style="padding-left:10px;padding-top:30px;">ประวัติการส่งซ่อม</h1>

    <div style="padding-left:5px;padding-right:5px;padding-bottom:5px;padding-top:5px;border-style: ridge;">
        <div style="background:#81559d;">
             <label style="padding-left:30px;font-size:18px;color:white;">ข้อมูลการแจ้งซ่อม</label>                                       
        </div>    
        <div class="border-detail" style ="padding-left:10px;
                                           padding-right:10px;
                                           padding-top:20px;
                                          text-align:center;">
                

                <div class ="group_detail" >
                        <label for="detail" 
                        style="  background:#be5680;
                                        padding-top: 5px;
                                        padding-right: 200px;
                                        padding-bottom: 5px;
                                        padding-left: 5px;
                                        border-style: ridge;
                                        color: white;">เลขที่คำร้อง</label>
                        <input type="text" value="<?php echo $id;?>"  readonly
                                style="
                                padding-top: 5px;
                                padding-right: 90px;
                                padding-bottom: 5px;
                                padding-left: 5px;">

                        <label for="detail" 
                        style="  background:#be5680;
                                        padding-top: 5px;
                                        padding-right: 200px;
                                        padding-bottom: 5px;
                                        padding-left: 5px;
                                        border-style: ridge;
                                        color: white;">สถานะแจ้งซ่อม</label>
                        <input type="text" value="test1"  readonly
                                style="
                                padding-top: 5px;
                                padding-right: 90px;
                                padding-bottom: 5px;
                                padding-left: 5px;">
                </div> <br>

                <div class ="group_detail">
                        <label for="detail" 
                        style="  background:#be5680;
                                        padding-top: 5px;
                                        padding-right: 193px;
                                        padding-bottom: 5px;
                                        padding-left: 5px;
                                        border-style: ridge;
                                        color: white;">วันที่แจ้งซ่อม</label>
                        <input type="text" value="<?php echo $day_take ?>"  readonly
                                style="
                                padding-top: 5px;
                                padding-right: 90px;
                                padding-bottom: 5px;
                                padding-left: 5px;">
                        <label for="detail" 
                        style="  background:#be5680;
                                        padding-top: 5px;
                                        padding-right: 215px;
                                        padding-bottom: 5px;
                                        padding-left: 5px;
                                        border-style: ridge;
                                        color: white;">ผู้ยื่นแจ้งซ่อม</label>
                        <input type="text" value="test1"  readonly
                                style="
                                padding-top: 5px;
                                padding-right: 90px;
                                padding-bottom: 5px;
                                padding-left: 5px;">
                </div><br>
                <div class ="group_detail">
                        <label for="detail" 
                                style="  background:#be5680;
                                        padding-top: 5px;
                                        padding-right: 200px;
                                        padding-bottom: 5px;
                                        padding-left: 5px;
                                        border-style: ridge;
                                        color: white;">วันที่รับเรื่อง</label>
                        <input type="text" value="test1"  readonly
                                style="
                                padding-top: 5px;
                                padding-right: 90px;
                                padding-bottom: 5px;
                                padding-left: 5px;">
                        <label for="detail" 
                        style="  background:#be5680;
                                        padding-top: 5px;
                                        padding-right: 235px;
                                        padding-bottom: 5px;
                                        padding-left: 5px;
                                        border-style: ridge;
                                        color: white;">วันที่สิ้นสุด</label>
                        <input type="text" value="test1"  readonly
                                style="
                                padding-top: 5px;
                                padding-right: 90px;
                                padding-bottom: 5px;
                                padding-left: 5px;">
                </div><br>
                <div class ="group_detail">
                        <label for="detail" 
                        style="  background:#be5680;
                                        padding-top: 5px;
                                        padding-right: 185px;
                                        padding-bottom: 5px;
                                        padding-left: 5px;
                                        border-style: ridge;
                                        color: white;">เบอร์โทรศัพท์</label>
                        <input type="text" value="test1"  readonly
                                style="
                                padding-top: 5px;
                                padding-right: 90px;
                                padding-bottom: 5px;
                                padding-left: 5px;">
                        <label for="detail" 
                        style="  background:#be5680;
                                        padding-top: 5px;
                                        padding-right: 256px;
                                        padding-bottom: 5px;
                                        padding-left: 5px;
                                        border-style: ridge;
                                        color: white;">Email</label>
                        <input type="text" value="test1"  readonly
                                style="
                                padding-top: 5px;
                                padding-right: 90px;
                                padding-bottom: 5px;
                                padding-left: 5px;">
                </div><br>  <!-- ตารางแสดงรายละเอียดข้อมูล !-->

                

        </div>
               <div class="table-detail" style ="padding-left:5px;
                                                  padding-right:5px;
                                                  padding-bottom:px;
                                                  padding-top:10px;">
                        <div style="background:#81559d;">
                                <label style="padding-left:30px;color:white;font-size:18px">ขั้นตอนการดำเนินการ</label>
        </div>   
        <?php   $date_recive=date('d/m/Y');
                $date_repair=date('d/m/Y');
                
        ?>
     
                        <table class="table">
                        <thead >
                                <tr>
                                        <th >ลำดับ</th>
                                        <th >ชื่อเส้นทางการแจ้งซ่อม</th>
                                        <th >ผู้รับเรื่อง</th>
                                        <th >สถานะการอนุมัติรายการ</th>
                                        <th >วันที่อนุมัติรายการ</th>
                                        <th >ผู้อนุมัติรายการ</th>
                                        <th >รายละเอียด</th>
                                </tr>
                        </thead>
                        
                        <tbody>
                                <tr>
                                                <td style="text-align: center;background-color: #adc2ef;border: 2px solid black;">1</td>
                                                <td>ฝ่ายเลขาทำการรับเรื่องแจ้งซ่อม</td>
                                                <td>เลขา<?php echo $type_work; ?></td>
                                                <td></td>
                                                <td style="text-align:center;"><?php echo $date_recive; ?></td>
                                                <td style="text-align:center;"></td>
                                                <td></td>
                                                
                                </tr>
                                <tr>
                                                <td style="text-align: center;background-color: #adc2ef;border: 2px solid black;">2</td>
                                                <td>ช่างทำการรับเรื่องแจ้งซ่อม</td>
                                                <td>ช่าง<?php echo $type_work?></td>
                                                <td></td>
                                                <td style="text-align:center;"><?php echo $date_repair; ?></td>
                                                <td style="text-align:center;"><?php echo $username_e; ?></td>
                                                <td></td>
                                </tr>
                                <tr>
                                                <td style="text-align: center;background-color: #adc2ef;border: 2px solid black;">3</td>
                                                <td>ตรวจสอบอุปกรณ์</td>
                                                <td>หัวหน้า<?php echo $type_work?></td>
                                                <td></td>
                                                <td></td>
                                                <td style="text-align:center;"><?php echo $username_check; ?></td>
                                                <td></td>
                                </tr>
                        </tbody>

                        </table>
                                        
                </div> 
    </div>
    
    </section> 
   
</body> 

  
</html>

