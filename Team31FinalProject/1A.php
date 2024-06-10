<?php
// Create connection
$conn = mysqli_connect("db.sice.indiana.edu","i308f19_team31","my+sql=i308f19_team31","i308f19_team31");
	//check connection
	if (mysqli_connect_errno())
	{echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";}
	else
	{echo "Established Database Connection <br>";}

$var_section = mysqli_real_escape_string($conn, $_POST['section']);

$sql = "SELECT CONCAT(s.nameL,', ',s.nameF) as Name
FROM tp_student as s, tp_student_takes_class as stc, tp_section as sect
WHERE stc.sectionID = sect.sectionID AND stc.studentID = s.studentID and sect.sectionNumber = '$var_section'
ORDER BY s.nameL;
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	//output data of each row
		while($row = $result->fetch_assoc()) {
			echo "<b>Student Name:</b> " . $row["Name"]. "<br>";
		}
	} else {
		echo "0 results";
	}
	
	//check for error on select
	if (!mysqli_query($conn,$sql))
	{die('Error: ' . mysqli_error($conn)). "<br>";}

	mysqli_close($conn);
?>