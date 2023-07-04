
<?php
include('../menu.php');
include('../server.php');
$sql_u = "SELECT customer AS label, COUNT(customer) AS y FROM notify_repair GROUP BY customer;";
$test = mysqli_query($conn,$sql_u);
$data = array();

$sql_noti="SELECT type_work AS label,count(type_work) as y from notify_repair group by type_work;";
$noti = mysqli_query($conn,$sql_noti);
$data_noti = array();

$sql_sum="SELECT edit_fixx AS label,count(edit_fixx) as y  from repair_tools WHERE `edit_fixx` != '' group by edit_fixx;";
$data_result = mysqli_query($conn,$sql_sum);
$result_data = array();

$sql_noti_user="SELECT tools_name AS label,count(tools_name) as y,type_work from notify_repair where type_work = 'ศูนย์คอมพิวเตอร์' group by tools_name ";
$noti_user = mysqli_query($conn,$sql_noti_user);
$data_noti_user = array();

$sql_noti_user1="SELECT tools_name AS label,count(tools_name) as y,type_work from notify_repair where type_work = 'ศูนย์ซ่อมบำรุง' group by tools_name ";
$noti_user1 = mysqli_query($conn,$sql_noti_user1);
$data_noti_user1 = array();

$sql_noti_user2="SELECT tools_name AS label,count(tools_name) as y,type_work from notify_repair where type_work = 'ศูนย์เครื่องมือแพทย์ฯ' group by tools_name ";
$noti_user2 = mysqli_query($conn,$sql_noti_user2);
$data_noti_user2 = array();



foreach ($test as $row) {
    $text = "" ;
    if($row['label'] == ""){
        $text = " " ;
    }else{
        $text = $row['label'] ;
    }
    array_push($data,array(
        "label"=> $text, 
        "y"=> (int)$row['y']
    ));
}

foreach ($noti as $row) {
    $text = "" ;
    if($row['label'] == ""){
        $text = " " ;
    }else{
        $text = $row['label'] ;
    }
    array_push($data_noti,array(
        "label"=> $text, 
        "y"=> (int)$row['y']
    ));
}

foreach ($data_result as $row) {
    $text = "" ;
    if($row['label'] == ""){
        $text = " " ;
    }else{
        $text = $row['label'] ;
    }
    array_push($result_data,array(
        "label"=> $text, 
        "y"=> (int)$row['y']
    ));
}



// ------------------แสดงข้อมูลจำนวนการแจ้งซ่อมอุปกรณ์-------------------- ///
foreach ($noti_user as $row) {
    $text = "" ;
    if($row['label'] == ""){
        $text = " " ;
    }else{
        $text = $row['label'] ;
    }
    array_push($data_noti_user,array(
        "label"=> $text, 
        "y"=> (int)$row['y']
    ));
}
foreach ($noti_user1 as $row) {
    $text = "" ;
    if($row['label'] == ""){
        $text = " " ;
    }else{
        $text = $row['label'] ;
    }
    array_push($data_noti_user1,array(
        "label"=> $text, 
        "y"=> (int)$row['y']
    ));
}
foreach ($noti_user2 as $row) {
    $text = "" ;
    if($row['label'] == ""){
        $text = " " ;
    }else{
        $text = $row['label'] ;
    }
    array_push($data_noti_user2,array(
        "label"=> $text, 
        "y"=> (int)$row['y']
    ));
}
//------------------------------------------------------//

//ข้อมูลจากสถิติของการเข้าใช้งานการแจ้งซ่อมของแต่ละแผนกในโรงพยาบาลพะเยา//


// echo "<br>";
// print_r($dataPoints) ;
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../plugins/css/bootstrap.min.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <link rel="stylesheet" href="../../plugins/style.css">
        <!-- Boxicons CDN Link -->
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        
        <title>Chart data</title>
<script>

window.onload = function () {
var chart = new CanvasJS.Chart("chartContainer", {

	animationEnabled: true,
	exportEnabled: true,
    backgroundColor: "white",
	title:{
		text: "ค่าเฉลี่ยการแจ้งซ่อมในแต่ละหน่วยงานต่างๆ"
	},
	subtitles: [{
		text: "เปอร์เซ็นการแจ้งซ่อมแต่ละหน่วยงาน"
	}],
    
	data: [{
        
		type: "pie",
		showInLegend: "true",
		legendText: "{label}.",
		indexLabelFontSize: 16,
		indexLabel: "{label} - #percent%",
		yValueFormatString: "#,##0",
		dataPoints: <?php echo json_encode($data, JSON_UNESCAPED_UNICODE); ?>
	}]
});
chart.render();


var chart = new CanvasJS.Chart("chartContainer2", {
animationEnabled: true,
exportEnabled: true,
backgroundColor: "white",
title:{
    text: "ค่าเฉลี่ยการแจ้งซ่อมในแต่ละศูนย์ซ่อม"
},
subtitles: [{
    text: "เปอร์เซ็นการแจ้งซ่อมแต่ละแผนกศูนย์ซ่อม"
}],

data: [{
    type: "pie",
    showInLegend: "true",
    legendText: "{label}.",
    indexLabelFontSize: 16,
    indexLabel: "{label} - #percent%",
    yValueFormatString: "#,##0 ครั้ง",
    dataPoints: <?php echo json_encode($data_noti, JSON_UNESCAPED_UNICODE); ?>
}]
});
chart.render();

var chart = new CanvasJS.Chart("chartContainer4", {
animationEnabled: true,
exportEnabled: true,
backgroundColor: "white",
title:{
    text: "ค่าเฉลี่ยซ่อมสำเร็จและแทงชำรุด"
},
subtitles: [{
    text: "เปอร์เซ็นสถานะการซ่อมของศูนย์ซ่อม"
}],

data: [{
    type: "pie",
    showInLegend: "true",
    legendText: "{label}.",
    indexLabelFontSize: 16,
    indexLabel: "{label} - #percent%",
    yValueFormatString: "#,##0 ครั้ง",
    dataPoints: <?php echo json_encode($result_data, JSON_UNESCAPED_UNICODE); ?>
}]
});
chart.render();



//ศูนย์คอมพิวเตอร์
var chart = new CanvasJS.Chart("chartContainer1", {
     animationEnabled: true,
     exportEnabled: true,
     backgroundColor: "white",
     theme: "light1", // "light1", "light2", "dark1", "dark2"
     title:{
         text: "จำนวนการแจ้งซ่อมอุปกรณ์ของแต่ล่ะศูนย์ซ่อม",
         
     },
     axisY:{
         includeZero: true
     },
     subtitles: [{
		text: "ศูนย์คอมพิวเตอร์"
	}],
     data: [{
         type: "column", //change type to bar, line, area, pie, etc
         //indexLabel: "{y}", //Shows y value on all Data Points
         indexLabelFontColor: "#5A57",
         indexLabelPlacement: "outside",
         dataPoints: <?php echo json_encode($data_noti_user, JSON_UNESCAPED_UNICODE); ?>
     }]
 });
 chart.render();

//ศูนย์ซ่อมบำรุง
chart.render();
var chart = new CanvasJS.Chart("chartContainer1.2", {
     animationEnabled: true,
     exportEnabled: true,
     backgroundColor: "white",
     theme: "light1", // "light1", "light2", "dark1", "dark2"
     title:{
         text: "จำนวนการแจ้งซ่อมอุปกรณ์ของแต่ล่ะศูนย์ซ่อม"
     },
     axisY:{
         includeZero: true
     },
     subtitles: [{
		text: "ศูนย์ซ่อมบำรุง"
	}],
     data: [{
         type: "column", //change type to bar, line, area, pie, etc
         //indexLabel: "{y}", //Shows y value on all Data Points
         indexLabelFontColor: "#5A57",
         indexLabelPlacement: "outside",
         dataPoints: <?php echo json_encode($data_noti_user1, JSON_UNESCAPED_UNICODE); ?>
     }]
 });
 chart.render();

//ศูนย์เครื่องมือแพทย์ฯ
chart.render();
var chart = new CanvasJS.Chart("chartContainer1.3", {
     animationEnabled: true,
     exportEnabled: true,
     backgroundColor: "white",
     theme: "light1", // "light1", "light2", "dark1", "dark2"
     title:{
         text: "จำนวนการแจ้งซ่อมอุปกรณ์ของแต่ล่ะศูนย์ซ่อม"
     },
     axisY:{
         includeZero: true
     },
     subtitles: [{
		text: "ศูนย์เครื่องมือแพทย์ฯ"
	}],
     data: [{
         type: "column", //change type to bar, line, area, pie, etc
         //indexLabel: "{y}", //Shows y value on all Data Points
         indexLabelFontColor: "#5A57",
         indexLabelPlacement: "outside",
         dataPoints: <?php echo json_encode($data_noti_user2, JSON_UNESCAPED_UNICODE); ?>
     }]
 });
 chart.render();
}





</script>
</head>
<body>
    <section class="home-section">
    <div style ="background-color:#81559d;box-shadow: 5px 5px #4a4a4a;">
            <div class="text" style="color:white;"> สถิติการแจ้งซ่อมอุปกรณ์</div>
        </div>ิ<br><br><br><br>
       

    <div classs = "reportPage">

        <div id="chartContainer" 
            style="height: 400px; width: 50% ;
            margin-left:25%;"
        ></div><br>

        <div id="chartContainer2" 
            style="height: 400px; width: 50%;
            margin-left:25%;">
        </div><br>

        <div id="chartContainer4" 
            style="height: 400px; width: 50%;
            margin-left:25%;">
        </div><br>

       
       

ิ<br><br><br><br>
<div style ="background-color:#81559d;box-shadow: 5px 5px #4a4a4a;">
            <div class="text" style="color:white;"> แจ้งศูนย์ซ่อมโรงพยาบาลพะเยา</div>
        </div><br><br><br><br>
        <div id="chartContainer1" 
            style="height: 400px; width: 50%;
            margin-left:25%;"
        ></div><br>

        <div id="chartContainer1.2" 
            style="height: 400px; width: 50%;
            margin-left:25%;"
        ></div><br>

        <div id="chartContainer1.3" 
            style="height: 400px; width: 50%;
            margin-left:25%;"
        ></div><br>
    </div>

    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


</section>
    
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