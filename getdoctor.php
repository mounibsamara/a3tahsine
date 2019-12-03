<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Dr. Western's Vet Clinic-Your Pets</title>
</head>
<body>
<?php
include 'connectDB.php';
?>
<?php
$mydoc = $_POST["mydoc"];
if(empty($mydoc)){
 die("ERROR: no doctor license number");
}
$query = 'SELECT * FROM doctor,hospital WHERE docLicNum = "'.$mydoc.'" AND doctor.hosWorksAt = hospital.hosCode';
$result = mysqli_query($connection,$query);
if(!$result){
	die("databases query failed.");
}
echo "<ol>";
while ($row = mysqli_fetch_assoc($result)){
	echo "<li>";
	echo $row["docLicNum"] . " " .  $row["firstName"] . " " . $row["lastName"] . $row["name"] . "</li>";
}
mysqli_free_result($result);
echo "</ol>";
?>
<?php
 mysqli_close($connection);
?>
</body>
</html>
