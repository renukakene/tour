<?php
session_start();
include('../connect.php');


// Check if user is admin
if(!isset($_SESSION['admin_id'])) {
    header('location:admin_login.php');
    exit();
}

// Fetch all bookings with user and package details
$query = "SELECT b.*, p.package_name, p.price,p.start_date, u.name as user_name, u.email 
          FROM bookings b 
          JOIN packages p ON b.package_id = p.id 
          JOIN user_form u ON b.user_id = u.id 
          ORDER BY b.id DESC";
$result = mysqli_query($conn, $query);
?>

    <?php include 'header.php'; ?>

    <div class="container"  style="padding-top:90px;" >
        <div class="card">
            <div class="card-header">
                <h3>All Bookings</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Customer</th>
                                <th>Package</th>
                                <th>Travel Date</th>
                                <th>Participants</th>
                                <th>Total Amount</th>
                                <th>Booking Status</th>
                                <th>Payment Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($booking = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?php echo $booking['id']; ?></td>
                                    <td>
                                        <?php echo $booking['user_name']; ?><br>
                                        <small class="text-muted"><?php echo $booking['email']; ?></small>
                                    </td>
                                    <td><?php echo $booking['package_name']; ?></td>
                                    <td><?php echo date('d M Y', strtotime($booking['start_date'])); ?></td>
                                    <td><?php echo $booking['participants']; ?></td>
                                    <td>₹<?php echo number_format($booking['total_price']); ?></td>
                                    <td>
                                        <select class="form-select status-select" data-booking-id="<?php echo $booking['id']; ?>" data-type="status">
                                            <option value="pending" <?php echo $booking['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                            <option value="confirmed" <?php echo $booking['status'] == 'confirmed' ? 'selected' : ''; ?>>Confirmed</option>
                                            <option value="cancelled" <?php echo $booking['status'] == 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-select status-select" data-booking-id="<?php echo $booking['id']; ?>" data-type="payment">
                                            <option value="pending" <?php echo $booking['payment_status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                            <option value="paid" <?php echo $booking['payment_status'] == 'paid' ? 'selected' : ''; ?>>Paid</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-danger delete-btn" data-booking-id="<?php echo $booking['id']; ?>">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

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
            color: #600070;
            margin: 0;
            text-align: center;
        }
        .btn-danger {
            background-color: #ff4444;
            border-color: #ff4444;
        }
        .form-select {
            padding: 5px;
            font-size: 14px;
        }
        .status-select {
            min-width: 100px;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Update booking status
            $('.status-select').change(function() {
                const bookingId = $(this).data('booking-id');
                const type = $(this).data('type');
                const value = $(this).val();
                
                $.ajax({
                    url: 'update_booking_status.php',
                    method: 'POST',
                    data: {
                        booking_id: bookingId,
                        type: type,
                        value: value
                    },
                    success: function(response) {
                        alert('Status updated successfully');
                    },
                    error: function() {
                        alert('Error updating status');
                    }
                });
            });

            // Delete booking
            $('.delete-btn').click(function() {
                if(confirm('Are you sure you want to delete this booking?')) {
                    const bookingId = $(this).data('booking-id');
                    
                    $.ajax({
                        url: 'delete_booking.php',
                        method: 'POST',
                        data: { booking_id: bookingId },
                        success: function(response) {
                            alert('Booking deleted successfully');
                            location.reload();
                        },
                        error: function() {
                            alert('Error deleting booking');
                        }
                    });
                }
            });
        });
    </script>
<?php include 'footer.php';?>