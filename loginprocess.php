<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "carservicebooking");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['login'])) {

    $username = $_POST['user'];
    $password = $_POST['passkey'];

    $sql = "SELECT username, fName, lName, role 
            FROM account
            WHERE username = '$username' 
            AND password = '$password'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);

        $_SESSION['username'] = $row['username'];
        $_SESSION['fName'] = $row['fName'];
        $_SESSION['lName'] = $row['lName'];
        $_SESSION['role'] = $row['role'];

        if ($row['role'] == "admin") {
            header("Location: admindashboard.php");
            exit();
        } else {
            header("Location: customerHome.php");
            exit();
        }

    } else {
        echo "Invalid username or password.";
    }
}
?>