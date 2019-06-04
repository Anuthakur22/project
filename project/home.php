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

<!-- pnotify -->
<script type="text/javascript" src="pnotify/src/pnotify.core.min.js"></script>
<link href="pnotify/src/pnotify.core.css" media="all" rel="stylesheet" type="text/css" />
<link href="pnotify/src/pnotify.brighttheme.css" media="all" rel="stylesheet" type="text/css" />
<!-- icheck -->
<link href="icheck/skins/all.css" rel="stylesheet">
<link href="icheck/skins/square/green.css" rel="stylesheet">
<script src="icheck/icheck.js"></script>

<!-- datepicker -->
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 
<!-- datatable -->
<link rel="stylesheet" href="DataTables/datatables.min.css">
 <script src="DataTables/datatables.min.js"></script>

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
  <input type="text" class="date" id="datepicker">
  <br><br>  


<?php 
      $sql = "SELECT * FROM user Limit 0,10";
      $result = mysqli_query($conn, $sql);  
      if (mysqli_num_rows($result) > 0) { 
?>
<table id="example" class="table table-bordered pagin-table">
  <thead>
     <tr>
        <th><input type="checkbox" class="input_checkbox" id="CheckAll" />&nbsp<button class="deletedata">Delete</button></th>
        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Date</th>
        <th>Action</th>
      </tr>
  </thead>
  <tbody id="user_list">
      <?php 
          while($row = mysqli_fetch_assoc($result)) { 
      ?>
      <tr id="list<?php echo $row['uid']; ?>">
      <td><input class="input_checkbox allcheckboxes"  data_checkboxid="<?php echo $row["uid"]; ?>" type="checkbox">
        <input class="input_checkbox radio_btn radio_<?php echo $row["uid"]; ?>" data_radio="<?php echo $row["uid"]; ?>" type="radio"></td>
        <td><?php echo $row['uid'];  ?></td>
        <td id="username<?php echo $row['uid']; ?>"><?php echo $row['name']; ?></td>
        <td id="useremail<?php echo $row['uid']; ?>"><?php echo $row['email']; ?></td>
        <td><?php echo $row['added_on']; ?></td>
        <td> <a  class="edit <?php echo $row['uid']; ?>" data-userid="<?php echo $row['uid']; ?>" data-toggle="tooltip" data-placement="top" title="Edit data!">EDIT</a> | <a class="delete <?php echo $row['uid']; ?>" data-delete-userid="<?php echo $row['uid']; ?>" data-toggle="tooltip" data-placement="top" title="Delete data!">DELETE</a></td>
      </tr><?php } ?>
  </tbody>
</table>
 <?php  }else{
    echo "No record ";
  }
  ?>
 <!-- modal -->
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
          success: function(data){
           $('#user_list').html(data);
        }
     });
    });
  $(document).on("click" ,'.deletedata' , function(){
    var userid = $(this).attr('data-delete-userid');
      var userdata = [];
      $(".input_checkbox:checked").each(function() {
         userdata.push($(this).attr('data_checkboxid'));
         //alert(userdata);
        $.ajax({
          type:'post',
          url: "deletecheckbox.php",
          data: {"userdata": userdata},
          success: function(data){
            if($.trim(data) == 'record deleted'){
               for(var i=0; i<userdata.length; i++)
                {
                    $("#list"+userdata[i]).remove();
                }
            }else{
              console.log('user is not deleted');
            }
          }
        });

      });
    });
  // tooltip
   $('[data-toggle="tooltip"]').tooltip();   
   //icheck
      $('.input_checkbox').iCheck({
          checkboxClass: 'icheckbox_square-green',
          radioClass: 'iradio_square-green'
         // increaseArea: '20%' // optional
      });

    // selectAll checkbox
     $('#CheckAll').on('ifUnchecked', function (event) {
        $('.allcheckboxes , .radio_btn').iCheck('uncheck');
        // jQuery("#radio_1").attr('checked', true);
      });
      // Make "All" checked if all checkboxes are checked
      $('#CheckAll').on('ifChecked', function (event) {
          $('.allcheckboxes , .radio_btn').iCheck('check');
      });


     $('.allcheckboxes').on('ifChecked' ,function(){
        var id = $(this).attr('data_checkboxid');
        $('.radio_'+id).iCheck('check');
     });
     $('.allcheckboxes').on('ifUnchecked' ,function(){
       $('.radio_btn').iCheck('uncheck');
     });
       



      //datepicker
        $( "#datepicker" ).datepicker({
             dateFormat: 'yy-mm-dd' 
        });

        $("#datepicker").on("change",function(){
          var selected = $(this).val();
         // alert(selected);
            $.ajax({
              type:'post',
              url: "datepicker.php",
              data: {"selected": selected},
              success: function(data){
                $('#user_list').html(data);
               // alert(data);
              }

            });
        });

        $('#example').DataTable();

});
 

 $('tbody').sortable();
</script>

</body>
</html>
