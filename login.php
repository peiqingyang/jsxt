<?php
session_start();
$dbhost = '127.0.0.1';
$dbuser = 'jsxt';
$dbpass = 'password';
$dbname = 'jsxt';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$conn) {
    die('Could not connect: ' . mysqli_error());
}
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) == 1) {
    $_SESSION['username'] = $username;
    header("Location: main.php");
} else {
    header("Location: error.php");
}
mysqli_close($conn);
?>
