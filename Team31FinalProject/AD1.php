<?php
// Create connection
$conn = mysqli_connect("db.sice.indiana.edu","i308f19_team31","my+sql=i308f19_team31","i308f19_team31");
	//check connection
	if (mysqli_connect_errno())
	{echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";}
	else
	{echo "Established Database Connection <br>";}

$var_department = mysqli_real_escape_string($conn, $_POST['department']);

$sql = "SELECT CONCAT(f.nameF,' ',f.nameL) as Name, fe.email as Email, d.title as Department
FROM tp_department as d, tp_faculty as f, tp_faculty_email as fe
WHERE d.departmentID = f.departmentID AND f.facultyID = fe.facultyID AND d.title = '$var_department'
GROUP BY Name ASC;
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	//output data of each row
		while($row = $result->fetch_assoc()) {
			echo "<b>Student Name:</b> " . $row["Name"]. " <b>Email: </b> " .$row["Email"]. " <b>Department: </b> " .$row["Department"]. "<br>";
		}
	} else {
		echo "0 results";
	}
	
	//check for error on select
	if (!mysqli_query($conn,$sql))
	{die('Error: ' . mysqli_error($conn)). "<br>";}

	mysqli_close($conn);
?>