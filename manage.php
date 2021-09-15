<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage database</title>
    <style>
        td {
            border: 1px solid black;
            margin: 0;
            padding: 0;
        }

        tr {
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
    <h1>Database preview</h1>
    <?php

    $conn = @new mysqli($_SESSION["servername"], $_SESSION["username"], $_SESSION["password"]);
    if ($conn->connect_error) {
        die("Connection failed, try again");
    } else {

        echo ("<form method='POST' action=''><label>Select database to see tables: <select name='database'>");
        $result = mysqli_query($conn, "SHOW DATABASES");
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {


                echo ("<option >" . $row["Database"] . "</option>");
            }
        }
        echo ("</select></label><input type='submit' value='Show'></form>");
    }
    $conn->close();
    if (!empty($_POST)) {
        $conn = @new mysqli($_SESSION["servername"], $_SESSION["username"], $_SESSION["password"], $_POST['database']);
        $_SESSION["database"] = $_POST["database"];
        if ($conn->connect_error) {
            die("Connection failed, try again");
        } else {
            echo ("<br>Connection successful. You are lokking at database:" . $_SESSION["database"] . ".<br>");

            $result = mysqli_query($conn, "SHOW TABLES");
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck > 0) {
                echo ("<table><tr><td>List of tables in " . $_SESSION["database"] . "</td></tr>");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo ("<tr><td>" . $row['Tables_in_' . $_SESSION["database"]] . "</td></tr>");
                }
                echo ("</table>");
            } else {
                echo ("There is no tables in that database");
            }
        }
    }


    ?>
</body>

</html>