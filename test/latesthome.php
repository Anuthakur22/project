
<?php 
session_start();
include('connection.php'); 
//echo  $_SESSION['name'];
$empname = $_SESSION['name'];
if($empname != true){
  header('Location:login.php');
}
?>

<!DOCTYPE html>
<a style="float:right;" href="logout.php">Logout</a>
<html>
<head>
<!-- tooltip -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<!-- select2 -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<!-- modal -->
<!--  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

<h2>Users Listing</h2>
 <select class="myselect" style="width:500px;">
    <option>Laravel</option>
    <option>Laravel ACL</option>
    <option>Laravel PDF</option>
    <option>Laravel Helper</option>
    <option>Laravel API</option>
    <option>Laravel CRUD</option>
    <option>Laravel Angural JS Crud</option>
    <option>C++</option>
  </select>
<br><br>
<table>
   <tr>
    <th>Id</th>
    <th>Name</th>
    <th>Email</th>
    <th>Action</th>
  </tr>
  <?php 
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);  
    if (mysqli_num_rows($result) > 0) { 
   // $i = 1; 
    $rows = mysqli_fetch_all($result ,MYSQLI_ASSOC);
 
      foreach ($rows as $key => $row) {
     // while($row = mysqli_fetch_assoc($result)) { 
       // echo "<pre>";print_r($row);die;
  ?>
  <tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td> <a href="#edit=<?php echo $row['id']; ?>" id="edit" data-toggle="modal" data-target="#myModal"  data-toggle="tooltip" data-placement="top" title="Edit data!">EDIT</a> | <a href="#" data-toggle="tooltip" data-placement="top" title="Delete data!">DELETE</a></td>
  <!--  <a href="edit.php?row['id']" data-toggle="modal" data-target="#myModal" data-toggle="tooltip" data-placement="top" title="Edit data!">EDIT</a> | <a href="#" data-toggle="tooltip" data-placement="top" title="Delete data!">DELETE</a> data-whatever="<?php //echo $row['id']; ?>"-->
  </tr>
 <?php } } ?>
</table>
<?php 
 echo $id =  $row['id'];
   // if (isset($_POST['submit'])) {
   //    $id = $_POST['id'];
   //     $name = $_POST['name'];
   //     $query = "UPDATE `users` SET `name` = '$name'WHERE `id`=$id";
   //     // $query = "UPDATE `users` SET `name` = '$name', `phone` = '$phone', `address`='$address', `email`='$email' WHERE `id`=$id";
   //     $result = mysqli_query($conn ,$query);
   //    if($result)
   //      {
   //          echo 'Data Updated';
   //          header("location:home.php");
   //      }else{
   //          echo 'Data Not Updated';
   //      }
      
   //  }
 
     // $edit=mysqli_query($conn,"select * from users where id='".$id."'");
     // $erow=mysqli_fetch_array($edit);

?>

<!-- Modal -->
<div class="container">
  <!-- Modal -->
     <!-- <div class="modal fade" id="edit<?php //echo $row['userid']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
          <div class="modal-body">
           <?php
              // $query=mysqli_query($conn,"select * from `users`");
              // while($row=mysqli_fetch_array($query)){
              //   $edit=mysqli_query($conn,"select * from users where id='".$id."'");
              //   $erow=mysqli_fetch_array($edit);
              //  }
            ?>
            <!-- <p>Some text in the modal.</p> -->
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>">

          </div>
        <div class="modal-footer">
          <input type="submit" name="submit" value="Submit" class="btn btn-default" data-dismiss="modal">
           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
  //  $("#edit").click(function(){
   
  // });
  $('[data-toggle="tooltip"]').tooltip();   
});
  $(".myselect").select2();
    
 </script>
</body>
</html>
