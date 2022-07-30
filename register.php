<?php
  if (!function_exists('str_contains')) {
    function str_contains($haystack, $needle) {
        return $needle !== '' && mb_strpos($haystack, $needle) !== false;
    }
}
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
  $first_name=$_POST['fname']; 
  $last_name=$_POST['lname']; 
  $phone=$_POST['phone']; 
  $email=$_POST['email']; 
  $password=$_POST['password']; 
  if(!empty($_POST['radio'])) {
     $gender=$_POST['radio']; 
    } 
    else
    {
      echo "please choose gender"; 
    }  
    $sql="INSERT INTO `users`(`FName`, `LName`,  `Email`, `Password`, `Phone`, `Gender`) VALUES ('$first_name','$last_name','$email','$password','$phone','$gender') ;";
    if ($conn->query($sql) === TRUE) {
      header('Location:index.php');
    } 
    else 
    {
      $error=$conn->error;
      if (str_contains($error,'Duplicate'))
      {
        echo '<script>alert("Eamil is already used")</script>';
      }
    }
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
    <form  method="post" id="form_sign_up" onsubmit="return validate()">
 <center><legend class="form__title">Register Form</legend></center>
    <label for="fname" class='col' >First Name <span class="required">*</span> </label><br>
    <input id="fname" type="text" class='input_text' placeholder="Enter your first Name" name="fname" required>
    <br><br>
    <label for="lname" class='col'>Last Name <span class="required">*</span> </label><br> 
    <input id="lname" type="text" class="input_text" placeholder="Enter your last Name" name="lname" required> 
    <br><br>
    <label for="email_2" class='col' >Email <span class="required">*</span></label><br>
    <input id="email_2" type="Email" class="input_text" placeholder="Enter Email" name="email" required>
    <br><br>
    <label for="pass_2" class='col'>Password<span class="required">*</span></label><br>
    <input id="pass_2" type="password" class="input_text" placeholder="Password" name="password" required>
    <br><br>
    <label for="phone_2" for="phone" class='col'>phone </label><br>
    <input id="phone_2" type="tel"  class="input_text" name="phone" placeholder="01125698532" pattern="[0-9]{11}"><br>
    <br>
    <input class='radio_gender' type="radio" id="male" name="radio" value="male" >
    <label class='label_gender' for="male" >Male</label>
    <br> 
    <input class='radio_gender' type="radio" id="female" name="radio" value="female" >
    <label class='label_gender' for="female" >Female</label> 
    <br>
    <center>
    <input  type="reset" value="Reset" id='reset_sign_up' > 
</center> 
<br>
<center>
  <input  type="submit"  name="submit" value="Sign Up" id='sign' >
</center>     
    </form>
</center>

<script src="script.js">
    

</script>
    </body>
</html>