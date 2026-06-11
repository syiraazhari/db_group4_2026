<?php
session_start();


$conn = mysqli_connect("localhost", "root", "", "carservicebooking");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['bookingID'])) {

    $bookingID = mysqli_real_escape_string($conn, $_GET['bookingID']);
    $email = $_SESSION['email'];

    $sql = "DELETE FROM bookings 
            WHERE bookingID = '$bookingID'
            AND email = '$email'
            AND bookingStatus != 'Completed'";

    if (mysqli_query($conn, $sql)) {

        if (mysqli_affected_rows($conn) > 0) {
            header("Location: bookingList.php?message=Booking deleted successfully");
            exit();
        } else {
            header("Location: bookingList.php?message=Booking not deleted. It may already be completed or does not belong to you.");
            exit();
        }

    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }

} else {
    header("Location: bookingList.php?message=No booking selected for deletion");
    exit();
}

mysqli_close($conn);
?>