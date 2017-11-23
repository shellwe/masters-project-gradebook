<?php
include_once("includes/start.php");
?>
<!DOCTYPE html>
<html><!-- InstanceBegin template="/Templates/template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>tests R us - add a question</title>
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
//this is if they are not an administrator
if ($admin['user_group']!=1){
    header("Location: login.php?login=notadmin");
}
//end code for if they are an administrator
?>
<form name="form1" method="post" action="admin-questions.php">
   <p><a href="admin-tests.php">Back to Test list    </a></p>
   <p>Here is where you would add in <strong>questions</strong>. Selet from the list below to add in answers to each question.</p>
   <p>
     <?php
if (isset($_GET["test"])) {
$test_id=$_GET["test"];
}
if (isset($_POST["test"])) {
$test_id=$_POST["test"];
}
if (!isset($test_id)) {
header("Location: admin-tests.php?problem=noid");
}
	 echo "the test id is ".$test_id;


   	  if (isset($_POST['delete'])) {
		  $questiondropdown=$_POST['questiondropdown'];
		  $deletequery = "DELETE FROM `questions` WHERE `id`='$questiondropdown';";
		  $deleteresult = mysqli_query($mysqli, $deletequery);
			if ($deleteresult) {
				// Success!
				echo "<div class='alert alert-success'>The question was successfully deleted</div>";
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
	  if (isset($_POST['edit'])) {
		  $questiondropdown=$_POST['questiondropdown'];
		  $queryedit= "SELECT * FROM `questions` WHERE `id`='$questiondropdown';";
		  $editresult = mysqli_query($mysqli, $queryedit);
			if ($editresult) {
				// Success!
				$questionedit = mysqli_fetch_array($editresult);
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

	//pull the question info
	$pullingtest = "select * from tests where id=$test_id";
	$resulttest = mysqli_query($mysqli, $pullingtest);
	$pulledtest = mysqli_fetch_array($resulttest);
	echo "<h3>".$pulledtest['name']."</h3>";
	  
	
	
	
	  if (isset($_POST['question'])) {
$question = mysqli_real_escape_string($mysqli, $_POST['question']);
$hint = mysqli_real_escape_string($mysqli, $_POST['hint']);
if (empty($_POST['questionedited'])) {
	$query = "INSERT INTO `questions` (`test_id`, `question`, `hint`) VALUES ('$test_id', '$question', '$hint');";
}
else {
	$questionedited=$_POST['questionedited'];
	$query = "UPDATE `questions` SET `question`='$question', `hint`='$hint' WHERE `id`='$questionedited';";

}
echo "<br />".$query."<br />";
$result = mysqli_query($mysqli, $query);
	if ($result) {
		// Success!
		$question_id=mysqli_insert_id($mysqli);
		echo $question_id;
		if (isset($_POST['addanswer'])) {
		//header("Location: admin-answers.php?question=$question_id");
		echo "add answer is posted";
		}
		if (isset($_POST['addquestion'])) {
		echo "add question is posted";
		//header("Location: admin-questions.php?test=$test_id");
		}
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
   </p>
   <p>
     <label for="question">What is the question?<br>
    </label>
    <textarea name="question" id="question" cols="45" rows="5"><?php echo @$questionedit['question']?></textarea>
</p>
  <p>
    <label for="hint">What is the hint?</label>
    <input type="text" name="hint" id="hint" value="<?php echo @$questionedit['hint']?>">
  </p>
  <p>
    <input type="hidden" name="test" id="hiddenField" value="<?php echo $test_id?>">
    <input type="hidden" name="questionedited" id="hiddenField" value="<?php echo @$questiondropdown?>">
    
  </p>
  <p>What is the correct answer (display dropdown of answers when list is not null)</p>
  <p>
    <input class="btn btn-success" type="submit" name="addquestion" id="addquestion" value="<?php echo (isset($_POST['edit'])) ? 'Edit Question' : 'Add Question'?>">
  </p>
  <p>&nbsp;</p>
</form>
<div class="well"><form name="form2" method="post" action="admin-questions.php">
Select a question from the dropdown to edit or delete.
<?php
sql_dropdown("questiondropdown", "id", "question", "test_id", $test_id, "questions", $mysqli)

?>
<input name="edited" type="hidden" value="editeddropdown">
    <input type="hidden" name="test" id="hiddenField" value="<?php echo $test_id?>">
<input class="btn btn-info" type="submit" name="edit" id="delete" value="edit Question">
<input class="btn btn-danger" type="submit" name="delete" id="delete" value="Delete Question">
</form>
</div>
<table class="table table-bordered table-hover table-striped table-condensed" border="1" cellspacing="1" cellpadding="1">
  <tr>
    <th scope='col'>question</th>
    <th scope='col'>answer</th>
    <th scope='col'>hint</th>
  </tr> 
<?php
$querysummary = "select * from questions where test_id=$test_id";
$resultsummary = mysqli_query($mysqli, $querysummary);
if (mysqli_num_rows($resultsummary) > 0){
while($tablerow = mysqli_fetch_array($resultsummary)){
echo "<tr><td><a href='admin-answers.php?question=".$tablerow['id']."'>".$tablerow['question']."</a></td>";
$correctanswer = "select answer from answers where id=".$tablerow['correct_answer'];
$correctansweroutput = mysqli_query($mysqli, $correctanswer);
$correctanswerarray = mysqli_fetch_array($correctansweroutput);
echo "<td>".$correctanswerarray['answer']."</td>";
echo "<td>".$tablerow['hint']."</td></tr>";

}
}
?>
</table>
<!-- InstanceEndEditable --> </div>
<script src="http://code.jquery.com/jquery.js"></script> 
<script src="js/bootstrap.min.js"></script>
</body>
<!-- InstanceEnd --></html>