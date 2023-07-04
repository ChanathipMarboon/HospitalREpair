<?php
//session_start();
include('login/server.php');
date_default_timezone_set('asia/bangkok');
        $date_show = date('Y-m-d');
if(isset($_POST['submit'])){
for($i=0;$i<count($_POST['slno']);$i++){
		$student_name = $_POST['student_name'][$i];
		$phone_no = $_POST['phone_no'][$i];
		$age = $_POST['age'][$i];
		$date_of_birth = $_POST['date_of_birth'][$i];
		if($student_name!=='' && $phone_no!=='' && $age!=='' && $date_of_birth!==''){
	$sql="INSERT INTO student(student_name,phone_no,age,date_of_birth)VALUES('$student_name','$phone_no','$age','$date_of_birth')";
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
  <!-- include bootstrap !-->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        
<style>
.container{
	
	width:80%;
	height:30%;
	padding:20px;
}
</style>
</head>
<body>
<div class="container">
<h3 align="center"><u>Inserting Multiple Rows in PHP</u></h3>
<br/><br/><br/>
	<form class="form-horizontal" action="#" method="post">
	<div class="row">
		<div >
	      <label for="Age">Sl No:</label>
	      <input type="text" class="form-control sl" name="slno[]" id="slno" value="1" readonly="">
	    </div>
	    
	    <div >
	      <label for="Student Name">Student Name:</label>
	      <input type="text" class="form-control" name="student_name[]" id="st_name" placeholder="Enter Student Name">
	    </div>
	    
	    <div >
	     <label for="Phone">Phone No*:</label>
	      <input type="text" class="form-control" name="phone_no[]" id="pn" placeholder="Enter Phone No">
	    </div>
	    
	    <div >
	      <label for="Age">Age:</label>
	      <input type="text" class="form-control" id="age" name="age[]" placeholder="Enter Age">
	    </div>
		
		<div >
	     <label for="DateofBirth">Date of Birth:</label>
	     	<input type="date" id="dob" name="date_of_birth[]" value="<?php echo $date_show; ?>" class="form-control"/>
	    </div>
	    
		</div><br/>
		<div id="next"></div>
		<br/>
	<button type="button" name="addrow" id="addrow" class="btn btn-success pull-right">Add New Row</button>
	<br/><br/>
	<button type="submit" name="submit" class="btn btn-info pull-left">Submit</button>
	</form>
</div>
<script src="jquery-3.2.1.min.js"></script>
<script src="bootstrap.min.js"></script>
<script>
$('#addrow').click(function(){
		var length = $('.sl').length;
		var i   = parseInt(length)+parseInt(1);
		var newrow = $('#next').append('<div class="row"><div ><label for="Age">Sl No:</label><input type="text" class="form-control sl" name="slno[]" value="'+i+'" readonly=""></div><div ><label for="Student Name">Student Name:</label><input type="text" class="form-control" name="student_name[]" id="st_name'+i+'" placeholder="Enter Student Name"></div><div ><label for="Phone">Phone No*:</label><input type="text" class="form-control" name="phone_no[]" id="pn'+i+'" placeholder="Enter Phone No"></div><div ><label for="Age">Age:</label><input type="text" class="form-control" id="age'+i+'" name="age[]" placeholder="Enter Age"></div><div ><label for="DateofBirth">Date of Birth:</label><input type="date" id="dob'+i+'" name="date_of_birth[]"  class="form-control"/></div><input type="button" class="btnRemove btn-danger" value="Remove"/></div><br>');
		
		});
	
	// Removing event here
  $('body').on('click','.btnRemove',function() {
       $(this).closest('div').remove()
  });
		
</script>
</body>
</html>