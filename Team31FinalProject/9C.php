<?php
// Create connection
$conn = mysqli_connect("db.sice.indiana.edu","i308f19_team31","my+sql=i308f19_team31","i308f19_team31");
	//check connection
	if (mysqli_connect_errno())
	{echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";}
	else
	{echo "Established Database Connection <br>";}

$sql = "SELECT CONCAT(s.nameF,' ',s.nameL) as Name, SUM(c.creditHours) as creditHours, m.title as Major, ROUND(SUM(((stc.grade/100)*4)*c.creditHours)/SUM(c.creditHours), 2) as GPA
FROM tp_student as s, tp_major as m, tp_student_takes_class as stc, tp_course as c, tp_section as sect
WHERE s.studentID = stc.studentID AND stc.sectionID = sect.sectionID AND sect.courseID = c.courseID
AND s.majorID = m.majorID 
group by m.title, Name
having SUM(c.creditHours) >= 15;
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	//output data of each row
		while($row = $result->fetch_assoc()) {
			echo "<b>Student Name:</b> " . $row["Name"]. " <b>Credit Hours: </b> " .$row["creditHours"]. " <b>Major: </b> " .$row["Major"]. " <b>GPA: </b>" .$row["GPA"]. "<br>";
		}
	} else {
		echo "0 results";
	}
	
	//check for error on select
	if (!mysqli_query($conn,$sql))
	{die('Error: ' . mysqli_error($conn)). "<br>";}

	mysqli_close($conn);
?>