<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Connection</title>
    <style>
        form {
            display: flex;
            flex-direction: column;

        }

        input {
            justify-content: center;
            width: 100px;

            margin: 20px;
        }
    </style>
</head>

<body>
    <h1>Connect to mysql host</h1>
    <form action="" method="POST">
        <label>Database address: <input type="text" name="servername"></label>
        <label>username: <input type="text" name="username"></label>
        <label>password: <input type="password" name="password"></label>
        <input type="submit" name="submit">
    </form>
    <?php


    if (!empty($_POST)) {
        if ($_POST["username"] == NULL || $_POST["servername"] == NULL) {
            echo ("Fill in the form to login into system");
        } else {

            $conn = @new mysqli($_POST["servername"], $_POST["username"], $_POST["password"]);

            if ($conn->connect_error) {
                die("Connection failed, try again");
            } else {
                echo ("Connection successful");

                $_SESSION["servername"] = $_POST["servername"];
                $_SESSION["username"] = $_POST["username"];
                $_SESSION["password"] = $_POST["password"];


                $address = substr($_SERVER['PHP_SELF'], 0, -9);
                header('Location: ' . $address . "manage.php");
            }
        }
    }
    ?>
</body>

</html>