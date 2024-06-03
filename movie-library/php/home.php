<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header('Location: signin.html');
  exit();
}

include 'config.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT ml.*, u.username, GROUP_CONCAT(m.title SEPARATOR ', ') as movies
        FROM movie_lists ml
        LEFT JOIN users u ON ml.user_id = u.id
        LEFT JOIN movie_list_items mli ON ml.id = mli.list_id
        LEFT JOIN movies m ON mli.movie_id = m.id
        WHERE ml.user_id = ? OR ml.is_public = 1
        GROUP BY ml.id";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$lists = [];
while ($row = $result->fetch_assoc()) {
  $lists[] = $row;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>

<body>
  <header>
    <h1>Welcome to Movie Library</h1>
    <a href="logout.php">Logout</a>
  </header>

  <main>
    <section class="search-section">
      <input type="text" id="searchQuery" placeholder="Search for movies...">
      <button onclick="searchMovies()">Search</button>
    </section>

    <section id="movieResults" class="results-section"></section>

    <section class="lists-section">
      <h2>Your Lists</h2>
      <a href="../create_list.html">Create a New List</a><br>
      <a href="../add_movies.html">Add Movies to List</a>
      <div id="userLists">
        <?php foreach ($lists as $list): ?>
          <div class="list-card">
            <h3><?php echo htmlspecialchars($list['name']); ?></h3>
            <p><?php echo $list['is_public'] ? 'Public' : 'Private'; ?></p>
            <p>Created by: <?php echo htmlspecialchars($list['username']); ?></p>
            <p>Movies:
            <ul>
              <?php 
                // Explode the movies string into an array
                $movies = explode(', ', $list['movies']); 
                foreach ($movies as $movie): 
              ?>
                <li><?php echo htmlspecialchars($movie); ?></li>
              <?php endforeach; ?>
            </ul>
            </p>
            <?php if ($list['is_public']): ?>
              <p>Shareable Link: <a href="view_list.php?list_id=<?php echo $list['id']; ?>">View List</a></p>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
  </main>

  <footer>
    <p>&copy; 2024 Movie Library</p>
  </footer>

  <script src="../js/scripts.js"></script>
</body>

</html>
