<?php
   include('session.php');
?>
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="viewmarks.css">
  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script><!--Used fontawesome for icons -->
  <link href="https://fonts.googleapis.com/css?family=Nunito+Sans" rel="stylesheet"> <!--Used google fonts for some fonts -->
</head>

<body>
    <?php
          $worked = $_SESSION['worked'];
          //echo $erroreg;
          if($worked){
                echo "<div class='alert'>";
                echo "<span class='closebtn' onclick=\"this.parentElement.style.display='none';\">&times;</span>";
                echo "<strong>WORKED!</strong> Remark Submitted";
                echo "</div>";
            }
            
?>

  <?php
    include('navbar.php');
    $_SESSION['worked']=false;
   $quiz = "select * from marks where utorid = "."'".$_SESSION['login_user']."'"; 
  $result=mysqli_query($db,$quiz);
  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  ?>
  <div id="background">
    <div id="CourseTitle">
    <div class="myBounceDiv">
      <h1>View Marks</h1>
      <br>
      <i class="far fa-newspaper fa-5x"></i>
    </div>
      </div>
    </div>
<form action="" method="get">
<div class='mainsection'>
<h4>QUIZ</h4>    
      <!--echo "<h4>Quiz1 :</h4>$row['quiz1'];-->
  
  <h3 >
  <input type="checkbox" name="type[]" value="0">
  Quiz1:   
  <?php 
      if($row['quiz1']==''){
          echo "Not Marked";
      }
      else{
          echo $row['quiz1']."%\r";
      }
      ?>
  <input type="text" name="remark[]">
  </h3>
   
  <h3>Quiz2: 
  <?php if($row['quiz2']==''){
          echo "Not Marked";
      }
      else{
          echo $row['quiz2']."%\r";
      }?>
      <input type="text" name="remark[]">
  </h3>
  </div>

  <div class="mainsection">
    <h4>LABS</h4>
        <!--echo "<h4>Quiz1 :</h4>$row['quiz1'];-->
      <h3>LAB1: 
      <?php
      if($row['lab1']==''){
          echo "Not Marked";
      }
      else{
          echo $row['lab1']."%\r";
      }?>
      <input type="text" name="remark[]">
      </h3>
      <h3>LAB2: 
      <?php 
      if($row['lab2']==''){
          echo "Not Marked";
      }
      else{
          echo $row['lab2']."%\r";
      }?>
      <input type="text" name="remark[]">
      </h3>
  </div>
    
  <div class="mainsection">
    <h4>ASSIGNMENT</h4>
     
      <h3>Assignment 1: 
      <?php
      if($row['assignment1']==''){
          echo "Not Marked";
      }
      else{
          echo $row['assignment1']."%\r";
      }?>
      <input type="text" name="remark[]" value="quiz1">
      </h3>
      <h3>Assignment 2: 
      <?php
     if($row['assignment2']==''){
          echo "Not Marked";
      }
      else{
          echo $row['assignment2']."%\r";
      }?>
      <input type="text" name="remark[]">
      </h3>
  </div>
    <div class="mainsection">
    <h4>MIDTERMS</h4>
    <h3>Midterm: 
      <?php 
      if($row['midterm']==''){
          echo "Not Marked";
      }
      else{
          echo $row['midterm']."%\r";
      }?>
      <input type="text" name="remark[]">
      </h3>
  </div>
    <div class="mainsection">
    <h4>FINAL EXAM</h4>
    <h3>Final Exam: 
      <?php 
      if($row['finalexam']==''){
          echo "Not Marked";
      }
      else{
          echo $row['finalexam']."%\r";
      }?>
      <input type="text" name="remark[]">
      </h3>
  </div>
    <div class="mainsection">
      <input type="submit" value="Submit">
    </div>
 </form>
<?php
   include('footer.php');
?>
<?php

$name = $_GET['remark'];
$type = $_GET['type'];

// optional
// echo "You chose the following color(s): <br>";
$match = array();
$x = 0;


foreach ($name as $color){
    if($color != ''){
        if($x == 0){
         $query = "insert into remarks values(NULL,'1','quiz1',"."'".$color."',"."'".$_SESSION['login_user']."')";

        }
        if($x == 1){
          $query = "insert into remarks values(NULL,'1','quiz2',"."'".$color."',"."'".$_SESSION['login_user']."')";

        }
        if($x == 2){
           $query = "insert into remarks values(NULL,'1','lab1',"."'".$color."',"."'".$_SESSION['login_user']."')";
 
        }
        if($x == 3){
           $query = "insert into remarks values(NULL,'1','lab2',"."'".$color."',"."'".$_SESSION['login_user']."')";
 
        }
        if($x == 4){
            $query = "insert into remarks values(NULL,'1','assignment1',"."'".$color."',"."'".$_SESSION['login_user']."')";

        }
        if($x == 5){
            $query = "insert into remarks values(NULL,'1','assignment2',"."'".$color."',"."'".$_SESSION['login_user']."')";

        }
        if($x == 6){
            $query = "insert into remarks values(NULL,'1','midterm',"."'".$color."',"."'".$_SESSION['login_user']."')";

        }
        if($x == 7){
            $query = "insert into remarks values(NULL,'1','finalexam',"."'".$color."',"."'".$_SESSION['login_user']."')";

        }
        $ses_sql = mysqli_query($db,$query);
                
    }
    $x += 1;
}
if($ses_sql){
     $_SESSION['worked'] = true;
}
header("location:viewmarks.php");


?>

</body>

</html>
