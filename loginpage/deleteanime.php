<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete Anime Project</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<?php 
	    // Get Anime by ID
	    $getAnimeByID = getAnimeByID($pdo, $_GET['anime_id']); 
	?>
	<h1>Are you sure you want to delete this anime project?</h1>
	<div class="container" style="border-style: solid; height: 400px;">
		<h2>Anime Title: <?php echo $getAnimeByID['anime_title']; ?></h2>
		<h2>Genre: <?php echo $getAnimeByID['genre']; ?></h2>
		<h2>Episodes: <?php echo $getAnimeByID['episodes']; ?></h2>
		<h2>Rating: <?php echo $getAnimeByID['rating']; ?></h2>
		<h2>Studio: <?php echo $getAnimeByID['studio_owner']; ?></h2>
		<h2>Date Added: <?php echo $getAnimeByID['date_added']; ?></h2>

		<div class="deleteBtn" style="float: right; margin-right: 10px;">
			<form action="core/handleForms.php?anime_id=<?php echo $_GET['anime_id']; ?>&studio_id=<?php echo $_GET['studio_id']; ?>" method="POST">
				<input type="submit" name="deleteAnimeBtn" value="Delete">
			</form>			
		</div>	
	</div>
</body>
</html>
