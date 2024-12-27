<?php
session_start();

$_SESSION['success'] = "";
$db = mysqli_connect('localhost', 'root', '', 'user');

$email = mysqli_real_escape_string($db, $_POST['email']);
$password = mysqli_real_escape_string($db, $_POST['password']);

$query = "SELECT `email`, `USER_PW` FROM `user_info` WHERE `email`='$email' AND `USER_PW`='$password'";
$results = mysqli_query($db, $query);

if (mysqli_num_rows($results) == 1) {
    header("Location: home.html");
    exit();
} else {
    echo "<div class='error-message'>
            <p style='color: #ff0000; text-align: center; font-weight: bold; font-size: 16px;'>Username or password incorrect</p>
          </div>";
}
?>
