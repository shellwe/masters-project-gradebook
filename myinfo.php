<?php
include_once("includes/start.php");
?>
<!DOCTYPE html>
<html><!-- InstanceBegin template="/Templates/template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>tests R us - My Info</title>
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
  <p>
    <?php
	$query = "select * from `users` WHERE `username`='".$_SESSION['username']."'";
	$result = mysqli_query($mysqli, $query);
	$row = mysqli_fetch_assoc($result);

if (isset($_POST["oldpassword"])) {
	$oldpassword = md5($_POST['oldpassword']);
	$password = md5($_POST['password']);
	$passwordconfirm = md5($_POST['passwordconfirm']);
	
	//verifying the password with the DB

	$passwordfromdb=$row['password'];
	
	
	if (empty($oldpassword) or empty($password) or empty($passwordconfirm)){
	echo "<div class='alert alert-info'>A field is empty.</div>";
	}
	else if ($password != $passwordconfirm){
		echo "<div class='alert alert-error'>The password and password confirmation do not match.</div>";
	}
	else if ($oldpassword != $passwordfromdb) {
		echo "<div class='alert alert-error'>The current password does not match what is in the system.</div>";
	}
		
	else {
		$query = "UPDATE `users` SET `password`='$password' WHERE `username`='".$_SESSION['username']."'";
		$result = mysqli_query($mysqli, $query);
		if ($result) {
		// Success!
		echo "<div class='alert alert-success'>It looks like it was successful.  Feel free to <a href='logout.php'>log out</a> and give it a go!</div>";
	}
	 else {
		// Display error message.
		echo "<div class='alert alert-error'>The query that was run is below <br />";
		echo $query;
		echo "<p>" . mysqli_error($mysqli) . "</p>";
		echo "There was an error!</div>";
	 }
	}
}
if (isset($_POST["update"])) {
	$updateid=$row['id'];
	$first = mysqli_real_escape_string($mysqli,$_POST["first"]);
	$last = mysqli_real_escape_string($mysqli,$_POST["last"]);
	$address1 = mysqli_real_escape_string($mysqli,$_POST["address1"]);
	$address2 = mysqli_real_escape_string($mysqli,$_POST["address2"]);
	$city = mysqli_real_escape_string($mysqli,$_POST["city"]);
	$state = mysqli_real_escape_string($mysqli,$_POST["state"]);
	$zip = mysqli_real_escape_string($mysqli,$_POST["zip"]);
	$major = mysqli_real_escape_string($mysqli,$_POST["major"]);
	$queryupdate="UPDATE `shellwe`.`users` SET `first`='$first', `last`='$last', `address1`='$address1', `address2`='$address2', `city`='$city', `state`='$state', `zip`='$zip', `major`='$major' WHERE `id`='$updateid';
";
echo $queryupdate;
		  $resultupdate = mysqli_query($mysqli, $queryupdate);
			if ($resultupdate) {
				// Success!
				header("Location: myinfo.php?update=success");
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
if (isset($_GET["update"]) && $_GET["update"]=="success") {
	echo "<div class='alert alert-success'>Your information was successfully updated</div>";
}

?>
  </p>
  <form class="well" name="form2" method="post" action="myinfo.php">
    <input type="text" name="first" id="first" class="input-block-level" placeholder="First Name" value="<?php echo @$row['first']?>">
    <input type="text" name="last" id="last" class="input-block-level" placeholder="Last Name" value="<?php echo @$row['last']?>">
    <input type="text" name="address1" id="address1" class="input-block-level" placeholder="Address Line 1" value="<?php echo @$row['address1']?>">
    <input type="text" name="address2" id="address2" class="input-block-level" placeholder="Address Line 2" value="<?php echo @$row['address2']?>">
    <input type="text" name="city" id="city" class="input-block-level" placeholder="city" value="<?php echo @$row['city']?>">
    <input type="text" name="state" id="state" class="input-block-level" placeholder="state" value="<?php echo @$row['state']?>">
    <input type="text" name="zip" id="zip" class="input-block-level" placeholder="zip" value="<?php echo @$row['zip']?>">
    <input type="text" name="major" id="major" class="input-block-level" placeholder="major" value="<?php echo @$row['major']?>">
    <input type="submit" name="update" id="update" value="update">
  </form>
  <form class="well" name="form1" method="post" action="myinfo.php">
    <p>Password reset form</p>
  <p>
    <label for="oldpassword">Old Password</label>
    <input type="password" name="oldpassword" class="input-block-level" id="oldpassword">
  </p>
  <p>
    <label for="password">New Password</label>
    <input type="password" name="password" class="input-block-level" id="password">
  </p>
  <p>
    <label for="passwordconfirm">Confirm Password</label>
    <input type="password" name="passwordconfirm" class="input-block-level" id="passwordconfirm">
  </p>
    <p>
      <input type="submit" name="changepassword" id="submit" value="Change Password">
    </p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
</form>
<!-- InstanceEndEditable --> </div>
<script src="http://code.jquery.com/jquery.js"></script> 
<script src="js/bootstrap.min.js"></script>
</body>
<!-- InstanceEnd --></html>