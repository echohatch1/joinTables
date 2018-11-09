<?php
//load variables
require_once('variables.php');
$checkid = '';
	
if(isset($_GET[movie_id])) {
	$checkid = "WHERE movie_id=$_GET[movie_id]";
}

// Create connection
$conn = mysqli_connect(HOST,USER,PASSWORD,DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM avengers INNER JOIN avenger_movie ON (avengers.movie = avenger_movie.movie_id) $checkid ORDER BY last";

//WHERE movie_id=$movie

//talk to database
$result = mysqli_query($conn, $sql) or die ('query failed');


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Avengers</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,600" rel="stylesheet">
	<link href="css/index.css" rel="stylesheet" type="text/css">
</head>
	<header>
	<?php include('nav.html');?>
	</header>
	
<body>
<main>	

<div id="background">
<h1>Avengers</h1>
    
<?php
	//check for no results
	if(mysqli_num_rows($result) == 0) {
		echo '<p>No results to display</p>';
	}
	
	//display what we found
	
	while ($row = mysqli_fetch_array($result)) {
		echo '<hr>';
		echo '<h3>';
		echo $row['avenger'].'<br>';
		echo '</h3>';
		
		//ternary operator
		($row['gender'] == 1 ? $gender = 'Actor: ' : $gender = 'Actress: ');
		/*if ($row['gender'] == 1) {
			$gender = 'Actor: ';
		} else {
			$gender = 'Actress: ';
		}*/
		echo '<b>' . $gender . '</b>';
		echo $row['first'] . ', ' . $row['last'];
		echo '<br><b>First Avengers Movie: </b>';
		echo $row['movie'];
		echo '<br><br>';
		
		//assign user id to a variable
		$userid = $row['id'];
		
		//build another inner join query
		$sql2 = "SELECT * FROM avenger_skills_reference INNER JOIN avenger_skills ON (avenger_skills_reference.skill_id = avenger_skills.skill_id) WHERE avenger_id = $userid";
		
		//talk to database
		$resultSkills = mysqli_query($conn, $sql2) or die ('skill query failed');
		
		echo '<b>Skills/ Abilities: </b>';
		
		while($row2 = mysqli_fetch_array($resultSkills)) {
		echo '<br>' . $row2['skill'];
		}
		
		
		echo '<br><br>';
	};
	
	$conn->close();
?>
</div>
</main>
</body>
</html>