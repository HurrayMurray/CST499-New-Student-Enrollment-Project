<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['userID'])) {
    echo "You must be logged in to drop a course.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['courseID'])) {
    $userID = $_SESSION['userID'];
    $courseID = $_POST['courseID'];

    $db = new Database();
    $conn = $db->connect();

    $stmt = $conn->prepare("DELETE FROM registrations WHERE userID = ? AND courseID = ?");
    $stmt->execute([$userID, $courseID]);

    echo "Course successfully dropped.";
} else {
    echo "Invalid request.";
}
?>
