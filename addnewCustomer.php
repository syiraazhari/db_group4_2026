<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = mysqli_connect("localhost", "root", "", "carservicebooking");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['add'])){

    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $contactNo = $_POST['contactNo'];
    $dob = $_POST['birthday'];

    // Check if username or email already exists
    $checkSql = "SELECT * FROM account 
                 WHERE username = '$username' OR email = '$email'";

    $checkResult = mysqli_query($conn, $checkSql);

    if(mysqli_num_rows($checkResult) > 0){

        echo "
        <!DOCTYPE html>
        <html>
        <head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Registration Failed',
                    text: 'Username or email is already registered. Please use another one.',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location.href = 'registerCustomer.php';
                });
            </script>
        </body>
        </html>
        ";

        exit();

    } else {

        // Insert new customer
        $sql = "INSERT INTO account 
                (fName, lName, username, password, email, address, contactNo, dob, role) 
                VALUES 
                ('$fName','$lName','$username','$password','$email','$address','$contactNo','$dob','Customer')";

        if(mysqli_query($conn, $sql)){

            echo "
            <!DOCTYPE html>
            <html>
            <head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            </head>
            <body>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Registration Successful',
                        text: 'Your account has been created successfully!',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        window.location.href = 'login.php';
                    });
                </script>
            </body>
            </html>
            ";

            exit();

        } else {

            echo "
            <!DOCTYPE html>
            <html>
            <head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            </head>
            <body>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Database Error',
                        text: 'Something went wrong while registering.'
                    }).then(function() {
                        window.location.href = 'registerCustomer.php';
                    });
                </script>
            </body>
            </html>
            ";

            exit();
        }
    }
}

mysqli_close($conn);
?>