<?php
session_start();
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = trim($_POST['userID'] ?? '');
    $passwordRaw = $_POST['password'] ?? '';
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $major = trim($_POST['major'] ?? '');

    // Basic validation
    if (empty($userID) || empty($passwordRaw)) {
        $_SESSION['error'] = "User ID and password are required.";
        header("Location: register.php");
        exit;
    }

    $password = password_hash($passwordRaw, PASSWORD_DEFAULT);

    try {
        $db = new Database();
        $conn = $db->connect();

        // Check if userID already exists
        $stmt = $conn->prepare("SELECT 1 FROM users WHERE userID = ?");
        $stmt->execute([$userID]);

        if ($stmt->fetch()) {
            $_SESSION['error'] = "User ID already exists.";
            header("Location: register.php");
            exit;
        }

        // Insert new user
        $stmt = $conn->prepare("INSERT INTO users (userID, password, name, email, phone, address, major) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$userID, $password, $name, $email, $phone, $address, $major]);

        $_SESSION['success'] = "Registration successful. You can now log in.";
        header("Location: login.php");
        exit;

    } catch (PDOException $e) {
        $_SESSION['error'] = "Database error: " . $e->getMessage();
        header("Location: register.php");
        exit;
    }
} else {
    header("Location: register.php");
    exit;
}
