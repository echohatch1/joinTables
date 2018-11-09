<?php
//load variables
require_once('variables.php');

// Create connection
$conn = mysqli_connect(HOST,USER,PASSWORD,DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//build querry
$query = "SELECT * FROM avenger_movie ORDER BY movie";

//talk to database
$result = mysqli_query($conn, $query) or die ('query failed');
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
	<link href="css/search.css" rel="stylesheet" type="text/css">
</head>

	<header>
	<?php include('nav.html');?>
	</header>
	
<body>
	<main>
		<div class="box">
	<h2>Search by Movie</h2>
	
	<?php
		 while($row = mysqli_fetch_array($result)) {
			 echo '<ul class="movie-list">';
			 echo '<li><a href="index.php?movie_id=' . $row['movie_id'] . '">';
			 echo $row['movie'];
			 echo '</a></li>';
			 echo '</ul>';
		 };
	?>
			</div>
	</main>
</body>
</html>