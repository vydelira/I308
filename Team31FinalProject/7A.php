<?php
// Create connection
$conn = mysqli_connect("db.sice.indiana.edu","i308f19_team31","my+sql=i308f19_team31","i308f19_team31");
	//check connection
	if (mysqli_connect_errno())
	{echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";}
	else
	{echo "Established Database Connection <br>";}

$var_advisor = mysqli_real_escape_string($conn, $_POST['advisor']);

if ($var_advisor == "Alfred Haste")
	($var_advisor = "1");
if ($var_advisor == "Amerigo Lakenden")
	($var_advisor = "2");
if ($var_advisor == "Isidoro Newiss")
	($var_advisor = "3");
if ($var_advisor == "Joseph Le Pine")
	($var_advisor = "4");
if ($var_advisor == "Forbes Sinnock")
	($var_advisor = "5");

$sql = "SELECT CONCAT(s.nameF,' ',s.nameL) as Name, m.title as Major
FROM tp_student as s, tp_major as m, tp_advisor as a
WHERE s.advisor = '$var_advisor' AND a.advisorID = s.advisor AND m.majorID = s.majorID
ORDER BY s.nameF ASC;
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	//output data of each row
		while($row = $result->fetch_assoc()) {
			echo "<b>Student name:</b> " . $row["Name"]. " <b>Major:</b> " . $row["Major"]. "<br>";
		}
	} else {
		echo "0 results";
	}
	
	//check for error on select
	if (!mysqli_query($conn,$sql))
	{die('Error: ' . mysqli_error($conn)). "<br>";}

	mysqli_close($conn);
?>