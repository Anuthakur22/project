<html lang="en">
<head>
    <title>Jquery Select2 - Select Box with Search Option</title>  
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
</head>
<body>
<div style="width:520px;margin:0px auto;margin-top:30px;height:500px;">
  <h2>Select Box with Search Option Jquery Select2.js</h2>
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
</div>
<script type="text/javascript">
      $(".myselect").select2();
</script>
</body>
</html>
<!-- https://jqueryui.com/sortable/ -->