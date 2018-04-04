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

<script>
  function validate(itemList) {
    var error = false;
    var noneChecked = true;
    for (var i = 0; i < itemList.length; i++) {
      var item = itemList[i];
      var isChecked = document.getElementById(item + "check").checked;
      if (isChecked) {
        noneChecked = false;
        var input = document.getElementById(item + "reason").value.trim();
        if (input == "") {
          document.getElementById(item + "error").innerHTML = "* Reason is required";
          error = true;
        } else if (input.length > 255) {
          document.getElementById(item + "error").innerHTML = "* Must be less than 255 characters";
          error = true;
        } else {
          document.getElementById(item + "error").innerHTML = "";
        }
      } else {
        document.getElementById(item + "error").innerHTML = "";
      }
    }
    if (noneChecked) {
      scroll(0,0);
      alert("You did not select any items to be remarked");
    } else if (!error) {
      // window.location.href = "viewmarks.php?submit=true";
      document.getElementById("mainform").submit();
    } else {
      scroll(0,0);
      alert("You have some errors");
    }
  }  

</script>

<body>
  <?php
  ob_start();
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
  $items_json = json_encode($items);
  $items_json = str_replace("\"", "'",$items_json);

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
      $error = "<div id=\"$item"."error\"class=\"error\"></div>";
      $textbox = "<textarea id=\"$item"."reason\" name=\"$item"."reason\" rows=\"3\"></textarea>";
      $checkbox = "<input id=\"$item"."check\" type=\"checkbox\" name=\"$item"."check\">";
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

    <form id="mainform" method="post" action="">
      <div class="table">
        <?php
        echo $quizformat;
        echo $labformat;
        echo $assignmentformat;
        echo $testformat; 
        ?>
      </div>
    </div>
    
  </form>
  <div class="submitbutton">
    <button id="submit" name="submit" onclick="validate(<?php echo $items_json; ?>)">Submit Requests</button>
  </div>

  <?php
  // Process info after submit has been pressed
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    foreach ($items as $item) {
      if (isset($_POST["$item"."check"])){
        $reason = $_POST["$item"."reason"];
        $requests[] = $reason;
        $updateItems[] = $item;
      }
    }
    $sql = "";
    for ($i = 0; $i < sizeof($requests); $i++) {
      $sql = $sql."INSERT INTO remarks (remarkitem, remarkreason, studentid) VALUES ('$updateItems[$i]', '$requests[$i]', '$studentid'); ";
    }
    if ($db->multi_query($sql)) {
      $_SESSION['success'] = "Your remark request(s) got submitted";
    }
    header("Location: viewmarks.php");
  }
  include('footer.php');
  ?>
</body>

</html>
