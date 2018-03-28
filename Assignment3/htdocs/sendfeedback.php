<?php
include('session.php');
?>
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="sendfeedback.css">
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
        <h1>Anonymous Feedback</h1>
        <br>
        <i class="far fa-newspaper fa-5x"></i>
      </div>
    </div>
  </div>
  <div id="instchoice" class="dropdown">
    <h2>Choose The Target Instructor</h2>
    <select name="instructors">
      <?php
      $sql = "SELECT firstname, lastname, utorid FROM instructors";
      $result = $db->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<option value=\"".$row['utorid']."\">".$row['firstname']." ".$row['lastname']."</option>";
        }
      } else {
        echo "<option>0 results</option>";
      }
      ?>
    </select>
  </div>
  <div class="mainsection">
    <?php
    $sql = "SELECT Question FROM feedbackquestions";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo $row['Question'];
        echo "<br>";
      }
    } else {
      echo "0 results";
    }
    ?>
  </div>
  <?php
  include('footer.php');
  ?>
</body>

</html>
