<?php
include_once("connectmsqli.php");
include_once("functions.php");
if(!isset($_SESSION)){session_start();}
if(!isset($_SESSION['username']))
header("Location: login.php?login=notloggedin");
?>