<?php
   include('config.php');
   if(session_id()==''){session_start();}
   $user_check = $_SESSION['login_user'];
   $usertype = $_SESSION['usertype'];
   $ses_sql = mysqli_query($db,"select * from ".$usertype." where utorid = '$user_check'");
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   $email = $row['email'];
   $fname = $row['firstname'];
   $lname = $row['lastname'];
   $_SESSION['firstname'] = $fname;
   $_SESSION['lastname'] = $lname;
   // echo '<script type="text/javascript">alert("'.$fname.'");</script>';
   //echo $name;
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
   }

?>
