<form method="POST" action="register_class.php">
  <select name="course_id">
    <?php
    require 'db.php';
    $courses = $pdo->query("SELECT * FROM courses")->fetchAll();
    foreach ($courses as $course) {
        echo "<option value='{$course['course_id']}'>{$course['course_name']}</option>";
    }
    ?>
  </select>
  <input type="submit" value="Register">
</form>
