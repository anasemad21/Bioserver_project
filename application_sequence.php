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
    $user_id;
    $user_id=$_SESSION['user_id']; 
    if(empty($user_id))
    { 
        header('Location:index.php');
    } 
    else
    {
    $sql = "SELECT  * FROM application_seq ";
    $result = $conn->query($sql);
    $row = $result-> fetch_assoc();
        echo "<center><table><tr><th>Gene ID</th><th>Gene Name</th><th>Gene Sequence</th></tr> ";
        while($row = $result->fetch_assoc()) 
        { 
            $gene_id=$row['GID']; 
            $gene_name=$row['GName']; 
            echo "<tr><td><a  href='functions.php?gene_id=$gene_id&gene_name=$gene_name'>".$row["GID"]."</td><td>".$row["GName"]."</td><td>".$row["Seq"]."</td></tr>";
        }
        echo "</table></center>";
}
}
// Close connection
$conn->close(); 
?> 

<html>
  <head>
<link rel="stylesheet" href="codecss.css">

<style>
       table,th, td {
      
      font-weight : bold;
      margin:15px;
      padding:15px;
      border: 1px solid; 
      border-color:black;
      border-collapse: collapse;
    }
    table {
  border-collapse: collapse;
  width: 70%;
  height: 10%;
  background-color:#9ba2a5; 
  opacity: 0.8;
}
tr:nth-child(odd) {background-color: #e5e5e5;}
tr:hover {background-color: #4D4C7D;}
th{background-color: black;
  color: white;
} 
a{color :black}
      </style>
    
  </head>
  <body>

  </body>
</html>
