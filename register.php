<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
try {
    // Database connection using PDO
    $conn = new PDO("mysql:host=localhost;port=3307;dbname=voting_system", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Get form data
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $confirm = $_POST['confirm'];
    
    // Check if passwords match
    if ($pass !== $confirm) {
        echo "<script>alert('Passwords do not match!'); window.location.href='registration.html';</script>";
        exit();
    }
    
    // Hash the password
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
    
    // Check if email already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    
    if ($stmt->rowCount() > 0) {
        echo "<script>alert('Email already registered!'); window.location.href='registration.html';</script>";
    } else {
        // Insert new user
        $stmt = $conn->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$fullname, $email, $hashed_password]);
        
        header("Location: registration-sucess.html");
        exit();
    }
    
}
catch(PDOException $e) {
    echo "PHP Error: " . htmlspecialchars($e->getMessage());
}
?>

