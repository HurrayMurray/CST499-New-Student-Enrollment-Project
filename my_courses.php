<?php
session_start();
require_once 'db.php';

// Check if user is logged in
if (!isset($_SESSION['userID'])) {
    echo "You must be logged in to view your courses.";
    exit;
}

$userID = $_SESSION['userID'];

$db = new Database();
$conn = $db->connect();

// Get the list of courses the user is registered for
$stmt = $conn->prepare("
    SELECT c.courseID, c.course_code, c.course_name, c.credits
    FROM registrations r
    JOIN courses c ON r.courseID = c.courseID
    WHERE r.userID = ?
");
$stmt->execute([$userID]);
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>My Courses</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background: linear-gradient(to right, #a8edea, #fed6e3);
            padding: 20px;
        }
        table {
            margin: auto;
            border-collapse: collapse;
            width: 80%;
            background: #fff;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ccc;
        }
        th {
            background-color: #f8f8f8;
        }
        .button {
            display: inline-block;
            margin: 20px 10px;
            padding: 10px 20px;
            background-color: #ff6f91;
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
        }
        .button:hover {
            background-color: #ff4e72;
        }
    </style>
</head>
<body>
    <h1>My Registered Courses</h1>

    <?php if (count($courses) > 0): ?>
        <table>
            <tr>
                <th>Course Code</th>
                <th>Course Name</th>
                <th>Credits</th>
            </tr>
            <?php foreach ($courses as $course): ?>
                <tr>
                    <td><?= htmlspecialchars($course['course_code']) ?></td>
                    <td><?= htmlspecialchars($course['course_name']) ?></td>
                    <td><?= htmlspecialchars($course['credits']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>You are not registered for any courses yet.</p>
    <?php endif; ?>

    <div>
        <a class="button" href="add_course.php">Add Course</a>
        <a class="button" href="drop_course.php">Drop Course</a>
        <a class="button" href="index.php">Back to Home</a>
    </div>
</body>
</html>
