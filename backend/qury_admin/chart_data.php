<?php 
    header('Content-Type: application/json');

    include("../../login/server.php");

    $sqlQuery = "SELECT customer, COUNT(customer) AS count_test FROM notify_repair GROUP BY customer;";
    $result = mysqli_query($conn, $sqlQuery);

    $data = array();
    foreach ($result as $row) {
        $data[] = $row;
    }

    mysqli_close($conn);

    echo json_encode($data,JSON_UNESCAPED_UNICODE);

?>