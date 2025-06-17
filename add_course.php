<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_code = $_POST['course_code'];
    $course_name = $_POST['course_name'];
    $credits = $_POST['credits'];

    $db = new Database();
    $conn = $db->connect();

    $stmt = $conn->prepare("INSERT INTO courses (course_code, course_name, credits) VALUES (?, ?, ?)");
    $stmt->execute([$course_code, $course_name, $credits]);

    echo "Course added successfully.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Course</title>
</head>
<body>
    <h1>Add New Course</h1>
    <form method="post">
        Course Code: <input type="text" name="course_code" required><br>
        Course Name: <input type="text" name="course_name" required><br>
        Credits: <input type="number" name="credits" min="1" max="6" required><br>
        <input type="submit" value="Add Course">
    </form>
</body>
</html>
