<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);



$conn = mysqli_connect("localhost", "root", "", "carservicebooking");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['bookingID'])) {

    $bookingID = mysqli_real_escape_string($conn, $_GET['bookingID']);

    $sql = "UPDATE bookings 
            SET bookingStatus = 'Completed' 
            WHERE bookingID = '$bookingID'";

    if (mysqli_query($conn, $sql)) {
        header("Location: bookingCustomer.php?message=Booking marked as completed");
        exit();
    } else {
        echo "Error updating booking: " . mysqli_error($conn);
    }

} else {
    header("Location: bookingCustomer.php");
    exit();
}

mysqli_close($conn);
?>