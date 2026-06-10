<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "carservicesbooking"
);

if (!$conn)
{
    die("Connection Failed: " . mysqli_connect_error());
}

?>