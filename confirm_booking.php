<?php
session_start();
include('connect.php');

if(!isset($_SESSION['user_id']) || !isset($_POST['booking_id'])) {
    header('location:login.php');
    exit();
}

$booking_id = mysqli_real_escape_string($conn, $_POST['booking_id']);

// Update booking status
$query = "UPDATE bookings SET 
          status = 'confirmed',
          payment_status = 'pending'
        
          WHERE id = '$booking_id' AND user_id = '".$_SESSION['user_id']."'";

if(mysqli_query($conn, $query)) {
    $_SESSION['success'] = "Booking confirmed successfully! Please complete the payment.";
    header('location:my_bookings.php');
} else {
    $_SESSION['error'] = "Something went wrong. Please try again.";
    header('location:payment.php');
}
exit();
?>