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

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- include sweet alert!-->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="../../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
        <script src="../../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="../../node_modules/sweetalert2/dist/sweetalert2.min.css">
        <!-- include bootstrap !-->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        
        <link rel="stylesheet" href="../../plugins/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <link rel="stylesheet" href="../../plugins/style.css">
        <!-- Boxicons CDN Link -->
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

        <!-- <script src='PDF_config/js/path_fonts.js'></script> -->
        <script src='../../PDF_config/js/pdfmake.min.js'></script>
        <script src='../../PDF_config/js/vfs_fonts.min.js'></script>
       
        <!-- ช่องค้นหา หน้าpage  -->
        <link rel="stylesheet" type="text/css" href="../../plugins/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="../../plugins/js/jquery.dataTables.js"></script>
        
        <title>อนุมัติสิทธิ์ใช้งาน</title>
    </head>

    <body>
        
        

        <?php if (!isset($_SESSION['user_level'])) header("location: ../../login/loginn.php");  ?>



        <section class="home-section" >
            <div style ="background-color:#81559d;box-shadow: 5px 5px #4a4a4a;">
            <div class="text" style ="font-size:30px;color:white;">ข้อมูลผู้ใช้งานในระบบ</div style="padding:30px;"></div>
        </div><br>
          
            
        <div style="padding:20px;">  
            <table class="table" id="data_table" style="background-color: #adc2ef;border: 1px solid black;">
                <thead style="background-color: #adc2ef;border: 1px solid black;">
                    
                        <th style='text-align:center;background-color: #adc2ef;border: 1px solid black;' >ลำดับ</th>
                        <th style='text-align:center;background-color: #adc2ef;border: 1px solid black;'>ชื่อ</th>
                        <th style='text-align:center;background-color: #adc2ef;border: 1px solid black;'>นามสกุล</th>
                        <th style='text-align:center;background-color: #adc2ef;border: 1px solid black;'>อีเมล์</th>
                        <th style='text-align:center;background-color: #adc2ef;border: 1px solid black;'>เบอร์โทรศัพท์</th>
                        <th style='text-align:center;background-color: #adc2ef;border: 1px solid black;'>username</th>
                        <th style='text-align:center;background-color: #adc2ef;border: 1px solid black;'>password</th>
                        <th style='text-align:center;background-color: #adc2ef;border: 1px solid black;'>หน่วยงาน</th>
                        <th style='text-align:center;background-color: #adc2ef;border: 1px solid black;'>สถานะการอนุมัติ</th>
                        <th style='text-align:center;background-color: #adc2ef;border: 1px solid black;'>อนุมัติ/ไม่อนุมัติ</th>
                        <th style='text-align:center;background-color: #adc2ef;border: 1px solid black;'>ลบ</th>
                        <th style='text-align:center;background-color: #adc2ef;border: 1px solid black;'>แก้ไขข้อมูล</th>
                    
                </thead>
                <tbody>
        <?php include('../server.php');
        $num = 1;
        $sql = "SELECT * FROM `user`";
        $result = $conn->query($sql);
       
        
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            ?>
        <tr>
            <td style ='text-align:center;background-color: #adc2ef;border: 1px solid black;'><?php echo $num ;?></td>
            <td style ='text-align:center;border: 1px solid black;'><?php echo $row['firstname'];?></td>
            <td style ='text-align:center;border: 1px solid black;'><?php echo $row['lastname'];?></td>
            <td style ='text-align:center;border: 1px solid black;'><?php echo $row['email'];?></td>
            <td style ='text-align:center;border: 1px solid black;'><?php echo $row['num_phone'];?></td>
            <td style ='text-align:center;border: 1px solid black;'><?php echo $row['username'];?></td>
            <td style ='text-align:center;border: 1px solid black;'><?php echo $row['password'];?></td>
            <td style ='text-align:center;border: 1px solid black;'><?php echo $row['user_level'];?></td>
            <td style ='text-align:center;border: 1px solid black;'><?php echo $row['status'];?></td>
            <td style ='text-align:center;border: 1px solid black;'>
                    <a  onclick="update_y('<?php echo $row['username'] ;?>');" helf='#'><span class='	fa fa-check-circle fa-2x 'style= 'color:black;margin-right:20px;'></span></a>
                    
                    <a onclick="update_n('<?php echo $row['username'] ;?>');"  helf='#'><span class='	fa fa-times fa-2x 'style= 'color:black'></span></a>
                </td>
            <td style ='text-align:center;border: 1px solid black;'><a onclick="delete_fun('<?php echo $row['username'] ;?>' );"helf='#'  ><span class='fas fa-trash-alt fa-2x 'style= 'color:black'></span></a></td>
            <td style ='text-align:center;border: 1px solid black;'><a href='edit.php?update=<?php echo $row['username'] ;?>' helf='#'><span class='fas fa-edit fa-2x 'style= 'color:black;'></span></a></td>

        </tr> 
        <?php
        $num++;
                }
    }else{

    }mysqli_close($conn);
    
    ?>
                    
                </tbody>
            </table>
        <p style="float:left;">ดาวโหลดเอกสารข้อมูลสมาชิกแจ้งซ่อมโรงพยาบาลพะเยา</p>
        <button id="make-pdf" onclick="makePdf();" style="float:left;"  type="button" class="btn btn-link">PDF</button>    
    </div>          
        <?php 
            $array_data_pdf = array();
            array_push($array_data_pdf,[
                'ชื่อ', 'นามสกุล','อีเมลล์', 'เบอร์โทร','username','password','แผนก','อนุมัติ'
            ]);

            foreach($result as $array_data){

                array_push($array_data_pdf,[
                    $array_data['firstname'] , $array_data['lastname'] , $array_data['email'] , $array_data['num_phone'],
                    $array_data['username'] , $array_data['password'] , $array_data['user_level'] , $array_data['status']
                ]);

            }
        ?>
        
        
        
    </section>
    <script>
        $(document).ready( function () {
            $('#data_table').DataTable();
        } );
        
        function makePdf() {
            var docDefinition = {
                content: [
                    // { text: "Sarabun Thai font กเดกดเ" ,fontSize :20 },
                    { text: "รายชื่อสมาชิกผู้รับซ่อมในแต่ละแผนก", bold: true ,fontSize :20},
                    
                    // { text: "Sarabun Thai font bold กดเกหดเกดเ", italics: true ,fontSize :20  },
                    {
                        layout: 'lightHorizontalLines', // optional
                        table: {
                            // headers are automatically repeated if the table spans over multiple pages
                            // you can declare how many rows should be treated as headers
                            headerRows:1,
                            widths: [ 40,40,90,50,40,40,70,40],

                            // body: [
                            // [ 'First', 'Second', 'Third', 'The last one' ],
                            // [ 'Value 1', 'Value 2', 'Value 3', 'Value 4' ],
                            // [ { text: 'Bold value', bold: true }, 'Val 2', 'Val 3', 'Val 4' ]
                            // ]
                            body : <?php echo json_encode($array_data_pdf) ?>
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

                    function delete_fun(username) {

                        Swal.fire({
                            title: 'ลบข้อมูล',
                            text: "คุณต้องการลบข้อมูลผู้ใช้งานหรือไม่",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            cancelButtonText: 'ยกเลิก',
                            confirmButtonText: 'ยืนยัน'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire(
                                    'ลบข้อมูลเรียบร้อยเเล้ว!',
                                    '',
                                    'success'
                                )
                                setTimeout(function() {
                                    window.location = "../../backend/qury_admin/del.php?del=" + username;
                                }, 2000);

                            }
                        })
                    }

                    function update_n(username) {

                        Swal.fire({
                            title: 'ยกเลิกสิทธิ์',
                            text: "คุณต้องการยกเลิกสิทธิ์การใช้งานหรือไม่",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            cancelButtonText: 'ยกเลิก',
                            confirmButtonText: 'ยืนยัน'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire(
                                    'ยกเลิกสิทธ์การใช้งานเรียบร้อยเเล้ว!',
                                    '',
                                    'success'
                                )
                                setTimeout(function() {
                                    window.location = "../../backend/qury_admin/confirm.php?nupdate=" + username;
                                }, 2000);

                            }
                        })
                    }

                    function update_y(username) {

                        Swal.fire({
                            title: 'อนุมัติ',
                            text: "คุณต้องการอนุมัติสิทธ์ผู้ใช้งานหรือไม่",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            cancelButtonText: 'ยกเลิก',
                            confirmButtonText: 'ยืนยัน'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire(
                                    'อนุมัติสิทธิการใช้งานเรียบร้อยเเล้ว!',
                                    '',
                                    'success'
                                )
                                setTimeout(function() {
                                    window.location = "../../backend/qury_admin/confirm.php?yupdate=" + username;
                                }, 2000);

                            }
                        })
                    }
                    </script>
    </body>
         
    </html>