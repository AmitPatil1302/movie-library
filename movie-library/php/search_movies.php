<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $searchQuery = '%' . $_GET['query'] . '%';

    $sql = "SELECT * FROM movies WHERE title LIKE ? OR director LIKE ? OR genre LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $searchQuery, $searchQuery, $searchQuery);
    $stmt->execute();
    $result = $stmt->get_result();

    $movies = [];
    while ($row = $result->fetch_assoc()) {
        $movies[] = $row;
    }

    echo json_encode($movies);

    $stmt->close();
    $conn->close();
}
?>
