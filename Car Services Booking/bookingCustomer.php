<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);



$conn = mysqli_connect("localhost", "root", "", "carservicebooking");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT 
            bookings.bookingID,
            bookings.email,
            bookings.vehicleID,
            bookings.bookingDate,
            bookings.bookingTime,
            bookings.bookingStatus,
            bookings.bookingNotes,

            account.fName,
            account.lName,
            account.username,
            account.contactNo,

            vehicles.vehicleType,
            vehicles.maker,
            vehicles.model,
            vehicles.year,
            vehicles.plateNumber

        FROM bookings

        INNER JOIN account 
            ON bookings.email = account.email

        INNER JOIN vehicles 
            ON bookings.vehicleID = vehicles.vehicleID

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
    <title>Customer Bookings</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Bookings Made by Customers</h3>
            <a href="admindashboard.php" class="btn btn-light btn-sm">Back to Dashboard</a>
        </div>

        <div class="card-body">

            <?php if (isset($_GET['message'])): ?>
                <div class="alert alert-success">
                    <?php echo htmlspecialchars($_GET['message']); ?>
                </div>
            <?php endif; ?>

            <?php if (mysqli_num_rows($result) > 0): ?>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Booking ID</th>
                                <th>Customer Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Contact No</th>
                                <th>Vehicle Type</th>
                                <th>Maker</th>
                                <th>Model</th>
                                <th>Year</th>
                                <th>Plate Number</th>
                                <th>Booking Date</th>
                                <th>Booking Time</th>
                                <th>Status</th>
                                <th>Notes</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['bookingID']); ?></td>

                                    <td>
                                        <?php echo htmlspecialchars($row['fName'] . " " . $row['lName']); ?>
                                    </td>

                                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                                    <td><?php echo htmlspecialchars($row['contactNo']); ?></td>

                                    <td><?php echo htmlspecialchars($row['vehicleType']); ?></td>
                                    <td><?php echo htmlspecialchars($row['maker']); ?></td>
                                    <td><?php echo htmlspecialchars($row['model']); ?></td>
                                    <td><?php echo htmlspecialchars($row['year']); ?></td>
                                    <td><?php echo htmlspecialchars($row['plateNumber']); ?></td>

                                    <td><?php echo htmlspecialchars($row['bookingDate']); ?></td>
                                    <td><?php echo htmlspecialchars($row['bookingTime']); ?></td>

                                    <td>
                                        <?php
                                            $status = $row['bookingStatus'];

                                            if ($status == "Pending") {
                                                echo "<span class='badge bg-warning text-dark'>Pending</span>";
                                            } else if ($status == "Approved") {
                                                echo "<span class='badge bg-primary'>Approved</span>";
                                            } else if ($status == "Completed") {
                                                echo "<span class='badge bg-success'>Completed</span>";
                                            } else if ($status == "Rejected") {
                                                echo "<span class='badge bg-danger'>Rejected</span>";
                                            } else {
                                                echo "<span class='badge bg-secondary'>" . htmlspecialchars($status) . "</span>";
                                            }
                                        ?>
                                    </td>

                                    <td><?php echo htmlspecialchars($row['bookingNotes']); ?></td>

                                    <td>
                                        <?php if ($row['bookingStatus'] != "Completed"): ?>
                                            <a href="completeBooking.php ?bookingID=<?php echo $row['bookingID']; ?>" 
                                               class="btn btn-success btn-sm"
                                               onclick="return confirm('Mark this booking as completed?');">
                                                Complete
                                            </a>
                                        <?php else: ?>
                                            <button class="btn btn-secondary btn-sm" disabled>
                                                Completed
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

            <?php else: ?>

                <div class="alert alert-info text-center">
                    No customer bookings found.
                </div>

            <?php endif; ?>

        </div>
    </div>

</div>

</body>
</html>

<?php mysqli_close($conn); ?>