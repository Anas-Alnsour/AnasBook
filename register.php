<?php

session_start();

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'user';

$db = mysqli_connect($host, $username, $password, $database);
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $firstname = mysqli_real_escape_string($db, trim($_POST['firstName']));
    $lastname = mysqli_real_escape_string($db, trim($_POST['lastName']));
    $email = mysqli_real_escape_string($db, trim($_POST['email']));
    $password = mysqli_real_escape_string($db, trim($_POST['password']));

    $query = "INSERT INTO `user_info` (`FIRST_NAME`, `LAST_NAME`, `EMAIL`, `USER_PW`) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($db, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssss', $firstname, $lastname, $email, $password);

        if (mysqli_stmt_execute($stmt)) {

            header("Location: login.html");
            exit();
        } else {

            error_log("Database Error: " . mysqli_error($db));
            echo "An error occurred. Please try again later.";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing the statement: " . mysqli_error($db);
    }
}

mysqli_close($db);
?>
