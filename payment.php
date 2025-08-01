<?php
session_start();
include('connect.php');

if(!isset($_SESSION['user_id']) || !isset($_POST['booking_id'])) {
    header('location:login.php');
    exit();
}

$booking_id = mysqli_real_escape_string($conn, $_POST['booking_id']);
$amount = mysqli_real_escape_string($conn, $_POST['amount']);

// Fetch booking details
$query = "SELECT b.*, p.package_name FROM bookings b 
          JOIN packages p ON b.package_id = p.id 
          WHERE b.id = '$booking_id' AND b.user_id = '".$_SESSION['user_id']."'";
$result = mysqli_query($conn, $query);
$booking = mysqli_fetch_assoc($result);

if(!$booking) {
    header('location:index.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./assets/css/nav.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/footer.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>
<body>
  <?php include 'includes/navbar.php'; ?>
    <div class="container mt-5" style="padding-top:50px;">
        <div class="card">
            <div class="card-header">
                <h3 style="color:#600070;">Payment Details</h3>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <h5>Booking Summary</h5>
                    <p><strong>Package:</strong> <?php echo $booking['package_name']; ?></p>
                    <p><strong>Amount to Pay:</strong> ₹<?php echo number_format($amount); ?></p>
                </div>

                <div class="payment-info mb-4">
                    <h5>Bank Account Details</h5>
                    <div class="bank-details p-3 bg-light rounded">
                        <p><strong>Bank Name:</strong> State Bank of India</p>
                        <p><strong>Account Name:</strong> AdvenTour Agency</p>
                        <p><strong>Account Number:</strong> 1234 5678 9012</p>
                        <p><strong>IFSC Code:</strong> SBIN0123456</p>
                        <p><strong>Branch:</strong> Main Branch</p>
                    </div>
                </div>

                <div class="alert alert-info">
                    <p><strong>Payment Instructions:</strong></p>
                    <ol>
                        <li>Make payment using bank transfer or visit our office</li>
                        <li>You can also do payment by check or in cash by visiting our office</li>
                        <li>After payment, contact us at: 123-456-7890</li>
                        <li>Your payment status will be confirmed after payment verification</li>
                    </ol>
                </div>

                <form action="confirm_booking.php" method="POST" class="text-center mt-4">
                    <input type="hidden" name="booking_id" value="<?php echo $booking_id; ?>">
                    <button type="submit" class="btn btn-success me-2">Confirm Booking</button>
                    <a href="booking_confirmation.php?id=<?php echo $booking_id; ?>" class="btn me-2">Back</a>
                    <a href="index.php" class="btn">Home</a>
                </form>
            </div>
        </div>
    </div>
      <?php include 'includes/footer.php';?>
    <style>
        .card {
            border: 1px solid #600070;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .card-header {
            background-color: #fff;
            border-bottom: 2px solid #600070;
            padding: 15px;
        }
        .card-header h3 {
            margin: 0;
            text-align: center;
        }
        h5 {
            color: #600070;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        .btn {
            background-color: #da9eec;
            color: #600070;
            border: 2px solid #600070;
            padding: 10px 30px;
            font-size: 18px;
            border-radius: 30px;
            transition: all 0.3s;
        }
        .btn:hover {
            background-color: #600070;
            color: white;
        }
        .bank-details {
            border: 1px dashed #600070;
        }
        .bank-details p {
            margin-bottom: 0.5rem;
        }
        .bank-details p:last-child {
            margin-bottom: 0;
        }
    </style>
</body>
</html>