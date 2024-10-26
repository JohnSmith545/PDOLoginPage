<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete Studio</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Are you sure you want to delete this animation studio?</h1>
	<?php 
		// Get Studio by ID
		$getStudioByID = getStudioByID($pdo, $_GET['studio_id']); 
	?>
	<div class="container" style="border-style: solid; height: 400px;">
		<h2>Studio Name: <?php echo $getStudioByID['studio_name']; ?></h2>
		<h2>Location: <?php echo $getStudioByID['location']; ?></h2>
		<h2>Founder: <?php echo $getStudioByID['founder']; ?></h2>
		<h2>Established Year: <?php echo $getStudioByID['established_year']; ?></h2>
		<h2>Website: <?php echo $getStudioByID['website']; ?></h2>
		<h2>Date Added: <?php echo $getStudioByID['date_added']; ?></h2>

		<div class="deleteBtn" style="float: right; margin-right: 10px;">
			<form action="core/handleForms.php?studio_id=<?php echo $_GET['studio_id']; ?>" method="POST">
				<input type="submit" name="deleteStudioBtn" value="Delete">
			</form>			
		</div>	
	</div>
</body>
</html>
