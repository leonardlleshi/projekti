<?php
require_once("scripts/connect_db.php");
session_start();

// A user-defined error handler function
function myErrorHandler($errno, $errstr, $errfile, $errline) {
    echo "<b>Custom error:</b> [$errno] $errstr<br>";
    echo " Error on line $errline in $errfile<br>";
}

// Set user-defined error handler function
set_error_handler("myErrorHandler");




// Trigger error

if($_SERVER["REQUEST_METHOD"] == "POST")
{
// username and password received from loginform
    $username=mysqli_real_escape_string($con,$_POST['username']);
    $password=mysqli_real_escape_string($con,$_POST['password']);
    $sql_query="SELECT id FROM admin WHERE username='$username' and password='$password'";
    $result=mysqli_query($con,$sql_query);
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
    $count=mysqli_num_rows($result);// If result matched $username and $password, table row must be 1 row
    if($count==1)
    {
        $_SESSION['login_user']=$username;

        header("location: index.html");
    }
    else
    {
        trigger_error("A custom error has been triggered");
    }
}
?>


<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <link rel="stylesheet" href="dist/reset.css">
    <link rel="stylesheet" href="dist/style1.css">

</head>
<body>

<div class="containmain">
    <div class="center">
        <div class="profile">

        </div>
        <form class="form" action="" method="post">
            <input type="text" class="topform" placeholder="Username" name="username"><br>
            <input type="password" class="bottomform" placeholder="Password" name="password"><br>
            <input type="submit">
        </form>
    </div>
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="dist/index.js"></script>
</body>
</html>
