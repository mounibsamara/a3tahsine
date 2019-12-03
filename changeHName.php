<html>
<body>

<?php
  include "connectDB.php";
?>

<?php
  $hoscode = $_POST["hosCode"];
  $name = $_POST["name"];
  if(empty($hoscode) OR empty($name)){
      echo "Please return to previous page and fill both inputs";
  }
  else{
     
     $query = "UPDATE hospital SET name='$name' WHERE hospital.hosCode='$hoscode'";
     if(!mysqli_query($connection, $query)){
         die("ERROR COULDNT UPDATE" . mysqli_error($connection));
     }
     echo "the hospital name has been changed";
  }
  mysqli_close($connection);
 
?>
 
<br>
<a href="index2.php">RETURN HOME</a>

</body>
</html>
