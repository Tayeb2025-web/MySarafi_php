

<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

$error = $_GET['error'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - MySarafi</title>
    <link rel="stylesheet" href="styles/login.css">
</head>
<body>

<div class="login-page">

    <div class="login-card">

        <div class="login-header">
            <h1>MySarafi</h1>
            <p>Login to your account</p>
        </div>

        <?php if ($error) { ?>
            <div class="error-message">
                Invalid username or password
            </div>
        <?php } ?>

        <form action="auth/login_process.php" method="post" class="login-form">

            <div class="form-group">
                <label>Username</label>
                <input type="text" name="user_name" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" name="login_btn" class="login-btn">
                Login
            </button>

        </form>

    </div>

</div>

</body>
</html>