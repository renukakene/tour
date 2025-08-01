<?php
session_start();
include('../connect.php');

if(!isset($_SESSION['admin_id']) || !isset($_POST['booking_id'])) {
    exit('Unauthorized access');
}

$booking_id = mysqli_real_escape_string($conn, $_POST['booking_id']);
$type = mysqli_real_escape_string($conn, $_POST['type']);
$value = mysqli_real_escape_string($conn, $_POST['value']);

// Determine which column to update based on type
$column = ($type == 'payment') ? 'payment_status' : 'status';

$query = "UPDATE bookings SET $column = '$value' WHERE id = '$booking_id'";

if(mysqli_query($conn, $query)) {
    // If payment status is changed to 'paid', automatically confirm the booking
    if($type == 'payment' && $value == 'paid') {
        $confirm_query = "UPDATE bookings SET status = 'confirmed' WHERE id = '$booking_id'";
        mysqli_query($conn, $confirm_query);
    }
    
    // If booking is cancelled, automatically set payment to pending
    if($type == 'status' && $value == 'cancelled') {
        $pending_query = "UPDATE bookings SET payment_status = 'pending' WHERE id = '$booking_id'";
        mysqli_query($conn, $pending_query);
    }
    
    echo 'success';
} else {
    http_response_code(500);
    echo 'error';
}