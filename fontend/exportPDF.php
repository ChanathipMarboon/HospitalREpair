<?php
if(isset($_GET['print'])){
    $print = $_GET['print'];
    $user = $_GET['user'];
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
include("server.php");
require_once __DIR__ . '/../vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf([
    'default_font_size' => 9,
    'default_font' => 'thniramitas'
]);
$sql_pdf = "SELECT * FROM `notify_repair` where id = $print";
        $result = mysqli_query($conn,$sql_pdf);
        while($row = mysqli_fetch_array($result)){
            $customer = $row['customer'];
            $tools_name = $row['tools_name'];
            $type_work = $row['type_work'];
            $status_repair = $row['status_repair'];
            $day_take =(string)explode("-",$row['day_take'])[2].' '.$month[(int)explode("-",$row['day_take'])[1]].' '.(string)((int)explode("-",$row['day_take'])[0]+543);
            //$day_take = $row['day_take'];
            $username = $row['username'];
            $noid = $row['noid'];
        }
$sql_pd = "SELECT * FROM `user` where username = '$username'";
        $resul = mysqli_query($conn,$sql_pd);
        while($row = mysqli_fetch_array($resul)){
            $user_level = $row['user_level'];
            $firstname_lastname = $row['firstname'] . " " . $row['lastname'];
        }
$sql_pdff = "SELECT * FROM `repair_tools` where noti_repair_id = $print";
        $resultt = mysqli_query($conn,$sql_pdff);
        while($row = mysqli_fetch_array($resultt)){
            $noti_repair_id = $row['noti_repair_id'];
            $date_recive =(string)explode("-",$row['date_recive'])[2].' '.$month[(int)explode("-",$row['date_recive'])[1]].' '.(string)((int)explode("-",$row['date_recive'])[0]+543);
            //$date_recive=explode("-",$row['date_recive'])[2]+'/'+explode("-",$row['date_recive'])[1]+'/'+(int)explode("-",$row['date_recive'])[0]+543;
            $username_e = $row['username_e'];
            $username_check = $row['username_check'];
            $date_check =(string)explode("-",$row['date_check'])[2].' '.$month[(int)explode("-",$row['date_check'])[1]].' '.(string)((int)explode("-",$row['date_check'])[0]+543);
            //$date_check=explode("-",$row['date_check'])[2]+'/'+explode("-",$row['date_check'])[1]+'/'+(int)explode("-",$row['date_check'])[0]+543;
            $comment   = $row['comment'];
            $sta_fix = $row['sta_fix'];
            $date_repair =(string)explode("-",$row['date_repair'])[2].' '.$month[(int)explode("-",$row['date_repair'])[1]].' '.(string)((int)explode("-",$row['date_repair'])[0]+543);
            //$date_repair=explode("-",$row['date_repair'])[2]+'/'+explode("-",$row['date_repair'])[1]+'/'+(int)explode("-",$row['date_repair'])[0]+543;
        }
$sql_part="SELECT * FROM `name_parts` WHERE id_repair = $noti_repair_id";
        $result_part = mysqli_query($conn,$sql_part);
        $array_namepart = ["&nbsp;","&nbsp;","&nbsp;","&nbsp;","&nbsp;","&nbsp;","&nbsp;","&nbsp;"];
        $count = 0;
        while($row = mysqli_fetch_array($result_part)){
            $array_namepart[$count] =$row['name_parts'] . " " . $row['num_s'];
            $count++;
        }
        $l = $array_namepart[0];
        $m = $array_namepart[1];
        $n = $array_namepart[2];
        $o = $array_namepart[3];
        $p = $array_namepart[4];
        $q = $array_namepart[5];
        $r = $array_namepart[6];
        $s = $array_namepart[7];

if($sta_fix=="ซ่อมได้"){
    $check1 = "/";
    $check2 = "&nbsp;";
    $check3 = '&nbsp;';
    $check4 = '&nbsp;';
    $check5 = '/';
    $k ="-";
}else if(($sta_fix=="แทงชำรุด")||($sta_fix=="ส่งเคลม")){
    $check1 = '&nbsp;';
    $check2 = '/';
    $check3 = '&nbsp;';
    $comment = '&nbsp;';
    $check4 = '&nbsp;';
    $check5 = '/';
    $username_check ='&nbsp;';
    $k = $sta_fix;
}else if($sta_fix=="รออะไหล่"){
    $check1 = '&nbsp;';
    $check2 = '&nbsp;';
    $check3 = '/';
    $check4 = '/';
    $check5 = '&nbsp;';
    $k ="&nbsp;";
}else{}
$x = $username_check;










$html = '
<div>
    <h2 style = "color:black;       
        position:absolute;
        padding-top:-14px;padding-left:185px;"
    >'.$user_level.'</h2>

    <h2 style = "color:black;       
        position:absolute;
        padding-top:-18px;padding-left:75px;"
    >'.$noti_repair_id.'</h2>

    <h2 style = "color:black;        
        position:absolute;
        padding-top:-42px;padding-left:180px;"
    >'.$day_take.'</h2>

    <h2 style = "color:black;
        position:absolute;
        padding-top:-55px;padding-left:595px;font-size:13px"
    >'.$type_work.'</h2>

    <h2 style = "color:black;        
        position:absolute;
        padding-top:-1px;padding-left:122px;"
    >'.$type_work.'</h2>

    <h2 style = "color:black;        
        position:absolute;
        padding-top:-50px;padding-left:575px;"
    >'.$noti_repair_id.'</h2>

    <h2 style = "color:black;        
        position:absolute;
        padding-top:-8px;padding-left:210px;"
    >'.$type_work.'</h2>
    
    <h2 style = "color:black;        
        position:absolute;
        padding-top:-50px;padding-left:550px;"
    >'.$day_take.'</h2>

    <h2 style = "color:black;        
        position:absolute;
        padding-top:-8px;padding-left:110px;"
    >'.$user_level.'</h2>

    <h2 style = "color:black;        
        position:absolute;
        padding-top:-16px;padding-left:50px;"
    >'.$tools_name.'</h2>

    <h2 style = "color:black;        
        position:absolute;
        padding-top:-42px;padding-left:410px;"
    >'.$noid.'</h2>

    <h2 style = "color:black;        
        position:absolute;
        padding-top:8px;text-align:center;"
    >'.$firstname_lastname.'</h2>

    <h2 style = "color:black;        
        position:absolute;
        padding-top:-18px;text-align:center;"
    >'.$user_level.'</h2>

    <h2 style = "color:black;        
        position:absolute;
        padding-top:55px;padding-left:15px;"
    >'.$check1.'</h2>

    <h2 style = "color:black;        
        position:absolute;
        padding-top:-19px;padding-left:15px;"
    >'.$check2.'</h2>

    <h2 style = "color:black;        
        position:absolute;
        padding-top:-45px;padding-left:40px;"
    >'.$k.'</h2>

    <h2 style = "color:black;        
        position:absolute;
        padding-top:40px;padding-left:15px;"
    >'.$check3.'</h2>

    <h2 style = "color:black;        
        position:absolute;
        padding-top:-21px;padding-left:36px;"
    >'.$l.' </h2>

    <h2 style = "color:black;        
        position:absolute;
        padding-top:-17px;padding-left:36px;"
    >'.$m.'</h2>

    <h2 style = "color:black;        
        position:absolute;
        padding-top:-15px;padding-left:36px;"
    >'.$n.'</h2>

    <h2 style = "color:black;        
        position:absolute;
        padding-top:-17px;padding-left:36px;"
    >'.$o.'</h2>

    <h2 style = "color:black;        
        position:absolute;
        padding-top:-17px;padding-left:36px;"
    >'.$p.'</h2>

    <h2 style = "color:black;        
        position:absolute;
        padding-top:-16px;padding-left:36px;"
    >'.$q.'</h2>

    <h2 style = "color:black;        
        position:absolute;
        padding-top:-16px;padding-left:36px;"
    >'.$r.'</h2>

    <h2 style = "color:black;        
        position:absolute;
        padding-top:-17px;padding-left:36px;"
    >'.$s.'</h2>

    <h2 style = "color:black;        
        position:absolute;
        padding-top:-17px;padding-left:108px;"
    >'.$username_e.'</h2>



    <h2 style = "color:black;        
        position:absolute;
        padding-top:35px;padding-left:20px;"
    >'.$comment.'</h2>

    <h2 style = "color:black;        
        position:absolute;
        padding-top:35px;padding-left:110px;"
    >'.$x.'</h2>

    <h2 style = "color:black;        
        position:absolute;
        padding-top:-13px;padding-left:110px;"
    >'.$username_check.'</h2>

    <h2 style = "color:green;        
        position:absolute;
        padding-top:-90px;padding-left:395px;"
    >'.$check4.'</h2>

    <h2 style = "color:black;        
        position:absolute;
        padding-top:-16px;padding-left:395px;"
    >'.$check5.'</h2>

    <h2 style = "color:black;        
        position:absolute;
        padding-top:-4px;padding-left:480px;"
    >'.$firstname_lastname.'</h2>

    <h2 style = "color:black;        
        position:absolute;
        padding-top:-11px;padding-left:500px;"
    >'.$date_check.'</h2>



</div>';


$pagecount = $mpdf->setSourceFile('../plugins/images/repair_notice.pdf');
$tplIdx = $mpdf->importPage($pagecount);
$mpdf->useTemplate($tplIdx);

//$mpdf->SetDocTemplate('repair_notice.pdf',true);

$mpdf->WriteHTML($html);
$mpdf->Output();
