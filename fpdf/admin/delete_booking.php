<?php
session_start();
include('../connect.php');

if(!isset($_SESSION['admin_id']) || !isset($_POST['booking_id'])) {
    exit('Unauthorized access');
}

$booking_id = mysqli_real_escape_string($conn, $_POST['booking_id']);

$query = "DELETE FROM bookings WHERE id = '$booking_id'";

if(mysqli_query($conn, $query)) {
    echo 'success';
} else {
    http_response_code(500);
    echo 'error';
}
?>