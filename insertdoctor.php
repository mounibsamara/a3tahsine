<html>
<body>

<?php
include "connectDB.php";
?>

<?php
$doclicnum = $_POST["licnum"];
$firstname = $_POST["fname"];
$lastname = $_POST["lname"];
$specialty = $_POST["special"];
$dateoflic = $_POST["ldate"];
$hospital = $_POST["whos"];

if(empty($doclicnum) OR empty($firstname) OR empty($lastname) OR empty($specialty) OR empty($dateoflic) OR empty(hospital)){
  echo "EMPTY INPUT: please return to the previous page and fill every textbox";
}
else{
  $query = "SELECT docLicNum FROM doctor WHERE doctor.docLicNum='$doclicnum'";
  $result = mysqli_query($connection,$query);
  if(!result){
     die("database query failed");
  }
  if(mysqli_num_rows($result) != 0){
     die("Doctor ID already exists: return and add a unique id");
  }

  else{
     $query1 = "INSERT INTO doctor(docLicNum,firstName,lastName,speciality,licenseDate,hosWorksAt) VALUES ('$doclicnum','$firstname','$lastname','$specialty','$dateoflic','$hospital')";
     if(!mysqli_query($connection,$query1)){
        die("ERROR: failed to insert" . mysqli_error($connection));
     }
     echo "the doctor got added";
  }
  mysqli_free_result($result);
}

mysqli_close($connection);
?>

</body>
</html>
