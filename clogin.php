<head>
  <link rel="stylesheet" type="text/css" hre="cstyle.css">
</head>
<?php
  echo "<body>";
   session_start();
  require_once 'dbconnect.php';
  $errorMessage="";
  if(isset($_POST['LOGIN'])){
		$oldname = trim($_POST['NAME']);
		$oldname = strip_tags($oldname);
		$oldname = htmlspecialchars($oldname);
    $olduser = trim($_POST['USERNAME']);
    $olduser = strip_tags($olduser);
    $olduser = htmlspecialchars($olduser);
		$oldpass = trim($_POST['PASSWORD']);
		$oldpass = strip_tags($oldpass);
		$oldpass = htmlspecialchars($oldpass);
    $oldpass = hash('sha256', $oldpass);
		// prevent sql injections / clear user invalid inputs
    if(empty($olduser) || empty($oldpass) || empty($oldname)){
      $errorMessage = "INVALID NAME OR USERNAME OR PASSWORD<br>";
      // header("signup.php");
    }else{
      // echo $oldpass;
      $oldie = "SELECT name, username, password FROM users WHERE username='$olduser'";
      $result = $mysqli->query($oldie);
      $row = $result->fetch_assoc();
      if($result->num_rows ==1 && $row['password'] ){//==1 && $row['password']== $oldpass){
        //echo $oldname. " ". $olduser. " ". $oldpass . "<br> ";
        $_SESSION['user'] = $row['username'];
        echo "WELCOME: ". $_SESSION['user'];
        $errorMessage="CORRECT INFORMATION<br>";
      }else{
        $errorMessage = "INCORRECT INFORMATION<br>";
      }
    }

}
?>
    <h1>Welcome to <span style="color: red;">THE</span> Calendar.</h1>
    <h2>Existing User?</h2>
    <div>
    <form action="cindex.php" method="POST">
      Name: <input type="text" name="NAME" placeholder="Name" width="50"><br><br>
      UserName: <input type="text" name="USERNAME" placeholder="UserName" width="50"><br><br>
      Password: <input type="text" name="PASSWORD" placeholder="**********" width="50"><BR><BR>
      <input id="idsubmit" type="submit" value="LOGIN" name='LOGIN' style="width:70%"><br>
      <span style="color:red;"><?php echo $errorMessage; ?></span>

    </form>
  </div>
  <script type="text/javascript">
     $(document).ready(function(){
       //to display the calendar when the button is clicked
          $("#idsubmit").click(function(){
            $.ajax({//display calendar
              type:'POST',
              url: "cindex.php",//will open to the ca`lendar page on the index webpage
              success: function(data){
                //alert(data);
                $("#contents").html(data);//innerHTML= data;
              }
            });
         });

        });
    </script>
    <!--if there is a new user to create an account to access the calendar-->

    <h2>New User?</h2>
    <div>
    <form action="signup.php" method="POST">
      <input type="submit" value="SIGNUP" style="width:70%">
    </form>
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
      form{font-weight: bold;}
      div{
        padding:15px;
        margin: auto;
        position: relative;
        border: 2px solid black;
        max-width: 350px;
        width:60%;
      }
    </style>
  </body>
