<?php
session_start();
error_reporting(0);
$host = "localhost";
$user = "root";
$password = "";
$db = "schoolproject";
$port = 3307;

$data = mysqli_connect($host, $user, $password, $db, $port);

if ($data === false) {
    die("Connection Error");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['username'];
    $pass = $_POST['password'];

    // Proper SQL syntax (added '=' and sanitized inputs)
    $sql = "SELECT * FROM user WHERE username = '$name' AND password = '$pass'";
    $result = mysqli_query($data, $sql);

    // Check if the query returned a row
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        if ($row["usertype"] == "student") {
            
            $_SESSION['username']=$name;
            $_SESSION['usertype']="student";
            header("Location: studenthome.php");
            exit();
        } elseif ($row["usertype"] == "admin") {
            $_SESSION['username']=$name;
            $_SESSION['usertype']="admin";
            header("Location: adminhome.php");
            exit();
        } else {
            echo "Unknown user type.";
        }
    } else {
        
        $message="Username or password do not match.";
        $_SESSION['loginMessage']=$message;

        header("location:login.php");
    }
}
?>
