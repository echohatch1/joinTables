<?php
//load the variables for the form
require_once('variables.php');

$avenger = $_POST[avenger];
$firstName = $_POST[firstName];
$lastName = $_POST[lastName];
$gender = $_POST[gender];
$firstMovie = $_POST[firstMovie];

	
// Create connection
$conn = mysqli_connect(HOST,USER,PASSWORD,DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//build query
$query = "INSERT INTO avengers (avenger, first, last, gender, movie) VALUES ('$avenger', '$firstName', '$lastName', '$gender', '$firstMovie')";

//talk to database
$result = mysqli_query($conn, $query) or die ('query failed');

//update skills
//get id of user just added
$recent_id = mysqli_insert_id($conn);

//loop through array that contains checkbox selections
foreach($_POST['skills'] as $skill_id) {
	
	//build query
$query = "INSERT INTO avenger_skills_reference (avenger_id, skill_id) VALUES ('$recent_id', '$skill_id')";

//talk to database
$result = mysqli_query($conn, $query) or die ('update skills query failed');
	
}; //end foreach

//close connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
	<title>Avenger Added</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,600" rel="stylesheet">
	<link href="css/sendData.css" rel="stylesheet" type="text/css">
</head>
	<header>
	<?php include('nav.html');?>
	</header>
<body>
<main>
<div id="background">
<h1>Succesfully Added</h1>
    
<?php 
	echo '<h2>';
	echo $avenger;
	echo '</h2>';

	echo '<br><br>';
	echo '<a href="add.php" class="button">Add Another</a><br>';
	echo '<a href="index.php" class="button-secondary">View Avengers</a>';
?>
</div>
</main>
</body>
</html>