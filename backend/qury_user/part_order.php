<?php
    include('../../login/server.php');
    if(isset($_POST['submit_part'])){
        for($i=0;$i<count($_POST['slno']);$i++){
                $date_order = $_POST['date_order'][$i];
                $id_repair = $_POST['repair_id'][$i];
                $name_parts = $_POST['name_parts'][$i];
                $num_s = $_POST['num_s'][$i];
                $price_unit = $_POST['price_unit'][$i];
                $username = $_POST['username'][$i];
                if($name_parts!=='' && $num_s!=='' && $price_unit!=='' && $username!=='' && $date_order!=='' && $id_repair!=='' ){
            $sql="INSERT INTO name_parts(name_parts,num_s,price_unit,username,date_order,id_repair)VALUES('$name_parts','$num_s','$price_unit','$username','$date_order','$id_repair')";
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
        }else{}
        ?>