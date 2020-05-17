
<?php


if(isset($_POST['desc'])){
  if(!isset($_POST['iscorrect']) || $_POST['iscorrect'] == ""){
    echo "Sorry, important data to submit your question is missing. Please press back in your browser and try again and make sure you select a correct answer for the question.";
    exit();
  }
  if(!isset($_POST['type']) || $_POST['type'] == ""){
    echo "Sorry, there was an error parsing the form. Please press back in your browser and try again";
    exit();
  }
  require_once("scripts/connect_db.php");
  $question = $_POST['desc'];
  $answer1 = $_POST['answer1'];
  $answer2 = $_POST['answer2'];
  $answer3 = $_POST['answer3'];
  $answer4 = $_POST['answer4'];
  $type = $_POST['type'];
  $type = preg_replace('/[^a-z]/', "", $type);
  $isCorrect = preg_replace('/[^0-9a-z]/', "", $_POST['iscorrect']);
  $answer1 = strip_tags($answer1);
  $answer1 = mysqli_real_escape_string($con,$answer1);
  $answer2 = strip_tags($answer2);
  $answer2 = mysqli_real_escape_string($con,$answer2);
  $answer3 = strip_tags($answer3);
  $answer3 = mysqli_real_escape_string($con,$answer3);
  $answer4 = strip_tags($answer4);
  $answer4 = mysqli_real_escape_string($con,$answer4);
  $question = strip_tags($question);
  $question = mysqli_real_escape_string($con,$question);

  if($type == 'tf'){
    if((!$question) || (!$answer1) || (!$answer2) || (!$isCorrect)){
      echo "Sorry, All fields must be filled in to add a new question to the quiz. Please press back in your browser and try again.";
      exit();
    }
  }
  if($type == 'mc'){
    if((!$question) || (!$answer1) || (!$answer2) || (!$answer3) || (!$answer4) || (!$isCorrect)){
      echo "Sorry, All fields must be filled in to add a new question to the quiz. Please press back in your browser and try again.";
      exit();
    }
  }

  $sql = mysqli_query($con,"INSERT INTO `questions` (`question`,`type`) VALUES ('$question','$type')")or die(mysqli_error($con));
  $lastId = mysqli_insert_id($con);
  mysqli_query($con,"UPDATE `questions` SET `question_id`='$lastId' WHERE id='$lastId'")or die(mysqli_error($con));

  if($type == 'tf'){
    if($isCorrect == "answer1"){
      $sql2 = mysqli_query($con,"INSERT INTO `answers` (`question_id`, `answer`, `correct`) VALUES ($lastId, '$answer1','1')")or die(mysqli_error($con));
      mysqli_query($con,"INSERT INTO `answers` (`question_id`, `answer`, `correct`) VALUES ('$lastId', '$answer2', '0')")or die(mysqli_error($con));
      $msg = 'Thanks, your question has been added';
      header('location: addQuestions.php?msg='.$msg.'');
      exit();
    }
    if($isCorrect == "answer2"){
      $sql2 = mysqli_query($con,"INSERT INTO `answers` (`question_id`, `answer`, `correct`) VALUES ('$lastId', '$answer2', '1')")or die(mysqli_error($con));
      mysqli_query($con,"INSERT INTO `answers` (`question_id`, `answer`, `correct`) VALUES ('$lastId', '$answer1', '0')")or die(mysqli_error($con));
      $msg = 'Thanks, your question has been added';
      header('location: addQuestions.php?msg='.$msg.'');
      exit();
    }
  }
  if($type == 'mc'){
    if($isCorrect == "answer1"){
      $sql2 = mysqli_query($con,"INSERT INTO `answers` (`question_id`, `answer`, `correct`) VALUES ('$lastId', '$answer1', '1')")or die(mysqli_error($con));
      mysqli_query($con,"INSERT INTO `answers` (`question_id`, `answer`, `correct`) VALUES ('$lastId', '$answer2', '0')")or die(mysqli_error($con));
      mysqli_query($con,"INSERT INTO answers (`question_id`, `answer`, `correct`) VALUES ('$lastId', '$answer3', '0')")or die(mysqli_error($con));
      mysqli_query($con,"INSERT INTO answers (`question_id`, `answer`, `correct`) VALUES ('$lastId', '$answer4', '0')")or die(mysqli_error($con));
      $msg = 'Thanks, your question has been added';
      header('location: addQuestions.php?msg='.$msg.'');
      exit();
    }
    if($isCorrect == "answer2"){
      $sql2 = mysqli_query($con,"INSERT INTO `answers` (`question_id`, `answer`, `correct`) VALUES ('$lastId', '$answer2', '1')")or die(mysqli_error($con));
      mysqli_query($con,"INSERT INTO answers (`question_id`, `answer`, `correct`) VALUES ('$lastId', '$answer1', '0')")or die(mysqli_error($con));
      mysqli_query($con,"INSERT INTO answers (`question_id`, `answer`, `correct`) VALUES ('$lastId', '$answer3', '0')")or die(mysqli_error($con));
      mysqli_query($con,"INSERT INTO answers (`question_id`, `answer`, `correct`) VALUES ('$lastId', '$answer4', '0')")or die(mysqli_error($con));
      $msg = 'Thanks, your question has been added';
      header('location: addQuestions.php?msg='.$msg.'');
      exit();
    }
    if($isCorrect == "answer3"){
      $sql2 = mysqli_query($con,"INSERT INTO `answers` (`question_id`, `answer`, `correct`) VALUES ('$lastId', '$answer3', '1')")or die(mysqli_error($con));
      mysqli_query($con,"INSERT INTO answers (`question_id`, `answer`, `correct`) VALUES ('$lastId', '$answer1', '0')")or die(mysqli_error($con));
      mysqli_query($con,"INSERT INTO answers (`question_id`, `answer`, `correct`) VALUES ('$lastId', '$answer2', '0')")or die(mysqli_error($con));
      mysqli_query($con,"INSERT INTO answers (`question_id`, `answer`, `correct`) VALUES ('$lastId', '$answer4', '0')")or die(mysqli_error($con));
      $msg = 'Thanks, your question has been added';
      header('location: addQuestions.php?msg='.$msg.'');
      exit();
    }
    if($isCorrect == "answer4"){
      $sql2 = mysqli_query($con,"INSERT INTO `answers` (`question_id`, `answer`, `correct`) VALUES ('$lastId', '$answer4', '1')")or die(mysqli_error());
      mysqli_query($con,"INSERT INTO `answers` (`question_id`, `answer`, `correct`) VALUES ('$lastId', '$answer1', '0')")or die(mysqli_error());
      mysqli_query($con,"INSERT INTO `answers` (`question_id`, `answer`, `correct`) VALUES ('$lastId', '$answer2', '0')")or die(mysqli_error());
      mysqli_query($con,"INSERT INTO `answers` (`question_id`, `answer`, `correct`) VALUES ('$lastId', '$answer3', '0')")or die(mysqli_error());
      $msg = 'Thanks, your question has been added';
      header('location: addQuestions.php?msg='.$msg.'');
      exit();
    }
  }
}
?>
<?php
$msg = "";
if(isset($_GET['msg'])){
  $msg = $_GET['msg'];
}
?>
<?php
if(isset($_POST['reset']) && $_POST['reset'] != ""){
  $reset = preg_replace('/^[a-z]/', "", $_POST['reset']);
  require_once("scripts/connect_db.php");
  mysqli_query($con,"TRUNCATE TABLE questions")or die(mysqli_error());
  mysqli_query($con,"TRUNCATE TABLE answers")or die(mysqli_error());
  $sql1 = mysqli_query($con,"SELECT id FROM `questions` ")or die(mysqli_error($con));
  $sql2 = mysqli_query($con,"SELECT id FROM `answers` ")or die(mysqli_error($con));
  $numQuestions = mysqli_num_rows($sql1);
  $numAnswers = mysqli_num_rows($sql2);
  if($numQuestions > 0 || $numAnswers > 0){
    echo "<div class=\"alert alert-danger\"There was a problem reseting the quiz.</div>";
    exit();
  }else{
    echo "<div class=\"alert alert-success\"> The quiz has now been reset.</div>";
    exit();
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard">

  <title>Add questions</title>

  <!-- Bootstrap core CSS -->
  <link href="assets/css/bootstrap.css" rel="stylesheet">
  <!--external css-->
  <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-datepicker/css/datepicker.css" />
  <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-daterangepicker/daterangepicker.css" />

  <!-- Custom styles for this template -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/style-responsive.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body>

<section id="container" >

  <!--header start-->
  <header class="header black-bg">
    <div class="sidebar-toggle-box">
      <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
    </div>
    <!--logo start-->
    <a href="index.html" class="logo"><b>Admin</b></a>
    <!--logo end-->
    <div class="nav notify-row" id="top_menu">
      <!--  notification start -->

      <!--  notification end -->
    </div>
    <div class="top-menu">
      <ul class="nav pull-right top-menu">
        <li><a class="logout" href="admin.php">Logout</a></li>
      </ul>
    </div>
  </header>
  <aside>
    <div id="sidebar"  class="nav-collapse ">
      <!-- sidebar menu start-->
      <ul class="sidebar-menu" id="nav-accordion">



        <li class="mt">
          <a href="addQuestions.php">
            <i class="fa fa-book"></i>
            <span>AddQuestions</span>
          </a>
        </li>

        <li class="mt">
          <a href="showQuestions.php">
            <i class="fa fa-table"></i>
            <span>ShowQuestions</span>
          </a>
        </li>
        <li class="mt">
          <a href="index.php">
            <i class="fa fa-question-circle"></i>
            <span>Quiz</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
  <!--header end-->

 
 
  <!--main content start-->
  <section id="main-content">
    <section class="wrapper">
      <h3></h3>

      <!-- BASIC FORM ELELEMNTS -->
      <div class="row mt">
        <div class="col-lg-12">
          <div class="form-panel">
            <h4 class="mb">Add questions</h4>
            <p style="color:#06F;"><?php echo $msg; ?></p>
            <h2>What type of question would you like to create?</h2>
            <button onClick="showDiv('tf', 'mc')" class="btn btn-theme">True/False</button>&nbsp;&nbsp;<button onClick="showDiv('mc', 'tf')" class="btn btn-theme03">Multiple Choice</button>&nbsp;&nbsp;
            <span id="resetBtn" ><button onclick="resetQuiz()" class="btn btn-theme04">Reset quiz to zero</button></span>

            <div class="content" id="tf">
              <h3>True or false</h3>
              <form class="form-group"action="addQuestions.php" name="addQuestion" method="post">
                <strong>Please type your new question here</strong>
                <br />
                <textarea id="tfDesc" name="desc" style="width:400px;height:95px;"></textarea>
                <br />
                <br />
                <strong>Please select whether true or false is the correct answer</strong>
                <br />
                <input type="text" id="answer1" name="answer1" value="True" readonly>&nbsp;
                <label style="cursor:pointer; color:#06F;">
                  <input type="radio" name="iscorrect" value="answer1">Correct Answer?</label>
                <br />
                <br />
                <input type="text" id="answer2" name="answer2" value="False" readonly>&nbsp;
                <label style="cursor:pointer; color:#06F;">
                  <input type="radio" name="iscorrect" value="answer2">Correct Answer?
                </label>
                <br />
                <br />
                <input type="hidden" value="tf" name="type">
                <input type="submit" onclick="refresh()"class="btn btn-theme02" value="Add To Quiz">
              </form>
            </div>
            <div class="content" id="mc">
              <h3>Multiple Choice</h3>
              <form class="form-group" action="addQuestions.php" name="addMcQuestion" method="post">
                <strong>Please type your new question here</strong>
                <br />
                <textarea id="mcdesc" name="desc" style="width:400px;height:95px;"></textarea>
                <br />
                <br />
                <strong>Please create the first answer for the question</strong>
                <br />
                <input type="text" id="mcanswer1" name="answer1">&nbsp;
                <label style="cursor:pointer; color:#06F;">
                  <input type="radio" name="iscorrect" value="answer1">Correct Answer?
                </label>
                <br />
                <br />
                <strong>Please create the second answer for the question</strong>
                <br />
                <input type="text" id="mcanswer2" name="answer2">&nbsp;
                <label style="cursor:pointer; color:#06F;">
                  <input type="radio" name="iscorrect" value="answer2">Correct Answer?
                </label>
                <br />
                <br />
                <strong>Please create the third answer for the question</strong>
                <br />
                <input type="text" id="mcanswer3" name="answer3">&nbsp;
                <label style="cursor:pointer; color:#06F;">
                  <input type="radio" name="iscorrect" value="answer3">Correct Answer?
                </label>
                <br />
                <br />
                <strong>Please create the fourth answer for the question</strong>
                <br />
                <input type="text" id="mcanswer4" name="answer4">&nbsp;
                <label style="cursor:pointer; color:#06F;">
                  <input type="radio" name="iscorrect" value="answer4">Correct Answer?
                </label>
                <br />
                <br />
                <input type="hidden" value="mc" name="type">
                <input type="submit" onclick="refresh()" class="btn btn-theme02" value="Add To Quiz">
              </form>
            </div>
          </div>
        </div><!-- col-lg-12-->
      </div><!-- /row -->



    </section><! --/wrapper -->
  </section><!-- /MAIN CONTENT -->

  <!--main content end-->
  <!--footer start-->
  <footer class="site-footer">
    <div class="text-center">

      <a href="form_component.html#" class="go-top">
        <i class="fa fa-angle-up"></i>
      </a>
    </div>
  </footer>
  <!--footer end-->
</section>

<!-- js placed at the end of the document so the pages load faster -->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="assets/js/jquery.scrollTo.min.js"></script>
<script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


<!--common script for all pages-->
<script src="assets/js/common-scripts.js"></script>

<!--script for this page-->
<script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>

<!--custom switch-->
<script src="assets/js/bootstrap-switch.js"></script>

<!--custom tagsinput-->
<script src="assets/js/jquery.tagsinput.js"></script>

<!--custom checkbox & radio-->

<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-daterangepicker/date.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-daterangepicker/daterangepicker.js"></script>

<script type="text/javascript" src="assets/js/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>


<script src="assets/js/form-component.js"></script>


<script>
  //custom select box

  $(function(){
    $('select.styled').customSelect();
  });

</script>
<script>
  function showDiv(el1,el2){
    document.getElementById(el1).style.display = 'block';
    document.getElementById(el2).style.display = 'none';
  }
</script>

<script>
  function resetQuiz(){
    var x = new XMLHttpRequest();
    var url = "addQuestions.php";
    var vars = 'reset=yes';
    x.open("POST", url, true);
    x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    x.onreadystatechange = function() {
      if(x.readyState == 4 && x.status == 200) {
        document.getElementById("resetBtn").innerHTML = x.responseText;

      }
    }
    x.send(vars);
    document.getElementById("resetBtn").innerHTML = "processing...";

  }
</script>
</body>
</html>
