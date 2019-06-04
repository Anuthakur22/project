<?php 
session_start();
$empname = $_SESSION['name'];
if($empname != true){
  header('Location:login.php');
}
include('connection.php');
 if(isset($_POST["userid"]))  
 { 
 	//die;
 	$delete = $_POST['userid'];
	$qry = "DELETE FROM user WHERE uid ='$delete'";
	$result=mysqli_query($conn , $qry);
	if(isset($result)) {
	   echo "YES";
	   exit;
	} else {
	   echo "NO";
	   exit;
	}
}
if($empname == true){
  header('Location:home.php');
}