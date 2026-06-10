<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Registration</title>
    <link href="booking.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body class="p-4">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3>Customer Registration</h3>
                    </div>
                    <div class="card-body">
                        <form action="addnewCustomer.php" method="POST">
                            <div class="mb-3">
                                <label for="customer_fname" class="form-label">First Name:</label>
                                <input type="text" class="form-control" id="customer_fname" name="fName" required>
                            </div>
                            <div class="mb-3">
                                <label for="customer_lname" class="form-label">Last Name:</label>
                                <input type="text" class="form-control" id="customer_lname" name="lName" required>
                            </div>
                            <div class="mb-3">
                                <label for="contact_no" class="form-label">Contact No:</label>
                                <input type="text" class="form-control" id="contact_no" name="contactNo">
                            </div>
							<div class="mb-3">
								<label for="address" class="form-label">Address:</label>
								<input type="text" class="form-control" id="address" name="address" required>
                            </div>
							<div class="mb-3">
                                <label for="bday" class="form-label">Birthday:</label>
                                <input type="date" class="form-control" id="bday" name="birthday" required>
                            </div>
							<div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" class="form-control" id="password" name="password"  placeholder="Abc@123" required>
                            </div>
                            <button type="submit" name="add" class="btn btn-primary">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

