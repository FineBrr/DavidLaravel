<?php

session_start();
require 'Connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>

<body>
<main>
    <form method="post">
        <h1>Authorization</h1>
        <div>
            <label for="username">Username:</label>
            <input type="text" name="login" id="username" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="pass" id="password" required minlength="8">
        </div>
        <div>
            <label for="rememberMe">Remember me:
                <input type="checkbox" name="remember">
            </label>

        </div>

        <button type="submit" name="submit">Login</button>
        <footer> You don't have an account? <a href="Registration.php">Register here</a></footer>
        <?php

        $logName = $_POST["login"];
        $logPass = $_POST["pass"];
        $conn = $_SESSION['conn'];
        $logPass = hash('sha256', $_POST["pass"]);
        $_SESSION['login'] = $logName;
        $_SESSION['pass'] = $logPass;
        $sql = "SELECT * FROM `users` WHERE login = '$logName' AND password='$logPass' limit 1 ";
        $result = mysqli_query($conn, $sql);
        if (isset($_POST['submit'])) {
            if (mysqli_num_rows($result) == 1) {
                header("Location: Menu.php");
            }
            if (isset($_POST['remember'])) {
                setcookie('logincookie', $logName, time() + 86400 * 30);
                setcookie('passwordcookie', $logPass, time() + 86400 * 30);
                //header("Location: Menu.php");

            } else {
                setcookie('logincookie', $logName, time() - 86400 * 30);
                setcookie('passwordcookie', $logPass, time() - 86400 * 30);
            }
            echo "invalid username or password";

        }

        ?>
    </form>
</main>
</body>
</html>