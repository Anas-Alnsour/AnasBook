<?php

$email = $_POST['email'];
$password = $_POST['password'];


$conn = mysqli_connect('localhost', 'root', '', 'user');


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql = "DELETE FROM `user_info` WHERE `email` = ? AND `USER_PW` = ?";


$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {

    mysqli_stmt_bind_param($stmt, "ss", $email, $password);


    if (mysqli_stmt_execute($stmt)) {

        header("Location: login.html");
        exit();
    } else {

        echo "Error deleting record: " . mysqli_error($conn);
    }


    mysqli_stmt_close($stmt);
} else {

    echo "Error preparing statement: " . mysqli_error($conn);
}


mysqli_close($conn);
?>
