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

<!DOCTYPE html>
    <html lang="en" dir="ltr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- include bootstrap !-->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        
        <link rel="stylesheet" href="../plugins/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <link rel="stylesheet" href="../plugins/style.css">
        <!-- Boxicons CDN Link -->
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

        <!-- <script src='PDF_config/js/path_fonts.js'></script> -->
        <script src='../PDF_config/js/pdfmake.min.js'></script>
        <script src='../PDF_config/js/vfs_fonts.min.js'></script>
       
         <!-- ช่องค้นหา หน้าpage  -->
        <link rel="stylesheet" type="text/css" href="../plugins/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="../plugins/js/jquery.dataTables.js"></script>
        <title>รายการแทงชำรุด</title>
    </head>

    <body>
        
        

        <?php if (!isset($_SESSION['user_level'])) header("location: ../login/loginn.php");  
                    date_default_timezone_set('asia/bangkok');
                    $day_take = date('Y-m-d');
                    $user_level = $_SESSION['user_level'];
                    if($_SESSION['user_level']=="ช่างคอมพิวเตอร์"){
                    $name_head  = "ศูนย์คอมพิวเตอร์";
                }else if($_SESSION['user_level']=="ช่างเครื่องมือแพทย์"){
                    $name_head  = "ศูนย์เครื่องมือแพทย์ฯ";
                }else if($_SESSION['user_level']=="ช่างซ่อมบำรุงทั่วไป"){
                    $name_head  = "ศูนย์ซ่อมบำรุง";
                }
                $month = array(
                    "", 
                    "มกราคม", 
                    "กุมภาพันธ์", 
                    "มีนาคม",
                    "เมษายน",
                    "พฤษภาคม",
                    "มิถุนายน",
                    "กรกฎาคม",
                    "สิงหาคม",
                    "กันยายน",
                    "ตุลาคม",
                    "พฤศจิกายน",
                    "ธันวาคม"
                );
                date_default_timezone_set('asia/bangkok');
                $date_now = date('Y-m-d');
                $date_now =(string)explode("-",$date_now )[2].' '.$month[(int)explode("-",$date_now )[1]].' '.(string)((int)explode("-",$date_now )[0]+543);
        ?>



        <section class="home-section">
            <div style ="background-color:#81559d;box-shadow: 5px 5px #4a4a4a;">
                <div class="text" style ="font-size:30px;color:white;">ข้อมูลอุปกรณ์แทงชำรุด<?php echo $name_head;?></div><br>
            </div>
            
            <div style="padding:20px">

            <div style="border-style: ridge;">
            <div style= "background-color:#81559d;">
                <label style="padding-left:30px;font-size:18px;color:white;margin-top:30">ค้นหาข้อมูล</label>
            </div><br>
            
                <form action="broken_tools.php" method="POST">
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
        
            <table class="table " id="data_table">
                <thead>
                    
                        <th style='text-align:center;'>ลำดับ</th>
                        <th style='text-align:center;'>วันที่ซ่อม</th>
                        <th style='text-align:center;'>เลขครุภัณฑ์</th>
                        <th style='text-align:center;'>อุปกรณ์</th>
                        <th style='text-align:center;'>หน่วยงานที่อยู๋</th>
                        <th style='text-align:center;'>ปัญหาที่เสีย</th>
                        <th style='text-align:center;'>หน่วยงานซ่อม</th>
                        <th style='text-align:center;'>สถานะซ่อม</th>
                        <th style='text-align:center;'>ผู้ตรวจสอบ</th>
                        
                    
                </thead>
                <tbody>
        <?php include('server.php');
        $num = 1;
        
            // if($_SESSION['user_level']=='ศูนย์เครื่องมือแพทย์ฯ'){
            //     $sql =  "SELECT repair_tools.*,notify_repair.* FROM repair_tools LEFT JOIN notify_repair ON repair_tools.noti_repair_id = notify_repair.id WHERE type_work='ศูนย์เครื่องมือแพทย์ฯ' AND sta_fix ='แทงชำรุด'; "; 
            //     $result = $conn->query($sql);
            // }else if($_SESSION['user_level']=='ศูนย์คอมพิวเตอร์'){
            //     $sql =  "SELECT repair_tools.*,notify_repair.* FROM repair_tools LEFT JOIN notify_repair ON repair_tools.noti_repair_id = notify_repair.id WHERE type_work='ศูนย์คอมพิวเตอร์'  AND sta_fix ='แทงชำรุด'; "; 
            //     $result = $conn->query($sql);
            // }else if($_SESSION['user_level']=='ศูนย์ซ่อมบำรุง'){
            //     $sql =  "SELECT repair_tools.*,notify_repair.* FROM repair_tools LEFT JOIN notify_repair ON repair_tools.noti_repair_id = notify_repair.id WHERE type_work='ศูนย์ซ่อมบำรุง'  AND sta_fix ='แทงชำรุด'; "; 
            //     $result = $conn->query($sql);
            // }else if($_SESSION['user_level']=='แอดมิน'){
            //     $sql =  "SELECT repair_tools.*,notify_repair.* FROM repair_tools LEFT JOIN notify_repair ON repair_tools.noti_repair_id = notify_repair.id  "; 
            //     $result = $conn->query($sql);
            // }else{
            //     echo "<script type='text/javascript'>";
            //     echo "window.location = 'menu.php'; ";
            //     echo "alert('ไม่อนุญาติให้ทำรายการ');";
            //     echo "</script>";
            // }
            if($_SESSION['user_level']=='ช่างเครื่องมือแพทย์'){
                $sql =  "SELECT repair_tools.*,notify_repair.* FROM repair_tools LEFT JOIN notify_repair ON repair_tools.noti_repair_id = notify_repair.id WHERE type_work='ศูนย์เครื่องมือแพทย์ฯ' AND sta_fix ='แทงชำรุด'; "; 
                $result = $conn->query($sql);
            }else if($_SESSION['user_level']=='ช่างคอมพิวเตอร์'){
                $sql =  "SELECT repair_tools.*,notify_repair.* FROM repair_tools LEFT JOIN notify_repair ON repair_tools.noti_repair_id = notify_repair.id WHERE type_work='ศูนย์คอมพิวเตอร์'  AND sta_fix ='แทงชำรุด'; "; 
                $result = $conn->query($sql);
            }else if($_SESSION['user_level']=='ช่างซ่อมบำรุงทั่วไป'){
                $sql =  "SELECT repair_tools.*,notify_repair.* FROM repair_tools LEFT JOIN notify_repair ON repair_tools.noti_repair_id = notify_repair.id WHERE type_work='ศูนย์ซ่อมบำรุง'  AND sta_fix ='แทงชำรุด'; "; 
                $result = $conn->query($sql);
            }else if($_SESSION['user_level']=='แอดมิน'){
                $sql =  "SELECT repair_tools.*,notify_repair.* FROM repair_tools LEFT JOIN notify_repair ON repair_tools.noti_repair_id = notify_repair.id  "; 
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
       
        // if($_SESSION['user_level']=='ศูนย์เครื่องมือแพทย์ฯ'){
        //     $sql =  "SELECT repair_tools.*,notify_repair.* FROM repair_tools LEFT JOIN notify_repair ON repair_tools.noti_repair_id = notify_repair.id WHERE sta_fix = 'แทงชำรุด' AND date_repair BETWEEN '$date_s' AND '$date_e' AND type_work = 'ศูนย์เครื่องมือแพทย์ฯ'; "; 
        //     $result = $conn->query($sql);
        // }else if($_SESSION['user_level']=='ศูนย์คอมพิวเตอร์'){
        //     $sql =  "SELECT repair_tools.*,notify_repair.* FROM repair_tools LEFT JOIN notify_repair ON repair_tools.noti_repair_id = notify_repair.id WHERE sta_fix = 'แทงชำรุด' AND date_repair BETWEEN '$date_s' AND '$date_e' AND type_work = 'ศูนย์คอมพิวเตอร์';"; 
        //     $result = $conn->query($sql);
        // }else if($_SESSION['user_level']=='ศูนย์ซ่อมบำรุง'){
        //     $sql =  "SELECT repair_tools.*,notify_repair.* FROM repair_tools LEFT JOIN notify_repair ON repair_tools.noti_repair_id = notify_repair.id WHERE sta_fix = 'แทงชำรุด' AND date_repair BETWEEN '$date_s' AND '$date_e' AND type_work = 'ศูนย์ซ่อมบำรุง';"; 
        //     $result = $conn->query($sql);
        // }else if($_SESSION['user_level']=='แอดมิน'){
        //     $sql =  "SELECT name_parts.*,notify_repair.type_work FROM name_parts LEFT JOIN notify_repair ON name_parts.id_repair = notify_repair.id WHERE date_repair BETWEEN $date_s AND $date_e AND sta_fix ='แทงชำรุด';  "; 
        //     $result = $conn->query($sql);
        // }else{
        //         echo "<script type='text/javascript'>";
        //         echo "window.location = 'menu.php'; ";
        //         echo "alert('ไม่อนุญาติให้ทำรายการ');";
        //         echo "</script>";
        // }
        if($_SESSION['user_level']=='ช่างเครื่องมือแพทย์'){
            $sql =  "SELECT repair_tools.*,notify_repair.* FROM repair_tools LEFT JOIN notify_repair ON repair_tools.noti_repair_id = notify_repair.id WHERE sta_fix = 'แทงชำรุด' AND date_repair BETWEEN '$date_s' AND '$date_e' AND type_work = 'ศูนย์เครื่องมือแพทย์ฯ'; "; 
            $result = $conn->query($sql);
        }else if($_SESSION['user_level']=='ช่างคอมพิวเตอร์'){
            $sql =  "SELECT repair_tools.*,notify_repair.* FROM repair_tools LEFT JOIN notify_repair ON repair_tools.noti_repair_id = notify_repair.id WHERE sta_fix = 'แทงชำรุด' AND date_repair BETWEEN '$date_s' AND '$date_e' AND type_work = 'ศูนย์คอมพิวเตอร์';"; 
            $result = $conn->query($sql);
        }else if($_SESSION['user_level']=='ช่างซ่อมบำรุงทั่วไป'){
            $sql =  "SELECT repair_tools.*,notify_repair.* FROM repair_tools LEFT JOIN notify_repair ON repair_tools.noti_repair_id = notify_repair.id WHERE sta_fix = 'แทงชำรุด' AND date_repair BETWEEN '$date_s' AND '$date_e' AND type_work = 'ศูนย์ซ่อมบำรุง';"; 
            $result = $conn->query($sql);
        }else if($_SESSION['user_level']=='แอดมิน'){
            $sql =  "SELECT name_parts.*,notify_repair.type_work FROM name_parts LEFT JOIN notify_repair ON name_parts.id_repair = notify_repair.id WHERE date_repair BETWEEN $date_s AND $date_e AND sta_fix ='แทงชำรุด';  "; 
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
            <td style ='text-align:center;'><?php echo $row['sta_fix'];?></td>
            <td style ='text-align:center;'><?php echo $row['username_e'];?></td>
          
           

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
                'วันที่ซ่อม', 'เลขครุภํณฑ์','อุปกรณ์', 'แผนกส่งซ่อม','ปัญหา','แผนกซ่อม','สถานะอุปกรณ์','ผู้ตรวจสอบ'

            ]);

            foreach($result as $array_data){

                array_push($array_data_pdf,[
                    $array_data['date_repair'] , $array_data['noid'] , $array_data['tools_name'],
                    $array_data['customer'] , $array_data['problem'] , $array_data['type_work'],
                    $array_data['sta_fix'] , $array_data['username_e']
                ]);

            }
        ?>
        <div style="float:left;">
           <p style="float:left;">ดาวโหลดเอกสารอุปกรณ์แทงชำรุดโรงพยาบาลพะเยา</p>
            <button id="make-pdf" onclick="makePdf();"  style="float:left;"  type="button" class="btn btn-link">PDF</button> 
        </div>
    </div>
        
    </section>
    <script>
        $(document).ready( function () {
            $('#data_table').DataTable();
        } );
        function makePdf() {
            var docDefinition = {
                pageOrientation: 'landscape',
                content: [
                    {
                        layout: 'noBorders',
                        table: {
                            body: [
                                [ 
                                    { image: 'data:image/jpeg;base64,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',
                                    width: 50,
                                    height: 50,
                                    margin: [ 5, 2, 10, 20 ] }, 
                                    {
                                        text :'โรงพยาบาลพะเยา' ,
                                        fontSize :30 , bold: true ,
                                        margin: [ -10, 10, 0, 0]
                                    }
                                ],
                            ]
                        }
                    },
                    {
                        // if you specify both width and height - image will be stretched
                        
                    },
                    { text: "รายการอุปกรณ์แทงชำรุด" ,fontSize :25 , bold: true},
                    // { text: "Sarabun Thai font bold ภาษาไทย", bold: true ,fontSize :20 },
                    // { text: "Sarabun Thai font bold ภาษาไทย", italics: true ,fontSize :20  },
                    {text: "  "},
                    {
                        layout: 'lightHorizontalLines', // optional
                        table: {
                            // headers are automatically repeated if the table spans over multiple pages
                            // you can declare how many rows should be treated as headers
                            headerRows: 1,
                            widths: [ 70,70,100,70,105,70,70,70],

                            body: <?php echo json_encode($array_data_pdf) ?>
                            
                        },
                        margin: [ 5, 2, 10, 60 ]
                    },
                    {
                        layout: 'noBorders', // optional
                        table: {
                            // headers are automatically repeated if the table spans over multiple pages
                            // you can declare how many rows should be treated as headers
                            headerRows: 1,
                            widths: [ '80%', 'auto' ],

                            body: [
                                [ ' ' , {text: "<?php echo $_SESSION['user'];?>"  ,fontSize :16 , alignment: 'center' , margin: [ -450, 2, 10, 10 ] }],
                                [ ' ' , {text: "(......................................................)" ,fontSize :16  , alignment: 'center', margin: [ -450, -5, 10, 10 ]}],
                                [ ' ' , {text: "<?php echo $name_head;?>" ,fontSize :16 , alignment: 'center' , margin: [ -450, -10, 10, 10 ]}],
                                [ ' ' , {text: "<?php echo $date_now ?>"  ,fontSize :16 , alignment: 'center' , margin: [ -450, -10, 10, 10 ] }]
                            ]
                        },
                        margin: [ 5, 2, 10, 20 ]
                    },
                    
                   
                ],
                // defaultStyle: { 
                //     font: 'Roboto'
                // }
            };
            pdfMake.createPdf(docDefinition).open();
        }
       
        // function makePdf() {
        //     var docDefinition = {
        //         pageOrientation: 'landscape',
               
        //         content: [
                    
        //             { text: "รายการสั่งซื้ออะไหล่", bold: true ,fontSize :30,},
                    
        //             // { text: "Sarabun Thai font bold กดเกหดเกดเ", italics: true ,fontSize :20  },
        //             {
        //                 layout: 'lightHorizontalLines', // optional
        //                 table: {
        //                     // headers are automatically repeated if the table spans over multiple pages
        //                     // you can declare how many rows should be treated as headers
        //                     headerRows:1,
        //                     widths: [70,70,70,70,70,70,70,70,70],fontSize :30,
                            
                            

        //                     // body: [
        //                     // [ 'First', 'Second', 'Third', 'The last one' ],
        //                     // [ 'Value 1', 'Value 2', 'Value 3', 'Value 4' ],
        //                     // [ { text: 'Bold value', bold: true }, 'Val 2', 'Val 3', 'Val 4' ]
        //                     // ]
        //                     body :<?php echo json_encode($array_data_pdf) ?>
                            
                            
        //                 }
                        
                        

                        
                        
        //             },
        //         ],
                
        //         // defaultStyle: { 
        //         //     font: 'Roboto'
        //         // }
        //     };
        //     pdfMake.createPdf(docDefinition).print();
        // }

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