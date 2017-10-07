<?php 
include("function.php");
$obj = new Controller();
$patient_name = $_POST['username'];
$patient_mobile = $_POST['mobile'];
$patient_age = $_POST['age'];
$add_register = $obj->addResister($patient_name, $patient_mobile, $patient_age);
echo $add_register;
?>