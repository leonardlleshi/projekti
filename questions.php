<?php

session_start();
require_once("scripts/connect_db.php");
$arrCount = "";
if(isset($_GET['question'])){
    $question = preg_replace('/[^0-9]/', "", $_GET['question']);
    $output = "";
    $answers = "";
    $q = "";
    $sql = mysqli_query($con,"SELECT id FROM `questions`");
    $numQuestions = mysqli_num_rows($sql);
    if(!isset($_SESSION['answer_array']) || $_SESSION['answer_array'] < 1){
        $currQuestion = "1";
    }else{
        $arrCount = count($_SESSION['answer_array']);
    }
    if($arrCount > $numQuestions){
        unset($_SESSION['answer_array']);
        header("location: index.php");
        exit();
    }
    if($arrCount >= $numQuestions){
        echo '<p>There are no more questions. Please enter your first and last name and click next</p>
				<form action="userAnswers.php" method="post">
				<input type="hidden" name="complete" value="true">
				First name:<input type="text" name="username">
				Last name:<input type="text" name="email">
				<input type="submit" value="Finish">
				</form>';
        exit();
    }
    $singleSQL = mysqli_query($con,"SELECT * FROM `questions` WHERE id='$question'");
    while($row = mysqli_fetch_array($singleSQL,MYSQLI_BOTH)){
        $id = $row['id'];
        $thisQuestion = $row['question'];
        $type = $row['type'];
        $question_id = $row['question_id'];
        $q = '<h2>'.$thisQuestion.'</h2>';
        $sql2 = mysqli_query($con,"SELECT * FROM `answers` WHERE `question_id`='$question' ORDER BY rand()");
        while($row2 = mysqli_fetch_array($sql2,MYSQLI_BOTH)){
            $answer = $row2['answer'];
            $correct = $row2['correct'];
            $answers .= '<label style="cursor:pointer;"><input type="radio" name="rads" value="'.$correct.'">'.$answer.'</label>
				<input type="hidden" id="qid" value="'.$id.'" name="qid"><br /><br />
				';

        }
        $output = ''.$q.','.$answers.',<span id="btnSpan"><button class="btn btn-success" onclick="post_answer()">Submit</button></span>';
        echo $output;
    }
}


?>
<head>
    <meta charset="utf-8">

    <meta charset="utf-8">
    <title>Create A Quiz</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

</body>
