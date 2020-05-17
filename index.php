<?php


$msg = "";
if(isset($_GET['msg'])){
    $msg = $_GET['msg'];
    $msg = strip_tags($msg);
    $msg = addslashes($msg);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboar">

    <title>Quiz</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        function startQuiz(url){
            window.location = url;
        }
    </script>
</head>
<style>
        hr {
            display: block;
            margin-top: 0.5em;
            margin-bottom: 0.5em;
            margin-left: auto;
            margin-right: auto;
            border-style: inset;
            border-width: 1px;
        }
    </style>

<body>

<section id="container" >

    <header class="header black-bg">


    </header>

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper site-min-height">
            <h3><b>PHP Quiz</b> </h3>
            <br><br>
            <p><hr>
            You can test your PHP skills with our quiz.</p><hr>
            <br>
            <br>
            <h3>The Test</h3>
            <p>The test contains 25 questions and there is  time limit.It's  a nice way to see how much you know, or don't know, about PHP.</p>
            <br><br>
            <h3>Count Your Score</h3>
            <p> At the end of the Quiz, your total score will be displayed.</p>
            <div class="row mt">
                <div class="col-lg-12">
                    <?php echo $msg; ?>
                    <h3>Start the Quiz
                        </h3><p>
                        Good luck!</p>
                    <button   class="btn btn-theme04" onClick="startQuiz('quiz.php?question=1')">Click Here To Begin</button>
                </div>
            </div>

        </section><! --/wrapper -->
    </section><!-- /MAIN CONTENT -->

    <footer class="site-footer">
        <div class="text-center">

            <a href="blank.html#" class="go-top">

            </a>
        </div>
    </footer>
    <!--footer end-->
</section>


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


