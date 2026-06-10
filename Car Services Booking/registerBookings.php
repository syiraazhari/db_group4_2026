<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 1. HANDLE DATABASE INSERTION ON FORM SUBMISSION
if (isset($_POST['add'])) {
    $conn = mysqli_connect("localhost", "root", "", "carservicebooking(1)");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }	

    $bookingID = $_POST[' bookingID'];
    $vehicleID  = $_POST['vehicleID'];
    $email        = $_POST['email'];
    $bookingDate  = $_POST['bookingDate'];
    $bookingTime  = $_POST['bookingTime'];
//    $bookingStatus = $_POST['bookingStatus'];
	$bookingNotes = $_POST['bookingNotes'];
    $bookingStatus = "Pending";

    $sql = "INSERT INTO bookings (
                 bookingID, vehicleID, email,
                 bookingDate, bookingTime, bookingStatus, bookingNotes;
            ) VALUES (
                '$bookingID', '$vehicleID', '$email',
                '$bookingDate', '$bookingTime', '$bookingStatus','$bookingNotes'
            )";

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Service Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8"> 
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">New Car Service Booking</h3>
                    </div>
                    <div class="card-body">
                        <form action="registerBookings.php" method="POST">
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="CustomerName" class="form-label">Customer Name:</label>
                                    <input type="text" class="form-control" id="CustomerName" name="CustomerName" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="PhoneNumber" class="form-label">Phone Number:</label>
                                    <input type="text" class="form-control" id="PhoneNumber" name="PhoneNumber" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="Email" class="form-label">Email Address:</label>
                                <input type="email" class="form-control" id="Email" name="Email">
                            </div>

                            <div class="mb-3">
                                <label for="Address" class="form-label">Address:</label>
                                <textarea class="form-control" id="Address" name="Address" rows="2"></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="VehicleType" class="form-label">Vehicle Type (e.g., Sedan, SUV):</label>
                                    <input type="text" class="form-control" id="VehicleType" name="VehicleType" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="PlateNumber" class="form-label">Plate Number:</label>
                                    <input type="text" class="form-control" id="PlateNumber" name="PlateNumber" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="ServiceType" class="form-label">Service Type:</label>
                                <select class="form-select" id="ServiceType" name="ServiceType" required>
                                    <option value="" selected disabled>-- Select Service Needed --</option>
                                    <option value="Major Service">Major Service</option>
                                    <option value="Minor Service">Minor Service</option>
                                    <option value="Oil Change">Oil Change</option>
                                    <option value="Brake Repair">Brake Repair</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="BookingDate" class="form-label">Preferred Date:</label>
                                    <input type="date" class="form-control" id="BookingDate" name="BookingDate" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="BookingTime" class="form-label">Preferred Time:</label>
                                    <input type="time" class="form-control" id="BookingTime" name="BookingTime" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="Reason_Notes" class="form-label">Reason / Special Notes:</label>
                                <textarea class="form-control" id="Reason_Notes" name="Reason_Notes" rows="3" placeholder="Describe car issues or structural requests..."></textarea>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" name="add" class="btn btn-primary">Submit Booking</button>
                                <a href="bookingList.php" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>