<?php
include ('osghs_mvc\controller\controller.php');
$controller = new controller();
$controller->login();
session_start();
error_reporting(0);
?>

