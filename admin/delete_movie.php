<?php
require_once("../include/connect.php"); 
session_start();

if(!isset($_SESSION['admin_log'])){
	redirect('login');
}
if(isset($_GET['delete_movie'])){
	$id = $_GET['delete_movie'];

	$query = runQuery("DELETE FROM records where m_id= '$id'");

	if($query){
		redirect('movie');
	}
	else{
		echo "not deleted";
	}
}
?>