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
  // test feedback and remark table
  // $sql = "SELECT * FROM marks";
  // $result = $db->query($sql);
  // if ($result->num_rows > 0) {
  //   while ($row = $result->fetch_assoc()) {
  //     $print = $row['utorid'].": ".$row['quiz1'].", ".$row['quiz2'].", ".$row['assignment1'].", ".$row['assignment2']."<br>";
  //     echo $print;
  //   }
  //   $sql = "SELECT * FROM remarks";
  //   $result = $db->query($sql);
  //   if ($result->num_rows > 0) {
  //     while ($row = $result->fetch_assoc()) {
  //       $print = $row['requestid'].": ".$row['requeststatus'].", ".$row['remarkitem'].", ".$row['remarkreason'].", ".$row['studentid']."<br>";
  //       echo $print;
  //     }
  //   }
  // define variables and set to empty values
    $item = $studentid = $mark = $fullrequest = "";
    $info = $request = $studentarr = $itemarr = $newMark = $markErr = $unique = array();
    $sql = "SELECT requestid, remarkitem, remarkreason, studentid FROM remarks WHERE requeststatus=1";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $item = $row['remarkitem'];
        $itemarr[] = $item;
        $studentid = $row['studentid'];
        $studentarr[] = $studentid;
        $unique[] = $studentid.$item;
        $sql = "SELECT $item FROM marks WHERE utorid='$studentid'";
        $mark = $db->query($sql)->fetch_assoc()[$item];
        $info[] = "StudentID: ".$studentid."<br>Item: ".$item;
        $request[] = "Mark Received: ".$mark.".<br>Request Reason: ".$row['remarkreason'];
      }
    } else {
      echo "0 results";
    }

    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //   for ($i = 0; $i < sizeof($unique); $i++) {
    //     $newMark[] = test_input($_POST["$unique[$i]"]);
    //     if (!preg_match("^[-+]?([0-9]|[1-9][0-9]|100)*\.?[0-9]+$"), $newMark[]) {
    //       $markErr[] = "Mark must be between 0-100";
    //     }
    //   }
    // }
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

    <form method="post" action="">
      <?php
      for ($i = 0; $i < sizeof($info); $i++) {
        echo "<div class=\"mainsection\">";
        $fullrequest = $info[$i]."<br>".$request[$i];
        echo $fullrequest;
        echo "<br>";
        echo "<br>";
        echo "New Mark: ";
        // echo "<input type=\"text\" name=\"$unique[$i]\" class=\"marks\" >"
        echo "</div>";

      }
      ?>
      <input id="submit" type="submit" name="submit" value="Submit">
    </form>
    <?php
    if(isset($_POST['submit'])){
      if ($markErr == '') {
        $sql = "";
        for ($i = 0; $i < sizeof($info); $i++) {
          if (empty($_POST($newMark[$i]))){
            $sql = $sql."UPDATE marks SET $item[$i]=$newMark[$i] WHERE utorid='$studentarr[$i]'; UPDATE remarks SET requeststatus=0 WHERE studentid='$studentarr[$i]';";
          }
        }
       //  if ($db->query($sql) == TRUE) {
       //    $message = "All changes have been recorded";
       //    echo "<script type='text/javascript'>alert('$message'); location=\"viewremarks.php\"</script>";
       //  } else {
       //   $message = "Error: ".$sql."<br>".$db->error;
       //   echo "<script type='text/javascript'>alert('$message');</script>";
       // }
     }
   }
   include('footer.php');
   ?>
 </body>

 </html>
