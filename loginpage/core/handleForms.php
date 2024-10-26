<?php  
require_once 'models.php';
require_once 'dbConfig.php';

if (isset($_POST['registerUserBtn'])) {

	$username = $_POST['username'];
	$password = sha1($_POST['password']);

	if (!empty($username) && !empty($password)) {

		$insertQuery = insertNewUser($pdo, $username, $password);

		if ($insertQuery) {
			header("Location: ../login.php");
		}
		else {
			header("Location: ../register.php");
		}
	}

	else {
		$_SESSION['message'] = "Please make sure the input fields 
		are not empty for registration!";

		header("Location: ../login.php");
	}

}




if (isset($_POST['loginUserBtn'])) {

	$username = $_POST['username'];
	$password = sha1($_POST['password']);

	if (!empty($username) && !empty($password)) {

		$loginQuery = loginUser($pdo, $username, $password);
	
		if ($loginQuery) {
			header("Location: ../index.php");
		}
		else {
			header("Location: ../login.php");
		}

	}

	else {
		$_SESSION['message'] = "Please make sure the input fields 
		are not empty for the login!";
		header("Location: ../login.php");
	}
 
}



if (isset($_GET['logoutAUser'])) {
	unset($_SESSION['username']);
	header('Location: ../login.php');
}


// Insert a new Animation Studio
if (isset($_POST['insertStudioBtn'])) {
	$query = insertStudio($pdo, $_POST['studio_name'], $_POST['location'], 
		$_POST['founder'], $_POST['established_year'], $_POST['website']);

	if ($query) {
		header("Location: ../index.php");
	}
	else {
		echo "Studio Insertion failed";
	}
}

// Edit an existing Animation Studio
if (isset($_POST['editStudioBtn'])) {
	$query = updateStudio($pdo, $_POST['studio_name'], $_POST['location'], 
		$_POST['founder'], $_POST['established_year'], $_POST['website'], $_GET['studio_id']);

	if ($query) {
		header("Location: ../index.php");
	}
	else {
		echo "Studio Update failed";
	}
}

// Delete an Animation Studio
if (isset($_POST['deleteStudioBtn'])) {
	$query = deleteStudio($pdo, $_GET['studio_id']);

	if ($query) {
		header("Location: ../index.php");
	}
	else {
		echo "Studio Deletion failed";
	}
}

// Insert a new Anime for a Studio
if (isset($_POST['insertNewAnimeBtn'])) {
	$query = insertAnime($pdo, $_POST['anime_title'], $_POST['genre'], 
		$_POST['release_date'], $_POST['episodes'], $_POST['rating'], $_SESSION['username'], $_GET['studio_id']);

	if ($query) {
		header("Location: ../viewanime.php?studio_id=" . $_GET['studio_id']);
	}
	else {
		echo "Anime Insertion failed";
	}
}

// Edit an existing Anime
if (isset($_POST['editAnimeBtn'])) {
	$query = updateAnime($pdo, $_POST['anime_title'], $_POST['genre'], 
		$_POST['release_date'], $_POST['episodes'], $_POST['rating'], $_GET['anime_id']);

	if ($query) {
		header("Location: ../viewanime.php?studio_id=" . $_GET['studio_id']);
	}
	else {
		echo "Anime Update failed";
	}
}

// Delete an Anime
if (isset($_POST['deleteAnimeBtn'])) {
	$query = deleteAnime($pdo, $_GET['anime_id']);

	if ($query) {
		header("Location: ../viewanime.php?studio_id=" . $_GET['studio_id']);
	}
	else {
		echo "Anime Deletion failed";
	}
}

?>