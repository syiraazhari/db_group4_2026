<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "carservicesbooking"
);

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['add'])){

	$services = isset($_POST['serviceType']) ? $_POST['serviceType'] : [];

	$serviceList = implode(", ", $services); // convert array to string
	
    $customerName = mysqli_real_escape_string($conn, $_POST['customerName']);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    $vehicleType = mysqli_real_escape_string($conn, $_POST['vehicleType']);
    $plateNumber = mysqli_real_escape_string($conn, $_POST['plateNumber']);

    $serviceType = mysqli_real_escape_string($conn, $_POST['serviceType']);

    $bookingDate = mysqli_real_escape_string($conn, $_POST['bookingDate']);
    $bookingTime = mysqli_real_escape_string($conn, $_POST['bookingTime']);

    $reasonNotes = mysqli_real_escape_string($conn, $_POST['reasonNotes']);

    echo "<h2>Booking Submitted Successfully</h2>";

    echo "<b>Customer:</b> $customerName<br>";
    echo "<b>Phone:</b> $phoneNumber<br>";
    echo "<b>Email:</b> $email<br>";
    echo "<b>Address:</b> $address<br><br>";

    echo "<b>Vehicle:</b> $vehicleType<br>";
    echo "<b>Plate Number:</b> $plateNumber<br><br>";

    echo "<b>Service:</b> $serviceType<br>";
    echo "<b>Date:</b> $bookingDate<br>";
    echo "<b>Time:</b> $bookingTime<br>";
    echo "<b>Notes:</b> $reasonNotes<br>";

}

mysqli_close($conn);

?>