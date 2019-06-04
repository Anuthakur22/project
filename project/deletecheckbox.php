<?php 
session_start();
$empname = $_SESSION['name'];
if($empname != true){
  header('Location:login.php');
}
include('connection.php');
 if(isset($_POST["userdata"]))  
 { 
 	//die;
 	$delete = $_POST['userdata'];
 	$ids = join("','",$delete);   
 	//$del_id = implode("','" ,$delete);
 	//print_r($del_id);die;
		$qry = "DELETE FROM user WHERE uid IN ('$ids')";
		$result=mysqli_query($conn , $qry);
		if(isset($result)) {
		   echo "record deleted";

		} else {
		   echo "NO";
		}	die;
		

}
	
if($empname == true){
  header('Location:home.php');
}
