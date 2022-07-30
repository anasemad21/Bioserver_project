<!-- <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
</head>
<body>
<p> lolooooo</p>
</body>
</html>
 -->


<?php
$servername ="localhost";
$username ="root";
$password ="usbw";
$dbname="biological";


$conn =new mysqli($servername, $username, $password, $dbname);// Check connection
if($conn->connect_error){
  die("Connection failed: ". $conn->connect_error);
}else   {

 echo"Connected successfully";
 $email=$_GET['email']; 
 $password=$_GET['password']; 


 $sql = "SELECT Email FROM `users` WHERE Email='$email';"; 
 $db_emails = $conn->query($sql);   
 $row = $db_emails->fetch_assoc(); 
 if($email === $row["Email"]) 
 {
    echo"ali";
    header("Location : /first.html");
 } 
 else
 {
  // echo "
  // <script type=\"text/javascript\"> 
  // document.getElementById('p1').innerHTML = 'email_not_coreect';

  // </script> " 
  
 }
//  $sql = "SELECT UID FROM `users` WHERE Email='$email';"; 

// $sql = "SELECT Email,Password , Phone FROM `users` WHERE Email='$email' and  Password='$password' ;"; 
// $sql="SELECT Email,Password FROM `users` WHERE UID='1'";

// if ($result = mysqli_query($conn, $sql)) {
//   // Fetch one and one row
//   while ($row = mysqli_fetch_array($result)) {
//     printf ("%s (%s)\n", $row[0], $row[1]);
//     echo $row["Email"];
//   }
//   mysqli_free_result($result);
// }

 

//  if($db_emails->num_rows > 0)
//  {
//    echo"success";
//  } 
//  else
//  {
//    echo"adkjfk";
//  }
 
//  echo $row["Password" ];
 

 
  

} 
  // Close connection
  $conn->close(); 

      ?>
