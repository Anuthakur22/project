<!DOCTYPE html>
<html>
<head>
  <title></title>
  <style>
    .container{
  margin-top:5%;
  margin-bottom:5%;
}
#headerText{
  margin-bottom:30px;
}

.input-group-addon{
    font-weight: 600;
    font-size: 15px;
  background:# ;
}

  </style>
</head>
<body>
<div class="container">
  <div class="row">
    <h2 id="headerText" class="text-center">Bootstrap checkboxes and radio addons with iCheck</h2>
    <p class="text-center">Using the JS provided will override the normal checkbox and radio and apply with iCheck style of your choice.</p>
    <div class="col-md-6">
      <div class="input-group">
        <span class="input-group-addon">
        <input type="checkbox" aria-label="...">
      </span>
        <input type="text" class="form-control" aria-label="...">
      </div>
      <!-- /input-group -->
    </div>
    <!-- /.col-lg-6 -->
    <div class="col-lg-6">
      <div class="input-group">
        <span class="input-group-addon">
        <input type="radio" aria-label="...">
      </span>
        <input type="text" class="form-control" aria-label="...">
      </div>
      <!-- /input-group -->
    </div>
    <!-- /.col-lg-6 -->
  </div>
  <!-- /.row -->
<br>
<div class="row">
  <div class="col-lg-6">
    <div class="input-group">
      <span class="input-group-addon">
           <input type="checkbox" aria-label="...">&nbsp; Text
                </span>
      <input type="text" class="form-control" aria-label="...">
    </div>
    <!-- /input-group -->
  </div>
  <div class="col-lg-6">
    <div class="input-group">
      <span class="input-group-addon">
                    <input type="radio" aria-label="...">&nbsp; Text
                </span>
      <input type="text" class="form-control" aria-label="...">
    </div>
    <!-- /input-group -->
  </div>
   <!-- /.row -->
  </div>
  <script type="text/javascript">
   $("input[type='checkbox'], input[type='radio']").iCheck({
        checkboxClass: 'icheckbox_square',
        radioClass: 'iradio_square'
</script>
</body>
</html>