<?php
session_start();
$error = $_SESSION['error'] ?? '';
$success = $_SESSION['success'] ?? '';
unset($_SESSION['error'], $_SESSION['success']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Course Portal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            margin: 0;
            padding: 40px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 25px 35px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h1 {
            color: #ff6f91;
            text-align: center;
        }
        label {
            display: block;
            margin: 12px 0 4px;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 8px;
        }
        .btn {
            background-color: #ff6f91;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            border-radius: 6px;
        }
        .btn:hover {
            background-color: #ff4e75;
        }
        .message {
            color: red;
            margin-bottom: 12px;
        }
        .success {
            color: green;
            margin-bottom: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Register</h1>

        <?php if ($error): ?>
            <p class="message"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <?php if ($success): ?>
            <p class="success"><?= htmlspecialchars($success) ?></p>
        <?php endif; ?>

        <form action="register_user.php" method="post">
            <label for="userID">User ID:</label>
            <input type="text" id="userID" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email">

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone">

            <label for="address">Address:</label>
            <input type="text" id="address" name="address">

            <label for="major">Major:</label>
            <input type="text" id="major" name="major">

            <button type="submit" class="btn">Register</button>
        </form>
    </div>
</body>
</html>
