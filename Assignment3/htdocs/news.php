<?php
   include('session.php');
?>
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="news.css">
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
    <a href="index.php">Home</a>
    <a href="news.php" class="active">News</a>
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
      <h1>NEWS</h1>
      <br>
      <i class="far fa-newspaper fa-5x"></i>
    </div>
      </div>
    </div>
  <div class="mainsection">
    <h4>January 2, 2018</h4>
    <p>
      Sitting mistake towards his few country ask. You delighted two rapturous six depending objection happiness something the. Off nay impossible dispatched partiality unaffected. Norland adapted put ham cordial. Ladies talked may shy basket narrow see. Him
      she distrusts questions sportsmen. Tolerably pretended neglected on my earnestly by. Sex scale sir style truth ought.
    </p>
  </div>
  <div class="mainsection">
    <h4>February 15, 2018</h4>
    <p>
      Agreed joy vanity regret met may ladies oppose who. Mile fail as left as hard eyes. Meet made call in mean four year it to. Prospect so branched wondered sensible of up. For gay consisted resolving pronounce sportsman saw discovery not. Northward or household
      as conveying we earnestly believing. No in up contrasted discretion inhabiting excellence. Entreaties we collecting unpleasant at everything conviction.
    </p>
  </div>
  <div class="mainsection">
    <h4>March 2, 2018</h4>
    <p>
      Sussex result matter any end see. It speedily me addition weddings vicinity in pleasure. Happiness commanded an conveying breakfast in. Regard her say warmly elinor. Him these are visit front end for seven walls. Money eat scale now ask law learn. Side
      its they just any upon see last. He prepared no shutters perceive do greatest. Ye at unpleasant solicitude in companions interested.
    </p>
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
