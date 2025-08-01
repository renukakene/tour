<?php
session_start();
include('connect.php');

if(!isset($_SESSION['user_id'])) {
    header('location:login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

if(isset($_POST['update_password'])) {
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    // Check if current password is correct
    $query = "SELECT password FROM user_form WHERE id = '$user_id'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if($current_password != $user['password']) {
        header('location: profile.php?error=current');
        exit();
    }

    if($new_password != $confirm_password) {
        header('location: profile.php?error=match');
        exit();
    }

    // Update password
    mysqli_query($conn, "UPDATE user_form SET password = '$new_password' WHERE id = '$user_id'");
    header('location: profile.php?password=success');
    exit();
}

header('location: profile.php');
?>