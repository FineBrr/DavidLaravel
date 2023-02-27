<?php

session_start();
require 'Connection.php';
$conn = $_SESSION['conn'];
$logName = $_SESSION['login'];
$logPass = $_SESSION["pass"];

?>

<!DOCTYPE html>
<html lang="eng">
<head>
    <title>Site menu</title>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="sites.css">

</head>
<body>


<div id="nav">
    <center>
        <h2> Welcome <?php
            echo $logName ?></h2>
    </center>
    <h3>Navigations to site</h3>

    <?php
    $admin = "SELECT * FROM `users` WHERE login = '" . $logName . "' AND password='" . $logPass . "' AND role = 'Administrator' ";
    $adminResult = mysqli_query($conn, $admin);
    if (mysqli_num_rows($adminResult) == 1) {
        echo "<a href='Administrator.php'> Admin</a>" . '<br>';
        echo "<a href='Moderator.php'> Moderator</a>" . '<br>';
        echo "<a href='User.php'> User</a>";
    }

    $moderator = "SELECT * FROM `users` WHERE login = '$logName' AND password='$logPass' AND role = 'Moderator' ";
    $moderatorResult = mysqli_query($conn, $moderator);
    if (mysqli_num_rows($moderatorResult) == 1) {
        echo "<a href='Moderator.php'> Moderator</a>" . '<br>';
        echo "<a href='User.php'> User</a>";
    }

    $user = "SELECT * FROM `users` WHERE login = '$logName' AND password='$logPass' AND role = 'User' ";
    $userResult = mysqli_query($conn, $user);
    if (mysqli_num_rows($userResult) == 1) {
        echo "<a href='User.php'> User</a>";
    }

    ?>

</div>
</body>
</html>