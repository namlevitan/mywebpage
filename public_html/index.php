<?php
ob_start();
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'id14858847_nam');
   define('DB_PASSWORD', 'Truyentranh8.net');
   define('DB_DATABASE', 'id14858847_esp32');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT id FROM loginform WHERE user = '$myusername' and pass = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
       //  session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         
         header("location: homepage.php");
         ob_end_flush();
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>
            Login page
        </title>
        <link rel="stylesheet" type="text/css" href="stylelogin.css"/>
    </head>
    <body>
        <div class="container">
            <img src="avatar.png" class ="avatar">
            <p></p>
            <p></p>
            <p></p>
            <h2>SIGN IN</h2>
            <form method="POST" action="#">
                <div class="form_input">
                <p>    Username</p>
                <input type="text" name="username" placeholder="your username">
                </div>
                <div class="form_input">
                <p>    Password</p>
                <input type="password" name="password" placeholder="your password">
                </div>
                <p></p>
                <div class="center">
                <input type="submit" name="submit" value="Sign in" class="btn_login"/>
                </div>
                <div class="m">
                <a href="#">Lost your password?</a><br>
                <a href="#">Don't have an account?</a>
            </div>
            </form>
        </div>
    </body>
</html>