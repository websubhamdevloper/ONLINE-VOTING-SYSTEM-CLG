<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

try {
    // Database connection
    $conn = new PDO("mysql:host=localhost;port=3307;dbname=voting_system", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Start transaction for data integrity
    $conn->beginTransaction();
    
    // Get user details from session
    $user_id = $_SESSION['user_id'];
    
    // Double-check if user has already voted (security measure)
    $check_sql = "SELECT has_voted FROM users WHERE id = :user_id";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bindParam(":user_id", $user_id);
    $check_stmt->execute();
    $user = $check_stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user['has_voted'] == 1) {
        $conn->rollBack();
        header("Location: already_voted.html");
        exit();
    }
    
    // Check if form was submitted with POST method
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        
        // Get the selected candidate
        if (!isset($_POST['candidate']) || empty($_POST['candidate'])) {
            $conn->rollBack();
            echo "<script>alert('Please select a candidate!'); window.location.href='vote.html';</script>";
            exit();
        }
        
        $candidate_name = trim($_POST['candidate']);
        
        // Insert vote into votes table
        $vote_sql = "INSERT INTO votes (user_id, candidate_name) VALUES (:user_id, :candidate_name)";
        $vote_stmt = $conn->prepare($vote_sql);
        $vote_stmt->bindParam(":user_id", $user_id);
        $vote_stmt->bindParam(":candidate_name", $candidate_name);
        $vote_stmt->execute();
        
        // Update candidate votes count
        $update_candidate_sql = "UPDATE candidates SET votes = votes + 1 WHERE name = :candidate_name";
        $update_candidate_stmt = $conn->prepare($update_candidate_sql);
        $update_candidate_stmt->bindParam(":candidate_name", $candidate_name);
        $update_candidate_stmt->execute();
        
        // Mark user as voted
        $update_user_sql = "UPDATE users SET has_voted = 1 WHERE id = :user_id";
        $update_user_stmt = $conn->prepare($update_user_sql);
        $update_user_stmt->bindParam(":user_id", $user_id);
        $update_user_stmt->execute();
        
        // Update session
        $_SESSION['has_voted'] = 1;
        
        // Commit transaction
        $conn->commit();
        
        // Redirect to success page
        header("Location: vote-success.html");
        exit();
        
    } else {
        $conn->rollBack();
        header("Location: vote.html");
        exit();
    }
    
} catch (PDOException $e) {
    // Rollback transaction on error
    if ($conn->inTransaction()) {
        $conn->rollBack();
    }
    die("Database Error: " . $e->getMessage());
}
?>

