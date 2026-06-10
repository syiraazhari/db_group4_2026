<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = mysqli_connect("localhost", "root", "root", "carservicebooking");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['add'])){
    $fName = mysqli_real_escape_string($conn, $_POST['fName']);
    $lName = mysqli_real_escape_string($conn, $_POST['lName']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$address = mysqli_real_escape_string($conn, $_POST['address']);
	$contactNo = mysqli_real_escape_string($conn, $_POST['contactNo']);
	$dob = mysqli_real_escape_string($conn, $_POST['dob']);
	
    // Note: id is NOT included because it's AUTO_INCREMENT
    $sql = "INSERT INTO account (fName, lName, username, password, email, address, contactNo, dob, role) 
            VALUES ('$fName','$lName','$username',$password','$email','$address','$contactNo','$dob','Customer' )";
    
    echo "Debug - SQL Query: " . $sql . "<br><br>"; // For debugging
    
    if(mysqli_query($conn, $sql)){
        echo "Customer added successfully! Redirecting...<br>";
        header("refresh:2; url=customerList.php?message=Customer added successfully");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn) . "<br>";
        echo "Please run fix_database.php first to fix the table structure.";
    }
}

mysqli_close($conn);
?>