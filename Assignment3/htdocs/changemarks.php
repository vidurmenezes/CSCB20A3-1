<?php
   include('session.php');
   if($_SESSION['instructors']==false){
       header("location:index.php");
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
  ?>
  <div id="background">
    <div id="CourseTitle">
    <div class="myBounceDiv">
      <h1>NEWS</h1>
      <br>
      <i class="far fa-newspaper fa-5x"></i>
    </div>
      </div>
    </div>
  <div class="mainsection">
    <h4>January 2, 2018</h4>
    <p>
      SHIT
    </p>
  </div>
  <div class="mainsection">
    <h4>February 15, 2018</h4>
    <p>
      Agreed joy vanity regret met may ladies oppose who. Mile fail as left as hard eyes. Meet made call in mean four year it to. Prospect so branched wondered sensible of up. For gay consisted resolving pronounce sportsman saw discovery not. Northward or household
      as conveying we earnestly believing. No in up contrasted discretion inhabiting excellence. Entreaties we collecting unpleasant at everything conviction.
    </p>
  </div>
  <div class="mainsection">
    <h4>March 2, 2018</h4>
    <p>
      Sussex result matter any end see. It speedily me addition weddings vicinity in pleasure. Happiness commanded an conveying breakfast in. Regard her say warmly elinor. Him these are visit front end for seven walls. Money eat scale now ask law learn. Side
      its they just any upon see last. He prepared no shutters perceive do greatest. Ye at unpleasant solicitude in companions interested.
    </p>
  </div>
<?php
   include('footer.php');
?>
</body>

</html>
