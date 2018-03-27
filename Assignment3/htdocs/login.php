
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#181818e8" />
  <link rel="stylesheet" type="text/css" href="login.css">
  <link rel="stylesheet" type="text/css" href="navbar.css">
  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script><!--Used fontawesome for icons -->
  <link href="https://fonts.googleapis.com/css?family=Nunito+Sans" rel="stylesheet"> <!--Used google fonts for some fonts -->
  <link href="https://fonts.googleapis.com/css?family=Noto+Serif" rel="stylesheet">
</head>
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
    <script>
function validateForm() {
    var x = document.forms["myForm"]["fname"].value;
    if (x == "") {
        alert("Name must be filled out");
        return false;
    }
}
</script>
<?php 
   ini_set('display_errors',0);

   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['utorid']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $usertype = mysqli_real_escape_string($db,$_POST['types']);  
      $studentDb = "students";
      $taDb = "tas";
      $instructorDb = "instructors";
      //echo $myusername."<br>";
      //echo $mypassword."<br>";
      //echo $usertype."<br>";
       $sql = "SELECT * FROM ".$usertype." WHERE utorid = '$myusername' and password = '$mypassword';";
      
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
     // $active = $row['active'];
      
      $count = mysqli_num_rows($result);

      if($count == 1) {
         //session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         $_SESSION['usertype'] = $usertype;
         
         header("location: index.php");

      }else {
          $_SESSION['usrpass'] = 'true';
          header("location:index.php");
      }
       
   }
?>
<?php
          $errorusr = $_SESSION['usrpass'];
          $errorreg = $_SESSION['register'];
          //echo $erroreg;
            if($errorusr){
                echo "<div class='alert'>";
                echo "<span class='closebtn' onclick=\"this.parentElement.style.display='none';\">&times;</span>";
                echo "<strong>Wrong</strong> Password or username";
                echo "</div>";
            }
            else if($errorreg){
                echo "<div class='alert'>";
                echo "<span class='closebtn' onclick=\"this.parentElement.style.display='none';\">&times;</span>";
                echo "<strong>Account is already created</strong>";
                echo "</div>";
            }
          ?>





  


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
       
               <form action = "" method = "post" onsubmit="return validateForm()">
                  <label>UtorID  :</label><input type = "text" name = "utorid" class = "box" required /><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box"required /><br/><br />
                   <select name="types" required>
                    <option value="instructors">instructor</option>
                    <option value="students">student
                           <?php $showDivFlag = true;  ?>
                           </option>
                    <option value="tas">ta</option>
                   </select>
                  <input type = "submit" value = " Submit " required/><br />
               </form>
          </div>


        </div>
      </div>
    </div>
     <div id="CourseTitle" style="margin-top: 40px;">
      <h1>Register</h1>

        <div class="container" >

          <h4><b>REGISTER: </b></h4>
          <div class="title">
           <form action = "register.php" method = "post" onsubmit="return validateForm()">
                   <label>First Name  :</label><input type = "text" name = "firstname" class = "box" required/><br /><br />
                  <label>Last Name  :</label><input type = "text" name = "lastname" class = "box"required /><br/><br />
                  <label>Email  :</label><input type = "text" name = "email" class = "box" required/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" required/><br/><br />
                  <label>UtorId  :</label><input type = "text" name = "utorid" class = "box" required/><br/><br />
                   <select name="types">
                    <option value="instructors">instructor</option>
                    <option value="students">student
                           <?php $showDivFlag = true;  ?>
                           </option>
                    <option value="tas">ta</option>
                   </select>
                  <input type = "submit" value = " Submit "/><br />
               </form>
          </div>
      </div>
    </div>
<br>
<?php
   include('footer.php');
?>
    </div>
</body>

</html>