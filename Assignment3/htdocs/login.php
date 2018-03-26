<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      $usertype = mysqli_real_escape_string($db,$_POST['types']);  
      echo $myusername."<br>";
      echo $mypassword."<br>";
      echo $usertype."<br>";
      if($usertype == "instructor"){
      $sql = "SELECT * FROM instructors WHERE email = '$myusername' and password = '$mypassword';";
      }
      else if($usertype == "student"){
         $sql = "SELECT * FROM students WHERE email = '$myusername' and password = '$mypassword';"; 
      }
      else{
          $sql = "SELECT * FROM tas WHERE email = '$myusername' and password = '$mypassword';";
      }
      echo $sql;
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
       if (!$row) {
             printf("Error this is from here: %s\n", mysqli_error($result));
      exit();
       }
     // $active = $row['active'];
      
      $count = mysqli_num_rows($result);

      if($count == 1) {
         //session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         
         header("location: welcome.php");
      }else {
         
         header("location:login.php");
      }
       
   }
?>

<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="contact.css">
  <link rel="stylesheet" type="text/css" href="navbar.css">
<link rel="stylesheet" type="text/css" href="footer.css">
  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script><!--Used fontawesome for icons -->
  <link href="https://fonts.googleapis.com/css?family=Nunito+Sans" rel="stylesheet"> <!--Used google fonts for some fonts -->
  <link href="https://fonts.googleapis.com/css?family=Noto+Serif" rel="stylesheet">

  <script>
    function myFunction() {
      var x = document.getElementById("myTopnav");
      if (x.className === "topnav") {
        x.className += " responsive";
      } else {
        x.className = "topnav";
      }
    }
  </script>
</head>

<body>
  
  <div id="background">
    <div id="CourseTitle">
        <div class="myBounceDiv">
      <h1>LOGIN</h1>

      <br>
      <i class="far fa-envelope fa-5x"></i>
        </div>
      <div class="card">

        <div class="container">

          <h4><b>LOGIN: </b></h4>
          <div class="title">
       
               <form action = "" method = "post">
                  <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                   <select name="types">
                    <option value="instructor">instructor</option>
                    <option value="student">student</option>
                    <option value="ta">ta</option>
                   </select>
                  <input type = "submit" value = " Submit "/><br />
               </form>
          </div>


        </div>
      </div>
    </div>
     <div id="CourseTitle"style="margin-top: 40px;">
      <h1>Register</h1>

        <div class="container" >

          <h4><b>TA</b></h4>
          <div class="title">
            <p> <b>Email:</b> <a href="mailto:bretscher@utsc.utoronto.ca">TA@mail.utoronto.ca</a></p>
            <p> <b>Tutorial Room:</b> IC493</p>
            <p> <b>Tutorial</b><br> 11:00-12:00 WENESDAY <br>4:00-6:00 FRIDAY</p>
              <p> <b>Office Hours:</b><br> 11:00-12:00 WENESDAY <br>
             4:00-6:00 FRIDAY
            <br>
             1:00-2:00 THURSDAY </p>
          </div>
      </div>
    </div>
<br>
<div class="footer">

     <footer>

     <p1><u>CREATOR</u><br>VIDUR MENEZES  &nbsp;<a class="gold" href="https://github.com/vidurmenezes"><i class="fab fa-github"></i></a>
     &nbsp;
     <a class="gold" href="https://www.linkedin.com/in/vidur-menezes-41076397/"><i  class="fab fa-linkedin"></i></a>
      </p1>
         <h2>CSCB2O <br><a class="gold" href="http://web.cs.toronto.edu/people/faculty.htm"><p> Faculty Of Computer Science</p></a>
         </h2>

      <p2><u>CREATOR</u><br><a class="gold" href="https://github.com/alexeicoreiba"><i class="fab fa-github"></i></a> &nbsp;<a class="gold" href="https://www.linkedin.com/in/alexei-coreiba-12621b140/"><i class="fab fa-linkedin"></i></a>&nbsp;ALEXEI COREIBA</p2>
       </footer>
  </div>
    </div>
</body>

</html>