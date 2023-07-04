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
<?php 
    include("server.php");
    if(isset($_POST['pass'])){
        $noti_repair_id=$_POST['noti_repair_id'];
        $username_check = $_POST['username_check'];
        $date_now = date('Y-m-d');
        $sql_check = "UPDATE repair_tools SET comment = 'ใช้งานได้ปกติ' , username_check = '$username_check' , date_check='$date_now' ,confirm3 ='y',edit_fixx ='ซ่อมสำเร็จ' WHERE noti_repair_id = '$noti_repair_id';";
        $sql_sta_noti = "UPDATE notify_repair SET status_repair = 'รอคืนอุปกรณ์' WHERE id = '$noti_repair_id';";
        $result_sta_up = mysqli_query($conn,$sql_sta_noti); 
        $result_check = mysqli_query($conn,$sql_check);
        if($result_check)
        {
            echo "<script type='text/javascript'>";
                    echo "alert('ระบบได้ทำการบันทึกข้อมูลเรียบร้อย');";
                    echo "window.location = 'send_review.php'; ";
            echo "</script>";
        }
        else
        {
            echo "<script type='text/javascript'>";
                    echo "alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล');";
                    echo "window.location = 'send_review.php'; ";
            echo "</script>";
        }
}if(isset($_POST['edit_fix'])){
    $noti_repair_id=$_POST['edit_fix'];
    $username_check = $_POST['username_check'];

        $sql = "SELECT repair_tools.*,notify_repair.* FROM repair_tools LEFT JOIN notify_repair ON repair_tools.noti_repair_id = notify_repair.id 
        WHERE sta_fix='ซ่อมเสร็จแล้ว' AND noti_repair_id = '$noti_repair_id'";

        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($result)){
            $models = $row['models'];
            $day_recive = $row['receive'];
            $price = $row['perunits'];
            $noid = $row['noid'];
            $name_tools = $row['names'];
        }
    date_default_timezone_set('asia/bangkok');
    $date_show = date('Y-m-d');
    $date_order  = date('Y/m/d');
    ?>
     <div class="modal-dialog">
        <!-- Modal content-->
        <form method="POST" action="modal.php">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">รายละเอียดอุปกรณ์</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <!-- <label>วันที่<br>
                    <input  name="value_date" value="" style="border: 0px; border-bottom: 1px solid black">
                </label> -->
                <div class="mb-3 mt-3">
                    <label>วันที่ซ่อม:</label>
                    <input name="date_repair" type="date" value="<?php echo $date_show; ?>" class="form-control" readonly>
                </div>
                <div class="mb-3 mt-3">
                    <label>รายการที่</label>
                    <input name="noti_repair_id" type="text"  value="<?php echo $_GET['noti_repair_id'] ?>" class="form-control" readonly>
                </div>

                <div class="mb-3 mt-3">
                    <label>สาเหตุ/ปัญหา</label>
                    <textarea name="problem" type="text"  class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label>สถานะการซ่อม </label><br>
                    <select name="sta_fix" class="form-control" type="text" > 
                        <option value="ซ่อมได้">ซ่อมได้</option>
                        <option value="รออะไหล่">รออะไหล่</option>
                        <option value="ส่งเคลม">ส่งเคลม</option>
                        <option value="แทงชำรุด">แทงชำรุด</option>
                        <option value="ซ่อมเสร็จแล้ว">ซ่อมเสร็จแล้ว</option>
                    </select ><br>
                </div>
                <div class="mb-3 mt-3" >
                    <label>ผู้รับผิดชอบ</label>
                    <input name="username_e" value="<?php echo $_GET['person'] ?>" class="form-control" readonly type="text" >
                </div >
            </div>
            <div class="modal-footer">
                <button type="submit" name="submit_news" class="btn btn-success">บันทึกข้อมูล</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
            </div>
        </div>
        </form>
    </div>
    <!-- ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
        
    <?php } ?>