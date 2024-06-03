<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../signin.html');
    exit();
}

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $list_id = $_POST['list_id'];
    $movie_id = $_POST['movie_id'];

    $sql = "INSERT INTO movie_list_items (list_id, movie_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $list_id, $movie_id);

    if ($stmt->execute()) {
        header('Location: home.php');
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
