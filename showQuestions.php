
<?php
require_once("scripts/connect_db.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard">
    <title>ShowQuestions</title>

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
  </head>

  <body>

  <section id="container" >

      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.html" class="logo"><b>Admin</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">

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

      <section id="main-content">
          <section class="wrapper">
          	<h4>Show questions </h4>
				<div class="row">
            </div>
              <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                          <?php

                          $sql = "SELECT question_id, question, type  FROM `questions`";

                          $result = mysqli_query($con, $sql);

                          if (mysqli_num_rows($result) > 0) {
                              echo "<table class=\"table table-striped table-advance table-hover\">";
                              echo " <thead>";
                              echo "<tr>";
                              echo "<th><i class=\"fa fa-info\">&nbsp;Id</th>";
                              echo "<th><i class=\"fa fa-question-circle\"></i>&nbsp;Question</th>";
                              echo "<th><i class=\"fa fa-bookmark\">&nbsp;Type</th>";
                              echo  "<th><i class=\"fa fa-edit\"></i>&nbsp; Status</th>";
                              echo "</thead>";

                              echo "</tr>";
                              while($row = mysqli_fetch_assoc($result)) {
                                  echo"<tbody>";
                                  echo "<tr>";
                                  echo "<td>" . $row['question_id'] . "</td>";
                                  echo "<td>" . $row['question'] . "</td>";
                                  echo "<td>" . $row['type'] . "</td>";
                                  echo" <td>

                                      <button onclick=\"deleteQ()\"class=\"btn btn-danger btn-xs\"><i class=\"fa fa-trash-o \"></i></button>
                                  </td>";

                                  echo "</tr>";
                                  echo "</tbody>";
                              }
                              echo "</table>";
                              }
                           else {
                              echo "0 results";
                          }

                          mysqli_close($con);
                          ?>


                      </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->

		</section><! --/wrapper -->
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      <!--footer start-->

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
    
  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>


  </body>
</html>
