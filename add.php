<?php
//load variables
require_once('variables.php');
	
// Create connection
$conn = mysqli_connect(HOST,USER,PASSWORD,DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//get avenger skills
$query = "SELECT * FROM avenger_skills";
$resultSkills = mysqli_query($conn, $query) or die ('query failed');

//get avenger movies
$query = "SELECT * FROM avenger_movie ORDER BY movie ASC";
$resultMovie = mysqli_query($conn, $query) or die ('query failed');
?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Add Avenger</title>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,600" rel="stylesheet">
<link href="css/add.css" rel="stylesheet" type="text/css">
</head>
	
	<header>
	<?php include('nav.html');?>
	</header>

<body>
<main>
    <div class="form">
		
<form action="sendData.php" method="POST" enctype="multipart/form-data" class="myForm" name="myForm">

    <h1>Add Avenger</h1>
	
<section id="avenger" class="normal">
<label ><span>Avenger Name</span>
	<input name="avenger" type="text" class="myInput" required placeholder = "avenger" autofocus>
</label>
</section>
	
	<hr>
	<h3>Actor Info</h3>
	
<section id="first-name" class="normal">
<label ><span>First Name</span>
	<input name="firstName" type="text" class="myInput" required placeholder = "first" autofocus>
</label>
</section>
    
<section id="last-name" class="normal">
<label ><span>Last Name</span>
	<input name="lastName" type="text" class="myInput" required placeholder = "last" autofocus>
</label>
</section>
		
		<hr>
	
<section id="gender" class="normal">
	<label><span>Gender</span><br>
		<input type="radio" name="gender" value="1"> Male<br>
		<input type="radio" name="gender" value="2"> Female
	</label>
</section>
		
		<hr>
	
<section id="firstMovie" class="normal">
<label ><span>First Avengers Film</span>
	<select name="firstMovie" class="myInput" required>
		<option value="">Please Select</option>
		<?php
		while($row=mysqli_fetch_array($resultMovie)) {
			echo '<option value="'.$row['movie_id'].'">' . $row['movie'] . '</option>';
		};
		?>
	</select>
</label>
</section>
	
<section>
	<label><span>Skills/ Powers</span><br>
		<?php
		while($row=mysqli_fetch_array($resultSkills)) {
			echo '<input name="skills[]" type="checkbox" value="'.$row['skill_id'].'">' . $row['skill'] . '</input><br>';
		};
		?>
	</label>
</section>
	

    

<input type="submit" value="Add" id="submitButton" class="submitButton">

</form>
    </div>
</main>
</body>
</html>