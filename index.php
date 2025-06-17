<?php
session_start();

$userName = null;

if (isset($_SESSION['userID'])) {
    require_once 'db.php';
    $db = new Database();
    $conn = $db->connect();

    $stmt = $conn->prepare("SELECT name FROM users WHERE userID = ?");
    $stmt->execute([$_SESSION['userID']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $userName = $user['name'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Home - Course Portal</title>
    <style>
      /* Reset and base */
      * {
        box-sizing: border-box;
      }
      body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
        margin: 0;
        padding: 0;
        color: #333;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
      }
      header {
        background-color: #fff;
        width: 100%;
        padding: 20px 0;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        text-align: center;
        font-size: 2.5rem;
        font-weight: 700;
        color: #ff6f91;
        letter-spacing: 1.2px;
        margin-bottom: 40px;
      }
      main {
        max-width: 800px;
        width: 90%;
        background-color: #fff;
        padding: 30px 40px;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
      }
      h1 {
        color: #ff6f91;
        margin-bottom: 10px;
      }
      p {
        font-size: 1.1rem;
        margin-top: 0;
        margin-bottom: 20px;
        line-height: 1.5;
      }
      a {
        color: #ff6f91;
        font-weight: 600;
        text-decoration: none;
        border-bottom: 2px solid transparent;
        transition: border-color 0.3s ease;
      }
      a:hover {
        border-bottom: 2px solid #ff6f91;
      }
      nav {
        margin-top: 20px;
        text-align: center;
      }
      .nav-links a {
        margin: 0 10px;
      }
    </style>
</head>
<body>
  <header>Course Portal</header>
  <main>
    <?php if ($userName): ?>
        <h1>Welcome back, <?= htmlspecialchars($userName) ?>!</h1>
        <nav class="nav-links">
          <a href="logout.php">Logout</a>
          <a href="my_courses.php">My Courses</a>
          <a href="view_courses.php">View Courses</a>
        </nav>
    <?php else: ?>
        <h1>Welcome to the Course Portal!</h1>
        <p><a href="login.php">Login</a> or <a href="register.php">Register</a> to start managing your courses.</p>
        <nav class="nav-links">
          <a href="view_courses.php">View Courses</a>
        </nav>
    <?php endif; ?>
  </main>
</body>
</html>
