<html>
<body>

<?php
include 'connectDB.php';
?>

<?php
$udate = $_POST["udate"];
echo $udate;
if(empty($udate)){
  die("ERROR: no date recieved");
}

$query ='SELECT * from doctor WHERE licenseDate < "'.$udate.'"';
$result = mysqli_query($connection,$query);
if(!result){
  die("database query failed");
}
echo "<ol>";
while ($row = mysqli_fetch_assoc($result)){
  echo "<li>";
  echo $row[firstName] . " " . $row[lastName] . " " . $row[licenseDate] . $row[hosWorksAt] .  "</li>";
}
mysqli_free_result($result);
echo "</ol>";
?>
