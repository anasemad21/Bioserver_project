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
  $result=""; 
    session_start(); 
    $check_user_id;
    $user_id=$_SESSION['user_id']; 
    if(empty($user_id))
    { 
        header('Location:index.php');
    } 
    else
    {   
    $gene_id=$_GET['gene_id']; 
    $gene_name=$_GET['gene_name']; 
    
    if(isset($_GET["logout"]))
    {
        unset($user_id); 
        session_destroy();
        header('Location:index.php'); 
    }


$dict_functions=array("Sequence Complement"=>"Seq_Complemet","Reverse Complement"=>"Seq_rever_Complemet",
"Translate"=>"Translate","Transcribe"=>"Transcription","GC Content"=>"gc","CpG ratio"=>"cpG","Most_Frequent_K-mer"=>"Most_Frequent_K_mer",); 


  if($gene_name==="")
  {
  $sql="SELECT Seq FROM `user_seq` WHERE UID = '$user_id' AND GID='$gene_id';";
  $db_seq = $conn->query($sql);   
  $row = $db_seq->fetch_assoc(); 
  $seq=$row['Seq']; 
  } 
  else
  {
    $sql="SELECT Seq FROM `application_seq` WHERE GID='$gene_id';";
    $db_seq = $conn->query($sql);   
    $row = $db_seq->fetch_assoc(); 
    $seq=$row['Seq']; 
  }
function Seq_Complemet($seq_complement)
{ 
  $length=strlen($seq_complement); 
  $com="";
  for ($i=0; $i<$length; $i++)
  
     {
  if ($seq_complement[$i]=="T")
  {
  $com = $com. "A";

  }
  else if($seq_complement[$i]=="A") {
  $com = $com. "T";
  
}
 else if($seq_complement[$i]=="G") {
  $com = $com. "C";
  
}
 else if($seq_complement[$i]=="C") {
  $com = $com. "G";
  
}


  }
  return $com;
}  
  
function Most_Frequent_K_mer($seq_kemr)
{
  

$k=3;
$length=strlen($seq_kemr);

 $ele= array();
  for ($i=0; $i<$length-$k+1; $i++)
  
 {
 $x=substr($seq_kemr, $i, ($i+$k)-$i);
 array_push($ele,"$x");


 }
  
  return array_count_values($ele); 


}
function cpG($seq_cpg)
{
  $len=strlen("$seq_cpg");
  $c=substr_count($seq_cpg, 'C');
  $g=substr_count($seq_cpg, 'G');
  $multi=$c*$g;
  return $multi/$len;
} 

function gc($seq_gc) 
{
  $len=strlen("$seq_gc");
  $c=substr_count($seq_gc, 'C');
  $g=substr_count($seq_gc, 'G');
  $total=$c+$g;
  return $total/$len*100;
}  

function Seq_rever_Complemet($seq_reverse_str)
{ 
  $seq_reverse=str_split($seq_reverse_str,1); 
  $length= count($seq_reverse);
  $comrev="";
  for ($i=count($seq_reverse)-1; $i>=0; $i--)
{ 
  if ($seq_reverse[$i]=="T")
  {
  $comrev = $comrev. "A";
  }
  else if($seq_reverse[$i]=="A") {
  $comrev = $comrev. "T";
  
}
 else if($seq_reverse[$i]=="G") {
  $comrev = $comrev. "C";
  
}
 else if($seq_reverse[$i]=="C") {
  $comrev = $comrev. "G";
  
}

  }
  return $comrev;  
} 

function Translate($seq_translate)
{
  $length= strlen($seq_translate);
  $protein='';
  $seq_translate=str_replace("N","",$seq_translate); 
  $genetic_code = array(
   'ATA'=>'I', 'ATC'=>'I', 'ATT'=>'I', 'ATG'=>'M',
        'ACA'=>'T', 'ACC'=>'T', 'ACG'=>'T', 'ACT'=>'T',
        'AAC'=>'N', 'AAT'=>'N', 'AAA'=>'K', 'AAG'=>'K',
        'AGC'=>'S', 'AGT'=>'S', 'AGA'=>'R', 'AGG'=>'R',                
        'CTA'=>'L', 'CTC'=>'L', 'CTG'=>'L', 'CTT'=>'L',
        'CCA'=>'P', 'CCC'=>'P', 'CCG'=>'P', 'CCT'=>'P',
        'CAC'=>'H', 'CAT'=>'H', 'CAA'=>'Q', 'CAG'=>'Q',
        'CGA'=>'R', 'CGC'=>'R', 'CGG'=>'R', 'CGT'=>'R',
        'GTA'=>'V', 'GTC'=>'V', 'GTG'=>'V', 'GTT'=>'V',
        'GCA'=>'A', 'GCC'=>'A', 'GCG'=>'A', 'GCT'=>'A',
        'GAC'=>'D', 'GAT'=>'D', 'GAA'=>'E', 'GAG'=>'E',
        'GGA'=>'G', 'GGC'=>'G', 'GGG'=>'G', 'GGT'=>'G',
        'TCA'=>'S', 'TCC'=>'S', 'TCG'=>'S', 'TCT'=>'S',
        'TTC'=>'F', 'TTT'=>'F', 'TTA'=>'L', 'TTG'=>'L',
        'TAC'=>'Y', 'TAT'=>'Y', 'TAA'=>'stop', 'TAG'=>'stop',
        'TGC'=>'C', 'TGT'=>'C', 'TGA'=>'stop', 'TGG'=>'W',);
$codons=str_split($seq_translate,3);
// print_r($codons);
foreach($codons as $i)
 {
   
if(strlen($i)<3){break;}
else{
  
   if($genetic_code[$i] == "Stop")
    {break;}
    else {
  $protein=$protein.$genetic_code[$i];
}
 }
}
  return $protein;
 } 

function Transcription($seq_transcripe)
{
  $length= strlen($seq_transcripe);
  $tranc="";
  for ($i=0; $i<$length; $i++)
  
  {
  if ($seq_transcripe[$i]=="T")
  {
      $tranc = $tranc. "U";
  }
  else {
  $tranc=$tranc. "$seq_transcripe[$i]";
}  
}

  return $tranc;  
}

 if(isset($_POST['perform']))
{ 
  if(isset($_POST['operate'])) 
  { 
    $chosen_func="";
    $func=$_POST['operate'];  
    $chosen_func=$dict_functions[$func];
    $result=$chosen_func($seq); 
  }
}
}
}
// Close connection
$conn->close(); 
?>
<!DOCTYPE html>
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

 <form  id='form_fun'  method="post" >
      <center>
      	<legend style='color:white;'>Operations on sequence</legend>
      </center>  

          
          <input type="radio" value="Sequence Complement" name="operate" checked id="Sequence Complement">
            <label for="Sequence Complement">Sequence Complement</label>
            <br>
            <input type="radio" value="Reverse Complement" name="operate" id="Reverse Complement">
            <label for="Reverse Complement">Reverse Complement </label>
            <br>
            <input type="radio" value="Translate" name="operate" id="Translate">
            <label for="Translate">Translate </label>
            <br>
            <input type="radio" value="Transcribe" name="operate" id="Transcribe">
            <label for="Transcribe">Transcribe </label>
            <br>
            <input type="radio" value="GC Content" name="operate" id="GC Content">
            <label for="GC Content">GC Content</label>
            <br>
            <input type="radio" value="CpG ratio" name="operate" id="CpG ratio" >
            <label for="CpG ratio" >CpG ratio </label>
            <br>
            <input type="radio" value="Most_Frequent_K-mer" name="operate" id="Most_Frequent_K-mer" >
            <label for="Most_Frequent_K-mer" > Most Frequent K-mer</label>
            <br> <br>
            
            <center>
            <input id='perform' type="submit" name="perform" value="Perform"></center>
            <br>
            <label for="result">Result</label> 
            <br>
            <textarea style="color:black; width:400px;" name="result" id="result" rows="3" cols="40"><?php print_r($result); ?></textarea>
            <br><br>
            <center>
              <a id='logout' href="functions.php?logout=<?php echo $user_id; ?>">Log Out</a>
            </center>

</form> 

</body>
</html>