<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Car Service Booking System</title>

    <link rel="stylesheet" href="bootstrap.min.css">

    <style>
        .about-header {
            background-image: linear-gradient(
                rgba(0, 0, 0, 0.6),
                rgba(0, 0, 0, 0.5)
            ), url("repairpicture.png");

            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 280px;

            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
        }

        .section-title {
            color: #5B88B2;
            letter-spacing: 3px;
            font-size: 14px;
            font-weight: bold;
        }

        .about-card {
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border-radius: 15px;
        }

        .info-box {
            background-color: #f8f9fa;
            border-left: 5px solid #5B88B2;
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>

<body>

<!-- Upper Nav Bar -->
<div class="bg-dark text-white py-2">
    <div class="container d-flex flex-wrap justify-content-between">
        <span>☎ Contact: 012-3456789</span>
        <span>📧 Email: group4db@gmail.com</span>
        <span>📍 Location: Wangsa Maju, Kuala Lumpur</span>
        <span>Open: Mon - Sat, 9AM - 6PM</span>
    </div>
</div>

<!-- Lower Nav Bar -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">

        <a class="navbar-brand fw-bold" href="index.php">CarService</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link" href="landingpage.php">Home</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link active" href="about.php">About</a>
                </li>

            </ul>

            <form class="d-flex me-2" role="search">
                <input class="form-control me-2" type="search" placeholder="🔍︎Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>

            <a href="login.php" class="btn btn-outline-primary me-2">Login</a>
            <a href="register.php" class="btn btn-primary">Register</a>

        </div>
    </div>
</nav>

<!-- About Header -->
<div>
    <div>
        <h1 class="fw-bold text-center mt-3">About Us</h1>
        <p class="fw-bold text-center">Learn more about our car service booking system</p>
    </div>
</div>

<!-- About Section -->
<section class="container my-5">

    <div class="row align-items-center">

        <div class="col-md-6 mb-4">
            <p class="section-title">ABOUT OUR SYSTEM</p>
            <h2 class="fw-bold mb-3">Car Service Booking Made Easier</h2>

            <p class="text-muted">
                The Car Service Booking System is a web-based system designed to help customers book car service appointments easily.
                Instead of calling or visiting the service centre manually, customers can use the system to view available services and make a booking online.
            </p>

            <p class="text-muted">
                This system also helps the service staff manage customer information, vehicle details, service bookings, and service records in a more organized way.
            </p>

            <a href="booking.php" class="btn btn-primary mt-2">Book a Service</a>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card about-card p-4">
                <h4 class="fw-bold mb-3">System Information</h4>

                <div class="info-box mb-3">
                    <h6 class="fw-bold">Purpose</h6>
                    <p class="mb-0 text-muted">
                        To provide an easier and more organized method for customers to book car service appointments.
                    </p>
                </div>

                <div class="info-box mb-3">
                    <h6 class="fw-bold">Target Users</h6>
                    <p class="mb-0 text-muted">
                        Customers, administrators, and service staff.
                    </p>
                </div>

                <div class="info-box">
                    <h6 class="fw-bold">Main Function</h6>
                    <p class="mb-0 text-muted">
                        Manage service bookings, customer details, vehicle information, and available car services.
                    </p>
                </div>
            </div>
        </div>

    </div>

</section>

<!-- Mission Vision Section -->
<section class="bg-light py-5">
    <div class="container">

        <div class="text-center mb-5">
            <p class="section-title">WHAT WE AIM FOR</p>
            <h2 class="fw-bold">Our Mission and Vision</h2>
        </div>

        <div class="row">

            <div class="col-md-6 mb-4">
                <div class="card about-card h-100 p-4">
                    <h4 class="fw-bold">Our Mission</h4>
                    <p class="text-muted">
                        To make the car service booking process easier, faster, and more convenient for customers by providing an online booking platform.
                    </p>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card about-card h-100 p-4">
                    <h4 class="fw-bold">Our Vision</h4>
                    <p class="text-muted">
                        To improve the management of car service appointments and help service centres handle bookings in a more systematic way.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="container my-5">

    <div class="text-center mb-5">
        <p class="section-title">WHY CHOOSE US</p>
        <h2 class="fw-bold">Reliable, Simple, and Organized</h2>
    </div>

    <div class="row text-center">

        <div class="col-md-4 mb-4">
            <div class="card about-card h-100 p-4">
                <h4 class="fw-bold">Easy Booking</h4>
                <p class="text-muted">
                    Customers can book car service appointments easily through the website.
                </p>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card about-card h-100 p-4">
                <h4 class="fw-bold">Service Management</h4>
                <p class="text-muted">
                    Service staff can manage bookings, services, vehicles, and customer records more efficiently.
                </p>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card about-card h-100 p-4">
                <h4 class="fw-bold">No Online Payment</h4>
                <p class="text-muted">
                    The system focuses on booking management only, without online payment functionality.
                </p>
            </div>
        </div>

    </div>

</section>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3">
    <p class="mb-1">Car Service Booking System</p>
    <p class="mb-0">Contact: 012-3456789 | Email: group4db@gmail.com</p>
</footer>

<script src="bootstrap.bundle.min.js"></script>

</body>
</html>