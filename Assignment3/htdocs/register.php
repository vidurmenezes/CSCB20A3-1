<?php 
ini_set('display_errors',0);

include("config.php");
if(session_id()==''){session_start();}
if($_SERVER["REQUEST_METHOD"] == "POST") {
 $firstname = mysqli_real_escape_string($db,$_POST['firstname']); 
 $lastname = mysqli_real_escape_string($db,$_POST['lastname']);  
 $email = mysqli_real_escape_string($db,$_POST['email']);
 $mypassword = mysqli_real_escape_string($db,$_POST['password']);  
 $usertype = mysqli_real_escape_string($db,$_POST['types']);  
 $utorid = mysqli_real_escape_string($db,$_POST['utorid']); 
 
 
 $studentDb = "students";
 $taDb = "tas";
 $instructorDb = "instructors";
   //INSERT INTO instructors VALUES ("firstname","lastname","email","password");
 $original = "select utorid,email from students union select utorid,email from instructors union select utorid,email from tas";
 echo $original."<br>";
 $result1=mysqli_query($db,$original);
 while ($row=mysqli_fetch_array($result1)) {
  if($row['utorid'] == $utorid || $row['email'] == $email){
   $_SESSION['register'] = 'true';
   header("location: login.php");
   exit();
 }
}
$sql = "INSERT INTO ".$usertype." VALUES ("."'".$utorid."','".$mypassword."','".$firstname."','".$lastname."','".$email."')";

$result = mysqli_query($db,$sql);
if($result) {
         //session_register("myusername");
 $_SESSION['register'] = 'false';
 $_SESSION['login_user'] = $utorid;
 $_SESSION['usertype'] = $usertype;
 
 if($usertype == "students"){
  $marks = "marks";
  $student = "INSERT INTO ".$marks." VALUES ("."'".$utorid."'".",NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL)";
  echo $student;
  $studres = mysqli_query($db,$student);
  if(!studres){
    header("location: login.php");
  }
}
        // session_destroy(); 
header("location: index.php");
}
else {
  $_SESSION['register'] = 'true';
  header("location: login.php");
  end();
}

}
?>
