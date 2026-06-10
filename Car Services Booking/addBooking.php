<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Make sure user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Make sure only customer can access
if ($_SESSION['role'] != "Customer") {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "carservicebooking");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get logged-in customer info from session
$username = $_SESSION['username'];
$email = $_SESSION['email'];
$fullName = $_SESSION['fName'] . " " . $_SESSION['lName'];

$formSubmitted = false;

if (isset($_POST['add'])) {

    // Vehicle form data
    $vehicleType = mysqli_real_escape_string($conn, $_POST['vehicleType']);
    $maker = mysqli_real_escape_string($conn, $_POST['maker']);
    $model = mysqli_real_escape_string($conn, $_POST['model']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $plateNumber = mysqli_real_escape_string($conn, $_POST['plateNumber']);

    // Booking form data
    $bookingDate = mysqli_real_escape_string($conn, $_POST['bookingDate']);
    $bookingTime = mysqli_real_escape_string($conn, $_POST['bookingTime']);
    $bookingNotes = mysqli_real_escape_string($conn, $_POST['bookingNotes']);
    $bookingStatus = "Pending";

    // 1. Insert vehicle first
    $vehicleSql = "INSERT INTO vehicles 
                   (username, vehicleType, maker, model, year, plateNumber)
                   VALUES
                   ('$username', '$vehicleType', '$maker', '$model', '$year', '$plateNumber')";

    if (mysqli_query($conn, $vehicleSql)) {

        // Get the newly created vehicleID
        $vehicleID = mysqli_insert_id($conn);

        // 2. Insert booking using vehicleID
        $bookingSql = "INSERT INTO bookings
                       (email, vehicleID, bookingDate, bookingTime, bookingStatus, bookingNotes)
                       VALUES
                       ('$email', '$vehicleID', '$bookingDate', '$bookingTime', '$bookingStatus', '$bookingNotes')";

        if (mysqli_query($conn, $bookingSql)) {
            $formSubmitted = true;
        } else {
            echo "Booking Error: " . mysqli_error($conn);
        }

    } else {
        echo "Vehicle Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<?php if ($formSubmitted): ?>

<!DOCTYPE html>
<html>
<head>
    <title>Booking Successful</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<script>
    Swal.fire({
        icon: 'success',
        title: 'Booking Submitted',
        text: 'Your appointment has been submitted successfully. Status: Pending.',
        confirmButtonText: 'OK'
    }).then(function() {
        window.location.href = 'customerhome.php';
    });
</script>

</body>
</html>

<?php else: ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Appointment</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            padding: 20px;
        }

        .form-container {
            max-width: 650px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        h2 {
            margin-top: 0;
            color: #333;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }

        h3 {
            margin-top: 25px;
            color: #555;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #666;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[readonly] {
            background-color: #e9ecef;
            cursor: not-allowed;
        }

        .btn-submit {
            background-color: #3498db;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            margin-top: 10px;
        }

        .btn-submit:hover {
            background-color: #2980b9;
        }

        .btn-back {
            display: block;
            text-align: center;
            background-color: #6c757d;
            color: white;
            padding: 12px;
            border-radius: 4px;
            text-decoration: none;
            margin-top: 10px;
        }

        .btn-back:hover {
            background-color: #5a6268;
        }
    </style>
</head>

<body>

<div class="form-container">

    <h2>Book a Car Service Appointment</h2>

    <form action="" method="POST">

        <h3>Customer Information</h3>

        <div class="form-group">
            <label>Full Name</label>
            <input type="text" value="<?php echo $fullName; ?>" readonly>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" value="<?php echo $email; ?>" readonly>
        </div>

        <h3>Vehicle Information</h3>

        <div class="form-group">
            <label for="vehicleType">Vehicle Type</label>
            <select id="vehicleType" name="vehicleType" required>
                <option value="" disabled selected>-- Select Vehicle Type --</option>
                <option value="Sedan">Sedan</option>
                <option value="SUV">SUV</option>
                <option value="Hatchback">Hatchback</option>
                <option value="MPV">MPV</option>
                <option value="Pickup Truck">Pickup Truck</option>
                <option value="Van">Van</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <div class="form-group">
            <label for="maker">Maker</label>
            <input type="text" id="maker" name="maker" placeholder="Example: Perodua, Proton, Honda" required>
        </div>

        <div class="form-group">
            <label for="model">Model</label>
            <input type="text" id="model" name="model" placeholder="Example: Myvi, Saga, Civic" required>
        </div>

        <div class="form-group">
            <label for="year">Year</label>
            <input type="number" id="year" name="year" placeholder="Example: 2020" required>
        </div>

        <div class="form-group">
            <label for="plateNumber">Plate Number</label>
            <input type="text" id="plateNumber" name="plateNumber" placeholder="Example: ABC1234" required>
        </div>

        <h3>Booking Details</h3>

        <div class="form-group">
            <label for="bookingDate">Booking Date</label>
            <input type="date" id="bookingDate" name="bookingDate" required>
        </div>

        <div class="form-group">
            <label for="bookingTime">Booking Time</label>
            <input type="time" id="bookingTime" name="bookingTime" required>
        </div>

        <div class="form-group">
            <label for="bookingNotes">Booking Notes</label>
            <textarea id="bookingNotes" name="bookingNotes" rows="4" placeholder="Describe your car issue or service request..."></textarea>
        </div>

        <button type="submit" name="add" class="btn-submit">Submit Booking</button>

        <a href="customerhome.php" class="btn-back">Back to Customer Home</a>

    </form>

</div>

</body>
</html>

<?php endif; ?>