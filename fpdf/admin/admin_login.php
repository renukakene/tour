<?php
session_start();
include('../connect.php');

if(isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);

    $select = mysqli_query($conn, "SELECT * FROM `admin` WHERE email = '$email' AND password = '$password'") or die('query failed');

    if(mysqli_num_rows($select) > 0){
        $row = mysqli_fetch_assoc($select);
        $_SESSION['admin_id'] = $row['id'];
        header('location:all_packages.php');
    }else{
        $message[] = 'Incorrect email or password!';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Admin Login</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        if(isset($message)){
                            foreach($message as $message){
                                echo '<div class="alert alert-danger">'.$message.'</div>';
                            }
                        }
                        ?>
                        <form method="post">
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" name="submit" class="btn w-100">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        body {
            background-color: #f8f9fa;
        }
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
        .card-header h3 {
            color: #600070;
            margin: 0;
            text-align: center;
        }
        .btn {
            background-color: #600070;
            color: white;
            padding: 10px 30px;
            font-size: 18px;
            border-radius: 30px;
            transition: all 0.3s;
        }
        .btn:hover {
            background-color: #da9eec;
            color: #600070;
        }
    </style>
</body>
</html>