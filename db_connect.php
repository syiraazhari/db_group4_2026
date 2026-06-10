<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "car_service_booking"
);

if (!$conn)
{
    die("Connection Failed: " . mysqli_connect_error());
}

?>