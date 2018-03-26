<?php
   include('session.php');
?>
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="index.css">
  <link rel="stylesheet" type="text/css" href="navbar.css">
  <link rel="stylesheet" type="text/css" href="footer.css">
   <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script><!--Used fontawesome for icons -->
   <link href="https://fonts.googleapis.com/css?family=Nunito+Sans" rel="stylesheet"> <!--Used google fonts for some fonts -->
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
    <a href="index.php" class="active">Home</a>
    <a href="news.php">News</a>
    <a href="calendar.php">Calendar</a>
    <a href="https://piazza.com/class/jcpjjp5l4bywd">Piazza</a>
    <a href="lectures.php">Lectures</a>
    <a href="labs.php">Labs</a>
    <a href="assignment.php">Assignments</a>
    <a href="https://docs.google.com/forms/d/e/1FAIpQLSfVx2TGzeBfwGCbDxO-3J21F73uBlIlM-dcIW__ZesKLMYBnQ/viewform">Feedback</a>
    <a href="https://markus.utsc.utoronto.ca/cscb20w18/?locale=en">MarkUs</a>
    <a href="contact.php">Contact</a>
    <a href="logout.php">Logout</a>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
  </div>
  <div id="background">
    <div id="CourseTitle">
       <div class="myBounceDiv">
      <h1>Welcome To CSCB20 <?php echo $_SESSION['login_user']; ?></h1>
         <i class="fas fa-laptop fa-4x"></i>
        </div>
    </div>
  </div>

  <div class="mainsection">
    <h2> Course Description</h2>

    <p>A practical introduction to databases and Web app development. Databases: terminology and applications; creating, querying and updating databases; the entity-relationship model for database design. Web documents and applications: static and interactive
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
</body>

</html>
