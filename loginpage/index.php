
<?php 
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 

if (!isset($_SESSION['username'])) {
	header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		body {
			font-family: "Arial";
		}
		input {
			font-size: 1.5em;
			height: 50px;
			width: 200px;
		}
		table, th, td {
			border:1px solid black;
		}
	</style>
</head>
<body>
	<?php if (isset($_SESSION['message'])) { ?>
		<h1 style="color: red;"><?php echo $_SESSION['message']; ?></h1>
	<?php } unset($_SESSION['message']); ?>



	<?php if (isset($_SESSION['username'])) { ?>
		<h1>Hello there!! <?php echo $_SESSION['username']; ?></h1>
		<a href="core/handleForms.php?logoutAUser=1">Logout</a>
	<?php } else { echo "<h1>No user logged in</h1>";}?>

	<h3>Users List</h3>
	<ul>
		<?php $getAllUsers = getAllUsers($pdo); ?>
		<?php foreach ($getAllUsers as $row) { ?>
			<li>
				<a href="viewuser.php?user_id=<?php echo $row['user_id']; ?>"><?php echo $row['username']; ?></a>
			</li>
		<?php } ?>
	</ul>

    <h1>Welcome to the Animation Studios Database Management System. Add New Animation Studios!</h1>

    <!-- Form to add new Animation Studio -->
    <form action="core/handleForms.php" method="POST">
        <p>
            <label for="studio_name">Studio Name</label> 
            <input type="text" name="studio_name" required>
        </p>
        <p>
            <label for="location">Location</label> 
            <input type="text" name="location" required>
        </p>
        <p>
            <label for="founder">Founder</label> 
            <input type="text" name="founder" required>
        </p>
        <p>
            <label for="established_year">Established Year</label> 
            <input type="number" name="established_year" min="1800" max="<?php echo date('Y'); ?>" required>
        </p>
        <p>
            <label for="website">Website</label> 
            <input type="url" name="website" placeholder="https://example.com" required>
        </p>
        <p>
            <input type="submit" name="insertStudioBtn" value="Add Studio">
        </p>
    </form>

    <!-- Display all studios -->
    <?php $getAllStudios = getAllStudios($pdo); ?>
    <?php foreach ($getAllStudios as $row) { ?>
    <div class="container" style="border-style: solid; width: 50%; height: auto; margin-top: 20px; padding: 10px;">
        <h3>Studio Name: <?php echo $row['studio_name']; ?></h3>
        <h3>Location: <?php echo $row['location']; ?></h3>
        <h3>Founder: <?php echo $row['founder']; ?></h3>
        <h3>Established Year: <?php echo $row['established_year']; ?></h3>
        <h3>Website: <a href="<?php echo $row['website']; ?>" target="_blank"><?php echo $row['website']; ?></a></h3>
        <h3>Date Added: <?php echo $row['date_added']; ?></h3>

        <div class="editAndDelete" style="float: right; margin-right: 20px;">
            <a href="viewanime.php?studio_id=<?php echo $row['studio_id']; ?>">View Projects</a>
            <a href="editstudio.php?studio_id=<?php echo $row['studio_id']; ?>">Edit</a>
            <a href="deletestudio.php?studio_id=<?php echo $row['studio_id']; ?>">Delete</a>
        </div>
    </div> 
    <?php } ?>
	
</body>
</html>
