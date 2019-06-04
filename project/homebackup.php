
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script> 
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<!-- select2 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
</script>
<!-- pnotify -->
<script type="text/javascript" src="pnotify/src/pnotify.core.min.js"></script>
<link href="pnotify/src/pnotify.core.css" media="all" rel="stylesheet" type="text/css" />
<link href="pnotify/src/pnotify.brighttheme.css" media="all" rel="stylesheet" type="text/css" />

<!-- modal -->
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script> 
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">-->
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
/*sortable*/
</style>
</head>
<body>
<h2>Users Listing</h2>
 <select id="myselectbox" class="myselect" style="width:500px;">
    <?php 
        $sql = "SELECT * FROM user";
        $result = mysqli_query($conn, $sql);  
        if (mysqli_num_rows($result) > 0) { 
          while($row = mysqli_fetch_assoc($result)) { 
    ?>
      <option><?php echo $row['name']; ?></option>
    <?php } } ?>
  </select>
  <br><br>


<table class="table table-bordered pagin-table">
  <thead>
     <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Action</th>
      </tr>
  </thead>
  <tbody id="user_list">
      <?php 
        $sql = "SELECT * FROM user";
        $result = mysqli_query($conn, $sql);  
        if (mysqli_num_rows($result) > 0) { 
       // $i = 1; 
          while($row = mysqli_fetch_assoc($result)) { 
      ?>
      <tr id="list<?php echo $row['uid']; ?>">
        <td><?php echo $row['uid'];  ?></td>
        <td id="username<?php echo $row['uid']; ?>"><?php echo $row['name']; ?></td>
        <td id="useremail<?php echo $row['uid']; ?>"><?php echo $row['email']; ?></td>
        <td> <a  class="edit <?php echo $row['uid']; ?>" data-userid="<?php echo $row['uid']; ?>" data-toggle="tooltip" data-placement="top" title="Edit data!">EDIT</a> | <a class="delete <?php echo $row['uid']; ?>" data-delete-userid="<?php echo $row['uid']; ?>" data-toggle="tooltip" data-placement="top" title="Delete data!">DELETE</a></td>
      </tr>
     <?php } } ?>
  </tbody>
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
  $(document).on("click", '.edit', function(){
  //$(".edit").on("click", function(){
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
         success: function(data){
          new PNotify({
            type :'success',
            text :'Record updated successfully'
          });
          if($.trim(data) == 'Record updated successfully'){
            $('#username'+uid).html(name);
            $('#useremail'+uid).html(email);
          }else{
            console.log('Record not updated');
          }
         // window.location.reload();
      }
   });
  });

// delete
$(document).on("click", '.delete', function(){
//$(".delete").on("click", function(){
      var userid = $(this).attr('data-delete-userid');
       $.ajax({
        type:'post',
        url: "delete.php",
         data: {"userid": userid},
         success: function(data){
          new PNotify({
            type :'success',
            text :'Record Deleted successfully'
          });
          if($.trim(data) == 'YES'){
            $("#list"+userid).remove();
          }else{
            console.log('user is not deleted');
          }
          //window.location.reload();
          //  alert(data);
      }
   });
  });
  $(".myselect").select2();

  $("#myselectbox").on("change", function(){
      var name = $(this).val();
       $.ajax({
        type:'post',
        url: "search.php",
        data: {"name": name},
        dataType:'json',
        success: function(data){
         $('#user_list').html(data.user_list);

      }
   });
  });

   $('[data-toggle="tooltip"]').tooltip();   
   /* sortable */
   // $('tbody').sortable();

});
 $('tbody').sortable();
$(window).scroll(function() {
    if($(window).scrollTop() == $(document).height() - $(window).height()) {
           // ajax call get data from server and append to the div
    }
});



</script>

</body>
</html>
