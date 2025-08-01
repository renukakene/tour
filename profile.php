<?php
session_start();
include('connect.php');

if(!isset($_SESSION['user_id'])) {
    header('location:login.php');
    exit();
}

// Change this line


// To this
$user_id = $_SESSION['user_id'];

if(isset($_POST['update_profile'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
   

    // Update basic info
    mysqli_query($conn, "UPDATE user_form SET name='$name', email='$email' WHERE id='$user_id'");

    // Handle image upload
    if(isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === 0) {
        $image = $_FILES['profile_image']['name'];
        $image_tmp = $_FILES['profile_image']['tmp_name'];
        $image_size = $_FILES['profile_image']['size'];
        $image_folder = 'uploaded_img/'.$image;

        if($image_size > 2000000) {
            $message[] = 'Image is too large!';
        } else {
            move_uploaded_file($image_tmp, $image_folder);
            mysqli_query($conn, "UPDATE user_form SET image='$image' WHERE id='$user_id'");
            $message[] = 'Profile updated successfully!';
        }
    }

    header('location: profile.php?success=1');
    exit();
}

$query = "SELECT * FROM user_form WHERE id = '$user_id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/nav.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/footer.css">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>
    
    <div class="container" style="padding-top: 100px;">
        <?php if(isset($_GET['success'])): ?>
            <div class="alert alert-success">Profile updated successfully!</div>
        <?php endif; ?>
        <?php if(isset($_GET['password']) && $_GET['password'] == 'success'): ?>
            <div class="alert alert-success">Password updated successfully!</div>
        <?php endif; ?>
        <?php if(isset($_GET['error'])): ?>
            <?php if($_GET['error'] == 'current'): ?>
                <div class="alert alert-danger">Current password is incorrect!</div>
            <?php elseif($_GET['error'] == 'match'): ?>
                <div class="alert alert-danger">New passwords do not match!</div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 style="color:#600070;">My Profile</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="text-center mb-4">
                                <?php if(!empty($user['image'])): ?>
                                    <img src="uploaded_img/<?php echo $user['image']; ?>" class="profile-image" alt="Profile">
                                <?php else: ?>
                                    <img src="assets/files/default-avatar.png" class="profile-image" alt="Default Profile">
                                <?php endif; ?>
                                <div class="mt-3">
                                    <input type="file" name="profile_image" class="form-control" accept="image/*">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" value="<?php echo $user['name']; ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" value="<?php echo $user['email']; ?>" required>
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" name="update_profile" class="btn">Update Profile</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">
                        <h3 style="color:#600070;">Change Password</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="update_password.php">
                            <div class="mb-3">
                                <label class="form-label">Current Password</label>
                                <input type="password" name="current_password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <input type="password" name="new_password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirm New Password</label>
                                <input type="password" name="confirm_password" class="form-control" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" name="update_password" class="btn">Update Password</button>
                            </div>
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
        .card-header h3 {
            margin: 0;
            text-align: center;
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
        .form-control {
            border: 1px solid #600070;
        }
        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #600070;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</body>
</html>
