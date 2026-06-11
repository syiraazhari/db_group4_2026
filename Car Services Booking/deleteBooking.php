<?php
$conn = mysqli_connect("localhost", "root", "", "carservicebooking");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_GET['id'])){

    $BookingID = mysqli_real_escape_string($conn, $_GET['id']);

    $sql = "DELETE FROM bookings WHERE BookingID = '$BookingID'";
    
    if(mysqli_query($conn, $sql)){
  
        header("Location: bookingList.php?message=Booking deleted successfully");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    header("Location: bookingList.php?message=No booking selected for deletion");
    exit();
}

mysqli_close($conn);
?>