<!DOCTYPE html>
<html>
<head>
    <title>Car Service Booking</title>
    <link rel="stylesheet" href="booking.css">
</head>
<body>

<div class="booking-container">

    <div class="booking-header">
        <h2>Book Your Car Service</h2>
        <p>Fast, reliable and professional vehicle maintenance</p>
    </div>

    <form method="POST" action="addBooking.php">

        <h3>Customer Information</h3>

        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="customerName" required>
        </div>

        <div class="row">

            <div class="form-group">
                <label>Phone Number</label>
                <input type="tel" name="phoneNumber" required>
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" required>
            </div>

        </div>

        <div class="form-group">
            <label>Address</label>
            <textarea name="address" required></textarea>
        </div>

        <h3>Vehicle Information</h3>

        <div class="row">

            <div class="form-group">
                <label>Vehicle Type</label>
                <select name="vehicleType" required>
                    <option value="">Select Vehicle</option>
                    <option>Sedan</option>
                    <option>Hatchback</option>
                    <option>SUV</option>
                    <option>MPV</option>
                    <option>Pickup Truck</option>
                </select>
            </div>

            <div class="form-group">
                <label>Vehicle Number Plate</label>
                <input type="text" name="plateNumber" placeholder="ABC1234" required>
            </div>

        </div>

        <h3>Service Information</h3>

        <div class="form-group">
            <label>Type of Service</label>
            <select name="serviceType" required>
                <option value="">Choose Service</option>
                <option>Oil Change</option>
                <option>Engine Service</option>
                <option>Brake Inspection</option>
                <option>Battery Replacement</option>
                <option>Tyre Replacement</option>
                <option>Air Conditioning Service</option>
                <option>Full Vehicle Service</option>
            </select>
        </div>

        <div class="row">

            <div class="form-group">
                <label>Booking Date</label>
                <input type="date" name="bookingDate" required>
            </div>

            <div class="form-group">
                <label>Booking Time</label>
                <input type="time" name="bookingTime" required>
            </div>

        </div>

        <div class="form-group">
            <label>Reason / Notes</label>
            <textarea
                name="reasonNotes"
                placeholder="Describe any vehicle issues or special requests..."
            ></textarea>
        </div>

        <input type="hidden" name="bookingStatus" value="Pending">

        <button type="submit" name="add" class="submit-btn">
            Book Service Appointment
        </button>

    </form>

</div>

</body>
</html>