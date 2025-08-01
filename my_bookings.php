<?php
session_start();
include('connect.php');

if(!isset($_SESSION['user_id'])) {
    header('location:login.php');
    exit();
}

// Fetch all bookings for the user
$query = "SELECT b.*, p.package_name, p.price,p.start_date
          FROM bookings b 
          JOIN packages p ON b.package_id = p.id 
          WHERE b.user_id = '".$_SESSION['user_id']."' 
          ORDER BY b.id DESC";  // Changed from created_at to id
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./assets/css/nav.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/footer.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>
<body>
    
<?php include 'includes/navbar.php'; ?>
    <div class="container mt-5" style="padding-top:30px;">
        <?php if(isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php 
                    echo $_SESSION['success']; 
                    unset($_SESSION['success']);
                ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header">
                <h3 style="color:#600070;">My Bookings</h3>
            </div>
            <div class="card-body">
                <?php if(mysqli_num_rows($result) > 0): ?>
                    <?php while($booking = mysqli_fetch_assoc($result)): ?>
                        <div class="booking-item mb-4 p-3 border rounded">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h5 class="mb-3"><?php echo $booking['package_name']; ?></h5>
                                    <p><strong>Booking Date:</strong> <?php echo date('d M Y'); ?></p>
                                    <p><strong>Travel Date:</strong> <?php echo date('d M Y',strtotime($booking['start_date'])); ?></p>
                                    <p><strong>Participants:</strong> <?php echo $booking['participants']; ?></p>
                                    <p><strong>Amount:</strong> ₹<?php echo number_format($booking['price'] * $booking['participants']); ?></p>
                                    <?php if($booking['payment_status'] == 'paid'): ?>
                                        <a href="generate_receipt.php?booking_id=<?php echo $booking['id']; ?>" class="btn btn-sm" style="background-color: #600070; color: white;">
                                            <i class='bx bx-download'></i> Download Receipt
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-4">
                                    <div class="status-badges">
                                        <p><strong>Booking Status:</strong><br>
                                            <span class="badge bg-<?php echo $booking['status'] == 'confirmed' ? 'success' : 'warning'; ?>">
                                                <?php echo ucfirst($booking['status']); ?>
                                            </span>
                                        </p>
                                        <p><strong>Payment Status:</strong><br>
                                            <span class="badge bg-<?php echo $booking['payment_status'] == 'paid' ? 'success' : 'warning'; ?>">
                                                <?php echo ucfirst($booking['payment_status']); ?>
                                            </span>
                                        </p>
                                        <?php if($booking['payment_status'] == 'pending'): ?>
                                            <form action="cancel_booking.php" method="POST" onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                                                <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">
                                                <button type="submit" class="btn btn-sm btn-danger" style="background-color: #ff4444; border-color: #ff4444;">Cancel Booking</button>
                                            </form>
                                        <?php endif; ?>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="text-center py-5">
                        <h5>No bookings found</h5>
                        <p class="mb-4">You haven't made any bookings yet.</p>
                        <a href="index.php" class="btn">Browse Packages</a>
                    </div>
                <?php endif; ?>
                </div>
                <div class="text-center mt-4">
                    <a href="index.php" class="btn back-btn">
                        Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
   <?php include 'includes/footer.php';?>
    <style>
        /* Add to existing styles */
        .back-btn {
            background-color: #600070;
            color: rgb(245, 238, 247);
            border: none;
            margin-bottom:20px;
        }
        .back-btn:hover {
            background-color: #da9eec;
            color: #600070;;
            
        }
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
        .booking-item {
            transition: transform 0.2s;
            
        }
        .booking-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px #600070;
            
        }
        .status-badges {
            text-align: center;
        }
        .badge {
            padding: 8px 12px;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .btn-sm {
            padding: 5px 15px;
            font-size: 14px;
        }
    </style>
</body>
</html>