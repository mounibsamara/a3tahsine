<html>
<body>

<?php
 include "connectDB.php";
?>
<?php
  $ohip = $_POST["ohip"];
  $doclicnum = $_POST["doclicnum"];
  
  if(empty($ohip) OR empty($doclicnum)){
      echo "return to previous page and put inputs";
  }
  else{
    $query = "UPDATE treats SET treats.docLicNum='$doclicnum' WHERE treats.ohip='$ohip'";
    if(!mysqli_query($connection, $query)){
       die("ERROR: update failed" . mysqli_error($connection));
    }
    $query1 = "SELECT firstname FROM patient WHERE patient.ohip='$ohip'";
    $result = mysqli_query($connection,$query1);
    if(!$result){
        die("databases query failed");
    }
    if(mysqli_num_rows($result) == 0){
       die("this patient does not exist return and try again");
    }
    else{
        echo "<ol>";
        while ($row = mysqli_fetch_assoc($result)){
            echo"<li>";
            echo $row[firstname] . " has been assigned a new doctor" . "</li>";
        }
    }
}
mysqli_free_result($result);
echo "</ol>";
?>

<a href="index2.php">RETURN HOME</a>

</body>
</html>
