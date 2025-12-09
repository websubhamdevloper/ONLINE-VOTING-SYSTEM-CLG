<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    // DB Connection (same as your register.php)
    $conn = new PDO("mysql:host=localhost;port=3307;dbname=voting_system", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // If form submitted
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $email = trim($_POST['email']);
        $votername = trim($_POST['votername']);
        $password = trim($_POST['password']);

        // Fetch user by email
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        // Email found?
        if ($stmt->rowCount() === 1) {

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Check voter name matches fullname
            if (strtolower($user['fullname']) !== strtolower($votername)) {
                header("Location: login-unsuccess.html");  // wrong name
                exit();
            }

            // Verify password
            if (password_verify($password, $user['password'])) {

                // If already voted
                if ($user['has_voted'] == 1) {
                    header("Location: already-voted.html");
                    exit();
                }

                // Start session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['fullname'] = $user['fullname'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['has_voted'] = $user['has_voted'];

                // Redirect to voting page
                header("Location: login-success.html");
                exit();

            } else {
                header("Location: login-unsuccess.html"); // wrong password
                exit();
            }

        } else {
            header("Location: login-unsuccess.html"); // email not found
            exit();
        }
    }

} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
}
?>


