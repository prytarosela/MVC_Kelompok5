<?php
session_start(); 
include ('osghs_mvc\controller\controller.php');
$controller = new controller();
$controller->index();
error_reporting(0);
?>