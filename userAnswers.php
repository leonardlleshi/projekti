<?php
/**
 * Created by PhpStorm.
 * User: Leonard
 * Date: 5/5/2020
 * Time: 2:36 PM
 */

session_start();
if(isset($_POST['radio']) && $_POST['radio'] != ""){
    $answer = preg_replace('/[^0-9]/', "", $_POST['radio']);
    if(!isset($_SESSION['answer_array']) || count($_SESSION['answer_array']) < 1){
        $_SESSION['answer_array'] = array($answer);
    }else{
        array_push($_SESSION['answer_array'], $answer);
    }

}
if(isset($_POST['qid']) && $_POST['qid'] != ""){
    $qid = preg_replace('/[^0-9]/', "", $_POST['qid']);
    if(!isset($_SESSION['qid_array']) || count($_SESSION['qid_array']) < 1){
        $_SESSION['qid_array'] = array($qid);
    }else{
        array_push($_SESSION['qid_array'], $qid);
    }
    $_SESSION['lastQuestion'] = $qid;
}
?>



<html>
<head>
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">

    <style>
        body{
            background-color: whitesmoke;
        }
.btn1{
        margin-left: 268px;
        margin-top: 97px;
        padding: 14px;
        width: 139px;
       background-color: #ed5565;
}
.btn2{
        margin-left: 268px;
        margin-top: 97px;
        padding: 14px;
        width: 139px;
       background-color: #48cfad;
}
    </style>
</head>
    <body>
    <?php
    require_once("scripts/connect_db.php");
    $response = "";
    if(!isset($_SESSION['answer_array']) || count($_SESSION['answer_array']) < 1){
        $response = "You have not answered any questions yet";
        echo "<div style='background-color: #0066FF'>$response";
        exit();
    }else{
        $countCheck = mysqli_query($con,"SELECT id FROM questions")or die(mysqli_error());
        $count = mysqli_num_rows($countCheck);
        $numCorrect = 0;
        foreach($_SESSION['answer_array'] as $current){
            if($current == 1){
                $numCorrect++;
            }
        }
        $percent = $numCorrect / $count * 100;
        $percent = intval($percent);
        if(isset($_POST['complete']) && $_POST['complete'] == "true"){
            if(!isset($_POST['username']) || $_POST['username'] == ""){
                echo "Sorry, We had an error";
                exit();
            }
            $username = $_POST['username'];
            $username = mysqli_real_escape_string($con,$username);
            $username = strip_tags($username);
            if(!in_array("1", $_SESSION['answer_array'])){
                $sql = mysqli_query($con,"INSERT INTO quiz_takers (username, percentage, date_time)
		VALUES ('$username', '0', now())")or die(mysqli_error($con));

                echo "<div style='background-color: #ffd777; margin-top: 12%; margin-left: 1%; height: 170px;'> You scored $percent%<br>	<button type=\"button\" class=\"btn1\" id=\"myButton\" onclick=\"document.location.href='index.php'\">Start again</button><button type=\"button\" class=\"btn2\" id=\"myButton2\" onclick=\"document.location.href='forma.php'\">Contact Us</button></div>";
                unset($_SESSION['answer_array']);
                unset($_SESSION['qid_array']);
                session_destroy();
                exit();
            }
            $sql = mysqli_query($con,"INSERT INTO quiz_takers (username, percentage, date_time)
	VALUES ('$username', '$percent', now())")or die(mysqli_error($con));
            echo "<div style='background-color: #ffd777; margin-top: 12%; margin-left: 1%; height: 170px;'>Thanks for taking the quiz! You scored $percent%.<br>	<button type=\"button\" class=\"btn1\" id=\"myButton\" onclick=\"document.location.href='index.php'\">Start again</button><button type=\"button\" class=\"btn2\" id=\"myButton2\" onclick=\"document.location.href='forma.php'\">Contact Us</button></div>";
            unset($_SESSION['answer_array']);
            unset($_SESSION['qid_array']);
            session_destroy();
            exit();
        }
    }
    ?>


    <script type="text/javascript">
        document.getElementById("myButton").onclick = myfunction () {
            location.href = "index.php";
        }
    </script>
   <script type="text/javascript">
        document.getElementById("myButton2").onclick = myfunctionM () {
            location.href = "forma.php";
        }
    </script>
</body>
</html>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           