<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// HANDLE DATABASE INSERTION ON FORM SUBMISSION
if (isset($_POST['add'])) {

    $conn = mysqli_connect("localhost", "root", "", "carservicebooking");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $CustomerName = $_POST['CustomerName'];
    $PhoneNumber  = $_POST['PhoneNumber'];
    $Email        = $_POST['Email'];
    $Address      = $_POST['Address'];
    $VehicleType  = $_POST['VehicleType'];
    $PlateNumber  = $_POST['PlateNumber'];
    $ServiceType  = $_POST['ServiceType'];
    $BookingDate  = $_POST['BookingDate'];
    $BookingTime  = $_POST['BookingTime'];
    $Reason_Notes = $_POST['Reason_Notes'];

    $BookingStatus = "Pending";

    $sql = "INSERT INTO bookings 
            (CustomerName, PhoneNumber, Email, Address, VehicleType, PlateNumber, ServiceType, BookingDate, BookingTime, Reason_Notes, BookingStatus)
            VALUES
            ('$CustomerName', '$PhoneNumber', '$Email', '$Address', '$VehicleType', '$PlateNumber', '$ServiceType', '$BookingDate', '$BookingTime', '$Reason_Notes', '$BookingStatus')";

    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        header("Location: bookingList.php?message=New booking registered successfully");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
        mysqli_close($conn);
    }
}
?>