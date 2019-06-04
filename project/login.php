<?php 
 session_start();
if(isset($_SESSION['name'])){
    header('location:home.php');
}

 include('connection.php'); 
 $message ='';
  if(isset($_POST['submit'])){ 
  $email = $_POST['email'];
  $password = $_POST['password'];
 
  $query = "SELECT * FROM user WHERE email = '$email'  and password = '$password'";
  $data = mysqli_query($conn ,$query);
  $row = mysqli_num_rows($data);
  $row1 = mysqli_fetch_assoc($data);
 // echo "<pre>";print_r($row1);die;
  if($row == 1){
    //echo 'user found';
    $_SESSION['name'] = $row1['name'];
    header('Location:home.php');
   } else{
    $message = 'Invalid username and password';
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
label.error{
    color:red !important;
  }
</style>
<body>

<div class="container">
  <h2>Login Form</h2>
  <?php echo $message; ?>
  <form id="myform" method="POST" action="#">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required="required">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required="required">
    </div>
    <!-- <div class="checkbox">
      <label><input type="checkbox" name="remember"> Remember me</label>
    </div> -->
   
    <input type="submit" name="submit" value="Login" class="btn btn-default">
  </form>
</div>
</body>
</html>