<html>
<body>

<?php
include "connectDB.php";
?>
<?php
$doclicnum = $_POST["doclicnum"];

if(empty($doclicnum)){
     echo "EMPTY INPUT: return and put a doctor license number";
}
else{
     $query="SELECT docLicNum FROM treats WHERE treats.docLicNum='$doclicnum'";
     $result=mysqli_query($connection,$query);
     if(mysqli_num_rows($result) != 0){
          echo "this doctor has patients!";
     }
     else{
        echo "this doctor has no patients :(";
     }
     mysqli_free_result($result);
     $query1 ="SELECT docLicNum FROM doctor WHERE doctor.docLicNum='$doclicnum'";
     $result1=mysqli_query($connection,$query1);
     if(mysqli_num_rows($result1)== 0){
       die("THIS DOCTOR DOESNT EXIST: please return and input a doctor license number that exists");
     }
     else{
        echo '<form action="cddoctor.php" method="post">';
        echo "Are you sure you want to delete this doctor?";
        echo "<br>";
        echo "<input type='radio' name='decision' value='$doclicnum' >";
        echo "Yes";
        echo "<br>";
        echo '<input type="radio" name="decision" value="NO" >';
        echo "No";
        echo "<br>";
        echo '<input type="submit" value="Submit">';
        echo '</form>';
      }
      mysqli_free_result($result1);
}

mysqli_close($connection);
?>

</body>
</html>
