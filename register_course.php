<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['userID'])) {
    echo "You must be logged in to register for a course.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['courseID'])) {
    $userID = $_SESSION['userID'];
    $courseID = $_POST['courseID'];

    $db = new Database();
    $conn = $db->connect();

    // Prevent duplicate registration
    $stmt = $conn->prepare("SELECT * FROM registrations WHERE userID = ? AND courseID = ?");
    $stmt->execute([$userID, $courseID]);

    if ($stmt->rowCount() > 0) {
        echo "Already registered for this course.";
    } else {
        $stmt = $conn->prepare("INSERT INTO registrations (userID, courseID) VALUES (?, ?)");
        $stmt->execute([$userID, $courseID]);
        echo "Successfully registered for course.";
    }
} else {
    echo "Invalid request.";
}
?>
