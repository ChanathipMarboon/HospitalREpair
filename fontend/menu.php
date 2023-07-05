<?php 
    session_start();
        include('server.php');
    if (!isset($_SESSION['user_level'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: /project/login/loginn.php');
    }
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['user_level']);
        header('location: /project/login/loginn.php');
    }
    $user_level=$_SESSION['user_level'];
?>
<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <!--<title> Responsive Sidebar Menu  | CodingLab </title>-->
    <link rel="stylesheet" href="../plugins/style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/b23c38ddca.js" crossorigin="anonymous"></script>

    
</head>
<style>

</style>

<body>
    <?php include("nav.php");?> 
    <div class="sidebar open">
        <div class="logo-details">
            <img src="../image/Logo.jpg"  style="width:60px;height:60px;text-align:center;margin-top:10px;margin-bottom:10px;margin-left:37%;border-radius: 50%;">
            <div class="logo_name" style="margin-left:10px;font-size:18px;margin-left:45px">ศูนย์ซ่อมอุปกรณ์</div>
            <div class="logo_name" style="margin-left:10px;font-size:18px;margin-left:37px">โรงพยาบาลพะเยา</div>
        </div>

        <ul class="nav-list" id="mymenu">

            <li>
                <i class='bx bx-search'></i>
                <input type="text" placeholder="ค้นหา..." id="Search" onkeyup="searchfunction()">
                <span class="tooltip">ค้นหา</span>
            </li>

            <?php if($_SESSION['user_level']=='แอดมิน'){?> <!-- **แอดมิน** !-->
            <?php 
            $sql_conf = "SELECT * FROM `user` WHERE status = 'รอการอนุมัติ' ";
            $result_conf = $conn->query($sql_conf);?>
            <li>
                <a href="index_a.php">
                    <i class="fas fa-user-shield"></i>
                    <span class="links_name">อนุมัติการใช้งาน</span>
                    <?php if(mysqli_num_rows($result_conf)!=0){?>
                    <span 
                                        style="
                                        position:absolute;
                                        right:20px;
                                        width: 20px;
                                        height: 20px;
                                        background: red;
                                        color: #ffffff;
                                        display: flex;
                                        justify-content: center;
                                        align-items: center;
                                        border-radius: 50%;
                                        font-size:15px"
                        ><?php echo mysqli_num_rows($result_conf)?></span>
                </a>
                <?php }?>
                <span class="tooltip">อนุมัติการใช้งาน</span>
            </li>
            <?php }?>

            <?php if($_SESSION['user_level']=='แอดมิน'){?> <!-- **แอดมิน** !-->
            <li>
                <a href="insert_user.php">
                    <i class="fa fa-user-plus"></i>
                    <span class="links_name">สมัครสมาชิก</span>
                </a>
                <span class="tooltip">สมัครสมาขิก</span>
            </li>
            <?php }?>
            
            <?php if(($_SESSION['user_level']!='แอดมิน')&&($_SESSION['user_level']!='ศูนย์คอมพิวเตอร์')&&($_SESSION['user_level']!='ศูนย์เครื่องมือแพทย์ฯ')&&($_SESSION['user_level']!='ช่างคอมพิวเตอร์')&&($_SESSION['user_level']!='ช่างซ่อมบำรุงทั่วไป')&&($_SESSION['user_level']!='ช่างเครื่องมือแพทย์')&&($_SESSION['user_level']!='ผู้ตรวจสอบ')){?> 
            <li>
                <a href="index_repair.php">         <!-- **ทุกผู้ใช้งาน ทดลอง** !-->
                    <i class="fas fa-tools"></i>
                    <span class="links_name">แจ้งซ่อม</span>
                </a>
                <span class="tooltip">แจ้งซ่อม</span>
            </li>
            <?php }?>

            

            <?php if(($_SESSION['user_level']=='ศูนย์ซ่อมบำรุง')||($_SESSION['user_level']=='ศูนย์คอมพิวเตอร์')||($_SESSION['user_level']=='ศูนย์เครื่องมือแพทย์ฯ')){?>  <!-- **เลขา ทดลอง** !-->
                <?php 
                $count_take =  "SELECT * FROM `notify_repair` where  status_repair ='รอดำเนินการ' AND type_work='$user_level' \n". "ORDER BY `notify_repair`.`day_take` DESC;";
                $take_rows = mysqli_query($conn,$count_take);
        ?>
                <li>
                    <a href="index_take.php">
                    <i class="fas fa-book-medical"></i>
                        <span class="links_name">รับเรื่อง</span>
                        <?php if(mysqli_num_rows($take_rows)!=0){?>
                        <span 
                                style="
                                        position:absolute;
                                        right:20px;
                                        width: 20px;
                                        height: 20px;
                                        background: red;
                                        color: #ffffff;
                                        display: flex;
                                        justify-content: center;
                                        align-items: center;
                                        border-radius: 50%;
                                        font-size:15px"
                        ><?php echo mysqli_num_rows($take_rows)?></span>
                        <?php }?>
                    </a>
                    <span class="tooltip">รับเรื่อง</span>
                </li>
            <?php }?>

            
            
            

            <?php if(($_SESSION['user_level']!='แอดมิน')&&($_SESSION['user_level']!='ศูนย์คอมพิวเตอร์')&&($_SESSION['user_level']!='ศูนย์เครื่องมือแพทย์ฯ')&&($_SESSION['user_level']!='ช่างคอมพิวเตอร์')&&($_SESSION['user_level']!='ช่างซ่อมบำรุงทั่วไป')&&($_SESSION['user_level']!='ช่างเครื่องมือแพทย์')&&($_SESSION['user_level']!='ผู้ตรวจสอบ')){?> 
            <li>
                <a href="index_history.php">        <!-- **ทุกผู้ใช้งาน ทดลอง** !-->
                    <i class="fas fa-history"></i>
                    <span class="links_name">ประวัติการส่งซ่อม</span>
                </a>
                <span class="tooltip">ประวัติการส่งซ่อม</span>
            </li>
            <?php }?>

           
            <?php if(($_SESSION['user_level']=='ช่างคอมพิวเตอร์')||($_SESSION['user_level']=='ช่างซ่อมบำรุงทั่วไป')||($_SESSION['user_level']=='ช่างเครื่องมือแพทย์')){?>

                <?php 
                if($user_level == "ช่างคอมพิวเตอร์"){
                    $sql_repair =  "SELECT * FROM repair_tools RIGHT JOIN notify_repair ON repair_tools.noti_repair_id = notify_repair.id where  (status_repair ='รับเรื่องแล้ว'OR status_repair='กำลังซ่อม' OR edit_fixx='แก้ไข')   AND type_work ='ศูนย์คอมพิวเตอร์' \n". "ORDER BY `notify_repair`.`day_take` DESC;";
                    $count_repair = mysqli_query($conn,$sql_repair);
                }else if($user_level == "ช่างซ่อมบำรุงทั่วไป"){
                    $sql_repair =  "SELECT * FROM repair_tools RIGHT JOIN notify_repair ON repair_tools.noti_repair_id = notify_repair.id where  (status_repair ='รับเรื่องแล้ว'OR status_repair='กำลังซ่อม' OR edit_fixx='แก้ไข') AND type_work ='ศูนย์ซ่อมบำรุง'  \n". "ORDER BY `notify_repair`.`day_take` DESC;";
                    $count_repair = mysqli_query($conn,$sql_repair);
                }else if($user_level == "ช่างเครื่องมือแพทย์"){
                    $sql_repair =  "SELECT * FROM repair_tools RIGHT JOIN notify_repair ON repair_tools.noti_repair_id = notify_repair.id where  (status_repair ='รับเรื่องแล้ว'OR status_repair='กำลังซ่อม' OR edit_fixx='แก้ไข') AND type_work ='ศูนย์เครื่องมือแพทย์ฯ'  \n". "ORDER BY `notify_repair`.`day_take` DESC;";
                    $count_repair = mysqli_query($conn,$sql_repair);
        }
            ?>
                <li>                                        <!-- **ช่าง ทดลอง** !--> 
                <a href="repair_all.php">
                    <i class="fas fa-hammer"></i>
                    <span class="links_name">รายการซ่อม</span>
                    <?php if(mysqli_num_rows($count_repair)!=0){?>
                    <span 
                    style="
                                        position:absolute;
                                        right:20px;
                                        width: 20px;
                                        height: 20px;
                                        background: red;
                                        color: #ffffff;
                                        display: flex;
                                        justify-content: center;
                                        align-items: center;
                                        border-radius: 50%;
                                        font-size:15px"
                        ><?php echo mysqli_num_rows($count_repair)?></span>
                    <?php }?>
                </a>
                <span class="tooltip">รายการซ่อม</span>
                </li>
            <?php }?>

            <?php if(($_SESSION['user_level']=='ช่างคอมพิวเตอร์')||($_SESSION['user_level']=='ช่างซ่อมบำรุงทั่วไป')||($_SESSION['user_level']=='ช่างเครื่องมือแพทย์')){?>
                <li>                                        <!-- **ช่าง ทดลอง** !--> 
                <a href="send_user.php">
                    <i class="fa-solid fa-print"></i>
                    <span class="links_name">เอกสารซ่อม</span>
                </a>
                <span class="tooltip">เอกสารซ่อม</span>
                </li>
            <?php }?>

            <?php if(($_SESSION['user_level']=='ช่างคอมพิวเตอร์')||($_SESSION['user_level']=='ช่างซ่อมบำรุงทั่วไป')||($_SESSION['user_level']=='ช่างเครื่องมือแพทย์')){?>
                <?php if($_SESSION['user_level']=='ช่างคอมพิวเตอร์'){
                        //$num_noti="SELECT COUNT(status_repair) AS num_noti FROM notify_repair WHERE status_repair='รอคืนอุปกรณ์' AND type_work = 'ศูนย์คอมพิวเตอร์';";
                        $num_noti="SELECT * FROM notify_repair WHERE status_repair='รอคืนอุปกรณ์' AND type_work = 'ศูนย์คอมพิวเตอร์';";
                        $result = mysqli_query($conn,$num_noti);          
                }else if($_SESSION['user_level']=='ช่างซ่อมบำรุงทั่วไป'){
                    //$num_noti="SELECT COUNT(status_repair) AS num_noti FROM notify_repair WHERE status_repair='รอคืนอุปกรณ์' AND type_work = 'ศูนย์คอมพิวเตอร์';";
                    $num_noti="SELECT * FROM notify_repair WHERE status_repair='รอคืนอุปกรณ์' AND type_work = 'ศูนย์ซ่อมบำรุง';";
                    $result = mysqli_query($conn,$num_noti);          
                }else if($_SESSION['user_level']=='ช่างเครื่องมือแพทย์'){
                    //$num_noti="SELECT COUNT(status_repair) AS num_noti FROM notify_repair WHERE status_repair='รอคืนอุปกรณ์' AND type_work = 'ศูนย์คอมพิวเตอร์';";
                    $num_noti="SELECT * FROM notify_repair WHERE status_repair='รอคืนอุปกรณ์' AND type_work = 'ศูนย์เครื่องมือแพทย์ฯ';";
                    $result = mysqli_query($conn,$num_noti);          
                }?>
                
                <li><!-- **ช่าง ทดลอง** !--> 
                <a href="send_install.php">
                    <i class="fas fa-hand-holding"></i>
                    <span class="links_name">รายการส่งคืน</span>
                    <?php if(mysqli_num_rows($result)!=0){?>
                    <span style="  position:absolute;
                                        right:20px;
                                        width: 20px;
                                        height: 20px;
                                        background: red;
                                        color: #ffffff;
                                        display: flex;
                                        justify-content: center;
                                        align-items: center;
                                        border-radius: 50%;
                                        font-size:15px">
                    <?php echo mysqli_num_rows($result)?></span>
                    <?php }?>
                </a>
                <span class="tooltip">รายการส่งคืน</span>
                </li>
            <?php }?>

            <?php if(($_SESSION['user_level']=='ช่างคอมพิวเตอร์')||($_SESSION['user_level']=='ช่างซ่อมบำรุงทั่วไป')||($_SESSION['user_level']=='ช่างเครื่องมือแพทย์')){?>
                <li>
                    <a href="broken_tools.php">
                    <i class="fa fa-recycle"></i>
                        <span class="links_name">รายการแทงชำรุด</span>
                    </a>
                    <span class="tooltip">รายการแทงชำรุด</span>
                </li>
            <?php }?>

            
            
            <?php if($_SESSION['user_level']=='แอดมิน'){?>
            <li>
                <a href="dash_b.php">        <!-- **ทุกผู้ใช้งาน ทดลอง** !-->
                    <i class="	fas fa-chart-line"></i>
                    <span class="links_name">รายงานสถิติ</span>
                </a>
                <span class="tooltip">รายงานสถิติ</span>
            </li>
            <?php }?>

            <?php if($_SESSION['user_level']=='ผู้ตรวจสอบ'){?>
            <?php 
                $sql_check =  "SELECT repair_tools.*,notify_repair.* FROM repair_tools LEFT JOIN notify_repair ON repair_tools.noti_repair_id = notify_repair.id WHERE edit_fixx='สำเร็จ' "; 
                $result_check = $conn->query($sql_check);
                ?>
            <li>
                <a href="send_review.php">        <!-- **ทุกผู้ใช้งาน ทดลอง** !-->
                    <i class="	fas fa-calendar-check"></i>
                    <span class="links_name">ตรวจการฃ่อม</span>
                    <?php if(mysqli_num_rows($result_check)!=0){?>
                    <span style="  position:absolute;
                                        right:20px;
                                        width: 20px;
                                        height: 20px;
                                        background: red;
                                        color: #ffffff;
                                        display: flex;
                                        justify-content: center;
                                        align-items: center;
                                        border-radius: 50%;
                                        font-size:15px">
                    <?php echo mysqli_num_rows($result_check)?></span>
                </a>
                <?php }?>
                <span class="tooltip">ตรวจการฃ่อม</span>
            </li>
            <?php }?>
            
            <li>
                <a href="index_repair.php?logout='1'">
                    <i class='bx bx-log-out' id="log_out"></i>
                        <span class="links_name">ออกจากระบบ</span>
                </a>
                <span class="tooltip">ออกจากระบบ</span>
            </li>
            <li class="profile">
                <div class="profile-details">
                    <!--<img src="profile.jpg" alt="profileImg">-->
                    <div class="name_job" >
                        <div class="name" style="font-size: 15px;font-weight: 400;">ผู้ใช้งาน <?php echo $_SESSION['user'];?></div>
                        <div class="job" style="font-size: 15px;font-weight: 400;">แผนก <?php echo $_SESSION['user_level'];?></div>
                    </div>
                </div>
                    <i class='fa fa-user' id="log_out"></i>
                    

            </li>
        </ul>
    </div>


    <script>
    function searchfunction() {
        var input, filter, ul, li, a, i;
        input = document.getElementById("Search");
        filter = input.value.toUpperCase();
        ul = document.getElementById("mymenu");
        li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }
    </script>

    <script>
    let sidebar = document.querySelector(".sidebar");
    
    let searchBtn = document.querySelector(".bx-search");

    closeBtn.addEventListener("click", () => {
        sidebar.classList.toggle("open");
        menuBtnChange(); //calling the function(optional)
    });

    searchBtn.addEventListener("click", () => { // Sidebar open when you click on the search iocn
        sidebar.classList.toggle("open");
        menuBtnChange(); //calling the function(optional)
    });

    // following are the code to change sidebar button(optional)
    function menuBtnChange() {
        if (sidebar.classList.contains("open")) {
            closeBtn.classList.replace( "bx-menu-alt-right"); //replacing the iocns class
        } else {
            closeBtn.classList.replace("bx-menu-alt-right"); //replacing the iocns class
        }
    }
    </script>
</body>

</html>