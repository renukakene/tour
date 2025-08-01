<?php
session_start();
include('connect.php');

if(!isset($_SESSION['user_id'])) {
    header('location:login.php');
    exit();
}

if(isset($_POST['booking_id'])) {
    $booking_id = mysqli_real_escape_string($conn, $_POST['booking_id']);
    
    // Verify the booking belongs to the user
    $query = "SELECT * FROM bookings WHERE id = '$booking_id' AND user_id = '".$_SESSION['user_id']."'";
    $result = mysqli_query($conn, $query);
    
    if(mysqli_num_rows($result) > 0) {
        // Update booking status to cancelled
        $update_query = "UPDATE bookings SET status = 'cancelled' WHERE id = '$booking_id'";
        if(mysqli_query($conn, $update_query)) {
            $_SESSION['success'] = "Booking cancelled successfully";
        } else {
            $_SESSION['success'] = "Error cancelling booking";
        }
    }
}

header('location:my_bookings.php');
exit();
?>