<?php
session_start();
if(!isset($_SESSION['admin_id'])) {
  header('location:admin_login.php');
  exit();
}
include("header.php");
include("../connect.php");
?>

<div class="container" style="padding:90px;">
    <div class="card">
        <div class="card-header">
            <h4 class="text-center" style="color:#600070;">All Tour Packages</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Package Name</th>
                        <th>Duration</th>
                        <th>Price</th>
                        <th>Location</th>
                        <th>Tour Type</th>
                        <th>Category</th>
                        <th>Max Participants</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $select_packages = mysqli_query($conn, "SELECT * FROM `packages`") or die('query failed');
                    if(mysqli_num_rows($select_packages) > 0){
                        while($fetch_packages = mysqli_fetch_assoc($select_packages)){
                    ?>
                    <tr>
                        <td><?php echo $fetch_packages['package_name']; ?></td>
                        <td><?php echo $fetch_packages['duration']; ?> Days</td>
                        <td>₹<?php echo $fetch_packages['price']; ?></td>
                        <td><?php echo $fetch_packages['city']; ?>, <?php echo $fetch_packages['region']; ?></td>
                        <td><?php echo ucfirst($fetch_packages['tour_type']); ?></td>
                        <td><?php echo ucfirst($fetch_packages['category']); ?></td>
                        <td><?php echo $fetch_packages['max_participants']; ?></td>
                        <td>
                            <a href="update_package.php?id=<?php echo $fetch_packages['id']; ?>" class="btn btn-primary btn-sm">Update</a>
                            <a href="delete_package.php?id=<?php echo $fetch_packages['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this package?');">Delete</a>
                        </td>
                    </tr>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="8" class="text-center">No packages found</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .card {
        margin-top: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .card-header {
        background-color: #fff;
        border-bottom: 2px solid #600070;
    }
    .table {
        margin-bottom: 0;
    }
    .btn-primary {
        background-color: #600070;
        border-color: #600070;
        margin-right: 5px;
    }
    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }
</style>

<?php include('footer.php'); ?>