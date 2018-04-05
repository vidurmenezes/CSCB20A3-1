<?php
include('session.php');
if($_SESSION['instructors'] != true){
    header("location:index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="news.css">
  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script><!--Used fontawesome for icons -->
  <link href="https://fonts.googleapis.com/css?family=Nunito+Sans" rel="stylesheet"> <!--Used google fonts for some fonts -->
</head>
<body>
  <?php
  include('navbar.php');
  $id = $questionId = $question = $answer = $final = $buildingBlock = "";
  $id = $_SESSION['utorid'];
  ?>
  <div id="background">
    <div id="CourseTitle">
      <div class="myBounceDiv">
        <h1>Feedback</h1>
        <br>
        <i class="far fa-newspaper fa-5x"></i>
      </div>
    </div>
  </div>
  <?php
  $sqlquestions = "SELECT * FROM feedbackquestions";
  $questions = mysqli_query($db,$sqlquestions);
  if ($questions->num_rows > 0) {
    while($row = mysqli_fetch_array($questions)){
      $questionId = $row['QuestionID'];
      $question = $row['Question'];

      $buildingBlock = "<div class=\"mainsection\"><h4>$question</h4><ul>";

      $sql = "SELECT $questionId FROM feedback WHERE instructorid='$id'";

      $result = mysqli_query($db,$sql);
      if ($result->num_rows > 0) {
        while($row = mysqli_fetch_array($result)){
          $answer = $row[0];
          $buildingBlock = $buildingBlock."<li>$answer</li>";
        }
        $buildingBlock = $buildingBlock."</ul></div>";
        $final = $final.$buildingBlock;
      }
    }
  }
  echo $final;
  include('footer.php');
  ?>
</body>

</html>
