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
<!-- include bootstrap !-->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">



<!DOCTYPE html>
    <html lang="en" dir="ltr">

    <head>
        <meta http-equiv="content-type" content="text/html; charset=tis620">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../plugins/css/bootstrap.min.css">
        <!-- include jquery to use export file !-->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.11.5/b-2.2.2/b-html5-2.2.2/b-print-2.2.2/datatables.min.css"/>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.11.5/b-2.2.2/b-html5-2.2.2/b-print-2.2.2/datatables.min.js"></script>


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <link rel="stylesheet" href="../../plugins/style.css">
        <!-- Boxicons CDN Link -->
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        <title>Document</title>
    </head>

    <body>


        <?php if (!isset($_SESSION['user_level'])){
            header("location: ../../login/loginn.php");
            }
        ?>



        <section class="home-section">
            <div class="text">ศูนย์แจ้งซ่อมโรงพยาบาลพะเยา</div>
            <table class="table" id="data_table">
                <thead class="thead-dark">
                    <tr>
                        <th style='text-align:center;'>ลำดับ</th>
                        <th style='text-align:center;'>ชื่อ</th>
                        <th style='text-align:center;'>นามสกุล</th>
                        <th style='text-align:center;'>อีเมล์</th>
                        <th style='text-align:center;'>เบอร์โทรศัพท์</th>
                        <th style='text-align:center;'>username</th>
                        <th style='text-align:center;'>password</th>
                        <th style='text-align:center;'>หน่วยงาน</th>
                        <th style='text-align:center;'>สถานะการอนุมัติ</th>
                        <th style='text-align:center;'>อนุมัติ/ไม่อนุมัติ</th>
                        <th style='text-align:center;'>ลบ</th>
                        <th style='text-align:center;'>แก้ไขข้อมูล</th>
                    </tr>
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
            <td style ='text-align:center;'><?php echo $num ;?></td>
            <td style ='text-align:center;'><?php echo $row['firstname']  ;?></td>
            <td style ='text-align:center;'><?php echo $row['lastname']  ;?></td>
            <td style ='text-align:center;'><?php echo$row['email'] ;?></td>
            <td style ='text-align:center;'><?php echo$row['num_phone'] ;?></td>
            <td style ='text-align:center;'><?php echo$row['username'] ;?></td>
            <td style ='text-align:center;'><?php echo$row['password'] ;?></td>
            <td style ='text-align:center;'><?php echo$row['user_level'] ;?></td>
            <td style ='text-align:center;'><?php echo$row['status'] ;?></td>
            <td style ='text-align:center;'>
                    <a  onclick="update_y('<?php echo $row['username'] ;?>');" helf='#'><span class='	fa fa-check-circle fa-2x 'style= 'color:black;margin-right:20px;'></span></a>
                    
                    <a onclick="update_n('<?php echo $row['username'] ;?>' )"  helf='#'><span class='	fa fa-times fa-2x 'style= 'color:black'></span></a>
                </td>
            <td style ='text-align:center;'><a onclick="delete_fun(' <?php echo $row['username'] ;?> ');"helf='#'  ><span class='fas fa-trash-alt fa-2x 'style= 'color:black'></span></a></td>
            <td style ='text-align:center;'><a href='edit.php?update=<?php echo $row['username'] ; ?>' helf='#'><span class='fas fa-edit fa-2x 'style= 'color:black;margin-left:25px'></span></a></td>

        </tr>
        <?php  
        $num++;
                }
    }else{

    }mysqli_close($conn);
    
    ?>

    
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
                  
                </tbody>
            </table>
            
            
        </section>
    </body>
                <script>
                    $(document).ready(function(){
                        $('#data_table').dataTable({
                            dom: 'Bfrtip',
                            button:[
                                'copy','csv','excel','pdf','print'
                            ]
                        });
                    });
                </script>
    </html>
    