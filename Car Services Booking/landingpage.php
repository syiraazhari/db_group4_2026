<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Car Service Booking System</title>
    <link rel="stylesheet" href="bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
    .hero-section {
        background-image:linear-gradient( rgba(0,0,0,0.0),rgba(0,0,0,0.0)), url("autocare2.png");
        background-size: cover;
        background-position:top center;
        background-repeat: no-repeat;
		height:580px;
    }
	.ourservice-icon {
    width: 85px;
    height: 85px;
    background-color: #064bd8;
    color: white;
    border-radius: 50%;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 35px;
}
	.offer-title {
    color: #5B88B2;
    letter-spacing: 4px;
}

</style>	
</head>

<body>
<!--Upper Nav Bar-->
<div class="bg-dark text-white py-2">
    <div class="container d-flex justify-content-between">
        <span>☎Contact: 012-3456789</span>
		<span>📧Email:group4db@gmail.com</span>
		<span>📍🗺️Location: Wangsa Maju , Kuala Lumpur</span>
        <span>Open: Mon - Sat, 9AM - 6PM</span>
    </div>
</div>
<!--Lower Nav Bar-->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>


      </ul>
      <!--<form class="d-flex me-2" role="search">
        <input class="form-control me-2" type="search" placeholder="🔍︎Search" aria-label="Search"/>
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>-->
	  
	   <a href="login.php" class="btn btn-outline-primary me-2">Login</a>
       <a href="registerCustomer.php" class="btn btn-primary">Register</a>
    </div>
  </div>
</nav>
<div class="hero-section hero-img d-flex align-items-center justify-content-center text-white text-center mb-5">
    <div>
  <!--      <h1>Car Service Booking System</h1>
        <p>Book your car service appointment easily</p>
        <a href="booking.php" class="btn btn-primary">Register</a> -->
    </div>
</div>

<section class="container my-5">

    <div class="text-center mb-5">
        <p class="offer-title fw-bold">WE OFFER SERVICES</p>
        <h2 class="fw-bold">Our Car Services</h2>
    </div>

    <div class="row">

        <div class="col-md-4 mb-5">
            <div class="d-flex">
                <div class="service-icon me-4">
                    <i class="bi bi-droplet"></i>
                </div>

                <div>
                    <h4 class="fw-bold">Oil Change</h4>
                    <p class="text-muted">
                        Replace old engine oil for better engine performance.
                    </p>
                    
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-5">
            <div class="d-flex">
                <div class="service-icon me-4">
                    <i class="fa-solid fa-car-battery"></i>
                </div>

                <div>
                    <h4 class="fw-bold">Battery Change</h4>
                    <p class="text-muted">
                        Check and replace weak batteries before breakdowns.
                    </p>
                    
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-5">
            <div class="d-flex">
                <div class="service-icon me-4">
                    <i class="bi bi-tools"></i>
                </div>

                <div>
                    <h4 class="fw-bold">Brake Check</h4>
                    <p class="text-muted">
                        Inspect brake pads, discs, and braking performance.
                    </p>
                    
                </div>
            </div>
        </div>

    </div>
	<div class="col-md-4 mb-5">
    <div class="d-flex">
        <div class="service-icon me-4">
            <i class="bi bi-plus-circle"></i>
        </div>

        <div>
            <h4 class="fw-bold">Many More</h4>
            <p class="text-muted">
                We also provide other car inspection and maintenance services based on your vehicle needs.
            </p>
            <a href="serviceoffers.php" class="text-dark fw-bold">READ MORE</a>
        </div>
    </div>
</div>
</section>
		

</body>

