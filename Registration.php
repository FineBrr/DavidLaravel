<?php

session_start();
require_once 'Connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Register</title>

</head>
<body>
<main>
    <form method="post">
        <h1>Sign Up</h1>
        <div>
            <label for="username">Username:</label>
            <input type="text" name="name" id="username"
                   pattern="[A-Za-z]{3,15}" title="Only alphabets and whitespace are allowed. Ex: David" required>
        </div>
        <div>
            <label for="role">Role:</label>
            <select name="role" id="role" typeof="text" required>
                <option disabled>Select a role</option>
                <option selected></option>
                <option>Administrator</option>
                <option>Moderator</option>
                <option>User</option>
            </select>
        </div>
        <div>
            <label for="regPass">Password:</label>
            <input type="password" name="registerPassword" id="regPass" required minlength="8">
        </div>
        <div>
            <label for="confirmPassword">Password Again:</label>
            <input type="password" name="confirmPassword" id="confirmPassword" required>
        </div>
        <div>
            <label for="agree">
                <input type="checkbox" name="agree" id="agree" value="yes" required/> I agree
                with the
                <a href="#" title="term of services">term of services</a>
            </label>
        </div>
        <button type="submit">Register</button>
        <footer>Already a member? <a href="Authorization.php">Login here</a></footer>
        <?php

        $conn = $_SESSION['conn'];
        $confirmPassword = $_POST["confirmPassword"];
        $name = $_POST['name'];
        $password = $_POST["registerPassword"];
        $role = $_POST["role"];

        if ($confirmPassword != $password) {
            echo "Confirm password must be the same as password";
        } elseif ($confirmPassword == $password) {
            $password = hash('sha256', $_POST["registerPassword"]);
            $sql = "INSERT INTO `users` (login, password, role) VALUES ('$name','$password','$role')";
            // $sql = "Select * from login";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                header("Location: Authorization.php");
            } else {
                die(mysqli_error($conn));
            }
        }

        ?>

</main>
</body>
</html>