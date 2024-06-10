<!doctype html>
<html>
<body>
<h2>I308 Final Project</h2>
<h3>Team 31: Andy, Chase, Lucas, Valeria</h3>

<!--QUERY 1A-->
<form action= "1A.php" method ="POST">
 
<strong>1a)</strong> Produce a roster for a *specified section* sorted by student’s last name, first name.<br>

Section: <select name="section" required>
<?php
$conn = mysqli_connect("db.soic.indiana.edu","i308f19_team31","my+sql=i308f19_team31","i308f19_team31");
// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error() . "<br>");
}
	$result = mysqli_query($conn,"SELECT distinct s.sectionNumber, c.title FROM tp_section as s, tp_course as c where c.courseID=s.sectionID");
    while ($row = mysqli_fetch_assoc($result)) {
    	unset($id, $name);
        $id = $row['sectionNumber'];
        $name = $row['sectionNumber']; 
		$title = $row['title'];
        echo '<option value="'.$id.'">'.$name.'- ' .$title.'</option>';
}
?>
</select><br>
<input type="submit" name="3B" value="Query 1a"><br><br>
</form>

<!--QUERY 5A-->
<form action= "5A.php" method ="POST">
 
<strong>5a)</strong>Produce a chronological list (transcript-like) of all courses taken by a *specified student*. Show grades earned.<br>
 
Student ID: <select name="student" required>
<?php
$conn = mysqli_connect("db.soic.indiana.edu","i308f19_team31","my+sql=i308f19_team31","i308f19_team31");
// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error() . "<br>");
}
	$result = mysqli_query($conn,"SELECT distinct studentID, nameF, nameL FROM tp_student");
    while ($row = mysqli_fetch_assoc($result)) {
        unset($id, $name);
        $id = $row['studentID'];
        $name = $row['studentID'];
		$fname = $row['nameF'];
		$lname = $row['nameL'];
        echo '<option value="'.$id.'">'.$name.'- ' .$fname.' '.$lname.'</option>';
}
?>
</select><br>
<input type="submit" name="5A" value="Query 5a"><br><br>
</form>

<!--QUERY 7A-->
<form action= "7A.php" method ="POST">
 
<strong>7a)</strong> Produce an alphabetical list of students with their majors who are advised by a
*specified advisor*.<br>
 
Advisor: <select name="advisor" required>
<?php
$conn = mysqli_connect("db.soic.indiana.edu","i308f19_team31","my+sql=i308f19_team31","i308f19_team31");
// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error() . "<br>");
}
	$result = mysqli_query($conn,"SELECT concat(a.nameF,' ', a.nameL) as fullname FROM tp_advisor as a");
    while ($row = mysqli_fetch_assoc($result)) {
                  unset($id, $name);
                  $id = $row['fullname'];
                  $name = $row['fullname']; 
                  echo '<option value="'.$id.'">'.$name.'</option>';
}
?>
</select><br>
<input type="submit" name="7a" value="Query 7a"><br><br>

</form>

<!--QUERY 3B-->
<form action= "3B.php" method ="POST">
 
<strong>3b)</strong> Produce a list of faculty who have never taught a *specific course*.<br>
 
Course: <select name="course" required>
<?php
$conn = mysqli_connect("db.soic.indiana.edu","i308f19_team31","my+sql=i308f19_team31","i308f19_team31");
// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error() . "<br>");
}
	$result = mysqli_query($conn,"SELECT distinct title FROM tp_course");
    while ($row = mysqli_fetch_assoc($result)) {
        unset($id, $name);
        $id = $row['title'];
        $name = $row['title']; 
        echo '<option value="'.$id.'">'.$name.'</option>';
}
?>
</select><br>
<input type="submit" name="5A" value="Query 3b"><br><br>
</form>

<!--QUERY 4C-->
<form action= "4C.php" method ="POST">
 
<strong>4c)</strong> Produce a list of all students who took a course that had a prerequisite but the student
had not taken the prerequisite. Include the semester, the course subject and number,
and the grade the student received.
<br>
 
<?php
$conn = mysqli_connect("db.soic.indiana.edu","i308f19_team31","my+sql=i308f19_team31","i308f19_team31");
// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error() . "<br>");
}

?>
</select><br>
<input type="submit" name="4C" value="Query 4c"><br><br>
</form>

<!--QUERY 9C-->
<form action= "9C.php" method ="POST">
 
<strong>9c)</strong> Produce a list of students with hours earned and overall GPA who have met the
graduation requirements for any major. Sort by major and then by student.
<br>
 
<?php
$conn = mysqli_connect("db.soic.indiana.edu","i308f19_team31","my+sql=i308f19_team31","i308f19_team31");
// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error() . "<br>");
}

?>
</select><br>
<input type="submit" name="9C" value="Query 9c"><br><br>
</form>

<h3> Additional Queries </h3>

<!--ADDITIONAL QUERY 1-->
<form action= "AD1.php" method ="POST">
 
<strong>1.)</strong> Find the names and emails of faculty from a *specified department*
<br>
 
Department: <select name="department" required>
<?php
$conn = mysqli_connect("db.soic.indiana.edu","i308f19_team31","my+sql=i308f19_team31","i308f19_team31");
// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error() . "<br>");
}
	$result = mysqli_query($conn,"SELECT distinct title FROM tp_department");
    while ($row = mysqli_fetch_assoc($result)) {
    	unset($id, $name);
        $id = $row['title'];
        $name = $row['title']; 
        echo '<option value="'.$id.'">'.$name.'</option>';
}
?>
</select><br>
<input type="submit" name="AD1" value="Additional Query 1"><br><br>
</form>

<!--ADDITIONAL QUERY 2-->
<form action= "AD2.php" method ="POST">
 
<strong>2.)</strong> Select all the rooms in a *specific building* with a *specific feature*
<br>
 
Building: <select name="building" required>
<?php
$conn = mysqli_connect("db.soic.indiana.edu","i308f19_team31","my+sql=i308f19_team31","i308f19_team31");
// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error() . "<br>");
}
	$result = mysqli_query($conn,"SELECT distinct name FROM tp_building");
    while ($row = mysqli_fetch_assoc($result)) {
    	unset($id, $name);
        $id = $row['name'];
        $name = $row['name']; 
        echo '<option value="'.$id.'">'.$name.'</option>';
}
?>
</select>

Feature: <select name="feature" required>
<?php
$conn = mysqli_connect("db.soic.indiana.edu","i308f19_team31","my+sql=i308f19_team31","i308f19_team31");
// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error() . "<br>");
}
	$result = mysqli_query($conn,"SELECT distinct feature FROM tp_room");
    while ($row = mysqli_fetch_assoc($result)) {
    	unset($id, $name);
        $id = $row['feature'];
        $name = $row['feature']; 
        echo '<option value="'.$id.'">'.$name.'</option>';
}
?>
</select><br>
<input type="submit" name="AD2" value="Additional Query 2"><br><br>
</form>

<!--ADDITIONAL QUERY 3-->
<form action= "AD3.php" method ="POST">
 
<strong>3.)</strong> Select parents' name, phone number, and their child's email if their child's email ends in ".com" 
<br>
 
<?php
$conn = mysqli_connect("db.soic.indiana.edu","i308f19_team31","my+sql=i308f19_team31","i308f19_team31");
// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error() . "<br>");
}

?>
<input type="submit" name="AD3" value="Additional Query 3"><br><br>
</form>

</body>
</html>
