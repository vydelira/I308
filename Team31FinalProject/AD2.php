<?php
// Create connection
$conn = mysqli_connect("db.sice.indiana.edu","i308f19_team31","my+sql=i308f19_team31","i308f19_team31");
	//check connection
	if (mysqli_connect_errno())
	{echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";}
	else
	{echo "Established Database Connection <br>";}

$var_building = mysqli_real_escape_string($conn, $_POST['building']);
$var_feature = mysqli_real_escape_string($conn, $_POST['feature']);

$sql = "SELECT r.roomID as Room, b.name as Building, r.feature as Feature
FROM tp_room as r, tp_building as b 
WHERE r.buildingID = b.buildingID AND b.name = '$var_building' AND r.feature = '$var_feature';
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	//output data of each row
		while($row = $result->fetch_assoc()) {
			echo "<b>Room:</b> " . $row["Room"]. " <b>Building: </b> " .$row["Building"]. " <b>Feature: </b> " .$row["Feature"]. "<br>";
		}
	} else {
		echo "0 results";
	}
	
	//check for error on select
	if (!mysqli_query($conn,$sql))
	{die('Error: ' . mysqli_error($conn)). "<br>";}

	mysqli_close($conn);
?>