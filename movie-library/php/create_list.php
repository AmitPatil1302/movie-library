<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../signin.html');
    exit();
}

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $is_public = isset($_POST['is_public']) ? 1 : 0;

    $sql = "INSERT INTO movie_lists (user_id, name, is_public, created_at) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isi", $user_id, $name, $is_public);

    if ($stmt->execute()) {
        // Redirect to home page after successful list creation
        header('Location: home.php');
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
