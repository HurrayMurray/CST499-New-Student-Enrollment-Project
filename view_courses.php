<?php
require_once 'db.php';

$db = new Database();
$conn = $db->connect();

$stmt = $conn->query("SELECT * FROM courses");
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Available Courses</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            color: #2c3e50;
        }
        table {
            width: 70%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        th, td {
            padding: 10px;
            border: 1px solid #999;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h1 style="text-align:center;">Available Courses</h1>
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
</body>
</html>
