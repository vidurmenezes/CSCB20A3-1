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
  $studentid = $mark = $message = $quizformat = $labformat = $assignmentformat = $testformat = $field = $remarks = $reason = "";
  $err = FALSE;
  $requestErr = $items = $marks = $requests = $updateItems = array();

  $studentid = $_SESSION['utorid'];

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
  // Pulling all of the inputed data and error checking
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($items as $item) {
      $requestErr[$item] = "";
      if (isset($_POST["$item"."check"])){
        if (empty($_POST["$item"."req"])) {
          $requestErr[$item] = "* Reason is required";
          $err = TRUE;
        } else {
          $reason = $_POST["$item"."req"];
          $requests[] = $reason;
          $updateItems[] = $item;
          if (isset($reason[255])) {
            $err = TRUE;
            $requestErr[$item] = "* Answer cannot exceed 255 characters";
          }
        }
      }
    }
  }

  
  // function toggleContent($item) {
  // // Get the DOM reference
  //   echo $item;
  //   echo "<script>
  //   var contentId = document.getElementById($item);
  //   contentId.style.display == \"block\" ? contentId.style.display = \"none\" : 
  //   contentId.style.display = \"block\"; 
  //   </script>";
  // }

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
        $quizformat = "Quizzes";
        $labformat = "Labs";
        $assignmentformat = "Assignments";
        $testformat = "Tests";

        $adding = "<br><div class=\"table\"><div class=\"row\"><div class=\"cell\">Item</div><div class=\"cell\">Mark</div><div id=\"remark\" class=\"cell\">Remark</div></div>";

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
            $adding = "<div class=\"row\"><div class=\"cell\">$item</div><div class=\"cell\">$mark</div><div class=\"cell\"><input id=\"remark\" type=\"checkbox\" name=\"$item"."check"."\"></div></div><textarea id=\"$item\" name=\"$item"."req"."\" rows=\"3\">".$_POST["$item"."req"]."</textarea> <span class=\"error\">".$requestErr[$item]."</span>";

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
        echo $quizformat;
        echo $labformat;
        echo $assignmentformat;
        echo $testformat;
        ?>
      </div>
    </form>
  </div>

  <div class="submitbutton">
    <input id="submit" type="submit" name="submit" value="Submit Requests">
  </div>
  
  <?php
  // Process info after submit has been pressed
  if(isset($_POST['submit'])){
    $sql = "";
    if (!$err) {
      for ($i = 0; $i < sizeof($requests); $i++) {
        $sql = $sql."INSERT INTO remarks (remarkitem, remarkreason, studentid) VALUES ('$updateItems[$i]', '$requests[$i]', '$studentid'); ";
      }
      if ($db->multi_query($sql)) {
        $message = "Your remark request(s) got submitted";
        // echo "<script type='text/javascript'>alert('$message'); location=\"viewmarks.php\"</script>";
      } else {
        $message = "No remark requests were submitted";
        // echo "<script type='text/javascript'>alert('$message');</script>";
      }
    } 
    else {
      $message = "You have some errors in input";
      // echo "<script type='text/javascript'>alert('$message');</script>";
    }
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
  }
  include('footer.php');
  ?>
</body>

</html>
