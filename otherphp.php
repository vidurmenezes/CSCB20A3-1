<html>
<head>
</head>
  <body>
    <?php
      $servername="localhost";
      $username="root";
      $password="root";
      $dbname="databasename";

      $conn=new
      mysqli($servername, $username, $password, $dbname);

      if($conn->connect_error)
      {
        die("Connection failed!");
      }
      echo "connected successfully!";
      $sql="SELECT id, firstname, lastname FROM table1";
      $result=$conn->quert($sql);
      echo $result;
    ?>

  </body>
</html>
