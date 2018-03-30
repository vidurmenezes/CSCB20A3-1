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
  include('navbar.php');
  // test feedback table
  // $sql = "SELECT instructorid, question1, question2, question3, question4 FROM feedback";
  // $result = $db->query($sql);
  // if ($result->num_rows > 0) {
  //   while ($row = $result->fetch_assoc()) {
  //     $print = $row['instructorid'].": ".$row['question1'].", ".$row['question2'].", ".$row['question3'].", ".$row['question4']."<br>";
  //     echo $print;
  //   }
  // }
  // define variables and set to empty values
  $item = $studentid = $mark = $fullrequest = "";
  $info = $request = $newMark = $markErr = array();
  $sql = "SELECT requestid, remarkitem, remarkreason, studentid FROM remarks WHERE requeststatus=1";
  $result = $db->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $item = $row['remarkitem'];
      $studentid = $row['studentid'];
      $sql = "SELECT $item FROM marks WHERE utorid='$studentid'";
      $mark = $db->query($sql)->fetch_assoc()[$item];
      $info[] = "StudentID: ".$studentid."<br>Item: ".$item;
      $request[] = "Mark Received: ".$mark.".<br>Request Reason: ".$row['remarkreason'];
    }
  } else {
    echo "0 results";
  }

  // if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //   $instructor = $_POST["instructors"];
  //   if (empty($_POST["answer1"])) {
  //     $answer1Err = "Answer is required";
  //   } else {
  //     $answer1 = test_input($_POST["answer1"]);
  //     if (isset($answer1[255])) {
  //       $answer1Err = "Answer cannot exceed 255 characters";
  //     }
  //   }
  // }
  // function test_input($data) {
  //   $data = trim($data);
  //   $data = stripslashes($data);
  //   $data = htmlspecialchars($data);
  //   return $data;
  // }

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
    for ($i = 0; $i < sizeof($info); $i++) {
      echo "<div class=\"mainsection\">";
      $fullrequest = $info[$i]."<br>".$request[$i];
      echo $fullrequest;
      echo "<br>";
      echo "</div>";

    }
  ?>


  <?php
  include('footer.php');
  ?>
</body>

</html>
