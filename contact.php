<?php
session_start();
include('connect.php');

if(isset($_POST['send_message'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $date = date('Y-m-d H:i:s');
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;

    $sql = "INSERT INTO contacts (name, email, subject, message, created_at, user_id) 
            VALUES ('$name', '$email', '$subject', '$message', '$date', " . ($user_id ? $user_id : "NULL") . ")";
    
    if(mysqli_query($conn, $sql)) {
        header('location: contact.php?success=1');
        exit();
    } else {
        header('location: contact.php?error=1');
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/nav.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/footer.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">  <!-- Add this line -->
</head>
<body>
    <?php include 'includes/navbar.php'; ?>
    
    <div class="container" style="padding-top: 100px;">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 style="color:#600070;">Contact Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="contact-info">
                            <p><i class="fas fa-map-marker-alt"></i> parel, Mumbai, India</p>
                            <p><i class="fas fa-phone"></i> +91 9022545122</p>
                            <p><i class="fas fa-envelope"></i> achal123@gmail.com</p>
                            <p><i class="fas fa-clock"></i> Mon-Sat: 9:00 AM - 6:00 PM</p>
                        </div>
                        <div class="social-links mt-4">
                            <h5>Follow Us</h5>
                            <a href="#"><i class="fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 style="color:#600070;">Send us a Message</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Subject</label>
                                <input type="text" name="subject" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Message</label>
                                <textarea name="message" class="form-control" rows="4" required></textarea>
                            </div>
                            <button type="submit" name="send_message" class="btn">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

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
        .contact-info p {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .contact-info i {
            color: #600070;
            margin-right: 10px;
            width: 20px;
        }
        .social-links a {
            color: #600070;
            font-size: 24px;
            margin-right: 20px;
            transition: all 0.3s;
        }
        .social-links a:hover {
            color: #da9eec;
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
    </style>
</body>
</html>