<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <h1 class="mb-4">Welcome to Your Dashboard</h1>
                
				<div class="d-grid gap-3">

				<a href="viewBookings.php" class="btn btn-primary btn-lg">
				<i class="bi bi-calendar-check me-2"></i>
				My Booking Appointments
				</a>

				<a href="customerVehicles.php" class="btn btn-secondary btn-lg">
				<i class="bi bi-car-front-fill me-2"></i>
				My Vehicles
				</a>

				<a href="addBooking.php" class="btn btn-success btn-lg">
				<i class="bi bi-plus-circle-fill me-2"></i>
				Book An Appointment
				</a>

				<a href="myprofile.php" class="btn btn-info text-white btn-lg">
				<i class="bi bi-person-circle me-2"></i>
				My Profile
				</a>

				<a href="logoutprocess.php" class="btn btn-danger btn-lg">
				<i class="bi bi-box-arrow-right me-2"></i>
				Log Out
			</a>

			</div>
                
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>