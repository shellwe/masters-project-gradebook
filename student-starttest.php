<?php
include_once("includes/start.php");
?>
<!DOCTYPE html>
<html><!-- InstanceBegin template="/Templates/template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>tests R us -</title>
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
if (isset($_GET["test"])) {
$test_id=$_GET["test"];
}
if (isset($_POST["test"])) {
$test_id=$_POST["test"];
}
if (!isset($test_id)) {
header("Location: student-tests.php?problem=noid");
}
$user_id=$_SESSION["user_id"];
?>

<form name="form1" method="post" action="student-starttest.php?test=<?php echo $test_id?>">
<?php


//$testme=$_POST['$question_id'];
//echo "hello world!!!!!!!!!!!!!!!!!! $testme how did this work";





	 	$queryquestion = "SELECT * FROM questions WHERE id NOT IN (SELECT question_id FROM gradebook where user_id=$user_id ) and test_id=$test_id limit 1;";
	$resultquestion = mysqli_query($mysqli, $queryquestion);
	echo "<ol class='questionlist'>";
	if (mysqli_num_rows($resultquestion) > 0){
		while($row = mysqli_fetch_array($resultquestion)){
		echo "<li>".$row['question'];
			echo "<ol class='answerlist'>";
				$question_id=$row['id'];
				$queryanswer = "select * from `answers` where question_id = $question_id";
				$resultanswer = mysqli_query($mysqli, $queryanswer);
				if (mysqli_num_rows($resultanswer) > 0){
					while($row = mysqli_fetch_array($resultanswer)){
						$answer_id=$row['id'];
						echo "<li><label>";
						echo "<input type='radio' name='$question_id' value='$answer_id'>".$row['answer']."</label></li>";
					}
				}
			echo "</ol>";
		echo "</li>";
	}
	}
	echo "</ol>";

if (isset($_POST[$question_id])) {

  $questionquery = "INSERT INTO `gradebook` (`user_id`, `question_id`, `answer_id`) VALUES ('$user_id', '$question_id', '$answer_id');";
  echo $questionquery;
  $questionresult = mysqli_query($mysqli, $questionquery);
	if ($questionresult) {
		// Success!
		header("Location: student-starttest.php?test=$test_id");
	}
	 else {
		// Display error message.
		echo "<div class='alert alert-error'>";
		echo $questionresult;
		echo "<p>Something went wrong</p>";
		echo "<p>" . mysqli_error($mysqli) . "</p>";
		echo "</div>";
	}

}	  

?>
<input class="btn btn-success" type="submit" value="Next Question" name="addquestion" id="addquestion">
</form>

<!-- InstanceEndEditable --> </div>
<script src="http://code.jquery.com/jquery.js"></script> 
<script src="js/bootstrap.min.js"></script>
</body>
<!-- InstanceEnd --></html>