<!DOCTYPE html>
<html>
<body>
<?php 
    $serverName="mathlab.utsc.utoronto.ca";
    $userName="meneze69";
    $password="meneze69";
    $dbName="cscb20w18_meneze69";
    $conn = new mysqli($serverName, $userName, $password, $dbName);
    //$year="7.5";
    $sql="select * from instructors";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        // output data of each row    
        echo "<ul>";    
        while($row = $result->fetch_assoc()) {  
            echo "<li>" . $row["firstname"] .",". $row["lastname"].",".$row["email"]. "</li>";   
        }    
        echo "</ul>";
    } 
    else { echo "0 results"; }
    ?>
    </body>
</html>
