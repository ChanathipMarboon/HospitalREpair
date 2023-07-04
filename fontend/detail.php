<?php 
    include('menu.php');
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
        <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
        <!-- include bootstrap !-->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <link rel="stylesheet" href="../plugins/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <link rel="stylesheet" href="../plugins/style.css">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../plugins/css/jquery.dataTables.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <title></title>
</head>
<?php if (!isset($_SESSION['user_level'])) header("location: ../../login/loginn.php");  ?>
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
                                $status_repair = $row['status_repair'];
                        }  
                            $sql_repair = "SELECT * FROM `repair_tools` where noti_repair_id = '$id'";  
                            $resultt = mysqli_query($conn,$sql_repair);
                            while($row = mysqli_fetch_array($resultt)){
                                $username_e = $row['username_e'];
                                $date_recive = $row['date_recive'];
                                $confirm1 = $row['confirm1'];
                                $confirm2 = $row['confirm2'];
                                $confirm3 = $row['confirm3'];
                                $date_repair = $row['date_repair'];
                                $date_check = $row['date_check'];
                                $username_check = $row['username_check'];
                                $username_recive = $row['username_recive'];
                                $sta_fix = $row['sta_fix'];
                                $problem = $row['problem'];
                                $comment = $row['comment'];
                                $edit_fixx = $row['edit_fixx'];
                             
                        }  
                                $sql_user = "SELECT * FROM `user` where username = '$username'";
                                $result_user = mysqli_query($conn,$sql_user);
                                while($row = mysqli_fetch_array($result_user)){
                                        $name = $row['firstname'] . " " . $row['lastname'];
                                        $num_phone = $row['num_phone'];
                                        $email = $row['email'];   
                                }  
                        } 
                        $date1=date_create($day_take);
                      

                        if(!empty($date_recive)){
                        $date2=date_create($date_recive);    
                        date_format($date2,"d/m/Y");
                        }
                        
                        if(!empty($date_repair)){
                        $date3=date_create($date_repair);
                        
                        }
                        
                        if(!empty($date_check)){
                        $date4 = date_create($date_check);
                        }    
                        
                        ?>
                        <?php 
                                if (empty($confirm1)||empty($confirm2)||empty($confirm3)) {
                                        $confirm1 ="w";
                                        $confirm2 ="w";
                                        $confirm3 ="w";
                                }if(empty($date_recive)||empty($date_repair)||empty($date_check)){
                                        $date_recive ="0000-00-00";
                                        $date_repair ="0000-00-00";
                                        $date_check ="0000-00-00";
                                }
                        ?>
<body>
<section class="home-section" >
    

    <div style="padding-left:5px;padding-right:5px;padding-bottom:5px;padding-top:5px;border-style: ridge;">
    <h2 style="padding-left:10px;padding-top:px;">ประวัติการส่งซ่อม</h2>

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
                        <input type="text" value="<?php echo $status_repair?>"  readonly
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
                        <input type="text" value="<?php echo date_format($date1,"d/m/Y"); ?>"  readonly
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
                        <input type="text" value="<?php echo $name;?>"  readonly
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
                        <input type="text" value="<?php if(!empty($date2)){echo date_format($date2,"d/m/Y");}else{}?>"  readonly
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
                        <input type="text" value="<?php if($date_check=="0000-00-00"){}else{echo date_format($date4,"d/m/Y");}?>"  readonly
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
                        <input type="text" value="<?php echo $num_phone ;?>"  readonly
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
                        <input type="text" value="<?php echo $email;?>"  readonly
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
     
                        <table class="table" >
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
                                                <td style="text-align: center;background-color: #adc2ef;border: 1px solid black;">1</td>
                                                <td>ฝ่ายเลขาทำการรับเรื่องแจ้งซ่อม</td>
                                                <td>เลขา<?php echo $type_work; ?></td>
                                                <td style="text-align:center;color:green;"><?php if($confirm1=="y"){?>
                                                                                <span class="glyphicon glyphicon-ok"></span> 
                                                                                <?php } else{}?>
                                                </td>
                                                <td style="text-align:center;"><?php if($date_recive=="0000-00-00"){ }else echo date_format($date2,"d/m/Y"); ?></td>
                                                <td style="text-align:center;"><?php if(!empty($username_recive)){echo $username_recive;}?></td>
                                                <td></td>
                                                
                                </tr>
                                <tr>
                                                <td style="text-align: center;background-color: #adc2ef;border: 2px solid black;">2</td>
                                                <td>ช่างทำการรับเรื่องแจ้งซ่อม</td>
                                                <td>ช่าง<?php echo $type_work?></td>
                                                <td style="text-align:center;"><?php    if($confirm2=="w"){
                                                                                        }else if($confirm2 == "y"){?>
                                                                                                <span class="glyphicon glyphicon-ok" style="color:green;"></span> 
                                                                                <?php   }else if($confirm2 == "n"){?> 
                                                                                        <span class="glyphicon glyphicon-remove" style="color:red;"></span> 
                                                                                <?php   }else{}?>
                                                </td>
                                                <td style="text-align:center;"><?php if($date_repair=="0000-00-00"){ }else echo date_format($date3,"d/m/Y"); ?></td>
                                                <td style="text-align:center;"><?php  if(!empty($username_e)){echo $username_e;}?></td>
                                                <td style="text-align:center;"><?php  if(!empty($problem)){echo $problem;}?></td>
                                </tr>
                                <tr>
                                                <td style="text-align: center;background-color: #adc2ef;border: 2px solid black;">3</td>
                                                <td>ตรวจสอบอุปกรณ์</td>
                                                <td>หัวหน้า<?php echo $type_work?></td>
                                                <td style="text-align:center;"><?php    if($confirm3=="w"){
                                                                                        }else if($confirm3 == "y"){?>
                                                                                                <span class="glyphicon glyphicon-ok" style="color:green;"></span> 
                                                                                <?php   }else if($confirm3 == "n"){?> 
                                                                                        <span class="glyphicon glyphicon-remove" style="color:red;"></span> 
                                                                                <?php }else{}?>
                                                </td>
                                                <?php if(!empty($edit_fixx)) {?>
                                                <?php if($edit_fixx!="แทงชำรุด"){?>
                                                <td style="text-align:center;"><?php if($date_check=="0000-00-00"){ }else echo date_format($date4,"d/m/Y");?></td>
                                                <td style="text-align:center;"><?php if(!empty($username_check)){ echo $username_check; }?></td>
                                                <td style="text-align:center;"><?php  if(!empty($comment)){echo $comment;}?></td>
                                                <?php }else if($edit_fixx=="แทงชำรุด"){?>
                                                <td style="text-align:center;"></td>
                                                <td style="text-align:center;"></td>
                                                <td style="text-align:center;"></td>        
                                               <?php }else{}?>
                                               <?php }else{ ?>
                                                <td style="text-align:center;"></td>
                                                <td style="text-align:center;"></td>
                                                <td style="text-align:center;"></td>   
                                               <?php }?>
                                </tr>
                        </tbody>

                        </table>
                                        
                </div> 
    </div>
    
    </section> 
   
</body> 

  
</html>

