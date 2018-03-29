<?php
ini_set('display_errors',0);
   include('session.php');
?>
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="navbar.css">
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
<body>
  <div class="topnav" id="myTopnav">
    <a href="index.php">Home</a>
    <a href="news.php">News</a>
    <a href="calendar.php">Calendar</a>
    <a href="https://piazza.com/class/jcpjjp5l4bywd">Piazza</a>
    <a href="lectures.php">Lectures</a>
    <a href="labs.php">Labs</a>
    <a href="assignment.php">Assignments</a>
    <?php 
      if ($_SESSION['usertype'] == "students") {
      echo "<a href=\"viewmarks.php\">View Marks</a>";
      echo "<a href=\"sendfeedback.php\">Send Feedback</a>";
      } else {
        echo "<a href=\"viewremarks.php\">View Remarks</a>";
        echo "<a href=\"changemarks.php\">Change Marks</a>";
        if ($_SESSION['usertype'] == "instructors") {
          echo "<a href=\"viewfeedback.php\">View Feedback</a>";
          echo "<a href=\"viewallmarks.php\">View Marks</a>";
        }
      }
  ?>
  <a href="https://markus.utsc.utoronto.ca/cscb20w18/?locale=en">MarkUs</a>
  <a href="contact.php">Contact</a>
  <a href="logout.php">Logout</a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
</div>
</body>
</html>