
<html>
<body>
<?php
include 'connectDB.php';
?>
<h2>Doctors listed in order</h2>
<br>
<?php
   $nameOrder = $_POST["nameOrder"];
        if(empty($nameOrder)){
            die("ERROR: You did not specifiy an order");
   }
   $query = "SELECT * FROM doctor ORDER BY $nameOrder";
   $result = mysqli_query($connection,$query);
   if (!$result) {
        die("databases query failed.");
   }
   echo '<form action="getdoctor.php" method="post">';
   while ($row = mysqli_fetch_assoc($result)) {
        echo '<input type="radio" name="mydoc" value="';
        echo $row["docLicNum"];
        echo '">' . $row["firstName"] . " " . $row["lastName"] . "<br>";     
   }
   echo '<input type="submit" value="doctor information">';
   echo '</form>';
   mysqli_free_result($result);
   mysqli_close($connection);
?>
</body>
</html>
