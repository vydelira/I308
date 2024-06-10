<?php
// Create connection
$conn = mysqli_connect("db.sice.indiana.edu","i308f19_team31","my+sql=i308f19_team31","i308f19_team31");
	//check connection
	if (mysqli_connect_errno())
	{echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";}
	else
	{echo "Established Database Connection <br>";}

$sql = "select distinct concat(spa.nameF,' ', spa.nameL) as parent_name, spa.phone as parent_phone, se.email as student_email
from tp_student_email as se, tp_student_parent as spa, tp_student_phone as sp
where spa.parentID=se.studentID and se.email like '%.com';
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	//output data of each row
		while($row = $result->fetch_assoc()) {
			echo "<b>Parent Name:</b> " . $row["parent_name"]. " <b>Parent Phone: </b> " .$row["parent_phone"]. " <b>Student Email: </b> " .$row["student_email"]. "<br>";
		}
	} else {
		echo "0 results";
	}
	
	//check for error on select
	if (!mysqli_query($conn,$sql))
	{die('Error: ' . mysqli_error($conn)). "<br>";}

	mysqli_close($conn);
?>