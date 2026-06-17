<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['role'] != "Customer") {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "carservicebooking");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$email = $_SESSION['email'];

if (isset($_POST['update'])) {

    $bookingID = mysqli_real_escape_string($conn, $_POST['bookingID']);
    $bookingDate = mysqli_real_escape_string($conn, $_POST['bookingDate']);
    $bookingTime = mysqli_real_escape_string($conn, $_POST['bookingTime']);
    $bookingNotes = mysqli_real_escape_string($conn, $_POST['bookingNotes']);

    $sql = "UPDATE bookings SET
            bookingDate = '$bookingDate',
            bookingTime = '$bookingTime',
            bookingNotes = '$bookingNotes'
            WHERE bookingID = '$bookingID'
            AND email = '$email'";

    if (mysqli_query($conn, $sql)) {
        header("Location: bookingList.php?message=Booking Updated Successfully");
        exit();
    } else {
        echo "Error : " . mysqli_error($conn);
    }
}

if (isset($_GET['bookingID'])) {

    $bookingID = mysqli_real_escape_string($conn, $_GET['bookingID']);

    $result = mysqli_query(
        $conn,
        "SELECT bookingID, bookingDate, bookingTime, bookingNotes 
         FROM bookings 
         WHERE bookingID = '$bookingID'
         AND email = '$email'"
    );

    $booking = mysqli_fetch_assoc($result);

    if (!$booking) {
        header("Location: bookingList.php?message=Booking Not Found");
        exit();
    }

} else {
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
        <p>Edit booking date, time, and notes</p>
    </div>

    <form action="updateBooking.php" method="POST">

        <input type="hidden"
               name="bookingID"
               value="<?php echo $booking['bookingID']; ?>">

        <div class="form-group">
            <label>Booking Date</label>
            <input type="date"
                   name="bookingDate"
                   value="<?php echo htmlspecialchars($booking['bookingDate']); ?>"
                   required>
        </div>

        <div class="form-group">
            <label>Booking Time</label>
            <input type="time"
                   name="bookingTime"
                   value="<?php echo htmlspecialchars($booking['bookingTime']); ?>"
                   required>
        </div>

        <div class="form-group">
            <label>Booking Notes</label>
            <textarea name="bookingNotes"><?php echo htmlspecialchars($booking['bookingNotes']); ?></textarea>
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