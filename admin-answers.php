<?php
include_once("includes/start.php");
?>
<!DOCTYPE html>
<html><!-- InstanceBegin template="/Templates/template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>tests R us - add an answer</title>
<!-- InstanceEndEditable -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css">
<link href="css/mystyles.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" -->
<?php
/*if(isset($_SESSION['user'])){
		if ($_SESSION['user'] != "") {
		header("Location: home.php");
	}
}*/
?>
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
if (isset($_GET["question"])) {
$question_id=$_GET["question"];
}
if (isset($_POST["question"])) {
$question_id=$_POST["question"];
}
if (!isset($question_id)) {
header("Location: admin-tests.php?problem=noid");
}
?>
<br>
    <ul class="breadcrumb">
    <li><a href="admin-tests.php">Test List</a> <span class="divider">/</span></li>
    <li><a href="admin-questions.php?question=<?php echo $question_id?>">Back to question</a> <span class="divider">/</span></li>
    <li class="active">answer</li>
    </ul>

<form name="form1" method="post" action="admin-answers.php">
   <p><a href="admin-tests.php">Back to Test list</a></p>
   <p>
     <?php
	    	  if (isset($_POST['correct'])) {
				  $answerdropdown=$_POST['answerdropdown'];
				  $correctquery = "UPDATE `questions` SET `correct_answer`='$answerdropdown' WHERE `id`=$question_id;";
				  $correctresult = mysqli_query($mysqli, $correctquery);
					if ($correctresult) {
						// Success!
						echo "<div class='alert alert-success'>The answer has bene updated </div>";
					}
					 else {
						// Display error message.
						echo "<div class='alert alert-error'>";
						echo $correctquery;
						echo "<p>Something went wrong</p>";
						echo "<p>" . mysqli_error($mysqli) . "</p>";
						echo "</div>";
					}
				  }	  
			  

	 


   	  if (isset($_POST['delete'])) {
		  $answerdropdown=$_POST['answerdropdown'];
		  $deletequery = "DELETE FROM `answers` WHERE `id`='$answerdropdown';";
		  $deleteresult = mysqli_query($mysqli, $deletequery);
			if ($deleteresult) {
				// Success!
				echo "<div class='alert alert-success'>The answer was successfully deleted</div>";
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
		  $answerdropdown=$_POST['answerdropdown'];
		  $queryedit= "SELECT * FROM `answers` WHERE `id`='$answerdropdown';";
		  $editresult = mysqli_query($mysqli, $queryedit);
			if ($editresult) {
				// Success!
				$answeredit = mysqli_fetch_array($editresult);
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
	$pullingquestion = "select * from questions where id=$question_id";
	$resultquestion = mysqli_query($mysqli, $pullingquestion);
	$pulledquestion = mysqli_fetch_array($resultquestion);
	echo "<h3>".$pulledquestion['question']."</h3>";
	  
	
	
	
if (isset($_POST['answer'])) {
$answer = mysqli_real_escape_string($mysqli, $_POST['answer']);
$hint = mysqli_real_escape_string($mysqli, $_POST['hint']);

if (empty($_POST['answerdropdown'])) {
	$query = "INSERT INTO `answers` (`question_id`, `answer`, `hint`) VALUES ('$question_id', '$answer', '$hint');";
}
else {
	$answerdropdown=$_POST['answerdropdown'];
	$query = "UPDATE `answers` SET `answer`='$answer', `hint`='$hint' WHERE `id`='$answerdropdown';";

}




echo $query;
$result = mysqli_query($mysqli, $query);
	if ($result) {
		// Success!
		echo $question_id;
		if (isset($_POST['addanswer'])) {
		//header("Location: admin-answers.php?question=$question_id");
		echo "add answer is posted";
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
     <label for="question">What is the answer?<br>
    </label>
    <textarea name="answer" id="answer" cols="45" rows="5"><?php echo @$answeredit['answer']?></textarea>
</p>
  <p>
    <label for="hint">What is the hint?</label>
    <input type="text" name="hint" id="hint" value="<?php echo @$answeredit['hint']?>">
  </p>
  <p>
    <input type="hidden" name="question" id="hiddenField" value="<?php echo $question_id?>">
    <input type="hidden" name="answerdropdown" id="hiddenField" value="<?php echo @$answerdropdown?>">

  </p>
  <p>What is the correct answer (display dropdown of answers when list is not null)</p>
  <p>
    <input class="btn btn-success" type="submit" name="addanswer" id="addanswer" value="Add Answer">
  </p>
  <p>&nbsp;</p>
</form>
<div class="well"><form name="form2" method="post" action="admin-answers.php">
Select a question from the dropdown to edit or delete.
    <input type="hidden" name="question" id="hiddenField2" value="<?php echo $question_id?>">
<?php
sql_dropdown("answerdropdown", "id", "answer", "question_id", $question_id, "answers", $mysqli)
?>
<input class="btn btn-success" type="submit" name="correct" id="correct" value="Correct Answer">
<input class="btn btn-info" type="submit" name="edit" id="edit" value="Edit Answer">
<input class="btn btn-danger" type="submit" name="delete" id="delete" value="Delete Answer">
</form>
</div>
<table class="table table-bordered table-hover table-striped table-condensed" border="1" cellspacing="1" cellpadding="1">
  <tr>
    <th scope='col'>answer</th>
    <th scope='col'>hint</th>
  </tr> 
<?php
	$querysummary = "select * from answers where question_id=$question_id";
	echo $querysummary;
	$resultsummary = mysqli_query($mysqli, $querysummary);
	if (mysqli_num_rows($resultsummary) > 0){
	while($tablerow = mysqli_fetch_array($resultsummary)){
		echo "<tr><td>".$tablerow['answer']."</td>";
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