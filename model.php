<?php
    include('db_conn.php')

function get_this_months_outstanding_rent() {
    $query = "CALL uspCurrentMonth();";
    //Get a connection
    $pdo_conn = $conn;
    //Prepare query for execution
    $statement = $pdo_conn->prepare($query);
    //Execute query
    $statement->execute();
    $result = $statement->fetchall($fetchStyle);
}
?>