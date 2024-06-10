<?php
// Create connection
$conn = mysqli_connect("db.sice.indiana.edu","i308f19_team31","my+sql=i308f19_team31","i308f19_team31");
	//check connection
	if (mysqli_connect_errno())
	{echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";}
	else
	{echo "Established Database Connection <br>";}

$var_section = mysqli_real_escape_string($conn, $_POST['section']);

$sql = "SELECT DISTINCT concat(s.nameF, ' ', s.nameL) as Full_Name, sem.title as Semester, concat(c.courseNumber,' ',c.title) as course, stc.grade as grade
FROM tp_student as s, tp_course as c, tp_section as sec, tp_semester as sem, tp_student_takes_class as stc
WHERE stc.studentID = s.studentID
and sec.sectionID = stc.sectionID
and sem.semesterID = sec.semesterID
and sec.courseID = c.courseID
and c.prereq != 'NULL'
and s.studentID NOT IN(
	SELECT DISTINCT s2.studentID 
	FROM tp_student as s2, tp_course as c2, tp_section as sec2, tp_student_takes_class as stc2 
	WHERE s2.studentID = stc2.studentID 
	AND sec2.sectionID = stc2.sectionID 
	AND sec2.courseID = c2.prereq)
ORDER BY s.studentID;
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	//output data of each row
		while($row = $result->fetch_assoc()) {
			echo "<b>Student Name:</b> " . $row["Full_Name"]. " <b>Semester: </b> " .$row["Semester"]. " <b>Course: </b> " .$row["course"]. " <b>Grade: </b>" .$row["grade"]. "<br>";
		}
	} else {
		echo "0 results";
	}
	
	//check for error on select
	if (!mysqli_query($conn,$sql))
	{die('Error: ' . mysqli_error($conn)). "<br>";}

	mysqli_close($conn);
?>