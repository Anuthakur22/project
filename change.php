<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("input").change(function(){
    alert("The text has been changed.");
  });
});
</script>
</head>
<body>

<input type="text">

<p>Write something in the input field, and then press enter or click outside the field.</p>

</body>
</html>
