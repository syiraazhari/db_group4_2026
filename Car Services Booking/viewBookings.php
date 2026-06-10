<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = mysqli_connect("localhost", "root", "", "carservicesbooking");

if (!$conn) {
    die("Connection failed: " . mysqli_error($conn));
}

$sql = "SELECT * FROM bookings ORDER BY id";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h3>Your Bookings</h3>
                <a href="addBooking.php" class="btn btn-light">Add New Bookings</a>
            </div>
            <div class="card-body">
                <?php if(isset($_GET['message'])): ?>
                    <div class="alert alert-success"><?php echo htmlspecialchars($_GET['message']); ?></div>
                <?php endif; ?>
                
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr><th>Name</th><th>Contact No.</th><th>Service Type</th><th>Vehicle Type</th><th>Plate Number</th></<th>Action</th></tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['customerName']); ?></td>
                            <td><?php echo htmlspecialchars($row['phoneNumber']); ?></td>
                            <td><?php echo htmlspecialchars($row['serviceType']); ?></td>
                            <td><?php echo htmlspecialchars($row['vehicleType']); ?></td>
                            <td><?php echo htmlspecialchars($row['plateNumber']); ?></td>
							<td>
                                <a href="updateBooking.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="deleteBooking.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete?')">Delete</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

<?php mysqli_close($conn); ?>