<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Anime Project</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <a href="viewprojects.php?studio_id=<?php echo htmlspecialchars($_GET['studio_id']); ?>">
        View The Projects
    </a>
    <h1>Edit the Anime Project!</h1>
    <?php $getAnimeByID = getAnimeByID($pdo, $_GET['anime_id']); ?>

    <?php if ($getAnimeByID): ?>
        <form action="core/handleForms.php?anime_id=<?php echo htmlspecialchars($_GET['anime_id']); ?>&studio_id=<?php echo htmlspecialchars($_GET['studio_id']); ?>" method="POST">
            <p>
                <label for="animeTitle">Anime Title</label> 
                <input type="text" name="anime_title" 
                value="<?php echo htmlspecialchars($getAnimeByID['anime_title']); ?>" required>
            </p>
            <p>
                <label for="genre">Genre</label> 
                <input type="text" name="genre" 
                value="<?php echo htmlspecialchars($getAnimeByID['genre']); ?>" required>
            </p>
            <p>
                <label for="release_date">Release Date</label> 
                <input type="date" name="release_date" 
                value="<?php echo htmlspecialchars($getAnimeByID['release_date']); ?>" required>
            </p>
            <p>
                <label for="episodes">Episodes</label>
                <input type="number" name="episodes" 
                value="<?php echo htmlspecialchars($getAnimeByID['episodes']); ?>" required>
            </p>
            <p>
                <label for="rating">Rating</label>
                <input type="number" name="rating" 
                value="<?php echo htmlspecialchars($getAnimeByID['rating']); ?>" step="0.01" min="0" max="10" required>
            </p>
            <p>
                <input type="submit" name="editAnimeBtn" value="Update">
            </p>
        </form>
    <?php else: ?>
        <p>Anime not found!</p>
    <?php endif; ?>
</body>
</html>
