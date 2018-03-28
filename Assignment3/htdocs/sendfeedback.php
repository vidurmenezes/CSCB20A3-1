<?php
include('session.php');
?>
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="sendfeedback.css">
  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script><!--Used fontawesome for icons -->
  <link href="https://fonts.googleapis.com/css?family=Nunito+Sans" rel="stylesheet"> <!--Used google fonts for some fonts -->
</head>

<body>
  <?php
  include('navbar.php');
// define variables and set to empty values
  $answer1 = $answer2 = $answer3 = $answer4 = $instructor = "";
  $answer1Err = $answer2Err = $answer3Err = $answer4Err = "";
  $column = array();
  $sql = "SELECT Question FROM feedbackquestions";
  $result = $db->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $column[] = $row['Question'];
    }
  } else {
    echo "0 results";
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $instructor = $_POST["instructors"];
    if (empty($_POST["answer1"])) {
      $answer1Err = "Answer is required";
    } else {
      $answer1 = test_input($_POST["answer1"]);
      if (isset($answer1[255])) {
        $answer1Err = "Answer cannot exceed 255 characters";
      }
    }
    if (empty($_POST["answer2"])) {
      $answer2Err = "Answer is required";
    } else {
      $answer2 = test_input($_POST["answer2"]);
      if (isset($answer2[255])) {
        $answer2Err = "Answer cannot exceed 255 characters"; 
      }
    }
    if (empty($_POST["answer3"])) {
      $answer3Err = "Answer is required";
    } else {
      $answer3 = test_input($_POST["answer3"]);
      if (isset($answer3[255])) {
        $answer3Err = "Answer cannot exceed 255 characters"; 
      }
    }
    if (empty($_POST["answer4"])) {
      $answer4Err = "Answer is required";
    } else {
      $answer4 = test_input($_POST["answer4"]);
      if (isset($answer4[255])) {
        $answer4Err = "Answer cannot exceed 255 characters"; 
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
        <h1>Anonymous Feedback</h1>
        <br>
        <i class="far fa-newspaper fa-5x"></i>
      </div>
    </div>
  </div>
  
  <div class="mainsection">

    <form method="post" action="">
      <div id="instchoice" class="dropdown">
        <h2>Choose The Target Instructor</h2>
        <select name="instructors">
          <?php
          $sql = "SELECT firstname, lastname, utorid FROM instructors";
          $result = $db->query($sql);
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $fullname = $row['firstname']." ".$row['lastname'];
              echo "<option value=\"".$row['utorid']."\">".$fullname."</option>";
            }
          } else {
            echo "<option>0 results</option>";
          }
          ?>
        </select>
      </div>
      <p><span class="error">* required field.</span></p>
      <?php echo $column[0]. "  <span class=\"error\">*".$answer1Err."</span><br>";?>
      <textarea name="answer1" rows="5"><?php echo $answer1;?></textarea>
      <br>
      <br>
      <?php echo $column[1]. "  <span class=\"error\">*".$answer2Err."</span><br>";?>
      <textarea name="answer2" rows="5"><?php echo $answer2;?></textarea>
      <br>
      <br>
      <?php echo $column[2]. "  <span class=\"error\">*".$answer3Err."</span><br>";?>
      <textarea name="answer3" rows="5"><?php echo $answer3;?></textarea>
      <br>
      <br>
      <?php echo $column[3]. "  <span class=\"error\">*".$answer4Err."</span><br>";?>
      <textarea name="answer4" rows="5"><?php echo $answer4;?></textarea>
      <br>
      <input id="submit" type="submit" name="submit" value="Submit">
    </form>
    <?php
    if(isset($_POST['submit'])){
      if ($answer1Err == '' && $answer2Err == '' && $answer3Err == '' && $answer4Err == '') {
        echo $answer1;
        echo "<br>";
        echo $answer2;
        echo "<br>";
        echo $answer3;
        echo "<br>";
        echo $answer4;
        $message = "Your feedback, ".$answer1.", ".$answer2.", ".$answer3.", ".$answer4." was successfully submitted to ".$instructor.".";
        echo "<script type='text/javascript'>alert('$message'); location=\"sendfeedback.php\"</script>";
      }
    }
    ?>
  </div>
  <?php
  include('footer.php');
  ?>
</body>

</html>
