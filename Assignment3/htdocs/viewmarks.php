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
  $studentid = $mark = $message = $quizformat = $labformat = $assignmentformat = $testformat = $field = $remarks = $reason = $sqlcheck = $success = $textbox = $checkbox = $adding = "";
  $err = FALSE;
  $requestErr = $items = $marks = $requests = $updateItems = array();
  $studentid = $_SESSION['utorid'];

  if ($_SESSION['success'] != "") {
    $success = $_SESSION['success'];
    echo "<script type='text/javascript'>alert('$success');</script>";
  }
  $_SESSION['success'] = "";

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
  // Sort so that items are displayed in order
  sort($items);

  $quizformat = "Quizzes";
  $labformat = "Labs";
  $assignmentformat = "Assignments";
  $testformat = "Tests";

  $adding = "<br><div class=\"table\"><div class=\"row\"><div class=\"cell\">Item</div><div class=\"cell\">Mark</div><div id=\"remark\" class=\"cell\">Remark</div></div><br>";

  $quizformat = $quizformat.$adding;
  $labformat = $labformat.$adding;
  $assignmentformat = $assignmentformat.$adding;
  $testformat = $testformat.$adding;

  $sql = "SELECT * FROM marks WHERE utorid='$studentid'";
  $result = $db->query($sql);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $studentid = $row['utorid'];
    foreach ($items as $item) {
      $mark = $row["$item"];
      $marks[] = $row["$item"];
      $error = "<span class=\"error\">".$_SESSION["err"]["$item"."err"]."</span>";
      $textbox = "<textarea id=\"$item\" name=\"$item"."req"."\" rows=\"3\">".$_SESSION["req"]["$item"."req"]."</textarea>";
      $checkbox = "<input id=\"remark\" type=\"checkbox\" name=\"$item"."check"."\"".$_SESSION["req"]["$item"."check"].">";
      $adding = "<div class=\"row\"><div class=\"cell\">$item</div><div class=\"cell\">$mark</div><div class=\"cell\">".$checkbox."</div></div>".$textbox."<div class=\"cell\"></div><div class=\"cell\">".$error."</div>";

      if (stripos($item, 'quiz') !== FALSE) {
        $quizformat = $quizformat.$adding;
      } elseif (stripos($item, 'lab') !== FALSE) {
        $labformat = $labformat.$adding;
      } elseif (stripos($item, 'assignment') !== FALSE) {
        $assignmentformat = $assignmentformat.$adding;
      } elseif ((stripos($item, 'midterm') !== FALSE) || (stripos($item, 'exam') !== FALSE)) {
        $testformat = $testformat.$adding;
      }
    }
    $quizformat = $quizformat."</div><br>";
    $labformat = $labformat."</div><br>";
    $assignmentformat = $assignmentformat."</div><br>";
    $testformat = $testformat."</div><br>";
  }

  $_SESSION["err"] = array();
  $_SESSION["req"] = array();

  // Pulling all of the inputed data and error checking
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($items as $item) {
      $requestErr[$item] = "";
      
      if (isset($_POST["$item"."check"])){
        $sqlcheck = "SELECT requeststatus FROM remarks WHERE remarkitem='$item' AND studentid='$studentid'";
        $_SESSION["req"]["$item"."check"] = "checked";
        $result = mysqli_query($db,$sqlcheck);
        if (mysqli_query($db,$sqlcheck)->num_rows > 0) {
          $requestErr[$item] = "* Request already submitted";
          $_SESSION["err"]["$item"."err"] = $requestErr[$item];
          $err = TRUE;
        } else {
          if (empty($_POST["$item"."req"])) {
            $requestErr[$item] = "* Reason is required";
            $_SESSION["err"]["$item"."err"] = $requestErr[$item];
            $err = TRUE;
          } else {
            $reason = $_POST["$item"."req"];
            $_SESSION["req"]["$item"."req"] = $reason;
            $requests[] = $reason;
            $updateItems[] = $item;
            if (isset($reason[255])) {
              $err = TRUE;
              $requestErr[$item] = "* Answer cannot exceed 255 characters";
              $_SESSION["err"]["$item"."err"] = $requestErr[$item];
            }
          }
        }
      }
    }
  }
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
        echo $quizformat;
        echo $labformat;
        echo $assignmentformat;
        echo $testformat;
        ?>
      </div>
    </div>
    <div class="submitbutton">
      <input id="submit" type="submit" name="submit" value="Submit Requests">
    </div>
    
  </form>
  
  <?php
  // Process info after submit has been pressed
  if(isset($_POST['submit'])){
    $sql = "";
    if (!$err) {
      for ($i = 0; $i < sizeof($requests); $i++) {
        $sql = $sql."INSERT INTO remarks (remarkitem, remarkreason, studentid) VALUES ('$updateItems[$i]', '$requests[$i]', '$studentid'); ";
      }
      if ($db->multi_query($sql)) {
        $_SESSION['success'] = "Your remark request(s) got submitted";
        $_SESSION["req"] = array();
        $_SESSION["err"] = array();
      }
    } 
    else {
      $_SESSION['success'] = "You have some errors in input";
    }
    header("Location: viewmarks.php");
    exit();
  }
  include('footer.php');
  ?>
</body>

</html>
