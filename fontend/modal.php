

<?php 
    include("../login/server.php");
    include("menu.php");
// แสดงรายละเอียดอุปกรณ์
    if(isset($_GET['id'])){
        $noid=$_GET['id'];
        $sql = "SELECT *  FROM `deprecia` WHERE `noid` = '$noid';";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($result)){
            $models = $row['models'];
            $day_recive = $row['receive'];
            $price = $row['perunits'];
            $noid = $row['noid'];
            $name_tools = $row['names'];
        }
        $day_recive= date('d-m-Y');
?>
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" align="center">รายละเอียดอุปกรณ์</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

        
                <div class="modal-body">
                    <label>วันที่รับอุปกรณ์<br>
                        <input  value="<?php echo $day_recive; ?>" style="border: 0px; border-bottom: 1px solid black">
                    </label>
                    <label style="margin-left:30px;">เลขครุภัณฑ์<br>
                        <input value="<?php echo $noid; ?>" style="border: 0px; border-bottom: 1px solid black;">
                    </label><br><br>

                    <label>ชื่ออุปกรณ์<br>
                        <input value="<?php echo $name_tools; ?>" style="border: 0px; border-bottom: 1px solid black">
                    </label>
                    <label style="margin-left:30px;">รุ่น<br>
                        <input value="<?php echo $models; ?>" style="border: 0px; border-bottom: 1px solid black;">
                    </label><br><br>

                    <label>ราคา<br>
                        <input value="<?php echo $price; ?>" style="border: 0px; border-bottom: 1px solid black">
                    </label>
                    
                </div>
        
           

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
<?php
    }
    // ---------------------------------------------------------------------------------------------------------------------------------------------------------------------



    // บันทึกสถานะอุปกรณ์ของช่างซ่อม
    if(isset($_GET['noti_repair_id'])){
      date_default_timezone_set('asia/bangkok');  
      $date_now = date('Y-m-d');
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
                    <input name="date_repair" type="date" value="<?php echo $date_now; ?>" class="form-control" readonly>
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
        
    <!-- สั่งรายการอะไหล่ -->
<?php 
    }if(isset($_GET['part_repair'])){
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

                <div class="mb-3 mt-3">
                <label>วันที่:</label><br>
                    <input type="date" name="date_order[]" value="<?php echo $date_show;?>" id="date_order" style="border: 0px; border-bottom: 1px solid black" readonly> 
                
                </div>

                <div class="mb-3 mt-3">
	                <label for="slno">รายการที่:</label>
	                <input type="text" class="form-control sl" name="slno[]" id="slno" value="1" readonly="">
	            </div>
                <div class="mb-3 mt-3">
                    <label>รายการที่</label>
                    <input  type="text" name="repair_id[]" value="<?php echo $_GET['part_repair'] ;?>" id="repair_id" class="form-control sl" >
                </div>
	            <div class="mb-3 mt-3">
	                <label for="Name parts">ชื่ออะไหล่:</label>
	                <input type="text" class="form-control sl" name="name_parts[]" id="st_name_part"  placeholder="ใส่ชื่ออะไหล่">
	            </div>
	    
	            <div class="mb-3 mt-3">
	                <label for="num_s">จำนวน</label>
	                <input type="text" class="form-control sl" name="num_s[]" id="num_s" placeholder="ใส่จำนวน">
	            </div>
	    
	            <div class="mb-3 mt-3">
	                <label for="price unit">ราคา:</label>
	                <input type="text" class="form-control sl" id="price_unit" name="price_unit[]" placeholder="ใส่ราคา">
	            </div>
		
		        <div class="mb-3 mt-3">
	                 <label for="Username__e">ชื่อผู้จัดซื้อ:</label>
	     	        <input type="text" id="username_e" name="username_e[]" value="<?php echo $_GET['person'];?>" class="form-control sl" readonly/>
	            </div>
            </div>
            <div id="next">55555</div>
            
            <div class="modal-footer">
                <button type="button" name="addrow" id="addrow" class="btn btn-warning">เพิ่มรายการ</button>
                <button type="submit" name="submit_part" class="btn btn-success">บันทึกข้อมูล</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
            </div>
        </div>
        </form>
    </div>
<?php
    }if(isset($_POST['submit_part'])){
        for($i=0;$i<count($_POST['slno']);$i++){
                $date_order = $_POST['date_order'][$i];
                $id_repair = $_POST['repair_id'][$i];
                $name_parts = $_POST['name_parts'][$i];
                $num_s = $_POST['num_s'][$i];
                $price_unit = $_POST['price_unit'][$i];
                $username_e = $_POST['username_e'][$i];
                if($name_parts!=='' && $num_s!=='' && $price_unit!=='' && $username_e!=='' && $date_order!=='' && $id_repair!=='' ){
                $sql="INSERT INTO name_parts(name_parts,num_s,price_unit,username,date_order,id_repair)VALUES('$name_parts','$num_s','$price_unit','$username_e','$date_order','$id_repair')";
                    
                    $stmt=$conn->prepare($sql);
                    $stmt->execute();
                     //echo '<div class="alert alert-success" role="alert">Submitted Successfully</div>';
		}
		else{
			
			echo '<div class="alert alert-danger" role="alert">Error Submitting in Data</div>';
		}
	}
	echo "<script type='text/javascript'>";

    echo "window.location = 'repair_all.php'; ";
		echo "alert('ระบบทำการบันทึกข้อมูลเรียบร้อย');";
		echo "</script>";
        
        }
    // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    if(isset($_POST["submit_news"])){
        date_default_timezone_set('asia/bangkok');  
        $date_now = date('Y-m-d');
        $username_e = mysqli_real_escape_string($conn,$_POST['username_e']);
        $noti_repair_id = mysqli_real_escape_string($conn,$_POST['noti_repair_id']);
        $problem = mysqli_real_escape_string($conn,$_POST['problem']);
        $sta_fix = mysqli_real_escape_string($conn,$_POST['sta_fix']);
        $date_repair = mysqli_real_escape_string($conn,$_POST['date_repair']);
        $sql_re = "UPDATE `repair_tools` SET problem='$problem',sta_fix='$sta_fix',username_e='$username_e',date_repair='$date_repair' WHERE noti_repair_id = '$noti_repair_id'";
        if(($sta_fix == "ซ่อมได้")||($sta_fix == "รออะไหล่")||($sta_fix == "ส่งเคลม")||($sta_fix == "แก้ไข")){
          $sql_up = "UPDATE `notify_repair` SET status_repair='กำลังซ่อม'  WHERE id = '$noti_repair_id'";
          $sql_con = "UPDATE `repair_tools` SET  confirm2 ='y' WHERE noti_repair_id = '$noti_repair_id'";
        }if($sta_fix == "แทงชำรุด"){
            $sql_up ="UPDATE `notify_repair` SET status_repair='ซ่อมไม่ได้'  WHERE id = '$noti_repair_id'";
            $sql_con = "UPDATE `repair_tools` SET  confirm2 ='n',edit_fixx='แทงชำรุด',date_check = '$date_now' WHERE noti_repair_id = '$noti_repair_id'";
        }
        $result_con = mysqli_query($conn,$sql_con);
        $result = mysqli_query($conn,$sql_re);
        $resultt = mysqli_query($conn,$sql_up);
        if(($_SESSION['user_level']=='ช่างคอมพิวเตอร์')||($_SESSION['user_level']=='ช่างซ่อมบำรุงทั่วไป')||($_SESSION['user_level']=='ช่างเครื่องมือแพทย์')){
            echo "<script>";
			    echo "alert('ระบบทำการบันทึกข้อมูลเรียบร้อย !');";
			    echo "window.location='repair_all.php';";
          	    echo "</script>";
            
        }else if($_SESSION['user_level']=='ผู้ตรวจสอบ'){
            echo "<script>";
            echo "alert('ระบบทำการบันทึกข้อมูลเรียบร้อย !');";
			echo "window.location='send_review.php';";
          	echo "</script>";
           
        }
    }if(isset($_GET['edit_fix'])){
        $noti_repair_id = $_GET['edit_fix'];
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

                <div class="mb-3 mt-3">
                    <label>รายการที่</label>
                    <input name="noti_repair_id" type="text"  value="<?php echo $noti_repair_id ?>" class="form-control" readonly>
                </div>

                <div class="mb-3 mt-3">
                    <label>สาเหตุ/ปัญหา</label>
                    <textarea name="comment" type="text"  class="form-control"></textarea>
                </div>

                <div class="mb-3 mt-3">
                    <label>สถานะการซ่อม</label>
                    <input name="edit_fixx" type="text"  class="form-control"  value="แก้ไข" readonly>
                 
            </div>
            <div class="modal-footer">
                <button type="submit" name="update_edit" class="btn btn-success">บันทึกข้อมูล</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
            </div>
        </div>
        </form>
    </div>
    <?php
    }if(isset($_POST['update_edit'])){
        $comment = mysqli_real_escape_string($conn,$_POST['comment']);
        $edit_fixx = mysqli_real_escape_string($conn,$_POST['edit_fixx']);
        $noti_repair_id = mysqli_real_escape_string($conn,$_POST['noti_repair_id']);
        $sql_ud = "UPDATE `repair_tools` SET comment='$comment',edit_fixx ='$edit_fixx' WHERE noti_repair_id = '$noti_repair_id'";
        $sql_st = "UPDATE `notify_repair` SET status_repair='กำลังซ่อม' WHERE id = '$noti_repair_id'";
        $result_ud = mysqli_query($conn,$sql_ud);
        $result_st = mysqli_query($conn,$sql_st);
        echo "<script>";
			    echo "alert('ระบบทำการแจ้งแก้ไขข้อมูลเรียบร้อย !');";
			    echo "window.location='send_review.php';";
         echo "</script>";
    }if(isset($_GET['show_user'])){
        $show_user = $_GET['show_user'];
        $sql_user = "SELECT * FROM `repair_db`.`user` WHERE `username` = $show_user";
        $result_user = mysqli_query($conn,$sql_user);
        while($row = mysqli_fetch_array($result_user)){
            $name = $row['firstname']." ".$row['lastname'];
            $user_address = $row['user_level'];
            $num_phone = $row['num_phone'];
            $email = $row['email'];
        }
        ?>
        <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">ข้อมูลผู้แจ้งซ่อมครุภัณฑ์</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <div class="mb-3 mt-3">
	                <label >ชื่อผู้แจ้งซ่อม:</label>
	                <input type="text"  value="<?php echo $name?>"  readonly class="form-control">
	            </div>
                <div class="mb-3 mt-3">
                    <label>แผนกที่อยู่:</label>
                    <input  type="text"  value="<?php echo $user_address?>" readonly class="form-control" >
                </div>
                <div class="mb-3 mt-3">
                    <label>เบอร์โทรติดต่อ:</label>
                    <input  type="text"  value="<?php echo $num_phone?>" readonly class="form-control" >
                </div>
                <div class="mb-3 mt-3">
                    <label>EMAIL:</label>
                    <input  type="text"  value="<?php echo $email?>" readonly class="form-control" >
                </div>
	            
            </div>
            <div id="next2"></div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
        <?php
    }else{}
    ?>
<script>
var num = 1;
$('#addrow').click(function(){
		// var length = $('.sl').length;
		// var i   = parseInt(length)+parseInt(1);

		var newrow = $('#next').append('\
        <div class="modal-body">\
              <div class="mb-3 mt-3">\
                <label >วันที่</label><br>\
                    <input type="date" name="date_order[]" value="<?php echo $date_show?>" id="date_order" style="border: 0px; border-bottom: 1px solid black" >\
                </div>\
                <div class="mb-3 mt-3">\
                    <label>รายการที่</label>\
                    <input name="repair_id[]" value="<?php echo $_GET['part_repair'] ?>" id="repair_id"class="form-control sl" type="text" readonly>\
                </div>\
                <div class="mb-3 mt-3">\
	                <label for="slno">รายการที่:</label>\
	                <input type="text" class="form-control sl" name="slno[]" id="slno"  value="'+num+'" readonly="">\
	            </div>\
	            <div class="mb-3 mt-3">\
	                <label for="Name parts">ชื่ออะไหล่:</label>\
	                <input type="text" class="form-control sl" name="name_parts[]" id="st_name_part" placeholder="ใส่ชื่ออะไหล่">\
	            </div>\
	            <div class="mb-3 mt-3">\
	                <label for="num_s">จำนวน</label>\
	                <input type="int" class="form-control sl" name="num_s[]" id="num_s">\
	            </div>\
	            <div class="mb-3 mt-3">\
	                <label for="price unit">ราคา:</label>\
	                <input type="text" class="form-control sl" id="price_unit" name="price_unit[]" placeholder="ใส่ราคา">\
	            </div>\
		        <div class="mb-3 mt-3">\
	                 <label for="Username_e">ชื่อผู้จัดซื้อ:</label>\
	     	        <input type="text" id="username_e" name="username_e[]" value="<?php echo $_GET['person'];?>" class="form-control sl" readonly/>\
	            </div>\
                    <input type="button" class="btnRemove btn-danger" value="นำออก" style="padding: 5px 5px;border-radius: 5px;font-size:15px "/>\
            </div>\
            ');
    
		});
        num ++ ;
	// Removing event here
    $('body').on('click','.btnRemove',function() {
       $(this).closest('div').remove()
  });
</script>




