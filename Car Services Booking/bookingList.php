<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = mysqli_connect("localhost", "root", "", "carservicesbooking");

if (!$conn) {
    die("Connection failed: " . mysqli_error($conn));
}

// Order by BookingDate and BookingTime so upcoming appointments show clearly
$sql = "SELECT * FROM bookings ORDER BY BookingDate DESC, BookingTime DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Car Service Booking List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid mt-5 px-4">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Car Service Bookings</h3>
                <button a href="addBooking.php" class="btn btn-primary btn-sm">Add New Booking</a></button>
				<button a href="viewBookings.php">View Bookings</a> </button>
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
                                <th>Customer Name</th>
                                <th>Contact Details</th>
                                <th>Vehicle Details</th>
                                <th>Service Type</th>
                                <th>Schedule</th>
                                <th>Notes</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['CustomerName']); ?></td>
                                <td>
                                    <small>
                                        📱 <?php echo htmlspecialchars($row['PhoneNumber']); ?><br>
                                        📧 <?php echo htmlspecialchars($row['Email']); ?>
                                    </small>
                                </td>
                                <td>
                                    <span class="badge bg-secondary"><?php echo htmlspecialchars($row['PlateNumber']); ?></span><br>
                                    <small class="text-muted"><?php echo htmlspecialchars($row['VehicleType']); ?></small>
                                </td>
                                <td><?php echo htmlspecialchars($row['ServiceType']); ?></td>
                                <td>
                                    <small>
                                        📅 <?php echo htmlspecialchars($row['BookingDate']); ?><br>
                                        ⏰ <?php echo htmlspecialchars($row['BookingTime']); ?>
                                    </small>
                                </td>
                                <td>
                                    <small class="text-truncate d-inline-block" style="max-width: 150px;" title="<?php echo htmlspecialchars($row['Reason_Notes']); ?>">
                                        <?php echo htmlspecialchars($row['Reason_Notes']); ?>
                                    </small>
                                </td>
                                <td class="text-center">
                                    <?php
                                    // Dynamic Badge Colors based on the Booking Status
                                    $status = $row['BookingStatus'];
                                    $badgeClass = "bg-secondary";
                                    if ($status == 'Pending') $badgeClass = "bg-warning text-dark";
                                    elseif ($status == 'Confirmed') $badgeClass = "bg-primary";
                                    elseif ($status == 'In Progress') $badgeClass = "bg-info text-dark";
                                    elseif ($status == 'Completed') $badgeClass = "bg-success";
                                    elseif ($status == 'Cancelled') $badgeClass = "bg-danger";
                                    ?>
                                    <span class="badge <?php echo $badgeClass; ?>"><?php echo htmlspecialchars($status); ?></span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex gap-1 justify-content-center">
                                        <a href="updateBooking.php?id=<?php echo $row['BookingID']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="deleteBooking.php?id=<?php echo $row['BookingID']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this booking record?')">Delete</a>
                                    </div>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                            
                            <?php if(mysqli_num_rows($result) == 0): ?>
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">No booking records found.</td>
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