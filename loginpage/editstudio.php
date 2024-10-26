<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Animation Studio</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<?php $getStudioByID = getStudioByID($pdo, $_GET['studio_id']); ?>
	<h1>Edit the Animation Studio!</h1>
	<form action="core/handleForms.php?studio_id=<?php echo $_GET['studio_id']; ?>" method="POST">
		<p>
			<label for="studio_name">Studio Name</label> 
			<input type="text" name="studio_name" value="<?php echo $getStudioByID['studio_name']; ?>">
		</p>
		<p>
			<label for="location">Location</label> 
			<input type="text" name="location" value="<?php echo $getStudioByID['location']; ?>">
		</p>
		<p>
			<label for="founder">Founder</label> 
			<input type="text" name="founder" value="<?php echo $getStudioByID['founder']; ?>">
		</p>
		<p>
			<label for="established_year">Established Year</label> 
			<input type="number" name="established_year" value="<?php echo $getStudioByID['established_year']; ?>">
		</p>
		<p>
			<label for="website">Website</label> 
			<input type="text" name="website" value="<?php echo $getStudioByID['website']; ?>">
		</p>
		<p>
			<input type="submit" name="editStudioBtn" value="Update">
		</p>
	</form>
</body>
</html>
