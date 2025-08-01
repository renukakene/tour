<?php
session_start();
include('connect.php');

if(!isset($_SESSION['user_id'])) {
    header('location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT c.*, cr.reply, cr.created_at as reply_date, a.name as admin_name 
          FROM contacts c 
          LEFT JOIN contact_replies cr ON c.id = cr.contact_id 
          LEFT JOIN admin a ON cr.admin_id = a.id
          WHERE c.user_id = '$user_id' 
          ORDER BY c.created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Messages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/nav.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/footer.css">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>
    
    <div class="container" style="padding-top: 100px;">
        <?php if(mysqli_num_rows($result) > 0): ?>
            <h2 class="mb-4" style="color: #600070;">My Messages</h2>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><?php echo htmlspecialchars($row['subject']); ?></h5>
                        <span class="badge bg-<?php 
                            echo $row['status'] == 'unread' ? 'warning' : 
                                ($row['status'] == 'replied' ? 'success' : 'secondary');
                        ?>">
                            <?php echo ucfirst($row['status']); ?>
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="message-details mb-3">
                            <small class="text-muted">Sent on: <?php echo date('F j, Y, g:i a', strtotime($row['created_at'])); ?></small>
                        </div>
                        <div class="message-content">
                            <p><?php echo nl2br(htmlspecialchars($row['message'])); ?></p>
                        </div>
                        
                        <?php if($row['reply']): ?>
                            <hr>
                            <div class="admin-reply">
                                <div class="reply-header">
                                    <h6><i class="fas fa-reply"></i> Admin Response</h6>
                                    <small class="text-muted">Replied by: <?php echo htmlspecialchars($row['admin_name']); ?></small>
                                    <small class="text-muted d-block">On: <?php echo date('F j, Y, g:i a', strtotime($row['reply_date'])); ?></small>
                                </div>
                                <div class="reply-content mt-2">
                                    <p><?php echo nl2br(htmlspecialchars($row['reply'])); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="alert alert-info">
                <h4>No Messages Yet</h4>
                <p>You haven't sent any messages yet. Want to contact us? <a href="contact.php" class="alert-link">Click here</a></p>
            </div>
        <?php endif; ?>
    </div>

    <?php include 'includes/footer.php'; ?>

    <style>
        .card {
            border: 1px solid #600070;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .card-header {
            background-color: #fff;
            border-bottom: 2px solid #600070;
            padding: 15px;
        }
        .message-content {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin: 10px 0;
        }
        .admin-reply {
            background-color: #f0e6f2;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #600070;
        }
        .reply-header {
            color: #600070;
        }
        .reply-content {
            background-color: white;
            padding: 15px;
            border-radius: 5px;
        }
        .badge {
            padding: 8px 12px;
            font-size: 0.9em;
        }
        .alert-link {
            color: #600070;
            text-decoration: none;
        }
        .alert-link:hover {
            text-decoration: underline;
        }
    </style>
</body>
</html>