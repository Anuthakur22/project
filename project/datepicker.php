<?php 
include('connection.php');
//echo 'test';
if(isset($_POST['selected'])){
	$selected = $_POST['selected'];
	$query ="SELECT * FROM `user` WHERE  added_on < '$selected' LIMIT 0,10";
	$output ='';
 	$result = mysqli_query($conn, $query); 
      while($row = mysqli_fetch_array($result))  
       {  
            $output .= '  
                <tr id="list'.$row['uid'].'"><td><input class="input_checkbox allcheckboxes"  data_checkboxid="'.$row["uid"].'" type="checkbox"><input class="input_checkbox" type="radio" name="iCheck"></td><td>'.$row['uid'].'</td><td id="username'.$row['uid'].'">'.$row['name'].'</td><td id="useremail'.$row['uid'].'">'.$row['email'].'</td><td>'.$row['added_on'].'</td><td><a class="edit  '.$row['uid'].'" data-userid="'.$row['uid'].'" data-toggle="tooltip" data-placement="top" title="Edit data!">EDIT</a> | <a class="delete '.$row['uid'].'" data-delete-userid="'.$row['uid'].'" data-toggle="tooltip" data-placement="top" title="Delete data!">DELETE</a></td></tr>
            ';  
       }  
 
      echo $output;  
}
?>
<script type="text/javascript">
		$(document).ready(function(){
			$('.input_checkbox').iCheck({
	          checkboxClass: 'icheckbox_square-green',
	          radioClass: 'iradio_square-green',
	          increaseArea: '20%' // optional
	      	});
	      	// selectAll checkbox
		     $('#CheckAll').on('ifUnchecked', function (event) {
		        $('.allcheckboxes').iCheck('uncheck');
		      });
		      // Make "All" checked if all checkboxes are checked
		      $('#CheckAll').on('ifChecked', function (event) {
		          $('.allcheckboxes').iCheck('check');
		      });

		});
</script>









	