<?php
session_start();

// Include database connection (Assuming you have db.php for connection)
include 'db.php';

// Function to validate input
function validate($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    // Check if inputs are empty
    if (empty($username) || empty($password)) {
        echo "Username and Password are required.";
        exit;
    }

    // Prepare and execute SQL statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo "Invalid username or password.";
        exit;
    }

    $user = $result->fetch_assoc();

    // Verify password
    if (password_verify($password, $user['password'])) {
        // Store user information in session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // Redirect to dashboard or another page
        header('Location: dashboard.php');
        exit;
    } else {
        echo "Invalid username or password.";
    }
}
?>
