<?php
session_start();
$con=mysqli_connect("localhost","root","","myhmsdb");
if(isset($_POST['submit'])){
 $username=$_POST['username'];
 $password=$_POST['password'];
 $query="select * from logintb where username='$username' and password='$password';";
 $result=mysqli_query($con,$query);
 if(mysqli_num_rows($result)==1)
 {
  $_SESSION['username']=$username;
  header("Location:admin-panel.php");
 }
 else
  header("Location:error.php");
}
if(isset($_POST['update_data']))
{
 $contact=$_POST['contact'];
 $status=$_POST['status'];
 $query="update appointmenttb set payment='$status' where contact='$contact';";
 $result=mysqli_query($con,$query);
 if($result)
  header("Location:updated.php");
}
function display_docs()
{
 global $con;
 $query="select * from doctb";
 $result=mysqli_query($con,$query);
 while($row=mysqli_fetch_array($result))
 {
  $username=$row['username'];
  $price=$row['docFees'];
  echo '<option value="' .$username. '" data-value="'.$price.'">'.$username.'</option>';
 }
}
if(isset($_POST['doc_sub']))
{
 $username=$_POST['username'];
 $query="insert into doctb(username)values('$username')";
 $result=mysqli_query($con,$query);
 if($result)
  header("Location:adddoc.php");
}

?>