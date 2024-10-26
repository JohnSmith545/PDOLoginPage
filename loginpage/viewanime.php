<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<a href="index.php">Return to home</a>
	<?php $getStudioByID = getStudioByID($pdo, $_GET['studio_id']); ?>
	<h1>Studio Name: <?php echo $getStudioByID['studio_name']; ?></h1>
	<h1>Add New Anime</h1>
	<form action="core/handleForms.php?studio_id=<?php echo $_GET['studio_id']; ?>" method="POST">
		<p>
			<label for="anime_title">Anime Title</label> 
			<input type="text" name="anime_title" required>
		</p>
		<p>
			<label for="genre">Genre</label> 
			<input type="text" name="genre" required>
		</p>
		<p>
			<label for="release_date">Release Date</label> 
			<input type="date" name="release_date" required>
		</p>
		<p>
			<label for="episodes">Episodes</label> 
			<input type="number" name="episodes" required>
		</p>
		<p>
			<label for="rating">Rating</label> 
			<input type="number" name="rating" step="0.01" min="0" max="10" required>
			<input type="submit" name="insertNewAnimeBtn" value="Add Anime">
		</p>
	</form>

	<table style="width:100%; margin-top: 50px;">
	  <tr>
	    <th>Anime ID</th>
	    <th>Anime Title</th>
	    <th>Genre</th>
	    <th>Release Date</th>
	    <th>Episodes</th>
	    <th>Rating</th>
	    <th>Date Added</th>
		<th>Added By</th>
		<th>Last Updated</th>
	    <th>Action</th>
	  </tr>
	  <?php $getAnimeByStudio = getAnimeByStudio($pdo, $_GET['studio_id']); ?>
	  <?php foreach ($getAnimeByStudio as $row) { ?>
	  <tr>
	  	<td><?php echo $row['anime_id']; ?></td>	  	
	  	<td><?php echo $row['anime_title']; ?></td>	  	
	  	<td><?php echo $row['genre']; ?></td>	  	
	  	<td><?php echo $row['release_date']; ?></td>	  	
	  	<td><?php echo $row['episodes']; ?></td>
	  	<td><?php echo $row['rating']; ?></td>
	  	<td><?php echo $row['date_added']; ?></td>
		<td><?php echo $row['added_by']; ?></td>
		<td><?php echo $row['last_updated']; ?></td>
	  	<td>
	  		<a href="editanime.php?anime_id=<?php echo $row['anime_id']; ?>&studio_id=<?php echo $_GET['studio_id']; ?>">Edit</a>
	  		<a href="deleteanime.php?anime_id=<?php echo $row['anime_id']; ?>&studio_id=<?php echo $_GET['studio_id']; ?>">Delete</a>
	  	</td>	  	
	  </tr>
	<?php } ?>
	</table>
</body>
</html>
