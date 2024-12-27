<?php
$email = $_POST['email'];
$old_password = $_POST['old_pass'];
$password_1 = $_POST['password_1'];
$password_2 = $_POST['password_2'];


if ($password_1 == $password_2) {
    try {

        $conn = mysqli_connect('localhost', 'root', '', 'user');


        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }


        $sql = "UPDATE `user_info` SET `USER_PW` = ? WHERE `email` = ? AND `USER_PW` = ?";


        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "sss", $password_1, $email, $old_password);


            if (mysqli_stmt_execute($stmt)) {

                header("Location: home.html");
                exit();
            } else {

                echo "Username or password incorrect";
            }


            mysqli_stmt_close($stmt);
        } else {

            echo "Error preparing statement: " . mysqli_error($conn);
        }


        mysqli_close($conn);
    } catch (Exception $e) {

        echo "Error: " . $e->getMessage();
    }
} else {

    echo "The two passwords do not match";
}
?>
