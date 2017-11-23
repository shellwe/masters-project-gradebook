<?php
include_once("includes/start.php");
?>
<!DOCTYPE html>
<html><!-- InstanceBegin template="/Templates/template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Student - Tests</title>
<!-- InstanceEndEditable -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css">
<link href="css/mystyles.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="brand" href="#">tests R us</a>
      <div class="nav-collapse collapse">
        <ul class="nav">
          <li><a href="index.php">Home</a></li>
          <li><a href="myinfo.php">My Info</a></li>
<!--          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">tests<b class="caret"></b> </a>
            <ul class="dropdown-menu">
              <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Finished tests<b class="caret"></b> </a>
                <ul class="dropdown-menu">
                  <li><a href="#">test1</a></li>
                  <li><a href="#">test2</a></li>
                  <li><a href="#">order by date taken</a></li>
                </ul>
              </li>
              <li class="divider"></li>
              <li class="nav-header">Untaken Tests</li>
              <li><a href="#">test4</a></li>
              <li><a href="#">test3</a></li>
              <li><a href="#">order by date due</a></li>
              <li><a href="#">make yellow if due less than 3 days</a></li>
              <li><a href="#">make red if due less than 1 days</a></li>
              <li><a href="#">gradebook</a></li>
            </ul>
          </li> -->
        </ul>
        <ul class="nav pull-right">
        <?PHP
        $username=$_SESSION['username'];
        $adminquery="SELECT * FROM users WHERE username='$username'";
        $adminresult = mysqli_query($mysqli, $adminquery);
        $admin = mysqli_fetch_array($adminresult);
        if ($admin['user_group']==1){ 
        echo "<li class='dropdown'><a href='#' class='dropdown-toggle' data-toggle='dropdown'>Admin<b class='caret'></b></a>
            <ul class='dropdown-menu'>
              <li><a href='admin-tests.php'>Tests</a></li>
              <li><a href='admin-users.php'>Users</a></li>
              <li><a href='admin-class.php'>Class details</a></li>
            </ul>
        </li>";
		}?>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
      <!--/.nav-collapse --> 
    </div>
  </div>
</div>
<div class="container-fluid"> <!-- InstanceBeginEditable name="maincontent" -->Here are the list of tests that are available for this course.  Please make note of the deadline because once that is past you will not be able to take the test.  Once you begin a test you must finish the test and cannot retake the test.
    <table class="table table-bordered table-hover table-striped table-condensed" border="1" cellspacing="1" cellpadding="1">
      <tr>
    <th scope='col'>test name</th>
    <th scope='col'>Start Date</th>
    <th scope='col'>End Date</th>
  </tr> 
  
<?php

	$querysummary = "select * from tests`";
	$resultsummary = mysqli_query($mysqli, $querysummary);
	if (mysqli_num_rows($resultsummary) > 0){
	while($tablerow = mysqli_fetch_array($resultsummary)){
		echo "<tr><td><a href='student-starttest.php?test=".$tablerow['id']."'>".$tablerow['name']."</a></td>";
		echo "<td>".$tablerow['start_date']."</td>";
		echo "<td>".$tablerow['end_date']."</td>";
	}
}

?>
</table>
<!-- InstanceEndEditable --> </div>
<script src="http://code.jquery.com/jquery.js"></script> 
<script src="js/bootstrap.min.js"></script>
</body>
<!-- InstanceEnd --></html>