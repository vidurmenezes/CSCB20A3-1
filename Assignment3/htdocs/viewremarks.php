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
  // test mark and remark table
  // echo "<br><br>";
  // $sql = "SELECT * FROM marks";
  // $result = $db->query($sql);
  // if ($result->num_rows > 0) {
  //   while ($row = $result->fetch_assoc()) {
  //     $print = $row['utorid'].": ".$row['quiz1'].", ".$row['quiz2'].", ".$row['assignment1'].", ".$row['assignment2']."<br>";
  //     echo $print;
  //   }
  // }
  // $sql = "SELECT * FROM remarks";
  // $result = $db->query($sql);
  // if ($result->num_rows > 0) {
  //   while ($row = $result->fetch_assoc()) {
  //     $print = $row['requestid'].": ".$row['requeststatus'].", ".$row['remarkitem'].", ".$row['remarkreason'].", ".$row['studentid']."<br>";
  //     echo $print;
  //   }
  // }
  // define variables and set to empty values
  $item = $studentid = $mark = $fullrequest = $message =  "";
  $info = $request = $studentarr = $itemarr = $newMark = $markErr = $unique = array();
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
      $info[] = "StudentID: ".$studentid."<br>Item: ".$item;
      $request[] = "Mark Received: ".$mark."<br>Request Reason: ".$row['remarkreason'];
    }
  }
  // Pulling all of the inputed data and error checking
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    for ($i = 0; $i < sizeof($unique); $i++) {
      $input = test_input($_POST["$unique[$i]"]);
      
      //$double = bcadd($input, "0", 2);
        $double = number_format($input, 2);
      echo $double;
      if ($input != "") {
        if (!is_numeric($input)) {
          $markErr[$i] = "* Input must be numeric";
        } elseif (!(0 <= $double && $double <= 100)) {
          $markErr[$i] = "* Mark must be between 0-100";
        } else {
          $newMark[$i] = $double;
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
    echo "<h3 style=\"text-align: center;\"> No Remark Requests At This Time</h3>";
  } else {
    ?>
    <form method="post" action="">
      <?php
    // Format for each remark request
      for ($i = 0; $i < sizeof($unique); $i++) {
        echo "<div class=\"mainsection\">";
        $fullrequest = $info[$i]."<br>".$request[$i];
        echo $fullrequest;
        echo "<br>";
        echo "<br>";
        echo "New Mark: ";
        echo "<input type=\"text\" name=\"$unique[$i]\" class=\"marks\">";
        echo "<span class=\"error\">".$markErr[$i]."</span><br>";
        echo "</div>";

      }
      ?>
      <div class="submitbutton">
        <input id="submit" type="submit" name="submit" value="Submit">
      </div>
    </form>
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

   if ($db->multi_query($sql) == TRUE) {
      $message = "All changes have been recorded";
      echo "<script type='text/javascript'>alert('$message'); location=\"viewremarks.php\"</script>";
    }
    
  }
  include('footer.php');
  ?>
</body>

</html>
