<?php
  session_start();
  //echo $_SESSION['user'];
 ?>
<!--The button page-->
  <head>
    <meta charset="utf-8">
    <title>Alma's Calendar</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  	<link rel="stylesheet" href="cstyle.css" type="text/css"><!--css link for styling-->
    <script type="text/javascript">
     $(document).ready(function(){
       //to display the calendar when the button is clicked
          $("button").click(function(){
            $.ajax({//display calendar
              type:'POST',
              url: "calendar.php",//will open to the calendar page on the index webpage
              success: function(data){
                //alert(data);
                $("#contents").html(data);//innerHTML= data;
              }
            });
         });

        });
    </script>
  </head>
  <body style="background-color:lightgreen;"><!--background-->
    <div id="contents" style="text-align:center;">
      <h1>Welcome to the Calendar</h1>
      <!--button that will use ajax and open the calendar-->
      <button type="button" name="BUTTON" value="LET'S GO!!">LET'S GO!!!</button><br>
      <!-- <form method="POST">
        <br><p style="font-size:30px;">Events</p><br>
        <input type="text"  placeholder="Add Event" id="event"><br>
        <br>
      <input type="submit" name="ADD" value="ADD EVENT" id="add">
      <p id="event"></p>
    </form> -->
    </div>
    <style>
      body{
        background-color: lightgreen;
        position: relative;
        display:block;
        text-align: center;
      }
      input{
        padding:5px;
        font-weight: bold;
      }

    </style>
  </body>
