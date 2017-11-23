<?php
include_once("includes/start.php");
?>
<!DOCTYPE html>
<html><!-- InstanceBegin template="/Templates/template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>tests R us - Class Information</title>
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
if (isset($_POST['name'])) {
$name = mysqli_real_escape_string($mysqli, $_POST['name']);
$description = mysqli_real_escape_string($mysqli, $_POST['description']);
$announcement = mysqli_real_escape_string($mysqli, $_POST['announcement']);
$message_type = $_POST['message_type'];

$query="UPDATE `class` SET `name`='$name', `description`='$description', `announcement`='$announcement', `message_type`='$message_type' WHERE `id`='1';";
$result = mysqli_query($mysqli, $query);
if ($result) {
	// Success!
	echo "<div class='alert alert-success'>The class details were succesfully updated</div>";
	echo $query;
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
$queryselect="select * from `class` WHERE `id`='1';";
$resultselect = mysqli_query($mysqli, $queryselect);
$resultarray = mysqli_fetch_array($resultselect);
?>

<form name="form1" method="post" action="admin-class.php">
  <p>
    <label for="name">Name of the Class</label>
    <input type="text" name="name" id="name" value="<?php echo @$resultarray['name']?>">
    <br>
    <label for="description">Description of the class</label>
    <textarea name="description" id="description"><?php echo  @$resultarray['description']?></textarea>
    <br>
    <label for="announcement">announcement</label>
    <textarea name="announcement" id="announcement"><?php echo  @$resultarray['announcement']?></textarea>
    <br>
    the message_type is <?php echo  @$resultarray['message_type']?>
    <label for="message_type">Message Type</label>
    <select name="message_type" id="message_type">
      <option <?php echo ($resultarray['message_type']=="alert alert-block") ? "selected" : '';?> value="alert alert-block">block</option>
      <option <?php echo ($resultarray['message_type']=="alert alert-error") ? "selected " : '';?>value="alert alert-error">error</option>
      <option <?php echo ($resultarray['message_type']=="alert alert-success") ? "selected " : '';?>value="alert alert-success">success</option>
      <option <?php echo ($resultarray['message_type']=="alert alert-info") ? "selected " : '';?>value="alert alert-info">info</option>
    </select>
    <br>
    <input type="submit" name="submit" id="submit" value="submit">
    <br>
  </p>
</form>
<!-- InstanceEndEditable --> </div>
<script src="http://code.jquery.com/jquery.js"></script> 
<script src="js/bootstrap.min.js"></script>
</body>
<!-- InstanceEnd --></html>