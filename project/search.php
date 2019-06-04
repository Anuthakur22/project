<?php 
include('connection.php');
//echo 'test';
if(isset($_POST['name'])){
	$name = $_POST['name'];
	//echo $username;
	$query = "SELECT * FROM user WHERE name like '%$name%'";
	$result = mysqli_query($conn, $query); 
	$user_list = ' ';

	while ($record = mysqli_fetch_assoc($result))
	    {
			$user_list .= '<tr id="list'.$record['uid'].'"><td><input class="input_checkbox allcheckboxes"  data_checkboxid="'.$record["uid"].'" type="checkbox"><input class="input_checkbox" type="radio" name="iCheck"></td><td>'.$record['uid'].'</td><td id="username'.$record['uid'].'">'.$record['name'].'</td><td id="useremail'.$record['uid'].'">'.$record['email'].'</td><td>'.$record['added_on'].'</td><td><a class="edit  '.$record['uid'].'" data-userid="'.$record['uid'].'" data-toggle="tooltip" data-placement="top" title="Edit data!">EDIT</a> | <a class="delete '.$record['uid'].'" data-delete-userid="'.$record['uid'].'" data-toggle="tooltip" data-placement="top" title="Delete data!">DELETE</a></td></tr>';
 			
	         
	    }
	       

	echo $user_list;
	?>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.input_checkbox').iCheck({
	          checkboxClass: 'icheckbox_square-green',
	          radioClass: 'iradio_square-green'
	         // increaseArea: '20%' // optional
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
<?php
	}
?>


