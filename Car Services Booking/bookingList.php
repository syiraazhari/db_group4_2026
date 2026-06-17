<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = mysqli_connect("localhost", "root", "", "carservicebooking");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$email = $_SESSION['email'];

$sql = "SELECT 
            bookings.bookingID,
            bookings.email,
            bookings.bookingDate,
            bookings.bookingTime,
            bookings.bookingStatus,
            bookings.bookingNotes,
            service.serviceName,
            vehicles.vehicleType,
            vehicles.maker,
            vehicles.model,
            vehicles.year,
            vehicles.plateNumber,
            account.fName,
            account.lName,
            account.contactNo
        FROM bookings
        INNER JOIN vehicles 
            ON bookings.vehicleID = vehicles.vehicleID
        INNER JOIN service 
            ON bookings.serviceID = service.serviceID
        INNER JOIN account 
            ON bookings.email = account.email
        WHERE bookings.email = '$email'
        ORDER BY bookings.bookingID DESC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking List</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
<div class="container mt-5">

    <div class="card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3>Your Bookings</h3>
            <a href="addBooking.php" class="btn btn-light">Add New Booking</a>
        </div>

        <div class="card-body">

            <?php if(isset($_GET['message'])): ?>
                <div class="alert alert-success">
                    <?php echo htmlspecialchars($_GET['message']); ?>
                </div>
            <?php endif; ?>

            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Booking ID</th>
                        <th>Name</th>
                        <th>Contact No.</th>
                        <th>Vehicle Type</th>
                        <th>Maker</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>Plate Number</th>
                        <th>Service</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Notes</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>

                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['bookingID']); ?></td>
                                <td><?php echo htmlspecialchars($row['fName'] . " " . $row['lName']); ?></td>
                                <td><?php echo htmlspecialchars($row['contactNo']); ?></td>
                                <td><?php echo htmlspecialchars($row['vehicleType']); ?></td>
                                <td><?php echo htmlspecialchars($row['maker']); ?></td>
                                <td><?php echo htmlspecialchars($row['model']); ?></td>
                                <td><?php echo htmlspecialchars($row['year']); ?></td>
                                <td><?php echo htmlspecialchars($row['plateNumber']); ?></td>
                                <td><?php echo htmlspecialchars($row['serviceName']); ?></td>
                                <td><?php echo htmlspecialchars($row['bookingDate']); ?></td>
                                <td><?php echo htmlspecialchars($row['bookingTime']); ?></td>
                                <td><?php echo htmlspecialchars($row['bookingStatus']); ?></td>
                                <td><?php echo htmlspecialchars($row['bookingNotes']); ?></td>
                                <td>
                                    <a href="updateBooking.php?bookingID=<?php echo htmlspecialchars($row['bookingID']); ?>" 
                                       class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <a href="deleteBooking.php?bookingID=<?php echo htmlspecialchars($row['bookingID']); ?>" 
                                       class="btn btn-danger btn-sm"
                                       onclick="confirmDelete(event, this.href);">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="14" class="text-center">No bookings found.</td>
                        </tr>

                    <?php endif; ?>
                </tbody>
            </table>

            <a href="customerhome.php" class="btn btn-secondary">Back to Home</a>

        </div>
    </div>

</div>

<script>
function confirmDelete(event, deleteUrl) {
    event.preventDefault();

    Swal.fire({
        title: "Are you sure you want to delete the booking?",
        text: "This booking will be permanently deleted.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#6c757d",
        confirmButtonText: "Yes, delete it",
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = deleteUrl;
        }
    });
}
</script>

</body>
</html>

<?php mysqli_close($conn); ?>