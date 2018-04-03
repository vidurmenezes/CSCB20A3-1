<?php
include('session.php');
?>
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="viewallmarks.css">
  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script><!--Used fontawesome for icons -->
  <link href="https://fonts.googleapis.com/css?family=Nunito+Sans" rel="stylesheet"> <!--Used google fonts for some fonts -->
</head>

<body>
  <?php
  include('navbar.php');
  // define variables and set to empty values
  $studentid = $mark = $message =  $choice = $markchoice = "";
  $err = FALSE;
  $studentarr = $newMark = $markErr = $currMark = array();
  if ($_GET["type"]) {
    $markchoice = $_GET["type"];
    $sql = "SELECT utorid, $markchoice FROM marks";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $id =  $row['utorid'];
        $studentarr[] = $id;
        $mark = $row["$markchoice"];
        $currMark[] = $mark;
      }
    }
  }
  // Pulling all of the inputed data and error checking
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    for ($i = 0; $i < sizeof($studentarr); $i++) {
      $input = $_POST["$studentarr[$i]"];
      if ($input != "") {
        if (!is_numeric($input)) {
          $markErr[$i] = "* Input must be numeric";
          $err = TRUE;
        } elseif (!(0 <= $input && $input <= 100)) {
          $err = TRUE;
          $markErr[$i] = "* Mark must be between 0-100";
        } else {
          $newMark[$i] = $input;
        }
      }
    }
  }

  function reload($data) {
    header("viewallmarks.php?type=".$data);
  }

  ?>

  <div id="background">
    <div id="CourseTitle">
      <div class="myBounceDiv">
        <h1>Class Marks</h1>
        <br>
        <i class="far fa-newspaper fa-5x"></i>
      </div>
    </div>
  </div>

  <div id="markchoice" class="dropdown">
    <h2>Choose The Assessment Item</h2>
    <form id="choice" method="post">
      <select name="markcolumns">
        <?php
        $sql = "SHOW COLUMNS FROM marks";
        $result = mysqli_query($db,$sql);
        if ($result->num_rows > 0) {
          while($row = mysqli_fetch_array($result)){
            if ($row['Field'] != "utorid") {
              echo $row['Field']."<br>";
              if ($row['Field'] == $markchoice) {
                echo "<option value=\"".$row['Field']."\" selected=\"selected\">".$row['Field']."</option>";
              } else {
                echo "<option value=\"".$row['Field']."\">".$row['Field']."</option>";

              }
            }
          }
        } else {
          echo "<option>0 results</option>";
        }
        ?>
      </select>
      <input type="submit" id="generate" name="choose" value="Generate Marks">
    </form> 
  </div>
  <div class="mainsection">

    <form method="post" action="">
      <div class="table">
        <?php
        if ($_GET["type"]) {
          echo "<div class=\"row\">";
          echo "<div class=\"cellLeft\"><b class=\"miniheaders\">utorid</b></div>";
          echo "<div class=\"cellRight\"><b class=\"miniheaders\">$markchoice</b></div>";
          echo "</div>";
          for ($i = 0; $i < sizeof($studentarr); $i++) {
            $id = $studentarr[$i];
            $mark = $currMark[$i];
            echo "<div class=\"row\">";
            echo "<div class=\"cellLeft\">$id</div>";
            echo "<div class=\"cellRight\">";
            echo "<input type=\"text\" name=\"$id\" class=\"marks\" value=\"$mark\">";
            echo "</div>";
            echo "</div>"; 
            echo "<br>";
          }
        }

        ?>
      </div>
    </div>
    <div class="submitbutton">
      <input id="submit" type="submit" name="submit" value="Submit">
      <br>
    <br>
    </div>
  </form>
  <?php
  if (isset($_POST['choose'])){
    header("location: viewallmarks.php?type=".$_POST['markcolumns']);
  }
  // Process info after submit has been pressed
  elseif(isset($_POST['submit'])){
    $sql = "";
    if (!$err) {
      for ($i = 0; $i < sizeof($studentarr); $i++) {
        echo $newMark[$i];
        if ($newMark[$i] != "" || is_numeric($newMark[$i])) {
          $sql = $sql."UPDATE marks SET $markchoice=$newMark[$i] WHERE utorid='$studentarr[$i]'; ";
        }
      }
      if ($db->multi_query($sql)) {
        $message = "All changes have been recorded";
        echo "<script type='text/javascript'>alert('$message'); location=\"viewallmarks.php?type=$markchoice\"</script>";

      }
    }
  }
  include('footer.php');
  ?>
</body>

</html>
