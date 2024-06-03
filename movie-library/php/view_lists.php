<?php
include 'config.php';

if (!isset($_GET['list_id'])) {
    echo "No list specified.";
    exit();
}

$list_id = $_GET['list_id'];

$sql_list = "SELECT ml.*, u.username FROM movie_lists ml 
             JOIN users u ON ml.user_id = u.id 
             WHERE ml.id = ? AND ml.is_public = 1";
$stmt_list = $conn->prepare($sql_list);
$stmt_list->bind_param("i", $list_id);
$stmt_list->execute();
$result_list = $stmt_list->get_result();

if ($result_list->num_rows === 0) {
    echo "List not found or is not public.";
    exit();
}

$list = $result_list->fetch_assoc();

$sql_movies = "SELECT m.* FROM movies m 
               JOIN movie_list_movies mlm ON m.id = mlm.movie_id 
               WHERE mlm.list_id = ?";
$stmt_movies = $conn->prepare($sql_movies);
$stmt_movies->bind_param("i", $list_id);
$stmt_movies->execute();
$result_movies = $stmt_movies->get_result();

$movies = [];
while ($movie_row = $result_movies->fetch_assoc()) {
    $movies[] = $movie_row;
}

$stmt_list->close();
$stmt_movies->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($list['name']); ?> - Movie List</title>
  <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
  <header>
    <h1><?php echo htmlspecialchars($list['name']); ?></h1>
    <p>Created by: <?php echo htmlspecialchars($list['username']); ?></p>
  </header>
  
  <main>
    <section class="movies-section">
      <h2>Movies in this List</h2>
      <ul>
        <?php foreach ($movies as $movie): ?>
          <li><?php echo htmlspecialchars($movie['title']); ?> (<?php echo htmlspecialchars($movie['year']); ?>)</li>
        <?php endforeach; ?>
      </ul>
    </section>
  </main>

  <footer>
    <p>&copy; 2024 Movie Library</p>
  </footer>
</body>
</html>
