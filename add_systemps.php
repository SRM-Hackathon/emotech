<?php 
include("function.php");
$obj = new Controller();
$diseases = strtolower($_POST['diseases']);
$diseases = str_replace(' ', '_', $diseases);
$sympomtoms = json_encode($_POST[$diseases]);
$mobile = $_COOKIE['mobile'];

$add_diseases = $obj->addChart('disease', $diseases, $mobile);
$add_sympomtoms = $obj->addChart('sympomtoms', $sympomtoms, $mobile);
?>