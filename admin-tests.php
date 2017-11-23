<?php
include_once("includes/start.php");
?>
<!DOCTYPE html>
<html><!-- InstanceBegin template="/Templates/template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>tests R us - Create a test</title>
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
<div class="container-fluid"> <!-- InstanceBeginEditable name="maincontent" -->

<?php
if ($admin['user_group']!=1){
    header("Location: login.php?login=notadmin");
}
//end code for if they are an administrator

		if (isset ($_GET["problem"])){
            if ($_GET["problem"] == "noid"){
                echo "<div class='alert alert-error'>How embarrassing, somehow I forgot what question or answer we were on.  Most likely it means that you went directly to a page without going through a post or one of my links. Could you please select the question again below?.</div>";
            }
		}
  if (isset($_POST['name'])) {
$name = mysqli_real_escape_string($mysqli, $_POST['name']);
$start_date = mysqli_real_escape_string($mysqli, $_POST['start_date']);
$end_date = mysqli_real_escape_string($mysqli, $_POST['end_date']);
$test_intro = mysqli_real_escape_string($mysqli, $_POST['test_intro']);

$query = "INSERT INTO `tests` (`name`, `start_date`, `end_date`, `test_intro`) VALUES ('$name', '$start_date', '$end_date', '$test_intro');";
$result = mysqli_query($mysqli, $query);
	if ($result) {
		// Success!
		$test_id=mysqli_insert_id($mysqli);
		echo $question_id;
		header("Location: admin-questions.php?test=$test_id");
		echo "<div class='alert alert-success'>The question was successfully added</div>";
	}
	 else {
		// Display error message.
		echo "<div class='alert alert-error'>";
		echo $query;
		echo "<p>Something went wrong</p>";
		echo "<p>" . mysqli_error($mysqli) . "</p>";
		echo "</div>";
	}
  }
?>
<div class="well">
<h3>Create a test</h3>
<form name="form1" method="post" action="admin-tests.php">
  <p>
    <label for="testname"> Test Name</label>
    <input type="text" placeholder="The name the students will see" name="name" id="name">
  </p>
  <p>
    <label for="startdate"> Start Date (will not be able to modify test after this date)</label>
<input type="text" placeholder="YYYY-MM-DD e.g. 1982-07-28" name="start_date" id="start">
  </p>
  <p>
    <label for="enddate">End Date</label>
<input type="text" placeholder="YYYY-MM-DD e.g. 1982-07-28" name="end_date" id="end">
  </p>
  <p>
    <label for="elaboration">Test Introduction</label>
    <br>
    <textarea name="test_intro" placeholder="Type in here what the test is about, they will see the intro before they see the test" id="test_intro" cols="45" rows="5"></textarea>
  </p>
  <p>
    <input class="btn btn-success" type="submit" name="addquestions" id="addquestions" value="create test and add questions">
  </p>
</form>
</div>

<table class="table table-bordered table-hover table-striped table-condensed" border="1" cellspacing="1" cellpadding="1">
  <tr>
    <th scope='col'>test name</th>
    <th scope='col'>Start Date</th>
    <th scope='col'>End Date</th>
    <th scope='col'>Answer Key</th>
  </tr> 
  
<?php

	$querysummary = "select * from tests`";
	$resultsummary = mysqli_query($mysqli, $querysummary);
	if (mysqli_num_rows($resultsummary) > 0){
	while($tablerow = mysqli_fetch_array($resultsummary)){
		echo "<tr><td><a href='admin-questions.php?test=".$tablerow['id']."'>".$tablerow['name']."</a></td>";
		echo "<td>".$tablerow['start_date']."</td>";
		echo "<td>".$tablerow['end_date']."</td>";
		echo "<td>Answer Key goes here</td></tr>";
	}
}

?>
</table>

<!-- InstanceEndEditable --> </div>
<script src="http://code.jquery.com/jquery.js"></script> 
<script src="js/bootstrap.min.js"></script>
</body>
<!-- InstanceEnd --></html>