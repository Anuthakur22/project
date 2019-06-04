
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
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<!-- select2 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
</script>
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
    $sql = "SELECT * FROM user";
    $result = mysqli_query($conn, $sql);  
    if (mysqli_num_rows($result) > 0) { 
    $i = 1; 
      while($row = mysqli_fetch_assoc($result)) { 
  ?>
  <tr>
    <td><?php //echo $i++;  
    echo $row['uid']; ?></td>
    <td id="name_<?php echo $row['uid']; ?>" class="name_<?php echo $row['uid']; ?>" data-userid="<?php echo $row['uid']; ?>"><?php echo $row['name']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td> <a  class="edit <?php echo $row['uid']; ?>" data-userid="<?php echo $row['uid']; ?>" data-toggle="tooltip" data-placement="top" title="Edit data!">EDIT</a> | <a class="delete <?php echo $row['uid']; ?>" data-delete-userid="<?php echo $row['uid']; ?>" data-toggle="tooltip" data-placement="top" title="Delete data!">DELETE</a></td>
  <!--  <a href="edit.php?row['id']" data-toggle="modal" data-target="#myModal" data-toggle="tooltip" data-placement="top" title="Edit data!">EDIT</a> | <a href="#" data-toggle="tooltip" data-placement="top" title="Delete data!">DELETE</a> data-whatever="<?php //echo $row['id']; ?>"-->
  </tr>
 <?php } } ?>
</table>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    <form method="post">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>

          <div class="modal-body">
            <!-- <p>Some text in the modal.</p> -->
            <label for="name">Name:</label>
            <input type="hidden" id="update_id" name="uid" class="form-control edit_item">
            <input type="text" id="name" name="name" class="form-control">
            
             <div class="form-group">
                <label for="email">email:</label>
                 <input type="text" id="email" name="email" class="form-control">
             </div>


          </div>
        <div class="modal-footer">
          <input type="submit" id="submit" name="submit" value="Submit" class="btn btn-default" data-dismiss="modal">
           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      </form>
    </div>
  </div>


<script type="text/javascript">
$(document).ready(function(){
  // $(".edit").on("click", function(){ 
  //    var usersid = $(this).attr('data-userid');
  //    alert(usersid);
  // });
  $(".edit").on("click", function(){
    //$('#basicExampleModal').show();
   // $('#myModal').modal();
      var userid = $(this).attr('data-userid');
       $.ajax({
        type:'post',
        url: "edit.php",
        //data: {"userid": userid},
         data: {"userid": userid},
        dataType:'json',
         success: function(data){
           $('#update_id').val(userid); 
           $('#name').val(data.name);
           $('#email').val(data.email); 
          
           $('#myModal').modal('show');

      }
   });
  });
  $("#submit").on("click", function(){
    //var userid = $(this).attr('data-userid');
    var uid = $("#myModal").find(".edit_item").val();
      var name = $("#name").val();
      var email = $("#email").val();
       $.ajax({
        type:'post',
        url: "edit.php",
        //data: {"userid": userid},
         data: {"uid": uid,"name": name,"email": email,'action':'update'},
         dataType:'json',
         success: function(data){
          //alert(data);
         //var nameval = $('#name').val(data.name);
         
         // window.location.reload();
        //  alert(data);
          
          
          // $('#myModal').modal('show');

      }
   });
  });

// delete
$(".delete").on("click", function(){
      var userid = $(this).attr('data-delete-userid');
       $.ajax({
        type:'post',
        url: "delete.php",
        //data: {"userid": userid},
         data: {"userid": userid},
         success: function(data){
            alert(data);
         //  if(data=="YES"){
         //     $ele.fadeOut().remove();
         // }else{
         //     alert("can't delete the row")
         // }
          

      }
   });
  });
  $(".myselect").select2();

});
  
</script>

</body>
</html>
