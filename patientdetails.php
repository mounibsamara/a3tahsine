<html>
<body>

<?php
 include "connectDB.php";
?>

<?php
 $ohip = $_POST["ohip"];

 if(empty($ohip)){
    die("ERROR: you left ohip empty");
 }
 else{
    $query = "SELECT ohip FROM patient WHERE patient.ohip='$ohip'";
    $result = mysqli_query($connection,$query);
    if(!result){
      die("databases query failed");
    }
    if(mysqli_num_rows($result) == 0){
      die("this patient does not exist: return to previous page and enter a patient");
    }
    else{
       $query1 = "SELECT * FROM patient,treats,doctor WHERE patient.ohip='$ohip' AND treats.ohip='$ohip' AND treats.docLicNum=doctor.docLicNum";
       $result1= mysqli_query($connection,$query1);
       if(!$result1){
          die("databases query failed");
       }
       echo "<ol>";
       while($row=mysqli_fetch_assoc($result1)){
            echo "<li>";
            echo $row[firstname] . " " . $row[lastname] . "-" . $row[firstName] . " " . $row[lastName] . "</li>";
       }
    }
}
mysqli_free_result($result);
mysqli_free_result($result1);
echo "</ol>"
?>
<br>
<a href="index2.php">RETURN HOME</a>

</body>
</html>
