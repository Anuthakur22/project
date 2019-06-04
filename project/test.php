<html>
 <head>
  <title>Auto Load More Data on Page Scroll | lisenme.com </title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css"> 

 </head>
 <body>
<input type="checkbox" id="ckbCheckAll" />
    <p id="checkBoxes">
        <input type="checkbox" class="checkBoxClass" id="Checkbox1" />
        <br />
        <input type="checkbox" class="checkBoxClass" id="Checkbox2" />
        <br />
        <input type="checkbox" class="checkBoxClass" id="Checkbox3" />
        <br />
        <input type="checkbox" class="checkBoxClass" id="Checkbox4" />
        <br />
        <input type="checkbox" class="checkBoxClass" id="Checkbox5" />
        <br />
    </p>
  
  <div class="container">
   <h2 align="center">Auto Load More Data on Page Scroll with Jquery & PHP</a></h2>
   <br />
   <div id="load_data"></div>
   <div id="load_data_message"></div>
   <br />
   <br />
   <br />
   <br />
   <br />
   <br />
  </div>
 </body>
</html>




<script>

$(document).ready(function(){
 
 // var limit = 15;
 // var start = 0;
 // var action = 'inactive';
 // function load_country_data(limit, start)
 // {
 //  $.ajax({
 //   url:"fetch.php",
 //   method:"POST",
 //   data:{limit:limit, start:start},
 //   cache:false,
 //   success:function(data)
 //   {
 //    $('#load_data').append(data);
 //    if(data == '')
 //    {
 //     $('#load_data_message').html("<button type='button' class='btn btn-info'>No Data Found</button>");
 //     action = 'active';
 //    }
 //    else
 //    {
 //     $('#load_data_message').html("<span>please wait..</span>");
 //     action = "inactive";
 //    }
 //   }
 //  });
 // }
 
 // if(action == 'inactive')
 // {
 //  action = 'active';
 //  load_country_data(limit, start);
 // }
 // $(window).scroll(function(){
 //  if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
 //  {
 //   action = 'active';
 //   start = start + limit;
 //   setTimeout(function(){
 //    load_country_data(limit, start);
 //   }, 100);
 //  }
 // });

 $("#ckbCheckAll").click(function () {
        $(".checkBoxClass").prop('checked', $(this).prop('checked'));
    });
 
});
</script>