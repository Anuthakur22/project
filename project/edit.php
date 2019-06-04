 <?php 
 session_start();
$empname = $_SESSION['name'];
if($empname != true){
  header('Location:login.php');
}
include('connection.php');
 if(isset($_POST["userid"]))  
 {  
      $query = "SELECT * FROM user WHERE uid = '".$_POST["userid"]."'";  
      $result = mysqli_query($conn, $query);  
      $row = mysqli_fetch_assoc($result);  
      echo json_encode($row);  
      exit;
 }  

 if(isset($_POST["action"]) && $_POST["action"] = 'update')   
 {  
  //die;
      $uid = $_POST["uid"];
      $name =$_POST['name'];
      $email =$_POST['email'];
     // die;
      $query = "Update user SET name = '$name' , email = '$email' WHERE uid ='$uid'"; 
      if (mysqli_query($conn, $query)) {
          echo ltrim("Record updated successfully");
          exit;
      } else {
          echo "Error updating record: " . mysqli_error($conn);
          exit;
      }
     
 }  

 if($empname == true){
   header('Location:home.php');
 }