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
// define variables and set to empty values
  $answer1 = $answer2 = $answer3 = $answer4 = "";
  $answer1Err = $answer2Err = $answer3Err = $answer4Err = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["answer1"])) {
      $answer1Err = "Answer is required";
    } else {
      $answer1 = test_input($_POST["answer1"]);
      if (isset($answer1[255])) {
        $answer1Err = "Answer cannot exceed 255 characters";
      }
    }
    if (empty($_POST["answer2"])) {
      $answer2Err = "Answer is required";
    } else {
      $answer2 = test_input($_POST["answer2"]);
      if (isset($answer2[255])) {
        $answer2Err = "Answer cannot exceed 255 characters"; 
      }
    }
    if (empty($_POST["answer3"])) {
      $answer3Err = "Answer is required";
    } else {
      $answer3 = test_input($_POST["answer3"]);
      if (isset($answer3[255])) {
        $answer3Err = "Answer cannot exceed 255 characters"; 
      }
    }
    if (empty($_POST["answer4"])) {
      $answer4Err = "Answer is required";
    } else {
      $answer4 = test_input($_POST["answer4"]);
      if (isset($answer4[255])) {
        $answer4Err = "Answer cannot exceed 255 characters"; 
      }
    }

    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
  }
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
    <p><span class="error">* required field.</span></p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <?php
      $column = array();
      $sql = "SELECT Question FROM feedbackquestions";
      $result = $db->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $column[] = $row['Question'];
        }
      } else {
        echo "0 results";
      }
      echo $column[0];
      echo "  "."<span class=\"error\">*".$answer1Err."</span>";
      echo "<br>";
      echo "<textarea name=\"comment\" rows=\"5\">".$answer1."</textarea>";
      echo "<br>";
      echo $column[1];
      echo "  "."<span class=\"error\">*".$answer2Err."</span>";
      echo "<br>";
      echo "<textarea name=\"comment\" rows=\"5\">".$answer2."</textarea>";
      echo "<br>";
      echo $column[2];
      echo "  "."<span class=\"error\">*".$answer3Err."</span>";
      echo "<br>";
      echo "<textarea name=\"comment\" rows=\"5\">".$answer3."</textarea>";
      echo "<br>";
      echo $column[3];
      echo "  "."<span class=\"error\">*".$answer4Err."</span>";
      echo "<br>";
      echo "<textarea name=\"comment\" rows=\"5\">".$answer4."</textarea>";
      echo "<br>";
      ?>
      <input id="submit" type="submit" name="submit" value="Submit">
    </div>
    <?php
    include('footer.php');
    ?>
  </body>

  </html>
