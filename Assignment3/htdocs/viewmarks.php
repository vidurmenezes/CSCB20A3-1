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
  $quizformat = "Quizzes<br><div class=\"table\"><div class=\"row\"><div class=\"cell\">Item</div><div class=\"cell\">Mark</div><div class=\"cell\">Remark</div></div>";
  $labformat = "Labs<br><div class=\"table\"><div class=\"row\"><div class=\"cell\">Item</div><div class=\"cell\">Mark</div><div class=\"cell\">Remark</div></div>";
  $assignmentformat = "Assignments<br><div class=\"table\"><div class=\"row\"><div class=\"cell\">Item</div><div class=\"cell\">Mark</div><div class=\"cell\">Remark</div></div>";
  $testformat = "Tests<br><div class=\"table\"><div class=\"row\"><div class=\"cell\">Item</div><div class=\"cell\">Mark</div><div class=\"cell\">Remark</div></div>";

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
      $adding = "<div class=\"row\"><div class=\"cell\">$item</div><div class=\"cell\">$mark</div><div class=\"cell\"><input type=\"checkbox\" name=\"$item"."check"."\"></div></div><textarea id=\"$item\" name=\"$item"."req"."\" rows=\"3\"></textarea>";
      if (stripos($item, 'quiz') !== FALSE) {
        $quizformat = $quizformat.$adding;
      } elseif (stripos($item, 'lab') !== FALSE) {
        $labformat = $labformat.$adding;
      } elseif (stripos($item, 'assignment') !== FALSE) {
        $assignmentformat = $assignmentformat.$adding;
      } elseif (stripos($item, 'test') !== FALSE) {
        $testformat = $testformat.$adding;
      }
    }
    $quizformat = $quizformat."</div><br>";
    $labformat = $labformat."</div><br>";
    $assignmentformat = $assignmentformat."</div><br>";
    $testformat = $testformat."</div><br>";
  }
  // Pulling all of the inputed data and error checking
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    for ($i = 0; $i < sizeof($items); $i++) {
      if (isset($_POST["$items[$i]"."check"])){
        if (empty($_POST["$items[$i]"."req"])) {
          $requestErr[] = "Reason is required";
          $err = TRUE;
        } else {
          $reason = $_POST["$items[$i]"."req"];
          $requests[] = $reason;
          $updateItems[] = $items[$i];
          if (isset($reason[255])) {
            $err = TRUE;
            $requestErr[] = "Answer cannot exceed 255 characters";
          }
        }
      }
    }
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
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
        // echo $updateItems[$i]." ".$requests[$i]." ".$studentid;
      }
      if ($db->multi_query($sql)) {
        $message = "Your remark request(s) got submitted";
        echo "<script type='text/javascript'>alert('$message'); location=\"viewmarks.php\"</script>";
      } else {
        $message = "Error writing to database";
        echo "<script type='text/javascript'>alert('$message');</script>";
      }
    } else {
      $message = "You have some errors in input";
      echo "<script type='text/javascript'>alert('$message');</script>";
    }
  }
  include('footer.php');
  ?>
</body>

</html>
