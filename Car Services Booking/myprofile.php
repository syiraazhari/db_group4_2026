<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "carservicebooking");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$username = $_SESSION['username'];

$sql = "SELECT fName, lName, username, email, address, contactNo, dob, role
        FROM account
        WHERE username = '$username'";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
} else {
    die("Profile not found.");
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Profile</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">My Profile</h3>
                </div>

                <div class="card-body">

                    <table class="table table-bordered">
                        <tr>
                            <th>Full Name</th>
                            <td><?php echo htmlspecialchars($row['fName'] . " " . $row['lName']); ?></td>
                        </tr>

                        <tr>
                            <th>Username</th>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                        </tr>

                        <tr>
                            <th>Contact No</th>
                            <td><?php echo htmlspecialchars($row['contactNo']); ?></td>
                        </tr>

                        <tr>
                            <th>Address</th>
                            <td><?php echo htmlspecialchars($row['address']); ?></td>
                        </tr>

                        <tr>
                            <th>Date of Birth</th>
                            <td><?php echo htmlspecialchars($row['dob']); ?></td>
                        </tr>

                        <tr>
                            <th>Role</th>
                            <td><?php echo htmlspecialchars($row['role']); ?></td>
                        </tr>
                    </table>

                    <a href="customerhome.php" class="btn btn-secondary">Back to Customer Home</a>

                </div>
            </div>

        </div>
    </div>

</div>

</body>
</html>