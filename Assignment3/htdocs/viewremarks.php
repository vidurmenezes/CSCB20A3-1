<?php
include('session.php');
?>
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="viewremarks.css">

  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script><!--Used fontawesome for icons -->
  <link href="https://fonts.googleapis.com/css?family=Nunito+Sans" rel="stylesheet"> <!--Used google fonts for some fonts -->
</head>

<body>
  <?php
  ob_start();
  include('navbar.php');
  // define variables and set to empty values
  $item = $studentid = $mark = $fullrequest = $message =  "";
  $info = $request = $studentarr = $itemarr = $newMark = $markErr = $unique = array();

  if ($_SESSION['success'] != "") {
    $success = $_SESSION['success'];
    echo "<script type='text/javascript'>alert('$success');</script>";
  }
  $_SESSION['success'] = "";

  // Setting up all the arrays and variables
  $sql = "SELECT requestid, remarkitem, remarkreason, studentid FROM remarks WHERE requeststatus=1";
  $result = $db->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $item = $row['remarkitem'];
      $itemarr[] = $item;
      $studentid = $row['studentid'];
      $studentarr[] = $studentid;
      // Unique would be the combination of the studentid and item they want remarked.
      // This would be the name of each input box to be retreived later
      $unique[] = $studentid.$item;
      $sql = "SELECT $item FROM marks WHERE utorid='$studentid'";
      $mark = $db->query($sql)->fetch_assoc()[$item];
      $info[] = "<br><b class=\"miniheaders\">StudentID:</b>".$studentid."<br><b class=\"miniheaders\">Item:</b>".$item;
      $request[] = "<b class=\"miniheaders\">Mark Received: </b>".$mark."<br><b class=\"miniheaders\">Request Reason:  </b>".$row['remarkreason'];
    }
  }
  // Pulling all of the inputed data and error checking
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    for ($i = 0; $i < sizeof($unique); $i++) {
      $input = test_input($_POST["$unique[$i]"]);
      if ($input != "") {
        if (!is_numeric($input)) {
          $markErr[$i] = "* Input must be numeric";
        } elseif (!(0 <= $input && $input <= 100)) {
          $markErr[$i] = "* Mark must be between 0-100";
        } else {
          $newMark[$i] = $input;
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

  ?>

  <div id="background">
    <div id="CourseTitle">
      <div class="myBounceDiv">
        <h1>Remark Requests</h1>
        <br>
        <i class="far fa-newspaper fa-5x"></i>
      </div>
    </div>
  </div>
  <?php
  if (sizeof($unique) == 0) {
   echo "<div class='alert'>";
   echo "<span class='closebtn' onclick=\"this.parentElement.style.display='none';\"></span>";
   echo "<strong>&nbsp;&nbsp;No Remark Requests At This Time</strong>";
   echo "</div>";

 } else {
  ?>
  <form method="post" action="">
    <?php
    // Format for each remark request
    for ($i = 0; $i < sizeof($unique); $i++) {
      echo "<div id=\"mainsection\" class=\"myBounceDiv\">";
      $fullrequest = $info[$i]."<br>".$request[$i];
      echo $fullrequest;
      echo "<br>";
      echo "<br>";
      echo "<b class=\"miniheaders\">New Mark:</b> ";
      echo "<input type=\"text\" name=\"$unique[$i]\" class=\"marks\">";
      echo "<span class=\"error\">".$markErr[$i]."</span><br>";
      echo "</div>";

    }
    ?>
    <input id="submit" type="submit" name="submit" value="Submit">
  </form>
  <br>
  <?php
}

?>
<?php
  // Process info after submit has been pressed
if(isset($_POST['submit'])){
  $sql = "";
  for ($i = 0; $i < sizeof($unique); $i++) {
    if (($newMark[$i] != "" || is_numeric($newMark[$i])) && $markErr[$i] == "") {
      $sql = $sql."UPDATE marks SET $itemarr[$i]=$newMark[$i] WHERE utorid='$studentarr[$i]'; UPDATE remarks SET requeststatus=0 WHERE studentid='$studentarr[$i]' AND remarkitem = '$itemarr[$i]'; ";
    }
  }
  if ($db->multi_query($sql)) {
    $_SESSION['success'] = "New marks successfully submitted";
    header("Location: viewremarks.php");
  }
}
include('footer.php');
?>
</body>

</html>
