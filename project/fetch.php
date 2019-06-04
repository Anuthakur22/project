<style type="text/css">table {
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
}</style>
<?php
include('connection.php');
if(isset($_POST["limit"], $_POST["start"]))
{
 $query = "SELECT * FROM user ORDER BY uid DESC LIMIT ".$_POST["start"].", ".$_POST["limit"]."";
 $result = mysqli_query($conn, $query);
 ?>
 <?php 
 echo '<table ><thead><tr><th>Id</th><th>Name</th></tr></thead><tbody id="user_list">';
 while($row = mysqli_fetch_array($result))
 {
  echo '
  <tr><td>'.$row["uid"].'</td><td>'.$row["name"].'</td></tr>
		  
  ';
 }
echo '</tbody></table>';
}
 
?>