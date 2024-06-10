<?php
// Create connection
$conn = mysqli_connect("db.sice.indiana.edu","i308f19_team31","my+sql=i308f19_team31","i308f19_team31");
	//check connection
	if (mysqli_connect_errno())
	{echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";}

$var_course = mysqli_real_escape_string($conn, $_POST['course']);

$sql = "select distinct concat(f.nameF,' ', f.nameL) as name 
from tp_faculty as f 
where not exists(select * from 
tp_course as c, tp_section as s
where c.courseID=s.courseID and c.instructor=f.facultyID and c.title='$var_course');
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  //output data of each row
    echo "<b>Instructors who have never taught ".$var_course . ":</b><br>";
		while($row = $result->fetch_assoc()) {
			echo " " . $row["name"]. "<br>";
		}
	} else {
		echo "0 results";
	}
	
	//check for error on select
	if (!mysqli_query($conn,$sql))
	{die('Error: ' . mysqli_error($conn)). "<br>";}

	mysqli_close($conn);
?>

