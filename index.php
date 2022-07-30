
<?php
$servername ="localhost";
$username ="root";
$password ="usbw";
$dbname="biological";
$conn =new mysqli($servername, $username, $password, $dbname);// Check connection
if($conn->connect_error){
  die("Connection failed: ". $conn->connect_error);
}
else 
{

 session_start();  
 if(isset($_POST['submit'])) 

{
 $email=$_POST['email']; 
 $password=$_POST['password']; 

$sql = "SELECT Email FROM `users` WHERE Email='$email';"; 
$db_emails = $conn->query($sql);   
$row = $db_emails->fetch_assoc();
 
 if($email === $row["Email"])
 {
     $sql_1 = "SELECT UID, Password  FROM `users` WHERE Email='$email';";
     $db_password = $conn->query($sql_1);   
     $row_1 = $db_password->fetch_assoc(); 
     $user_id =$row_1["UID"];
    
     if($password=== $row_1["Password"])
     { 
         $_SESSION['user_id']=$user_id;
        //  header('Location:base.php?user_id='.$user_id); 
        header('Location:base.php'); 
     } 
     else
     {
        echo '<script>alert("Password Not Correct")
        </script>';
     }
 } 
 else
 { echo '<script>alert("Email Not Correct")</script>';}

}
} 
  // Close connection
  $conn->close(); 
?>

<html>
<head>
      <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="codecss.css">
<!-- jQuery library -->
<script src="js/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="js/bootstrap.min.js"></script>
    </head>
<body>
  <center>
    <form  id="form_login"  method="post" > 
            <center><legend class="form__title">Login Form</legend></center>
    <center> <label for="email_1" class="col">Email:</label></center>
    <center><input id="email_1" class='input_text' type="Email"  placeholder="Enter Email" name="email" required></center> 
    <br>
    <label for="pass_1" class="col">Password:</label>
    <input id="pass_1" type="password" class='input_text'  placeholder="Password" name="password" required>
 <br><br> 
        <input id='sign' type="submit"  name="submit" value="SIGN IN " >
        <br><br><br><br><br>
        <p id='text'> Not a member?</p>
        <a id='text' href="register.php" type="submit"  name="submit" style="color: rgb(32, 137, 202);">Create New Account</a></center>  
    </form>
    
    </body>
</html>