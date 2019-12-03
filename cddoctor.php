<html>
<body>

<?php
include "connectDB.php";
?>

<?php
$doclicnum = $_POST["decision"];
if("'$doclicnum'" == "'NO'"){
  echo "The doctor was not deleted, use this link to return to home page";
  echo "<br>";
  echo '<a href="index2.php">RETURN HOME </a>';
}
else{
  $query = "SELECT docLicNum FROM doctor WHERE doctor.docLicNum='$doclicnum'";
  $result = mysqli_query($connection,$query);
  if(!result){
     die("databases query failed");
  }
  $query1 = "DELETE FROM doctor WHERE doctor.docLicNum='$doclicnum';";
  if(!mysqli_query($connection,$query1)){
     die("ERROR DELETING" . mysqli_error($connection));
  }
  echo "doctor has been deleted!";
}
mysqli_free_result($result);
mysqli_close($connection);

?>
<br>

<a href="index2.php">RETURN HOME</a>

</body>
</html>
