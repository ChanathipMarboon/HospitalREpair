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
<!-- include sweet alert!-->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="../../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="../../node_modules/sweetalert2/dist/sweetalert2.min.css">

<script src='PDF_config/js/pdfmake.min.js'></script>
<script src='PDF_config/js/vfs_fonts.min.js'></script>
<!-- <script src='PDF_config/js/path_fonts.js'></script> -->

<!DOCTYPE html>
    <html lang="en" dir="ltr">
    <script src="https://kit.fontawesome.com/b23c38ddca.js" crossorigin="anonymous"></script>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../plugins/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/b23c38ddca.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../plugins/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Boxicons CDN Link -->

    
    <!-- ช่องค้นหา หน้าpage  -->
    <link rel="stylesheet" type="text/css" href="../plugins/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="../plugins/js/jquery.dataTables.js"></script>

        <title>ตรวจงานซ่อม
        </title>
    </head>

    <body>
        
        

        <?php if (!isset($_SESSION['user_level'])) header("location: ../login/loginn.php");  
                    date_default_timezone_set('asia/bangkok');
                    $day_take = date('Y-m-d');
                    
                    $username_check=$_SESSION['user'];
                    
        ?>



        <section class="home-section" >
            <div style ="background-color:#81559d;box-shadow: 5px 5px #4a4a4a;">
                <div class="text" style ="font-size:30px;color:white;">ตรวจสอบอุปกรณ์การซ่อม</div style="padding:30px;"></div>
            </div><br>

            <div style="padding:20px">
            
                <div style="border-style: ridge;">
                <div style= "background-color:#81559d;">
                    <label style="padding-left:30px;font-size:18px;color:white;margin-top:30">ค้นหาข้อมูล</label>
                </div><br>

            <form action="send_review.php" method="POST">
                <div style="margin-left: 35%;" >
                    <label style="margin-left:25px">ตั้งเเต่วันที่</label></label>
                    <input type="date"  name="date_s" value="<?php echo $day_take;?>" style="margin-left:5px">

                    <label style="margin-left:25px">ถึงวันที่</label></label>
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

            <table class="table " id="data_table">
                <thead vvv>
                    
                        <th style='text-align:center;'>ลำดับ</th>
                        <th style='text-align:center;'>วันที่ซ่อม</th>
                        <th style='text-align:center;'>เลขครุภัณฑ์</th>
                        <th style='text-align:center;'>อุปกรณ์</th>
                        <th style='text-align:center;'>หน่วยงานที่อยู่</th>
                        <th style='text-align:center;'>ปัญหาที่เสีย</th>
                        <th style='text-align:center;'>หน่วยงานซ่อม</th>
                        <th style='text-align:center;'>หมายเหตุ</th>
                        <th style='text-align:center;'>ผู้ซ่อม</th>
                        <th style='text-align:center;'>อนุมัติงานซ่อม</th>
                        <th style='text-align:center;'>แก้ไขงานซ่อม</th>
                </thead>
                <tbody>
        <?php include('server.php');
        $num = 1;
        
        
            if($_SESSION['user_level']=='ผู้ตรวจสอบ'){
                $sql =  "SELECT repair_tools.*,notify_repair.* FROM repair_tools LEFT JOIN notify_repair ON repair_tools.noti_repair_id = notify_repair.id WHERE edit_fixx='สำเร็จ' "; 
                $result = $conn->query($sql);
            }else{
                echo "<script type='text/javascript'>";
                echo "window.location = 'menu.php'; ";
                echo "alert('ไม่อนุญาติให้ทำรายการ');";
                echo "</script>";
            }
    if(isset($_POST['search_day'])){
            $date_s = $_POST['date_s'];
            $date_e = $_POST['date_e'];
       
        
        if($_SESSION['user_level']=='ผู้ตรวจสอบ'){
            $sql =  "SELECT name_parts.*,notify_repair.type_work FROM name_parts LEFT JOIN notify_repair ON name_parts.id_repair = notify_repair.id WHERE date_repair BETWEEN $date_s AND $date_e AND edit_fixx ='สำเร็จ';  "; 
            $result = $conn->query($sql);
        }else{
                echo "<script type='text/javascript'>";
                echo "window.location = 'menu.php'; ";
                echo "alert('ไม่อนุญาติให้ทำรายการ');";
                echo "</script>";
        }
    }
        
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $user_level = $_SESSION['user_level'];
        while($row = mysqli_fetch_assoc($result)) {
            ?>
        <tr>
            <td style ='text-align:center;'><?php echo $num ;?></td>
            <td style ='text-align:center;'><?php echo $row['date_repair'];?></td>
            <td style ='text-align:center;'><?php echo $row['noid'];?></td>
            <td style ='text-align:center;'><?php echo $row['tools_name'];?></td>
            <td style ='text-align:center;'><?php echo $row['customer'];?></td>
            <td style ='text-align:center;'><?php echo $row['problem'];?></td>
            <td style ='text-align:center;'><?php echo $row['type_work'];?></td>
            <td style ='text-align:center;color:green;'><?php echo $row['edit_fixx'];?></td>
            <td style ='text-align:center;'><?php echo $row['username_e'];?></td>
            <?php if(($row['edit_fixx']=="สำเร็จ")){?>
            <td style ='text-align:center;'>
                <form action="test.php" method="POST">
                        <input name="noti_repair_id" type="text"  value="<?php echo $row['noti_repair_id'] ?>" class="form-control" readonly hidden>
                        <input name="username_check" type="text"  value="<?php echo $_SESSION['user'] ?>" class="form-control" readonly hidden>
                        <button name="pass" type="submit" class="btn btn-link" ><span class='fa fa-check-circle fa-2x' style='color:black'>
                    </form>
                </td>
                    <td style='text-align:center;margin-bottom:30px' >
                        <button onclick="a4('<?php echo $row['noti_repair_id']?>','<?php echo $username_check?>');" type="submit" class="btn btn-link" data-toggle="modal" data-target="#myModal" ><span class='fa-solid fa-rectangle-list fa-2x' style='color:black'></span></button>
                    </td>

                     
            </td>  
            <?php } ?>
            
            <?php  ?>
        </tr> 
        <?php
        $num++;
                }
    }else{
    }mysqli_close($conn);
    
    ?>
                    
                </tbody>
            </table
           
        <?php 
            $array_data_pdf = array();
            array_push($array_data_pdf,[
                'วันที่ซ่อม', 'เลขครุภํณฑ์','อุปกรณ์', 'แผนกส่งซ่อม','ปัญหา','แผนกซ่อม','หมายเลขซ่อม', 'วันที่สั่งซื้ออะไหล่','ชื่อไหล่'

            ]);

            foreach($result as $array_data){

                array_push($array_data_pdf,[
                    $array_data['date_repair'] , $array_data['noid'] , $array_data['tools_name'],
                    $array_data['customer'] , $array_data['problem'] , $array_data['type_work'],
                    $array_data['sta_fix'] , $array_data['username_e'], $array_data['username_e']
                ]);

            }
        ?>
        <div style="float:left;">
           <p style="float:left;">ดาวโหลดเอกสารข้อมูลสมาชิคแจ้งซ่อมโรงพยาบาลพะเยา</p>
            <button id="make-pdf" onclick="makePdf();"  style="float:left;"  type="button" class="btn btn-link">PDF</button> 
        </div>
    </div>
        
    </section>
    <div class="modal fade" id="myModal" role="dialog">
            <div id ='modal-div'></div>
    </div> 

    <script>
            function a4(text,person){
                $( "#modal-div" ).load('modal.php?edit_fix='+text,'&person='+person);
            }    
    </script>

    <script>
        $(document).ready( function () {
            $('#data_table').DataTable();
        } );
        
        function makePdf() {
            var docDefinition = {
                pageOrientation: 'landscape',
                content: [
                    // { text: "Sarabun Thai font กเดกดเ" ,fontSize :20 },
                    { text: "รายการสั่งซื้ออะไหล่", bold: true ,fontSize :30},
                    
                    // { text: "Sarabun Thai font bold กดเกหดเกดเ", italics: true ,fontSize :20  },
                    {
                        layout: 'lightHorizontalLines', // optional
                        table: {
                            // headers are automatically repeated if the table spans over multiple pages
                            // you can declare how many rows should be treated as headers
                            headerRows:1,
                            widths: [70,70,70,70,70,70,70,70,70],fontSize :30,
                            
                            

                            // body: [
                            // [ 'First', 'Second', 'Third', 'The last one' ],
                            // [ 'Value 1', 'Value 2', 'Value 3', 'Value 4' ],
                            // [ { text: 'Bold value', bold: true }, 'Val 2', 'Val 3', 'Val 4' ]
                            // ]
                            body :<?php echo json_encode($array_data_pdf) ?>
                            
                            
                        }
                        
                        

                        
                        
                    },
                ],
                
                // defaultStyle: { 
                //     font: 'Roboto'
                // }
            };
            pdfMake.createPdf(docDefinition).print();
        }

    </script>
        
        <script>
                    function myFunction() {
                        var input, filter, table, tr, td, i, txtValue;
                        input = document.getElementById("myInput");
                        filter = input.value.toUpperCase();
                        table = document.getElementById("data_table");
                        tr = table.getElementsByTagName("tr");
                        for (i = 0; i < tr.length; i++) {
                            td = tr[i].getElementsByTagName("td")[1];
                            if (td) {
                                txtValue = td.textContent || td.innerText;
                                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                    tr[i].style.display = "";
                                } else {
                                    tr[i].style.display = "none";
                                }
                            }
                        }
                    }

                    
            </script>
            <script>
            $(document).ready( function () {
                 $('#data_table').DataTable();
            } );
        </script>   
        


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