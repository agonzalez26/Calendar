<?php
echo "<body>";
  session_start();
  include_once 'dbconnect.php';
  $errorMessage="";
if(isset($_POST['NEWSUBMIT'])){
    $newname = $_POST['NEWNAME'];
    $newuser = $_POST['NEWUSER'];
    $newpass = $_POST['NEWPASS'];

    if(empty($newname)|| empty($newuser)||empty($newpass)){
      echo $errorMessage = "MISSING INFORMATION";
    }else{
    $query = "INSERT INTO users(name, username, password) VALUES('$newname','$newuser','$newpass')";
    if($mysqli->query($query)===TRUE){
      echo "NEW RECORD<br>";
      $newbie = "SELECT username FROM users WHERE username='$newuser'";
      $result = $mysqli->query($newbie);
      while($row = $result->fetch_assoc()){
        //echo "NAME: " . $row['username'] . "<br>";
        $_SESSION['user'] = $row['username'];
        echo "Welcome: ". $_SESSION['user'];
      }
    }else{
      echo $errorMessage = "ACCOUNT ALREADY EXISTS<br>";
    //  header("location: signup.php");
    }
    // $newbie = "SELECT username FROM users WHERE username='$newuser'";
    // $result = $mysqli->query($newbie);
    // while($row = $result->fetch_assoc()){
    //   echo "NAME: " . $row['username'];
    //   $_SESSION['user'] = $row['username'];
    //   echo "Welcome: ". $_SESSION['user'];
    //
    // }
  }
}
 ?>
  <h1>Welcome new user.</h1>
  <h2>Please enter the information below.</h2>
  <p id="test"><p>
  <div>
  <form action="clogin.php" method="POST">
    Create Name:<input type="text" name="NEWNAME" width="50" placeholder="NEWNAME"><br><br>
    Create Username:<input type="text" name="NEWUSER" width="50" placeholder="NEWUSER"><br><br>
    Create Password:<input type="text" name="NEWPASS" width="50" placeholder="NEWPASS"><br><br>
    <input type="submit" name="NEWSUBMIT" value="SUBMIT"><br>
    <span style="color:red;"> <?php  echo $errorMessage; ?></span>
  </form>

</div>
</body>

<style>
  body{
    background-color: lightgreen;
    text-align: center;
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
