<?php
  //Connection to the SQL Database
  $mysqli = mysqli_connect('localhost', 'root', '', 'calendar');
  if($mysqli-> connect_errno){
    printf("ERROR");
  }
  echo "DATABASE CONNECTION SUCCESSFUL<br>";
  // session_start();
  // $usercheck = $_SESSION['login_user'];
  // //fetch the information from the usercheck
  // //$ses_sql= mysql_query("SELECT username FROM users WHERE username = '$usercheck'");
  // $row = mysql_fetch_assoc($ses_sql);
  // $ses_sql = "SELECT username, password FROM users WHERE username = '$usercheck'";
  // $result = $mysqli->query($ses_sql);
  // $row = mysql_fetch_assoc($ses_sql);
  // $login_session = $row['username'];
  // echo $login_session;
  // if(!isset($login_session)){
  //   mysql_close($mysqli); // Closing Connection
  //   header('Location: clogin.php'); // Redirecting To Home Page
  // }



    // $uname=$_POST['USERNAME'];
    // $pword = $_POST['PASSWORD'];
 ?>
