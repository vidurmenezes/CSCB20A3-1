<?php
   include('config.php');
   session_start();
   $user_check = $_SESSION['login_user'];
   $usertype = $_SESSION['usertype'];
   echo $user_check;
   $ses_sql = mysqli_query($db,"select * from ".$usertype." where email = '$user_check'");
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   $email = $row['email'];
   $name = $row['firstname'];
   $_SESSION['firstname'] = $name;
   //echo $name;
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
   }
?>