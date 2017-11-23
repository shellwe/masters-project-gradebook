<?php
include_once("includes/start.php");
?>
<!DOCTYPE html>
<html><!-- InstanceBegin template="/Templates/template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>tests R us - add or modify users</title>
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
<div class="well">
  <form name="form1" method="post" action="admin-users.php">
    <?php
  if (isset($_POST["delete"])) {
	$student=$_POST['student'];
	//need to perform a select first so I can get the first and last name
	$querytodelete = "select * from users WHERE id=$student";
	$selectresult = mysqli_query($mysqli, $querytodelete);
	$pendingdelete = mysqli_fetch_array($selectresult);
	$deletequery = "DELETE FROM users WHERE id=$student";
	$deleteresult = mysqli_query($mysqli, $deletequery);
	if ($deleteresult) {
		// Success!
		$deletedname = $pendingdelete['first']." ".$pendingdelete['last'];
		echo "<div class='alert alert-success'>$deletedname was successfully deleted</div>";
		//header("Location: index.php");
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
  
	sql_dropdown2("student", "id", "first", "last", "users", $mysqli);
	?>
    <input class="btn btn-info" type="submit" name="edit" id="edit" value="edit">
    <input class="btn btn-danger" type="submit" name="delete" id="delete" value="delete">
  </form>
</div>
<div class="hero-unit">
  <?php
  if (isset($_POST["username"])) {
	$username = mysqli_real_escape_string($mysqli, $_POST['username']);
	$first = mysqli_real_escape_string($mysqli, $_POST['first']);
	$last = mysqli_real_escape_string($mysqli, $_POST['last']);
	$password=md5($_POST['password']);
	$user_group=$_POST['user_group'];
	$date_created=date('Y-m-d');
	$editedid= $_POST["edited_id"];
  	if (empty($editedid)) {
			$query = "INSERT INTO `users` (`username`, `password`, `user_group`, `first`, `last`, `date_created`) VALUES ('$username', '$password', '$user_group', '$first', '$last', '$date_created')";
	}
	else{
		$student=$_POST['edited_id'];
		$query = "UPDATE `users` SET `username`='$username', `password`='$password', `user_group`='$user_group', `first`='$first', `last`='$last' WHERE `id`='$student';";

	}

	$result = mysqli_query($mysqli, $query);
	if ($result) {
		// Success!
		echo "<div class='alert alert-success'>$username was successfully added or modified</div>";
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
  	if (isset($_POST["edit"])){
		$student=$_POST['student'];
		$valuesforedit = "select * from users where id = '$student'";
		$resultedited = mysqli_query($mysqli, $valuesforedit);
		$edited = mysqli_fetch_array($resultedited);
	}

  ?>
  <form name="form1" method="post" action="admin-users.php">
    <h3>add student</h3>
        <label for="username">student e-mail</label>
        <input type="text" name="username" id="username" placeholder="their e-mail" value="<?php echo  @$edited['username']?>">
        <label for="password">password</label>
        <input type="text" name="password" id="password" placeholder="their password">
        <label for="first">First Name</label>
      <input type="text" name="first" id="first" placeholder="The student's first name" value="<?php echo  @$edited['first']?>">
      <label for="last">Last Name</label>
        <input type="text" name="last" id="last" placeholder="Their last name goes here" value="<?php echo  @$edited['last']?>">
        <label for="user_group">access level</label>
        <select name="user_group" id="user_group">
          <option value="1">admin</option>
          <option value="2" selected="selected">student</option>
        </select>
        <input type="hidden" name="edited_id" id="edited_id" value="<?php echo  @$edited['id']?>">
<input class="btn btn-success" type="submit" name="submit" id="submit" value="Submit">
  </form>
</div>



<table class="table table-bordered table-hover table-striped table-condensed" border="1" cellspacing="1" cellpadding="1">
  <tr>
    <th scope='col'>username</th>
    <th scope='col'>First Name</th>
    <th scope='col'>Last Name</th>
    <th scope='col'>Group Type</th>
  </tr> 
<?php
	$querysummary = "select * from users order by `user_group`";
	$resultsummary = mysqli_query($mysqli, $querysummary);
	if (mysqli_num_rows($resultsummary) > 0){
	while($tablerow = mysqli_fetch_array($resultsummary)){
		echo "<tr><td><a href='mailto:".$tablerow['username']."'>".$tablerow['username']."</a></td>";
		echo "<td>".$tablerow['first']."</td>";
		echo "<td>".$tablerow['last']."</td>";
		echo "<td>".$tablerow['user_group']."</td>";
	}
}
?>
</tr></table>
<!-- InstanceEndEditable --> </div>
<script src="http://code.jquery.com/jquery.js"></script> 
<script src="js/bootstrap.min.js"></script>
</body>
<!-- InstanceEnd --></html>