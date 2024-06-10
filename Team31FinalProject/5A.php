<?php
// Create connection
$conn = mysqli_connect("db.sice.indiana.edu","i308f19_team31","my+sql=i308f19_team31","i308f19_team31");
	//check connection
	if (mysqli_connect_errno())
	{echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";}

$var_student= mysqli_real_escape_string($conn, $_POST['student']);

$sql = "select c.title as 'class', grade 
from tp_course as c, tp_student_takes_class as stc,tp_section as s, tp_student as student
where c.courseID=s.courseID 
and stc.sectionID=s.sectionID 
and student.studentID=stc.studentID 
and student.studentID='$var_student';";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  //output data of each row
    echo "<b>Courses taken by student with ID ".$var_student.":</b><br>";
		while($row = $result->fetch_assoc()) {
			echo " " . $row["class"]. "<br>";
		}
	} else {
		echo "0 results";
	}
	
	//check for error on select
	if (!mysqli_query($conn,$sql))
	{die('Error: ' . mysqli_error($conn)). "<br>";}

	mysqli_close($conn);
?>