<?php
if(!isset($_SESSION)){session_start();}
include_once("includes/connectmsqli.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Sign in &middot; Twitter Bootstrap</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="../assets/ico/favicon.png">
  </head>

  <body>
    <div class="container">
      <form action="login.php" method="post" class="form-signin">
<?php
		if (isset($_POST["username"])){
			$username=$_POST['username'];
			$password=md5($_POST['password']);
			$username = mysqli_real_escape_string($mysqli,$username);
			$password = mysqli_real_escape_string($mysqli,$password);
			$query="SELECT * FROM users WHERE username='$username' and password='$password'";

			$result = mysqli_query($mysqli, $query);
	  $row = mysqli_fetch_assoc($result);
	if ($result) {
			$_SESSION['user_group']=$row['user_group'];
			$_SESSION['user_id']=$row['id'];
	} else {
		// Display error message.
		echo "<p>Report creation failed.</p>";
		echo $query;
		echo "<p>" . mysqli_error($mysqli) . "</p>";
		echo "<br /> Something went very wrong!";
	}			
			$rowcount = mysqli_num_rows($result);
			
			if ($rowcount == 1) {
				$_SESSION['username']=$username;
				//I COMMENTED THIS OUT TO MAKE SURE SESSIONS ARE BEING RECORDED!
				echo "<script type='text/javascript'>window.location = 'index.php' </script>";
				//header("Location: index.php");
			}
			else if (empty($username) or empty($password)) {
				echo "<script type='text/javascript'>window.location = 'login.php?login=empty'</script>";
				//header("Location: login.php?login=empty");
			}
			else {
				echo "<script type='text/javascript'>window.location = 'login.php?login=fail'</script>";
				//header("Location: login.php?login=fail");
			}
			
		}

		if (isset ($_GET["login"])){
            if ($_GET["login"] == "fail"){
                echo "<div class='alert alert-error'>Username or Password is incorrect.</div>";
            }
            if ($_GET["login"] == "empty"){
                echo "<div class='alert alert-info'>A field is empty.</div>";
            }
            if ($_GET["login"] == "notloggedin"){
                echo "<div class='alert alert-info'>You are not logged in.</div>";
            }
            if ($_GET["login"] == "logout"){
                echo "<div class='alert alert-success'>You have successfully logged out.</div>";
            }
            if ($_GET["login"] == "notadmin"){
                echo "<div class='alert alert-info'>You are not authorized to view that page.  Please log in with an admin account.</div>";
            }
        }
        ?>
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="text" class="input-block-level" placeholder="Email address" name="username">
        <input type="password" class="input-block-level" placeholder="Password" name="password">
        <label class="checkbox">
          <br>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        <button class="btn btn-large btn-primary" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	<script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
