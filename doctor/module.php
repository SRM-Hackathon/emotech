<?php
ob_start();
include("conection.php");

//admin login
class Admin extends Connection
{
	function adminLogin($username, $password)
	{
		$qry="SELECT * FROM doctor where username='$username' AND password='$password'";
		$this->ExecQuery($qry);
		$row=$this->FetchResult();
		return $row;	
	}
	
	//view class by id wise
	function view_profile($id)
	{
		$query="SELECT * FROM doctor WHERE id='$id'";
		$this->ExecQuery($query);
		$row=$this->FetchResult();
		return $row;
	}

	//view class by id wise
	function isCalling()
	{
		$query="SELECT * FROM chart_table WHERE chart_meta_data='videocalling' AND chart_description='start' ORDER BY chart_id DESC LIMIT 1";
		$this->ExecQuery($query);
		$row=$this->FetchResult();
		return $row;
	}	
}
?>