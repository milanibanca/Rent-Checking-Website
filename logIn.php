<?php
include('db_conn.php');
    $username = $_POST['user_email'];
    $password = $_POST['user_password'];

    $sql = "select * from admin where email = '$username' and password = '$password'";  
    $result = mysqli_query($con, $sql);  
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    $count = mysqli_num_rows($result); 
    mysqli_free_result($result);

    if($count == 1)
    {
        echo "<script>alert('Check in successful');
        window.location.href='admin.html';</script>";
        
    }
    else
    {
        echo "<script>alert('Check in unsuccessful please enter correct username and password');
                window.location.href='index.html';</script>";
    }
?>