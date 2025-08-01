<?php
session_start();
include("header.php");
include('../connect.php');

if(!isset($_SESSION['admin_id'])) {
    header('location:login.php');
    exit();
}

if(isset($_GET['id'])) {
    $message_id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT c.*, u.name as user_name 
              FROM contacts c 
              LEFT JOIN user_form u ON c.user_id = u.id 
              WHERE c.id = '$message_id'";
    $result = mysqli_query($conn, $query);
    $message = mysqli_fetch_assoc($result);
}

if(isset($_POST['send_reply'])) {
    $reply = mysqli_real_escape_string($conn, $_POST['reply']);
    $date = date('Y-m-d H:i:s');
    $admin_id = $_SESSION['admin_id'];
    $user_id = $message['user_id'];
    
    $sql = "INSERT INTO contact_replies (contact_id, admin_id, user_id, reply, created_at) 
            VALUES ('$message_id', '$admin_id', " . ($user_id ? $user_id : "NULL") . ", '$reply', '$date')";
    
    if(mysqli_query($conn, $sql)) {
        mysqli_query($conn, "UPDATE contacts SET status='replied' WHERE id='$message_id'");
        header('location: contacts.php?reply=success');
    } else {
        header('location: contacts.php?reply=error');
    }
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reply to Message</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assests/style.css">
</head>
<body>
    <div class="container">
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>
                <div class="user">
                    <img src="assets/imgs/customer01.jpg" alt="">
                </div>
            </div>

            <div class="content-wrapper p-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-white mb-0">Reply to Message</h3>
                    </div>
                    <div class="card-body">
                        <div class="original-message mb-4 p-3 bg-light rounded">
                            <h5>Original Message:</h5>
                            <p><strong>From:</strong> <?php echo $message['name']; ?> 
                                <?php if($message['user_id']): ?>
                                    <span class="badge bg-info">Registered User</span>
                                <?php endif; ?>
                            </p>
                            <p><strong>Email:</strong> <?php echo $message['email']; ?></p>
                            <p><strong>Subject:</strong> <?php echo $message['subject']; ?></p>
                            <p><strong>Message:</strong><br><?php echo nl2br($message['message']); ?></p>
                            <p><strong>Received:</strong> <?php echo date('Y-m-d H:i', strtotime($message['created_at'])); ?></p>
                        </div>

                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Your Reply</label>
                                <textarea name="reply" class="form-control" rows="6" required></textarea>
                            </div>
                            <div class="text-end">
                                <a href="contacts.php" class="btn btn-secondary">Back</a>
                                <button type="submit" name="send_reply" class="btn btn-primary">Send Reply</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assests/main.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <style>
        .content-wrapper {
            padding: 20px;
            margin-top: 60px;
        }
        .card {
            border: none;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .card-header {
            background-color: #600070 !important;
            padding: 15px;
        }
        .card-header h3 {
            color: white;
            margin: 0;
        }
        .original-message {
            border-left: 4px solid #600070;
        }
        .btn-primary {
            background-color: #600070;
            border-color: #600070;
        }
        .btn-primary:hover {
            background-color: #4a0058;
            border-color: #4a0058;
        }
        .form-control:focus {
            border-color: #600070;
            box-shadow: 0 0 0 0.2rem rgba(96, 0, 112, 0.25);
        }
    </style>
</body>
</html>