<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Hospital Hub</title>
</head>
<body>
<!-- connects to database -->
<?php
include 'connectDB.php';
?>
<h2>Hospital Info Hub</h2>
<br>
<!--Allows user to pick out sorting order for doctors -->
<h5>pick a sorting order to list doctors in:</h5>
<form action="getdata.php" method="post">
    <input type="radio" name="nameOrder" value="firstName ASC"> First name Ascending <br>
    <input type="radio" name="nameOrder" value="firstName DESC"> First name Descending <br>
    <input type="radio" name="nameOrder" value="lastName ASC"> Last name Ascending <br>
    <input type="radio" name="nameOrder" value="lastName DESC"> Last name Descending<br>
    <br>
    <input type="submit" value="Submit Name Order">
</form>
<!--spacing and a line between sections-->
<br>
<hr>
<br>
<!--Allows user to list doctors licensed before a specific Date-->
<h5>List doctors licensed before specific date:</h5>
<form action="listdoctors.php" method="post">
  doctors licensed before this date:
  <input type="text" name="udate" maxLength="4">
  <br>
  <input type="submit" value="push Date">
</form>

<br>
<hr>
<br>
<!--Allows user to insert a new doctor-->
<h5>Insert A new Doctor:</h5>
<form action="insertdoctor.php" method="post">
  <br>
  doctor license number:
  <input type="text" name="licnum" maxLength="8">
  <br>
  First Name:
  <input type="text" name="fname" maxlength="12">
  <br>
  Last Name:
  <input type="text" name="lname" maxlength="12">
  <br>
  Specialty:
  <input type="text" name="special" maxLength="15">
  <br>
  Date of license received:
  <input type="date" name="ldate" maxlength="12">
  <br>
  Hospital of employment:
  <input type="text" name="whos" maxlength="3" required="required">
  <br>
  <input type="submit" value="add doctor">
</form>

<br>
<hr>
<br>

<!--Allows user to delete doctor based off doctor license number
<h5>Delete A doctor</h5>
<form action="deletedoctor.php" method="post">
	choose a doctor to Delete:
        <br>
        <input type="text" name="doclicnum" maxLength="5>"
        <br>
        <input type="submit" value="Delete doctor">
</form>

<br>
<hr>
<br>

<!--Allows user to change hospital Name-->
<h5>Change Hospital Name:</h5>
<form action="changeHName.php" method="post">
        <br>
	Enter the Hospital Code:
        <br>
        <input type="text" name="hosCode" maxlength="3">
        <br>
        Enter New name of this hospital:
        <br>
        <input type="text" name="name" maxlength="20">
        <br>
        <input type="submit" value="change Name">
</form>
<br>
<hr>
<br>

<!--shows to the user the hospitals, and their head doctors-->
<h5>List of hospitals, their date that the head doctor joined, and head doctor name</h5>
<?php
  $query = "SELECT * FROM hospital,doctor WHERE doctor.docLicNum=hospital.headdoc ORDER BY hospital.name";
  $result = mysqli_query($connection,$query);
  if(!$result){
    die("database query failed");
  }
  
  echo "<ol>";
  while ($row = mysqli_fetch_assoc($result)){
    echo "<li>";
    echo $row[name] . " " .  $row[headDocStartDate] . " " . $row[firstName] . " " . $row[lastName] . "</li>";
  }
  mysqli_free_result($result);
?>
<br>
<hr>
<br>
<!--Allows user to input ohip Number then shows patient details, and who treats said patient-->
<h5>Search for a patient:</h5>
<form action="patientdetails.php" method="post">
   <br>
   Enter Ohip Number:
   <input type="text" name="ohip" maxlength="9">
   <br>
   <input type="submit" value="Search patient">
</form
<br>
<hr>
<br>
<!--Allows user to assign a doctor to a patient-->
<form action="treat.php" method="post">
  <h5>Assign a doctor to treat a patient:</h5>
  <br>
  Enter the Ohip number of patient:
  <input type="text" name="ohip" maxlength="9">
  <br>
  Enter the doctor license number of the doctor:
  <input type="text" name="doclicnum" maxlength="4">
  <br>
  <input type="submit" value="Assign Patient">
</form>
<hr>
<!--Allows user to stop a doctor from treating a patient:-->
<form action="untreat.php" method="post">
  <h5>stop a doctor from treating a patient:</h5>
  <br>
  Enter the ohip number of patient:
  <input type="text" name="ohip" maxlength="9">
  <br>
  Enter the doctor license number of doctor:
  <input type="text" name="doclicnum" maxlength="4">
  <br>
  <input type="submit" value="unassign Doctor">
</form>

<br>
<hr>
<br>

<!--Shows which doctors do not have a patient-->
<h5>Doctors with no patients:</h5>
<?php
 $query = "SELECT * FROM doctor WHERE doctor.docLicNUM NOT IN (SELECT docLicNum FROM treats)";
 $result = mysqli_query($connection,$query);
 if(!$result){
    die("databases query failed");
 }
 echo"<ol>";
 while($row = mysqli_fetch_assoc($result)){
    echo "<li>";
    echo $row["firstName"] . " " . $row["lastName"] . " " . $row["docLicNum"] . "</li>";
 }
 mysqli_free_result($result);
 echo "</ol>"
?>

<?php
 mysqli_close($connection);
?>

</body>
</html>
