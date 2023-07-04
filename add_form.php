<?php include("fontend/menu.php");?>
<?php

//session_start();
include('login/server.php');
if(isset($_POST['submit'])){
for($i=0;$i<count($_POST['slno']);$i++){
		$name_parts = $_POST['name_parts'][$i];
		$num_s = $_POST['num_s'][$i];
		$price_unit = $_POST['price_unit'][$i];
		$username = $_POST['username'][$i];
		if($name_parts!=='' && $num_s!=='' && $price_unit!=='' && $username!==''){
	$sql="INSERT INTO name_parts(name_parts,num_s,price_unit,username)VALUES('$name_parts','$num_s','$price_unit','$username')";
			$stmt=$conn->prepare($sql);
			$stmt->execute();
		    //echo '<div class="alert alert-success" role="alert">Submitted Successfully</div>';
		}
		else{
			
			echo '<div class="alert alert-danger" role="alert">Error Submitting in Data</div>';
		}
	}
	echo "<script type='text/javascript'>";
		echo "alert('Submitted successfully')";
		echo "</script>";
}
?>
<html>
<head>
<title>ajax example</title>
<link rel="stylesheet" href="bootstrap.css" crossorigin="anonymous">
<!-- Optional theme -->
<link rel="stylesheet" href="bootstrap-theme.css" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
<link rel="stylesheet" href="plugins/style.css">
<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
<style>
.container{
	
	width:80%;
	height:30%;
	padding: 20px;
}
</style>
</head>
<body>
	<section class="home-section">
<div class="container">
<h3 align="center"><u>รายการสั่งอะไหล่ซ่อม</u></h3>
<br/><br/><br/>
	<form class="form-horizontal" action="#" method="post">

    <label for="tools_name"></label>

	<div class="row">
		<div class="col-sm-1">
	      <label for="slno">รายการที่:</label>
	      <input type="text" class="form-control sl" name="slno[]" id="slno" value="1" readonly="">
	    </div>
	    
	    <div class="col-sm-3">
	      <label for="Name parts">ชื่ออะไหล่:</label>
	      <input type="text" class="form-control" name="name_parts[]" id="st_name_part" placeholder="ใส่ชื่ออะไหล่">
	    </div>
	    
	    <div class="col-sm-1">
	     <label for="num_s">จำนวน</label>
	      <input type="text" class="form-control" name="num_s[]" id="num_s">
	    </div>
	    
	    <div class="col-sm-3">
	      <label for="price unit">ราคา:</label>
	      <input type="text" class="form-control" id="price_unit" name="price_unit[]" placeholder="ใส่ราคา">
	    </div>
		
		<div class="col-sm-3">
	     <label for="Username">ชื่อผู้จัดซื้อ:</label>
	     	<input type="text" id="username" name="username[]" class="form-control"/>
	    </div>
	    
		</div><br/>
		<div id="next"></div>
		<br/>
	<button type="button" name="addrow" id="addrow" class="btn btn-success pull-right">เพิ่มรายการ</button>
	
	<button type="submit" name="submit" class="btn btn-info pull-left" >บันทึก</button>
	</form>

    <!-- แบบฟอร์มไว้สำหรับใส่ใน script !-->
    <!-- <div class="row">
        <div class="col-sm-1">
            <label for="Age">รายการที่:</label>
            <input type="text" class="form-control sl" name="slno[]" value="'+i+'" readonly="">
        </div>
        <div class="col-sm-3">
            <label for="Student Name">ชื่ออะไหล่</label>
            <input type="text" class="form-control" name="student_name[]" id="st_name'+i+'" placeholder="Enter Student Name">
        </div>
        <div class="col-sm-3">
            <label for="Phone">จำนวนในการซื้อ:</label>
            <input type="text" class="form-control" name="phone_no[]" id="pn'+i+'" placeholder="Enter Phone No">
        </div>
        <div class="col-sm-1">
            <label for="Age">ราคา:</label>
            <input type="text" class="form-control" id="age'+i+'" name="age[]" placeholder="Enter Age">
        </div>
        <div class="col-sm-3">
            <label for="DateofBirth">ชื่อผู้จัดซื้อ:</label>
            <input type="date" id="dob'+i+'" name="date_of_birth[]" class="form-control"/>
        </div>
    </div> -->

<script src="jquery-3.2.1.min.js"></script>
<script src="bootstrap.min.js"></script>
<script>
$('#addrow').click(function(){
		var length = $('.sl').length;
		var i   = parseInt(length)+parseInt(1);
		var newrow = $('#next').append('<div class="row">\
											<div class="col-sm-1">\
												<label for="slo">รายการที่</label>\
												<input type="text" class="form-control sl" name="slno[]" value="'+i+'" readonly="">\
											</div>\
											<div class="col-sm-3">\
												<label for="name_parts">ชื่ออะไหล่:</label>\
												<input type="text" class="form-control" name="name_parts[]" id="name_parts'+i+'" placeholder="ใส่ชื่ออะไหล่">\
											</div>\
											<div class="col-sm-1">\
												<label for="num_s">จำนวน:</label>\
												<input type="text" class="form-control" name="num_s[]" id="num_s'+i+'" >\
											</div>\
											<div class="col-sm-3">\
													<label for="price_unit">ราคา:</label>\
													<input type="text" class="form-control" id="price_unit'+i+'" name="price_unit[]" placeholder="ใส่ราคา"></div>\
											<div class="col-sm-3">\
													<label for="username">ชื่อผู้จัดซื้อ:</label>\
													<input type="text" id="username'+i+'" name="username[]" class="form-control"/>\
											</div>\
													<input type="button" class="btnRemove btn-danger" value="นำออก" style="padding: 5px 5px;border-radius: 5px;font-size:15px "/>\
											</div><br>');
		
		});
	
	// Removing event here
  $('body').on('click','.btnRemove',function() {
       $(this).closest('div').remove()
  });
		
</script>
</section>
</body>
</html>