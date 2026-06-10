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

$formSubmitted = false;

if(isset($_POST['add'])){

    $services = isset($_POST['serviceType']) ? $_POST['serviceType'] : [];
    $serviceList = implode(", ", $services); 
    
    $customerName = mysqli_real_escape_string($conn, $_POST['customerName']);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    $vehicleType = mysqli_real_escape_string($conn, $_POST['vehicleType']);
    $plateNumber = mysqli_real_escape_string($conn, $_POST['plateNumber']);

    $serviceTypeEscaped = mysqli_real_escape_string($conn, $serviceList); 

    $bookingDate = mysqli_real_escape_string($conn, $_POST['bookingDate']);
    $bookingTime = mysqli_real_escape_string($conn, $_POST['bookingTime']);

    $reasonNotes = mysqli_real_escape_string($conn, $_POST['reasonNotes']);


    // $sql = "INSERT INTO bookings (...) VALUES (...)";
    // mysqli_query($conn, $sql);

    $formSubmitted = true;

    echo "<div style='font-family: Arial, sans-serif; max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; background: #f9f9f9;'>";
    echo "<h2 style='color: green;'>Booking Submitted Successfully</h2>";

    echo "<b>Customer:</b> $customerName<br>";
    echo "<b>Phone:</b> $phoneNumber<br>";
    echo "<b>Email:</b> $email<br>";
    echo "<b>Address:</b> $address<br><br>";

    echo "<b>Vehicle:</b> $vehicleType<br>";
    echo "<b>Plate Number:</b> $plateNumber<br><br>";

    echo "<b>Service(s):</b> $serviceTypeEscaped<br>";
    echo "<b>Date:</b> $bookingDate<br>";
    echo "<b>Time:</b> $bookingTime<br>";
    echo "<b>Notes:</b> $reasonNotes<br><br>";
    echo "<a href=''>Book Another Appointment</a>";
    echo "</div>";
}

mysqli_close($conn);

// Only show the form if it hasn't been submitted yet
if (!$formSubmitted): 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Service Booking</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; padding: 20px; }
        .form-container { max-width: 600px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        h2 { margin-top: 0; color: #333; border-bottom: 2px solid #3498db; padding-bottom: 10px; }
        h3 { margin-top: 20px; color: #555; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; color: #666; }
        .form-group input[type="text"], .form-group input[type="email"], .form-group input[type="date"], .form-group input[type="time"], .form-group textarea { width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        .checkbox-group { margin: 10px 0; }
        .checkbox-group label { font-weight: normal; margin-left: 5px; }
        .btn-submit { background-color: #3498db; color: white; padding: 12px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; width: 100%; }
        .btn-submit:hover { background-color: #2980b9; }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Book a Car Service Appointment</h2>
    <form action="" method="POST">
        
        <h3>Customer Information</h3>
        <div class="form-group">
            <label for="customerName">Full Name</label>
            <input type="text" id="customerName" name="customerName" required>
        </div>
        
        <div class="form-group">
            <label for="phoneNumber">Phone Number</label>
            <input type="text" id="phoneNumber" name="phoneNumber" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" id="address" name="address" required>
        </div>

        <h3>Vehicle Information</h3>
        <div class="form-group">
            <label for="vehicleType">Vehicle Model / Type (e.g., Honda Civic)</label>
            <input type="text" id="vehicleType" name="vehicleType" required>
        </div>
        
        <div class="form-group">
            <label for="plateNumber">Plate Number</label>
            <input type="text" id="plateNumber" name="plateNumber" required>
        </div>

        <h3>Service Details</h3>
        <div class="form-group">
            <label>Select Services Required</label>
            <div class="checkbox-group">
                <input type="checkbox" name="serviceType[]" value="Oil Change" id="oil">
                <label for="oil">Oil Change</label>
            </div>
            <div class="checkbox-group">
                <input type="checkbox" name="serviceType[]" value="Brake Repair" id="brakes">
                <label for="brakes">Brake Repair</label>
            </div>
            <div class="checkbox-group">
                <input type="checkbox" name="serviceType[]" value="Tire Rotation" id="tires">
                <label for="tires">Tire Rotation / Alignment</label>
            </div>
            <div class="checkbox-group">
                <input type="checkbox" name="serviceType[]" value="Engine Diagnostics" id="engine">
                <label for="engine">Engine Diagnostics</label>
            </div>
        </div>
        
        <div class="form-group">
            <label for="bookingDate">Preferred Date</label>
            <input type="date" id="bookingDate" name="bookingDate" required>
        </div>
        
        <div class="form-group">
            <label for="bookingTime">Preferred Time</label>
            <input type="time" id="bookingTime" name="bookingTime" required>
        </div>
        
        <div class="form-group">
            <label for="reasonNotes">Additional Notes / Symptoms</label>
            <textarea id="reasonNotes" name="reasonNotes" rows="4" placeholder="Describe any issues your car is having..."></textarea>
        </div>

        <button type="submit" name="add" class="btn-submit">Submit</button>
    </form>
</div>

</body>
</html>

<?php endif; ?>