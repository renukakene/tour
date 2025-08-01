<?php
session_start();
include("header.php");
include('../connect.php');

if(!isset($_SESSION['admin_id'])) {
    header('location:admin_login.php');
    exit();
}

// Mark message as read
if(isset($_GET['read']) && is_numeric($_GET['read'])) {
    $id = mysqli_real_escape_string($conn, $_GET['read']);
    mysqli_query($conn, "UPDATE contacts SET status='read' WHERE id='$id'");
    header('location: contacts.php');
    exit();
}

// Delete message
if(isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = mysqli_real_escape_string($conn, $_GET['delete']);
    mysqli_query($conn, "DELETE FROM contacts WHERE id='$id'");
    header('location: contacts.php');
    exit();
}

// Fetch all messages
$query = "SELECT c.*, u.name as user_name 
          FROM contacts c 
          LEFT JOIN user_form u ON c.user_id = u.id 
          ORDER BY c.created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Contact Messages</title>
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
                        <input type="text" placeholder="Search messages...">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>
                <div class="user">
                    <img src="assets/imgs/customer01.jpg" alt="">
                </div>
            </div>

            <div class="content-wrapper p-4">
                <?php if(isset($_GET['reply']) && $_GET['reply'] == 'success'): ?>
                    <div class="alert alert-success">Reply sent successfully!</div>
                <?php endif; ?>
                
                <?php if(isset($_GET['reply']) && $_GET['reply'] == 'error'): ?>
                    <div class="alert alert-danger">Error sending reply. Please try again.</div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Contact Messages</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                                        <tr class="<?php echo $row['status'] == 'unread' ? 'table-warning' : ''; ?>">
                                            <td><?php echo date('Y-m-d H:i', strtotime($row['created_at'])); ?></td>
                                            <td>
                                                <?php echo $row['name']; ?>
                                                <?php if($row['user_id']): ?>
                                                    <span class="badge bg-info">Registered User</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['subject']; ?></td>
                                            <td>
                                                <?php 
                                                    $short_message = substr($row['message'], 0, 50);
                                                    echo nl2br($short_message . (strlen($row['message']) > 50 ? '...' : ''));
                                                ?>
                                            </td>
                                            <td>
                                                <span class="badge bg-<?php 
                                                    echo $row['status'] == 'unread' ? 'warning' : 
                                                        ($row['status'] == 'replied' ? 'success' : 'secondary');
                                                ?>">
                                                    <?php echo ucfirst($row['status']); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?php if($row['status'] == 'unread'): ?>
                                                    <a href="?read=<?php echo $row['id']; ?>" class="btn btn-sm btn-success">
                                                        <i class="fas fa-check"></i>
                                                    </a>
                                                <?php endif; ?>
                                                <a href="reply_message.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-reply"></i>
                                                </a>
                                                <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" 
                                                   onclick="return confirm('Are you sure you want to delete this message?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
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
        .table {
            margin-bottom: 0;
        }
        .btn-sm {
            padding: 0.25rem 0.5rem;
            margin: 0 2px;
        }
        .badge {
            padding: 0.5em 0.8em;
        }
        .profile-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
    </style>
<? include("footer.php"); ?>