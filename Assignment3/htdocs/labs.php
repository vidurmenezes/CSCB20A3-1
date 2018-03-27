<?php
   include('session.php');
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="labs.css">
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script><!--Used fontawesome for icons -->
<link href="https://fonts.googleapis.com/css?family=Nunito+Sans" rel="stylesheet"> <!--Used google fonts for some fonts -->

</head>
<script>
  function toggle_visibility(id) {
    var e = document.getElementById(id);
    if (e.style.display == 'block')
      e.style.display = 'none';
    else
      e.style.display = 'block';
  }
    function toggle_visibility_all(id) {
        for (i = 1; i < 100; i++) {
            var text="";
            text += id + i;
            //document.write(text);
            var e = document.getElementById(text);

            if (e.style.display == 'block')
              e.style.display = 'none';
            else
              e.style.display = 'block';
            }

        }

</script>
<body>
  <?php
    include('navbar.php');
  ?>
     <div id="background">
  <div id="CourseTitle">
 <div class="myBounceDiv">
    <h1>LABS</h1>
      <br>
      <i class="fas fa-flask fa-5x"></i>
      </div>
  </div>
</div>
    <a onclick="toggle_visibility_all('Week');">
 <div class="title">
      EXPAND ALL
    </div>
        </a>
    <br>

  <div class="space">
    <a onclick="toggle_visibility('Week1');">
    <div class="title">
      LAB 1
    </div>
    </a>
    <div class="standard" id="Week1">
      <div class="center">
        <h3><u>Extra Material</u></h3>
        <ul id="extralinks">
          <li>
            What is a database? Very high level introduction to a Database.
            <br>
            <a href="http://web.calstatela.edu/library/whatisadatabase.htm">http://web.calstatela.edu/library/whatisadatabase.htm</a>
          </li>
          <li>
            A basic tutorial on SQL
            <br>
            <a href="https://www.w3resource.com/sql/tutorials.php">https://www.w3resource.com/sql/tutorials.php</a>
          </li>
          <li>
            Basic introduction to SQL
            <br>
            <a href=" https://www.w3schools.com/sql/"> https://www.w3schools.com/sql/</a>
          </li>
          <li>
            Difference between a Primary and a Foreign Key
            <br>
            <a href="https://www.essentialsql.com/what-is-the-difference-between-a-primary-key-and-a-foreign-key/">https://www.essentialsql.com/what-is-the-difference-between-a-primary-key-and-a-foreign-key/</a>
          </li>
        </ul>
      </div>
    </div>
  </div>


  <div class="space">
     <a onclick="toggle_visibility('Week2');">
    <div class="title">
        LAB 2
    </div>
    </a>
    <div class="standard" id="Week2">
      <div class="center">
        <ul id="weeklist">
          <div id="topic">
            Introduction, Databases background
          </div>
          <div>
            <h3><u>Summary</u></h3>
            <ul id="summary">
              <li>Expectations of the course.</li>
              <li>What is a database?</li>
              <li>What database technologies and web technologies are covered in this course? </li>
              <li>SQL and PHP</li>
              <li>HTML, CSS, JavaScript and JQuery</li>
              <li>What is a internet?</li>
              <li>network of computers and routers.</li>
              <li>What is a protocol?</li>
              <li>We looked at briefly the http protocol and from a very high level understood the request/response workflow.</li>
              <li>Relation in Database</li>
              <li>Tuple, record, data row (all mean the same thing). And a collection of these makes up a Relation. </li>
              <li>Relation Schema (what columns/relation name)</li>
              <li>Database Schema</li>
              <li>Foriegn Key and Primary Key</li>
            </ul>
            <h3><u>Lecture Material</u></h3>

            <ul id="lecturelinks">
              <li>
                <a href="https://portal.utoronto.ca/bbcswebdav/pid-6516926-dt-content-rid-42416763_2/courses/Winter-2018-CSCB20H3-S-LEC01/B20Week1.pdf">B20Week1.pdf</a>
              </li>
              <li>
                <a href="https://portal.utoronto.ca/bbcswebdav/pid-6516926-dt-content-rid-42416762_2/courses/Winter-2018-CSCB20H3-S-LEC01/B20Week2.pdf">B20Week2.pdf</a>
              </li>
            </ul>
          </div>
        </ul>
      </div>
    </div>
  </div>

    <div class="space">
    <a onclick="toggle_visibility('Week3');">
    <div class="title">
    LAB 3
    </div>
    </a>
    <div class="standard" id="Week3">
      <div class="center">
        <ul id="weeklist">
          <div id="topic">
            Introduction, Databases background
          </div>
          <div>
            <h3><u>Summary</u></h3>
            <ul id="summary">
              <li>Expectations of the course.</li>
              <li>What is a database?</li>
              <li>What database technologies and web technologies are covered in this course? </li>
              <li>SQL and PHP</li>
              <li>HTML, CSS, JavaScript and JQuery</li>
              <li>What is a internet?</li>
              <li>network of computers and routers.</li>
              <li>What is a protocol?</li>
              <li>We looked at briefly the http protocol and from a very high level understood the request/response workflow.</li>
              <li>Relation in Database</li>
              <li>Tuple, record, data row (all mean the same thing). And a collection of these makes up a Relation. </li>
              <li>Relation Schema (what columns/relation name)</li>
              <li>Database Schema</li>
              <li>Foriegn Key and Primary Key</li>
            </ul>
            <h3><u>Lecture Material</u></h3>

            <ul id="lecturelinks">
              <li>
                <a href="https://portal.utoronto.ca/bbcswebdav/pid-6516926-dt-content-rid-42416763_2/courses/Winter-2018-CSCB20H3-S-LEC01/B20Week1.pdf">B20Week1.pdf</a>
              </li>
              <li>
                <a href="https://portal.utoronto.ca/bbcswebdav/pid-6516926-dt-content-rid-42416762_2/courses/Winter-2018-CSCB20H3-S-LEC01/B20Week2.pdf">B20Week2.pdf</a>
              </li>
            </ul>
          </div>
        </ul>
      </div>
    </div>
  </div>
    <div class="space">
    <a onclick="toggle_visibility('Week4');">
    <div class="title">
     LAB 4
    </div>
    </a>
    <div class="standard" id="Week4">
      <div class="center">
        <ul id="weeklist">
          <div id="topic">
            Introduction, Databases background
          </div>
          <div>
            <h3><u>Summary</u></h3>
            <ul id="summary">
              <li>Expectations of the course.</li>
              <li>What is a database?</li>
              <li>What database technologies and web technologies are covered in this course? </li>
              <li>SQL and PHP</li>
              <li>HTML, CSS, JavaScript and JQuery</li>
              <li>What is a internet?</li>
              <li>network of computers and routers.</li>
              <li>What is a protocol?</li>
              <li>We looked at briefly the http protocol and from a very high level understood the request/response workflow.</li>
              <li>Relation in Database</li>
              <li>Tuple, record, data row (all mean the same thing). And a collection of these makes up a Relation. </li>
              <li>Relation Schema (what columns/relation name)</li>
              <li>Database Schema</li>
              <li>Foriegn Key and Primary Key</li>
            </ul>
            <h3><u>Lecture Material</u></h3>

            <ul id="lecturelinks">
              <li>
                <a href="https://portal.utoronto.ca/bbcswebdav/pid-6516926-dt-content-rid-42416763_2/courses/Winter-2018-CSCB20H3-S-LEC01/B20Week1.pdf">B20Week1.pdf</a>
              </li>
              <li>
                <a href="https://portal.utoronto.ca/bbcswebdav/pid-6516926-dt-content-rid-42416762_2/courses/Winter-2018-CSCB20H3-S-LEC01/B20Week2.pdf">B20Week2.pdf</a>
              </li>
            </ul>
          </div>
        </ul>
      </div>
    </div>
  </div>
<?php
   include('footer.php');
?>

</body>

</html>
