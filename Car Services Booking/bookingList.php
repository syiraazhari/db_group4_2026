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
            bookings.vehicleID,
            bookings.bookingDate,
            bookings.bookingTime,
            bookings.bookingStatus,
            bookings.bookingNotes,

            account.fName,
            account.lName,
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

        WHERE bookings.email = '$email'

        ORDER BY bookings.bookingDate DESC, bookings.bookingTime DESC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Booking List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container-fluid mt-5 px-4">
    <div class="card shadow-sm">

        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">My Car Service Bookings</h3>

            <div class="d-flex gap-2">
                <a href="addBooking.php" class="btn btn-primary btn-sm">Add New Booking</a>
                <a href="customerhome.php" class="btn btn-outline-light btn-sm">Back to Home</a>
            </div>
        </div>

        <div class="card-body">

            <?php if(isset($_GET['message'])): ?>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <?php echo htmlspecialchars($_GET['message']); ?>
                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered align-middle">

                    <thead class="table-secondary">
                        <tr>
                            <th>Booking ID</th>
                            <th>Customer Name</th>
                            <th>Contact Details</th>
                            <th>Vehicle Details</th>
                            <th>Schedule</th>
                            <th>Notes</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if(mysqli_num_rows($result) > 0): ?>

                            <?php while($row = mysqli_fetch_assoc($result)): ?>

                                <tr>
                                    <td><?php echo htmlspecialchars($row['bookingID']); ?></td>

                                    <td>
                                        <?php echo htmlspecialchars($row['fName'] . " " . $row['lName']); ?>
                                    </td>

                                    <td>
                                        <small>
                                            📱 <?php echo htmlspecialchars($row['contactNo']); ?><br>
                                            📧 <?php echo htmlspecialchars($row['email']); ?>
                                        </small>
                                    </td>

                                    <td>
                                        <span class="badge bg-secondary">
                                            <?php echo htmlspecialchars($row['plateNumber']); ?>
                                        </span>
                                        <br>

                                        <small class="text-muted">
                                            <?php 
                                                echo htmlspecialchars(
                                                    $row['vehicleType'] . " - " .
                                                    $row['maker'] . " " .
                                                    $row['model'] . " (" .
                                                    $row['year'] . ")"
                                                );
                                            ?>
                                        </small>
                                    </td>

                                    <td>
                                        <small>
                                            📅 <?php echo htmlspecialchars($row['bookingDate']); ?><br>
                                            ⏰ <?php echo htmlspecialchars($row['bookingTime']); ?>
                                        </small>
                                    </td>

                                    <td>
                                        <small class="text-truncate d-inline-block" 
                                               style="max-width: 150px;" 
                                               title="<?php echo htmlspecialchars($row['bookingNotes']); ?>">
                                            <?php echo htmlspecialchars($row['bookingNotes']); ?>
                                        </small>
                                    </td>

                                    <td class="text-center">
                                        <?php
                                            $status = $row['bookingStatus'];
                                            $badgeClass = "bg-secondary";

                                            if ($status == "Pending") {
                                                $badgeClass = "bg-warning text-dark";
                                            } else if ($status == "Approved") {
                                                $badgeClass = "bg-primary";
                                            } else if ($status == "Completed") {
                                                $badgeClass = "bg-success";
                                            } else if ($status == "Cancelled") {
                                                $badgeClass = "bg-danger";
                                            }
                                        ?>

                                        <span class="badge <?php echo $badgeClass; ?>">
                                            <?php echo htmlspecialchars($status); ?>
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        <?php if ($row['bookingStatus'] != "Completed"): ?>

                                            <a href="deleteBooking.php?bookingID=<?php echo $row['bookingID']; ?>" 
                                               class="btn btn-danger btn-sm"
                                               onclick="return confirm('Are you sure you want to delete this booking?');">
                                                Delete
                                            </a>

                                        <?php else: ?>

                                            <button class="btn btn-secondary btn-sm" disabled>
                                                Locked
                                            </button>

                                        <?php endif; ?>
                                    </td>
                                </tr>

                            <?php endwhile; ?>

                        <?php else: ?>

                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    No booking records found.
                                </td>
                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>
            </div>

        </div>
    </div>
</div>

</body>
</html>

<?php mysqli_close($conn); ?>