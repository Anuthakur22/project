<!DOCTYPE html>
<html>
   <head>
      <title>jQuery UI Sortable - Example</title>
      <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
      <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
      
      <style>
         #sortable-list { list-style-type: none; margin: 0; 
            padding: 0; width: 25%; }
         #sortable-list li { margin: 0 3px 3px 3px; padding: 0.4em; 
            padding-left: 1.5em; font-size: 17px; height: 16px; }
         .default {
            background: #cedc98;
            border: 1px solid #DDDDDD;
            color: #333333;
         }
      </style>
      
      <script>
         $(function() {
            $( "#sortable-list" ).sortable();
         });
      </script>
   </head>
   
   <body>
      <ul id = "sortable-list">
         <li class = "default">Product 1</li>
         <li class = "default">Product 2</li>
         <li class = "default">Product 3</li>
         <li class = "default">Product 4</li>
         <li class = "default">Product 5</li>
         <li class = "default">Product 6</li>
         <li class = "default">Product 7</li>
      </ul>
   </body>
</html>