<?php
session_start();
include('connect.php');

if(!isset($_SESSION['user_id']) || !isset($_GET['id'])) {
    header('location:login.php');
    exit();
}

$booking_id = mysqli_real_escape_string($conn, $_GET['id']);
$query = "SELECT b.*, p.package_name, p.price, p.duration, p.start_date, p.end_date, p.transport_type, p.departure_city 
          FROM bookings b 
          JOIN packages p ON b.package_id = p.id 
          WHERE b.id = '$booking_id' AND b.user_id = '".$_SESSION['user_id']."'";
$result = mysqli_query($conn, $query);
$booking = mysqli_fetch_assoc($result);

if(!$booking) {
    header('location:index.php');
    exit();
}

// Simplified price calculation
$base_price = $booking['price'];
$total_participants = $booking['participants'];
$subtotal = $base_price * $total_participants;
$gst = $subtotal * 0.18;
$total = $subtotal + $gst;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./assets/css/nav.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/footer.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>
<body>
  <?php include 'includes/navbar.php'; ?>
    <div class="container mt-5" >
        <div class="card">
            <div class="card-header">
                <h3 style="color:#600070;">Booking Confirmation</h3>
            </div>
            <div class="card-body">
                <div class="booking-details mb-4">
                    <h5>Package Details</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Package Name:</strong> <?php echo $booking['package_name']; ?></p>
                            <p><strong>Duration:</strong> <?php echo $booking['duration']; ?> Days</p>
                            <p><strong>Travel Dates:</strong> <?php echo date('d M Y', strtotime($booking['start_date'])); ?> - <?php echo date('d M Y', strtotime($booking['end_date'])); ?></p>
                            <p><strong>Departure City:</strong> <?php echo ucfirst($booking['departure_city']); ?></p>
                        </div>
                    </div>
                </div>

                <div class="personal-details mb-4">
                    <h5>Personal Details</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Name:</strong> <?php echo $booking['name']; ?></p>
                            <p><strong>Email:</strong> <?php echo $booking['email']; ?></p>
                            <p><strong>Phone:</strong> <?php echo $booking['phone']; ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Number of Participants:</strong> <?php echo $booking['participants']; ?></p>
                            <p><strong>Food Preference:</strong> <?php echo ucfirst($booking['food_preference']); ?></p>
                        </div>
                    </div>
                </div>

                <div class="accommodation-details mb-4">
                    <h5>Accommodation & Transport Details</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Room Type:</strong> <?php echo ucfirst($booking['room_type']); ?></p>
                            <p><strong>Room Sharing:</strong> <?php echo ucfirst($booking['room_sharing']); ?></p>
                            <p><strong>Number of Rooms:</strong> <?php echo $booking['number_of_rooms']; ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Transportation Type:</strong> <?php echo ucfirst($booking['transport_type']); ?></p>
                            <p><strong>Transport Preference:</strong> <?php echo ucfirst(str_replace('_', ' ', $booking['transport_preference'])); ?></p>
                        </div>
                    </div>
                </div>

                <div class="price-details mb-4">
                    <h5>Price Breakdown</h5>
                    <table class="table">
                        <tr>
                            <td>Package Price (₹<?php echo number_format($base_price); ?> × <?php echo $total_participants; ?> participants)</td>
                            <td class="text-end">₹<?php echo number_format($base_price * $total_participants); ?></td>
                        </tr>
                        <tr>
                            <td>Subtotal</td>
                            <td class="text-end">₹<?php echo number_format($subtotal); ?></td>
                        </tr>
                        <tr>
                            <td>GST (18%)</td>
                            <td class="text-end">₹<?php echo number_format($gst); ?></td>
                        </tr>
                        <tr class="table-active">
                            <th>Total Amount</th>
                            <th class="text-end">₹<?php echo number_format($total); ?></th>
                        </tr>
                    </table>
                </div>

                <form action="payment.php" method="POST" class="text-center">
                    <input type="hidden" name="booking_id" value="<?php echo $booking_id; ?>">
                    <input type="hidden" name="amount" value="<?php echo $total; ?>">
                    <button type="submit" class="btn">Proceed to Payment</button>
                </form>
            </div>
        </div>
    </div>
     <?php include 'includes/footer.php';?>

    <style>


    /* Add proper spacing for fixed navbar */
    .container {
        padding-top: 50px;
    }
    .navbar {
        display: flex;
        align-items: center;
    }

    nav .navbar li {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    nav .navbar li a {
        display: flex;
        align-items: center;
    }
        .card {
            border: 1px solid #600070;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;  /* Added margin-bottom */
        }
        .card-header {
            background-color: #fff;
            border-bottom: 2px solid #600070;
            padding: 15px;
            margin-bottom: 0;  /* Added margin-bottom */
        }
        .card-body {
            border-top: none;  /* Added to prevent double border */
            padding: 20px;     /* Added padding */
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
        .table {
            margin-top: 20px;
        }
        .table-active {
            background-color: #f8f9fa;
        }
    </style>
</body>
</html>