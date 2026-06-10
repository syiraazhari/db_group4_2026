<?php

$conn = mysqli_connect("localhost", "root", "root", "CarService_db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

/* UPDATE BOOKING */
if(isset($_POST['update'])){

    $bookingID = mysqli_real_escape_string($conn, $_POST['bookingID']);

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
    $bookingStatus = mysqli_real_escape_string($conn, $_POST['bookingStatus']);

    $sql = "UPDATE booking_tbl SET

            CustomerName = '$customerName',
            PhoneNumber = '$phoneNumber',
            Email = '$email',
            Address = '$address',

            VehicleType = '$vehicleType',
            PlateNumber = '$plateNumber',

            ServiceType = '$serviceType',

            BookingDate = '$bookingDate',
            BookingTime = '$bookingTime',

            Reason_Notes = '$reasonNotes',
            BookingStatus = '$bookingStatus'

            WHERE BookingID = '$bookingID'";

    if(mysqli_query($conn, $sql)){
        header("Location: bookingList.php?message=Booking Updated Successfully");
        exit();
    }
    else{
        echo "Error : " . mysqli_error($conn);
    }
}

/* GET BOOKING DATA */
if(isset($_GET['id'])){

    $bookingID = mysqli_real_escape_string($conn, $_GET['id']);

    $result = mysqli_query(
        $conn,
        "SELECT * FROM booking_tbl WHERE BookingID='$bookingID'"
    );

    $booking = mysqli_fetch_assoc($result);

    if(!$booking){
        header("Location: bookingList.php?message=Booking Not Found");
        exit();
    }

}
else{
    header("Location: bookingList.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Update Booking</title>

    <link rel="stylesheet" href="booking.css">

</head>
<body>

<div class="booking-container">

    <div class="booking-header">
        <h2>Update Booking</h2>
        <p>Edit customer booking information</p>
    </div>

    <form action="updateBooking.php" method="POST">

        <input type="hidden"
               name="bookingID"
               value="<?php echo $booking['BookingID']; ?>">

        <h3>Customer Information</h3>

        <div class="form-group">
            <label>Customer Name</label>
            <input type="text"
                   name="customerName"
                   value="<?php echo htmlspecialchars($booking['CustomerName']); ?>"
                   required>
        </div>

        <div class="row">

            <div class="form-group">
                <label>Phone Number</label>
                <input type="text"
                       name="phoneNumber"
                       value="<?php echo htmlspecialchars($booking['PhoneNumber']); ?>"
                       required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email"
                       name="email"
                       value="<?php echo htmlspecialchars($booking['Email']); ?>"
                       required>
            </div>

        </div>

        <div class="form-group">
            <label>Address</label>
            <textarea name="address"><?php echo htmlspecialchars($booking['Address']); ?></textarea>
        </div>

        <h3>Vehicle Information</h3>

        <div class="row">

            <div class="form-group">
                <label>Vehicle Type</label>
                <input type="text"
                       name="vehicleType"
                       value="<?php echo htmlspecialchars($booking['VehicleType']); ?>">
            </div>

            <div class="form-group">
                <label>Plate Number</label>
                <input type="text"
                       name="plateNumber"
                       value="<?php echo htmlspecialchars($booking['PlateNumber']); ?>">
            </div>

        </div>

        <h3>Service Information</h3>

        <div class="form-group">
            <label>Service Type</label>
            <input type="text"
                   name="serviceType"
                   value="<?php echo htmlspecialchars($booking['ServiceType']); ?>">
        </div>

        <div class="row">

            <div class="form-group">
                <label>Booking Date</label>
                <input type="date"
                       name="bookingDate"
                       value="<?php echo $booking['BookingDate']; ?>">
            </div>

            <div class="form-group">
                <label>Booking Time</label>
                <input type="time"
                       name="bookingTime"
                       value="<?php echo $booking['BookingTime']; ?>">
            </div>

        </div>

        <div class="form-group">
            <label>Reason / Notes</label>
            <textarea name="reasonNotes"><?php echo htmlspecialchars($booking['Reason_Notes']); ?></textarea>
        </div>

        <div class="form-group">
            <label>Booking Status</label>

            <select name="bookingStatus">

                <option value="Pending"
                    <?php if($booking['BookingStatus']=="Pending") echo "selected"; ?>>
                    Pending
                </option>

                <option value="Confirmed"
                    <?php if($booking['BookingStatus']=="Confirmed") echo "selected"; ?>>
                    Confirmed
                </option>

                <option value="Completed"
                    <?php if($booking['BookingStatus']=="Completed") echo "selected"; ?>>
                    Completed
                </option>

                <option value="Cancelled"
                    <?php if($booking['BookingStatus']=="Cancelled") echo "selected"; ?>>
                    Cancelled
                </option>

            </select>
        </div>

        <button type="submit"
                name="update"
                class="submit-btn">
            Update Booking
        </button>

    </form>

</div>

</body>
</html>

<?php mysqli_close($conn); ?>