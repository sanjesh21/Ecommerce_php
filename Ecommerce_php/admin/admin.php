<?php
session_start();

// Check if admin is already logged in, redirect to admin-management page if true
if(isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin-management.php");
    exit;
}

// Check if form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate login credentials (for demonstration purposes, check against hardcoded values)
    $username = "admin";
    $password = "admin123";

    if($_POST['username'] == $username && $_POST['password'] == $password) {
        // Set admin login status to true
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin-management.php");
        exit;
    } else {
        // Invalid credentials
        $login_error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Admin Login</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
            <?php
            if(isset($login_error)) {
                echo '<div class="error">' . $login_error . '</div>';
            }
            ?>
        </form>
    </div>
</body>
</html>
