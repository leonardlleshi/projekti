
<?php


session_start();
if(isset($_GET['question'])){
    $question = preg_replace('/[^0-9]/', "", $_GET['question']);
    $next = $question + 1;
    $prev = $question - 1;
    if(!isset($_SESSION['qid_array']) && $question != 1){
        $msg = " No cheating.";
        header("location: index.php?msg=$msg");
        exit();
    }
    if(isset($_SESSION['qid_array']) && in_array($question, $_SESSION['qid_array'])){
        $msg = " Cheating is not allowed.";
        unset($_SESSION['answer_array']);
        unset($_SESSION['qid_array']);
        session_destroy();
        header("location: index.php?msg=$msg");
        exit();
    }
    if(isset($_SESSION['lastQuestion']) && $_SESSION['lastQuestion'] != $prev){
        $msg = "Cheating is not allowed.";
        unset($_SESSION['answer_array']);
        unset($_SESSION['qid_array']);
        session_destroy();
        header("location: index.php?msg=$msg");
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
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title></title>


    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
    <script src="dist/sweetalert.min.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <![endif]-->
    <script type="text/javascript">
        function countDown(secs,elem) {
            var element = document.getElementById(elem);
            element.innerHTML = "You have "+secs+" seconds remaining.";
            if(secs < 1) {
                var xhr = new XMLHttpRequest();
                var url = "userAnswers.php";
                var vars = "radio=0"+"&qid="+<?php echo $question; ?>;
                xhr.open("POST", url, true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if(xhr.readyState == 4 && xhr.status == 200) {
                        swal("You did not answer the question in the allowed time. It will be marked as incorrect.");
                        clearTimeout(timer);
                    }
                }
                xhr.send(vars);
                document.getElementById('counter_status').innerHTML = "";
                document.getElementById('btnSpan').innerHTML = '<h2>Times Up!</h2>';
                document.getElementById('btnSpan').innerHTML += '<a href="quiz.php?question=<?php echo $next; ?>">Click here now</a>';

            }
            secs--;
            var timer = setTimeout('countDown('+secs+',"'+elem+'")',1000);
        }
    </script>
    <script>
        function getQuestion(){
            var hr = new XMLHttpRequest();
            hr.onreadystatechange = function(){
                if (hr.readyState==4 && hr.status==200){
                    var response = hr.responseText.split("|");
                    if(response[0] == "finished"){
                        document.getElementById('status').innerHTML = response[1];
                    }
                    var nums = hr.responseText.split(",");
                    document.getElementById('question').innerHTML = nums[0];
                    document.getElementById('answers').innerHTML = nums[1];
                    document.getElementById('answers').innerHTML += nums[2];
                }
            }
            hr.open("GET", "questions.php?question=" + <?php echo $question; ?>, true);
            hr.send();
        }
        function x() {
            var rads = document.getElementsByName("rads");
            for ( var i = 0; i < rads.length; i++ ) {
                if ( rads[i].checked ){
                    var val = rads[i].value;
                    return val;
                }
            }
        }
        function post_answer(){
            var p = new XMLHttpRequest();
            var id = document.getElementById('qid').value;
            var url = "userAnswers.php";
            var vars = "qid="+id+"&radio="+x();
            p.open("POST", url, true);
            p.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            p.onreadystatechange = function() {
                if(p.readyState == 4 && p.status == 200) {
                    document.getElementById("status").innerHTML = '';
                    swal("Thanks, Your answer was submitted");
                    var url = 'quiz.php?question=<?php echo $next; ?>';
                    window.location = url;
                }
            }
            p.send(vars);
            document.getElementById("status").innerHTML = "processing...";

        }
    </script>
   
</head>

<body onLoad="getQuestion()">

<section id="container" >

    <header class="header black-bg">
        <div class="sidebar-toggle-box">

        </div>

        <a href="index.html" class="logo"><b></b></a>

        <div class="nav notify-row" id="top_menu">

            <ul class="nav top-menu">

            </ul>

        </div>
        <div class="top-menu">

        </div>
    </header>

    <section id="main-content">
        <section class="wrapper site-min-height">
            <h3></h3>
            <div class="row mt">
                <div class="col-lg-12">
                    <h3>PHP Quiz</h3>
                    <br><br>
                    <div id="status" style="border: 1px; border-style: solid;background-color:whitesmoke; padding-left: 30px; padding-top: 10px; padding-bottom: 10px; ">
                        <div id="counter_status" ></div>
                        <div id="question"></div>
                        <div id="answers"></div>
                        <div id="status">
                            <div id="counter_status"></div>
                            <div id="question"></div>
                            <div id="answers"></div>

                        </div>
                        <script type="text/javascript">countDown(20,"counter_status");</script>
                    </div>
                </div>
            </div>

        </section><! --/wrapper -->
    </section>
    <footer class="site-footer">
        <div class="text-center">

            <a href="quiz.php#" class="go-top">

            </a>
        </div>
    </footer>
    <!--footer end-->
</section>

<!-- js placed at the end of the document so the pages load faster -->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
<script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="assets/js/jquery.scrollTo.min.js"></script>
<script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


<!--common script for all pages-->
<script src="assets/js/common-scripts.js"></script>

<!--script for this page-->

<script>
    //custom select box

    $(function(){
        $('select.styled').customSelect();
    });

</script>

</body>
</html>
