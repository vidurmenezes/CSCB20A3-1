<?php
   define('DB_SERVER', 'mathlab.utsc.utoronto.ca');
   define('DB_USERNAME', 'meneze69');
   define('DB_PASSWORD', 'meneze69');
   define('DB_DATABASE', 'cscb20w18_meneze69');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
if (mysqli_connect_errno())
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }

?>
