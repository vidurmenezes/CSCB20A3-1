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
  include('navbar.php');
  // define variables and set to empty values
  $studentid = $mark = $message = $quizformat = $labformat = $assignmentformat = $testformat = $field = "";
  $err = FALSE;
  $markErr = $items = $marks = array();

  $studentid = $_SESSION['utorid'];
  $quizformat = "<h2>Quizzes<h2><br><div class=\"table\">";
  $labformat = "<h2>Labs<h2><br><div class=\"table\">";
  $assignmentformat = "<h2>Assignments<h2><br><div class=\"table\">";
  $testformat = "<h2>Tests<h2><br><div class=\"table\">";

  $sql = "SHOW COLUMNS FROM marks";
  $result = mysqli_query($db,$sql);
  if ($result->num_rows > 0) {
    while($row = mysqli_fetch_array($result)){
      $field = $row['Field'];
      if ($field != "utorid") {
        $items[] = $field;
      }
    }
  }
  $sql = "SELECT * FROM marks WHERE utorid='$studentid'";
  $result = $db->query($sql);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $studentid = $row['utorid'];
    foreach ($items as $item) {
      $mark = $row["$item"];
      $marks[] = $row["$item"];
      if (stripos($item, 'quiz') !== FALSE) {
        $quizformat = $quizformat."<div class=\"row\"><div class=\"cell\">$item</div><div class=\"cell\">$mark</div><input type=\"checkbox\" name=\"$item"."check"."\">";
      } elseif (stripos($item, 'lab') !== FALSE) {
        $labformat = $labformat."<div class=\"row\"><div class=\"cell\">$item</div><div class=\"cell\">$mark</div><input type=\"checkbox\" name=\"$item"."check"."\">";
      } elseif (stripos($item, 'assignment') !== FALSE) {
        $assignmentformat = $assignmentformat."<div class=\"row\"><div class=\"cell\">$item</div><div class=\"cell\">$mark</div><input type=\"checkbox\" name=\"$item"."check"."\">";
      } elseif (stripos($item, 'test') !== FALSE) {
        $testformat = $testformat."<div class=\"row\"><div class=\"cell\">$item</div><div class=\"cell\">$mark</div><input type=\"checkbox\" name=\"$item"."check"."\">";
      }
    }
  }
  // Pulling all of the inputed data and error checking
  // if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //   for ($i = 0; $i < sizeof($items); $i++) {
  //     $input = test_input($_POST["$items[$i]"]);
  //     if ($input != "") {
  //       if (!is_numeric($input)) {
  //         $markErr[$i] = "* Input must be numeric";
  //         $err = TRUE;
  //       }
  //     }
  //   }
  //   function test_input($data) {
  //     $data = trim($data);
  //     $data = stripslashes($data);
  //     $data = htmlspecialchars($data);
  //     return $data;
  //   }

    ?>

    <div id="background">
      <div id="CourseTitle">
        <div class="myBounceDiv">
          <h1>Your Marks</h1>
          <br>
          <i class="far fa-newspaper fa-5x"></i>
        </div>
      </div>
    </div>

    <div class="mainsection">

      <form method="post" action="">
        <div class="table">
          <?php

          ?>
        </div>
      </div>
      <div class="submitbutton">
        <input id="submit" type="submit" name="submit" value="Submit">
      </div>
    </form>
    <?php
  // Process info after submit has been pressed
  // if(isset($_POST['submit'])){
  //   $sql = "";
  //   if (!$err) {
  //     for ($i = 0; $i < sizeof($uniqueArr); $i++) {
  //       if ($newMark[$i] != "" || is_numeric($newMark[$i])) {
  //         $sql = $sql."UPDATE marks SET $markchoice=$newMark[$i] WHERE utorid='$studentarr[$i]'; ";
  //       }
  //     }
  //     if ($db->multi_query($sql)) {
  //       $message = "All changes have been recorded";
  //       echo "<script type='text/javascript'>alert('$message'); location=\"viewallmarks.php?type=$markchoice\"</script>";

  //     }
  //   }
  // }
    include('footer.php');
    ?>
  </body>

  </html>
