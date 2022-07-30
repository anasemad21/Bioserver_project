
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
if(isset($_GET["logout"]))
{
    unset($user_id); 
    session_destroy();
    header('Location:index.php');
}
if(isset($_POST['submit']))
{ 
    $gene_name=$_POST['gname']; 
    $gene_id=$_POST['gid']; 
    $seq=$_POST['seq']; 
    $sql="INSERT INTO user_seq (GID, GName, Seq,UID)
    VALUES ('$gene_id' , '$gene_name' , '$seq','$user_id');"; 
     if ($conn->query($sql) === TRUE) 
     { 
        header("Location:functions.php?gene_id=".$gene_id."&gene_name=");
     } 
    else 
    {
        $error=$conn->error;
        {
          echo '$error';
        }
    }

} 
  }
}
$brose_ur_seq_def="Browse Your Sequences That You Have Entered Before In The Site " ;
$browse_app_seq_def="Browse Sequences In The Site"; 
// Close connection
$conn->close(); 
?>



<html>
<head> 

      <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="codecss.css">
<!-- jQuery library -->
<!-- <script src="js/jquery.min.js"></script> -->

<!-- Latest compiled JavaScript -->
<!-- <script src="js/bootstrap.min.js"></script> -->
    </head>
<body>
    <form id="form_submit_data" enctype="multipart/form-data"   method="post" onsubmit="return maxlengthh()"> 
        <fieldset>
                <center><legend class="form__title">Submit data</legend></center>
        <label for="gname"  >Gene Name:</label> <br>
        <input type="text" id ="gname" name="gname" class="form-control"  placeholder="Enter Gene Name" required> 
      <br> 
        <label for="gid"  >Gene ID:</label> <br>
        <input type="text" id ="gid" name="gid" class="form-control" placeholder="Enter Gene ID ">  
      <br>
        <label for="seq" >Enter Seq:<br>
    <textarea style="color:black;" name="seq" id="seq" cols="40"></textarea><br><br>
        <input id='reset' type="reset" value="Reset" > 
        <br><br><br>

<?php 
   echo"<a name='browse_1' title='$brose_ur_seq_def' id='browse_your_seq' href='user_sequence.php'>Browse Your Sequences</a>" ; 
    
   echo"<a title='$browse_app_seq_def' id='browse_app_seq' href='application_sequence.php'>Browse Sequences</a>" ;
   echo"<br><br>"; 

?>       
        <br>
        <center>
        <input id='submit_data'  type="submit"  name="submit" value="Submit" >
        <center>
        <br>
        <br><center>
              <a id='logout' href="base.php?logout=<?php echo $user_id; ?>">Log Out</a>
        </center>


    </fieldset>

    </form>
    
    <script src="script.js"></script>
    </body>
</html>