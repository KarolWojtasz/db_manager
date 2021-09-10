<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Manager</title>
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
    <h1>Database manager</h1>
    <form action="" method="POST">
        <label>username: <input type="text" name="username"></label>
        <label>password: <input type="password" name="password"></label>
        <input type="submit" name="submit">
    </form>
    <?php


    if (!empty($_POST)) {
        if ($_POST["username"] == NULL || $_POST["password"] == NULL) {
            echo ("Fill in the form to login into system");
        } else {
            include("pass.php");
            $conn = new mysqli($servername, $username, $password);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $result = $conn->query("SELECT * FROM users");
            if ($result) {
                while ($row = $result->fetch_object()) {
                    $user_arr[] = $row;
                    echo ($row["username"]);
                }
                // Free result set
                echo ($row["username"]);
                $result->close();
                $db->next_result();
            }
        }
    }
    ?>
</body>

</html>