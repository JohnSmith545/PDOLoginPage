<?php  

require_once 'dbConfig.php';

function insertNewUser($pdo, $username, $password) {

	$checkUserSql = "SELECT * FROM user_passwords WHERE username = ?";
	$checkUserSqlStmt = $pdo->prepare($checkUserSql);
	$checkUserSqlStmt->execute([$username]);

	if ($checkUserSqlStmt->rowCount() == 0) {

		$sql = "INSERT INTO user_passwords (username,password) VALUES(?,?)";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$username, $password]);

		if ($executeQuery) {
			$_SESSION['message'] = "User successfully inserted";
			return true;
		}

		else {
			$_SESSION['message'] = "An error occured from the query";
		}

	}
	else {
		$_SESSION['message'] = "User already exists";
	}

	
}



function loginUser($pdo, $username, $password) {
	$sql = "SELECT * FROM user_passwords WHERE username=?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$username]); 

	if ($stmt->rowCount() == 1) {
		$userInfoRow = $stmt->fetch();
		$usernameFromDB = $userInfoRow['username']; 
		$passwordFromDB = $userInfoRow['password'];

		if ($password == $passwordFromDB) {
			$_SESSION['username'] = $usernameFromDB;
			$_SESSION['message'] = "Login successful!";
			return true;
		}

		else {
			$_SESSION['message'] = "Password is invalid, but user exists";
		}
	}

	
	if ($stmt->rowCount() == 0) {
		$_SESSION['message'] = "Username doesn't exist from the database. You may consider registration first";
	}

}

function getAllUsers($pdo) {
	$sql = "SELECT * FROM user_passwords";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}

}

function getUserByID($pdo, $user_id) {
	$sql = "SELECT * FROM user_passwords WHERE user_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$user_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}


// Function to insert a new animation studio
function insertStudio($pdo, $studio_name, $location, $founder, $established_year, $website) {
    $sql = "INSERT INTO studios (studio_name, location, founder, established_year, website, date_added) 
            VALUES (?, ?, ?, ?, ?, NOW())";

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$studio_name, $location, $founder, $established_year, $website]);

    if ($executeQuery) {
        return true;
    }
}

// Function to update an existing studio
function updateStudio($pdo, $studio_name, $location, $founder, $established_year, $website, $studio_id) {
    $sql = "UPDATE studios
            SET studio_name = ?,
                location = ?,
                founder = ?,
                established_year = ?,
                website = ?
            WHERE studio_id = ?";

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$studio_name, $location, $founder, $established_year, $website, $studio_id]);

    if ($executeQuery) {
        return true;
    }
}

// Function to delete an animation studio and its associated anime
function deleteStudio($pdo, $studio_id) {
    $deleteStudioAnime = "DELETE FROM anime WHERE studio_id = ?";
    $deleteStmt = $pdo->prepare($deleteStudioAnime);
    $executeDeleteQuery = $deleteStmt->execute([$studio_id]);

    if ($executeDeleteQuery) {
        $sql = "DELETE FROM studios WHERE studio_id = ?";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$studio_id]);

        if ($executeQuery) {
            return true;
        }
    }
}

// Function to get all animation studios
function getAllStudios($pdo) {
    $sql = "SELECT * FROM studios";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute();

    if ($executeQuery) {
        return $stmt->fetchAll();
    }
}

// Function to get a single studio by its ID
function getStudioByID($pdo, $studio_id) {
    $sql = "SELECT * FROM studios WHERE studio_id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$studio_id]);

    if ($executeQuery) {
        return $stmt->fetch();
    }
}

// Function to get all anime by a specific studio
function getAnimeByStudio($pdo, $studio_id) {
    $sql = "SELECT 
                anime.anime_id AS anime_id,
                anime.anime_title AS anime_title,
                anime.genre AS genre,
                anime.release_date AS release_date,
                anime.episodes AS episodes,
                anime.rating AS rating,
                anime.date_added AS date_added,
				anime.added_by AS added_by,
				anime.last_updated AS last_updated
            FROM anime
            WHERE anime.studio_id = ?";
    
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$studio_id]);
    
    if ($executeQuery) {
        return $stmt->fetchAll();
    }
    return [];
}

// Function to insert a new anime for a studio
function insertAnime($pdo, $anime_title, $genre, $release_date, $episodes, $rating, $added_by, $studio_id) {
    $sql = "INSERT INTO anime (anime_title, genre, release_date, episodes, rating, added_by, studio_id, date_added, last_updated) 
            VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
    
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$anime_title, $genre, $release_date, $episodes, $rating, $added_by, $studio_id]);

    if ($executeQuery) {
        return true;
    }
}

// Function to get a single anime by its ID
function getAnimeByID($pdo, $anime_id) {
    $sql = "SELECT 
                anime.anime_id AS anime_id,
                anime.anime_title AS anime_title,
                anime.genre AS genre,
                anime.release_date AS release_date,
                anime.episodes AS episodes,
                anime.rating AS rating,
                anime.date_added AS date_added,
                studios.studio_name AS studio_owner
            FROM anime
            JOIN studios ON anime.studio_id = studios.studio_id
            WHERE anime.anime_id  = ? 
            GROUP BY anime.anime_title";

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$anime_id]);
    if ($executeQuery) {
        return $stmt->fetch();
    }
}

// Function to update an anime
function updateAnime($pdo, $anime_title, $genre, $release_date, $episodes, $rating, $anime_id) {
    $sql = "UPDATE anime
            SET anime_title = ?,
                genre = ?,
                release_date = ?,
                episodes = ?,
                rating = ?,
				last_updated = NOW()
            WHERE anime_id = ?";
    
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$anime_title, $genre, $release_date, $episodes, $rating, $anime_id]);

    if ($executeQuery) {
        return true;
    }
}

// Function to delete an anime
function deleteAnime($pdo, $anime_id) {
    $sql = "DELETE FROM anime WHERE anime_id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$anime_id]);
    if ($executeQuery) {
        return true;
    }
}

?>