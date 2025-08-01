<?php
session_start();
include('connect.php');

// Check if user is logged in
if(!isset($_SESSION['user_id'])) {
    header('location:login.php');
    exit();
}

if(isset($_GET['id'])) {
    $package_id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM packages WHERE id = '$package_id'";
    $result = mysqli_query($conn, $query) or die('query failed');
    $package = mysqli_fetch_assoc($result);
}

// Update the if(isset($_POST['submit'])) block
if(isset($_POST['submit'])) {
    $user_id = $_SESSION['user_id'];
    
    // Validate booking date against package dates
    $current_date = date('Y-m-d');
    if($current_date > $package['start_date']) {
        $error_msg = "Cannot book package: Tour has already started or passed";
    } else {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $participants = mysqli_real_escape_string($conn, $_POST['participants']);
        $package_id = mysqli_real_escape_string($conn, $_POST['package_id']);
        $transport_preference = mysqli_real_escape_string($conn, $_POST['transport_preference']);
        $room_type = mysqli_real_escape_string($conn, $_POST['room_type']);
        $room_sharing = mysqli_real_escape_string($conn, $_POST['room_sharing']);
        $number_of_rooms = mysqli_real_escape_string($conn, $_POST['number_of_rooms']);
        $food_preference = mysqli_real_escape_string($conn, $_POST['food_preference']);

        // Calculate total price including GST
        $base_price = $package['price'];
        $subtotal = $base_price * $participants;
        $gst = $subtotal * 0.18;
        $total_price = $subtotal + $gst;

        $insert_query = "INSERT INTO bookings (package_id, user_id, name, email, phone, participants, transport_preference, room_type, room_sharing, 
                        number_of_rooms, food_preference, booking_date, total_price) 
                        VALUES ('$package_id', '$user_id', '$name', '$email', '$phone', '$participants', 
                        '$transport_preference', '$room_type','$room_sharing', '$number_of_rooms', '$food_preference', CURRENT_TIMESTAMP, '$total_price')";
        
        if(mysqli_query($conn, $insert_query)) {
            $booking_id = mysqli_insert_id($conn);
            header("Location: booking_confirmation.php?id=" . $booking_id);
            exit();
        } else {
            $error_msg = "Error in booking submission.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Package</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./assets/css/nav.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/footer.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>
<body>

    <?php include 'includes/navbar.php'; ?>
    <!-- Rest of your page content -->
    <div class="container-fluid " style="padding-top:100px;" >  <!-- Changed from container to container-fluid -->
        <?php if(isset($package)) { ?>
            <div class="row">
                <div class="col-md-10 offset-md-1">  <!-- Changed from col-md-8 to col-md-10 -->
                    <div class="card">
                        <div class="card-header">
                            <h3 style="color:#600070;">Book Package: <?php echo $package['package_name']; ?></h3>
                        </div>
                        <div class="card-body">
                            <?php
                            if(isset($success_msg)) {
                                echo '<div class="alert alert-success">'.$success_msg.'</div>';
                            }
                            if(isset($error_msg)) {
                                echo '<div class="alert alert-danger">'.$error_msg.'</div>';
                            }
                            ?>
                            <form method="POST" action="">
                                <input type="hidden" name="package_id" value="<?php echo $package['id']; ?>">
                                
                                <!-- After the form starts, replace the existing field arrangement with: -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Phone</label>
                                            <input type="tel" class="form-control" name="phone" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Number of Participants</label>
                                            <input type="number" class="form-control" name="participants" min="1" max="<?php echo $package['max_participants']; ?>" required>
                                            <small class="text-muted">Maximum allowed: <?php echo $package['max_participants']; ?></small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Transportation Preference</label>
                                            <?php if($package['transport_type'] == 'flight') { ?>
                                                <select class="form-control" name="transport_preference" required>
                                                    <option value="">Select Seat Class</option>
                                                    <option value="economy">Economy Class</option>
                                                    <option value="business">Business Class</option>
                                                    <option value="first">First Class</option>
                                                </select>
                                            <?php } elseif($package['transport_type'] == 'train') { ?>
                                                <select class="form-control" name="transport_preference" required>
                                                    <option value="">Select Seat Class</option>
                                                    <option value="sleeper">Sleeper Class</option>
                                                    <option value="ac3">AC 3 Tier</option>
                                                    <option value="ac2">AC 2 Tier</option>
                                                    <option value="ac1">AC 1 Tier</option>
                                                </select>
                                            <?php } elseif($package['transport_type'] == 'bus') { ?>
                                                <select class="form-control" name="transport_preference" required>
                                                    <option value="">Select Seat Type</option>
                                                    <option value="seater">Seater</option>
                                                    <option value="semi_sleeper">Semi Sleeper</option>
                                                    <option value="sleeper">Sleeper</option>
                                                    <option value="ac_sleeper">AC Sleeper</option>
                                                </select>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Food Preference</label>
                                            <select class="form-control" name="food_preference" required>
                                                <option value="">Select Food Preference</option>
                                                <option value="vegetarian">Vegetarian</option>
                                                <option value="non_vegetarian">Non-Vegetarian</option>
                                                <option value="both">Both Veg and Non-Veg</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                        
                                    <div class="card mb-3">
                                    <div class="card-header">
                                        <h5 class="mb-0">Accommodation Details</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Room Type</label>
                                                    <select class="form-control" name="room_type" required>
                                                        <option value="">Select Room Type</option>
                                                        <option value="standard">Standard Room</option>
                                                        <option value="deluxe">Deluxe Room</option>
                                                        <option value="suite">Suite</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Room Sharing</label>
                                                    <select class="form-control" name="room_sharing" required>
                                                        <option value="">Select Sharing Type</option>
                                                        <option value="single">Single Occupancy</option>
                                                        <option value="double">Double Sharing</option>
                                                        <option value="triple">Triple Sharing</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Number of Rooms</label>
                                                    <input type="number" class="form-control" name="number_of_rooms" min="1" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="booking-summary mb-4">
                                    <h5>Booking Summary</h5>
                                    <p><strong>Package:</strong> <?php echo $package['package_name']; ?></p>
                                    <p><strong>Duration:</strong> <?php echo $package['duration']; ?> Days</p>
                                    <p><strong>Date:</strong> <?php echo date('d M Y', strtotime($package['start_date'])); ?> - <?php echo date('d M Y', strtotime($package['end_date'])); ?></p>
                                    <p><strong>Price per person:</strong> ₹<?php echo $package['price']; ?></p>
                                </div>

                                <!-- Change this line -->
                                <button type="submit" name="submit" class="btn">Confirm Booking</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="alert alert-danger">Package not found!</div>
        <?php } ?>
    </div>

    <?php include 'includes/footer.php';?>
    <style>
        /* Update navbar positioning */
       
            .card {
                border: 1px solid #600070;
                border-radius: 10px;
                box-shadow: 5px 5px 10px #3b3737;
                
                width: 100%;  /* Changed from 90% */
               max-width: 1400px;  /* Changed from 800px */
               padding: 30px;
                margin: 0 auto 30px auto; 
                
            }
            .row {
            margin-right: -10px;
            margin-left: -10px;
        }
    
        .col-md-6, .col-md-4 {
            padding-right: 10px;
            padding-left: 10px;
        }
        
            .form-control {
                padding: 10px;
                margin: 7px 0;
                min-height: 2em;
                border: 1px solid #600070;
                border-radius: 5px;
                background-color: white;
            }
        
            .form-label {
                font-size: 16px;
                color: #600070;
                font-weight: 600;
            }
        
            select.form-control {
                width: 100%;
                padding: 5px;
                border: 1px solid #600070;
                box-shadow: rgba(0, 0, 0, .1) 0 0 8px;
                border-radius: 5px;
                color: #333;
            }
        
            .btn {
                display: block;  /* Changed from inline-block */
                padding: 10px 40px;
                width: 300px;    /* Fixed width instead of auto/max-width */
                margin: 1em auto;  /* This will center the button */
                border: 3px solid #600070;
                border-radius: 30px;
                font-size: 20px;
                background-color: #da9eec;
                color: #600070;
                transition: ease 0.20s;
            }
        
            @media (max-width: 768px) {
                .btn {
                    width: 250px;  /* Smaller fixed width for mobile */
                }
            }
        
            .btn:hover {
                background-color: #600070;
                color: white;
                cursor: pointer;
            }
        
            .card-header {
                border-bottom: 2px solid #600070;
                background-color: #fff;
                padding: 15px;
                margin-bottom: 20px;
            }
        
            .card-header h3 {
                margin: 0;
                text-align: center;
            }
        
            .booking-summary {
                background-color: #f8f9fa;
                padding: 20px;
                border-radius: 5px;
                border: 1px solid #600070;
                margin: 20px 0;
            }
        
            .booking-summary h5 {
                color: #600070;
                margin-bottom: 15px;
            }
        
            textarea.form-control {
                min-height: 100px;
            }
        
            .mb-3 {
                margin-bottom: 1.5rem;
            }
        
            .alert {
                padding: 15px;
                border-radius: 5px;
                margin-bottom: 20px;
            }
        
            .alert-success {
                background-color: #d4edda;
                border-color: #c3e6cb;
                color: #155724;
            }
        
            .alert-danger {
                background-color: #f8d7da;
                border-color: #f5c6cb;
                color: #721c24;
            }
        
            .card-body {
                padding: 20px;
            }
        
            @media (max-width: 768px) {
            .card {
                width: 98%;
                padding: 15px;
                margin: 0 auto;
            }
            
            .container-fluid {
                padding-right: 10px;
                padding-left: 10px;
            }
        
                
                .btn {
                    width: 100%;
                }
            }
        </style>
 <script>
    // Update the script section
    document.addEventListener('DOMContentLoaded', function() {
    // Trigger initial calculation
    calculateRooms();
    });
    
    function calculateRooms() {
    const participants = parseInt(document.querySelector('input[name="participants"]').value) || 1;
    const roomSharingSelect = document.querySelector('select[name="room_sharing"]');
    const numberOfRoomsInput = document.querySelector('input[name="number_of_rooms"]');
    
    const sharing = roomSharingSelect.value;
    let maxPerRoom = sharing === 'single' ? 1 : (sharing === 'double' ? 2 : 3);
    
    let minRooms = Math.ceil(participants / maxPerRoom);
    numberOfRoomsInput.min = minRooms;
    
    if(parseInt(numberOfRoomsInput.value) < minRooms) {
        numberOfRoomsInput.value = minRooms;
    }
    }
    
    document.querySelector('input[name="participants"]').addEventListener('change', calculateRooms);
    document.querySelector('select[name="room_sharing"]').addEventListener('change', calculateRooms);
  </script>
</body>
</html>