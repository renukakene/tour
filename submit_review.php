<?php
session_start();
include('connect.php');

if(!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $package_id = $_POST['package_id'];
    $user_id = $_SESSION['user_id'];
    $rating = $_POST['rating'];
    $review_text = $_POST['review_text'];
    
    $query = "INSERT INTO reviews (package_id, user_id, rating, review_text) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "iiis", $package_id, $user_id, $rating, $review_text);
    
    if(mysqli_stmt_execute($stmt)) {
        header("Location: package_details.php?id=" . $package_id . "&review=success");
    } else {
        header("Location: package_details.php?id=" . $package_id . "&review=error");
    }
} else {
    header('Location: index.php');
}
?>