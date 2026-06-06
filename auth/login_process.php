

<?php
session_start();

include '../backend/db.php';

if (isset($_POST['login_btn'])) {

    $username = $_POST['user_name'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE user_name = :username LIMIT 1";
    $statement = $conn->prepare($query);

    $statement->execute([
        ':username' => $username
    ]);

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user && $password == $user['password']) {

        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_name'] = $user['user_name'];

        header("Location: ../dashboard.php");
        exit;

    } else {
        header("Location: ../login.php?error=1");
        exit;
    }
}