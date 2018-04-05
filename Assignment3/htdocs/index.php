<?php
//ini_set('display_errors',0);
include("session.php");
if(session_id()==''){session_start();}
?>
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="index.css">
  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script><!--Used fontawesome for icons -->
  <link href="https://fonts.googleapis.com/css?family=Nunito+Sans" rel="stylesheet"> <!--Used google fonts for some fonts -->
</head>

<body>
  <?php
    include('navbar.php');
  ?>
<div id="background">
  <div id="CourseTitle">
   <div class="myBounceDiv">
    <h1>Welcome To CSCB20 </h1>
    <h2 style="color:white;"><?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?></h2>
    <i class="fas fa-laptop fa-4x"></i>
  </div>
</div>
</div>
<?php 
    echo "<div class=\"mainsection\"><h2> Important Links</h2>";
      if ($_SESSION['usertype'] == "students") {
      
      echo  "<a href=\"viewmarks.php\">Click here to View your Marks</a><br>";
      echo  "<a href=\"sendfeedback.php\">Click here toSend anonomous feedback</a><br>";
      }
     else {
        echo "<a href=\"viewremarks.php\">Click here to View Remarks</a><br>";
        echo "<a href=\"viewallmarks.php\">Click here to Edit Marks</a><br>";
        if ($_SESSION['usertype'] == "instructors") {
          echo "<a href=\"viewfeedback.php\">Click here to View Feedback</a><br>";
        }
      }
    echo"<br></div>";
      
?>  
<div class="mainsection">
  <h2> Course Description</h2>

  <p>
    A practical introduction to databases and Web app development. Databases: terminology and applications; creating, querying and updating databases; the entity-relationship model for database design. Web documents and applications: static and interactive
  documents; Web servers and dynamic server-generated content; Web application development and interface with databases.</p>
</div>
<div class="mainsection">
  <h2>Prerequisite</h2>
  <p>Some experience with programming in an imperative language such as Python, Java or C.</p>
</div>
<div class="mainsection">
  <h2>Exclusion</h2>
  <p>This course may not be taken after - or concurrently with - any C- or D-level CSC course.</p>
</div>
<div class="mainsection">
  <h2>Syllabus</h2>
  <p>The syllabus to the course is in this pdf:
    <a href="http://www.utsc.utoronto.ca/bretscher/b20/syllabus.pdf">PDF</a></p>
  </div>

  <?php
  include('footer.php');
  ?>
</body>

</html>
