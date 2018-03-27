<?php
   include('session.php');
?>
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="assignment.css">
  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script> <!--Used fontawesome for icons -->
  <link href="https://fonts.googleapis.com/css?family=Nunito+Sans" rel="stylesheet"> <!--Used google fonts for some fonts -->


</head>

<body>
  <?php
    include('navbar.php');
  ?>
  <div id="background">
    <div id="CourseTitle">
        <div class="myBounceDiv">
      <h1>Assignments</h1>

      <br>
      <i class="fas fa-file-alt fa-5x"></i>
        </div>
    </div>
  </div>

  <div class="fwb-blue">
    <div class="subtitleparbox">
      <h2 class="subtitle"> <u>Course Description</u></h2>
      <div class="subtitlepara">
        <p>Here are the assignment and exercise topics, weights, and due dates. I will be posting the exercise and assignment handouts here. All exercises and assignments will be submitted on MarkUs.</p>
      </div>

      <div class="fwb-bluecontentleft">
        <div class="space">
          <div class="card">
            <div class="title">
              <div class="container">
                <h4><b>1) Relational Algebra and MySQL</b></h4>
                <a class="title" href="https://www.utsc.utoronto.ca/~bretscher/b20/assignments/a1/">
                  <p>Handout</p>
                </a>
                <div class="assignmentpara">
                  <p class="center">
                    Part 1. Wednesday Feb. 1, 11.59pm<br> UPDATED Part 2 and 3. For 5% bonus Saturday Feb. 11, 11.59pm or Friday Feb. 17, 11.59 <br> You can download a dumpfile for IMDB_SMALL here. To use it type mysql -u utorid -p IMDB_SMALL.sql
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="fwb-bluecontentright">
        <div class="space">
          <div class="card">
            <div class="container">
              <h4><b>2) HTML, CSS, PHP</b></h4>
              <a href="http://mathlab.utsc.utoronto.ca/courses/cscb20w17/bretsche/assignments/a2/a2.html">
                <p>H2 zip</p>
              </a>
              <div class="assignmentpara">
                <p class="center">
                  Part 1: Worth 50% Friday March. 10, 11.59pm
                  <br> Part 2: Worth 50% Friday March. 19, 11.59pm
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="fwb-blue">
      <div class="fwb-bluecontentleft">
        <div class="space">
          <div class="card">
            <div class="container">
              <h4><b>3) Web Application and Database</b></h4>
              <a href="http://www.utsc.utoronto.ca/bretscher/b20/assignments/a3/a3_marking_scheme.txt">
                <p>Marking Scheme for A3 Handout
                </p>
              </a>
              <div class="assignmentpara">
                <p class="center">
                  Friday March 31, 11.59pm
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="fwb-bluecontentright">
        <div class="space">
          <div class="card">

            <div class="title">
              <div class="container">
                <h4><b>4) More to come Soon</b></h4>
                <p>Architect & Engineer</p>
                <div class="assignmentpara">
                  <p class="center">
                    Coming soon to a UTSC near you
                  </p>

                </div>
              </div>

            </div>

          </div>

        </div>
      </div>
    </div>
  </div>
<?php
   include('footer.php');
?>
</body>

</html>
