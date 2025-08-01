<?php 
include("header.php");
include("../connect.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $select = mysqli_query($conn, "SELECT * FROM `packages` WHERE id = '$id'") or die('query failed');
    if(mysqli_num_rows($select) > 0){
        $fetch = mysqli_fetch_assoc($select);
?>

<div class="container" style="padding:90px;">
    <div class="card">
        <div class="card-header">
            <h2 class="text-center" style="color:#600070;">Update Package</h2>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="old_image" value="<?php echo $fetch['package_image']; ?>">
                <input type="hidden" name="id" value="<?php echo $fetch['id']; ?>">
                
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label text-secondary">Package Name:</label>
                        <input type="text" class="form-control" name="package_name" value="<?php echo $fetch['package_name']; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-secondary">Departure City:</label>
                        <input type="text" class="form-control" name="departure_city" value="<?php echo $fetch['departure_city']; ?>" required>
                    </div>
                </div><br>

                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label text-secondary">Start Date:</label>
                        <input type="date" class="form-control" name="start_date" value="<?php echo $fetch['start_date']; ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-secondary">End Date:</label>
                        <input type="date" class="form-control" name="end_date" value="<?php echo $fetch['end_date']; ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-secondary">Duration (Days):</label>
                        <input type="number" class="form-control" name="duration" value="<?php echo $fetch['duration']; ?>" min="1" required>
                    </div>
                </div><br>

                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label text-secondary">Price (₹):</label>
                        <input type="number" class="form-control" name="price" value="<?php echo $fetch['price']; ?>" min="0" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-secondary">Region/State:</label>
                        <input type="text" class="form-control" name="region" value="<?php echo $fetch['region']; ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-secondary">City:</label>
                        <input type="text" class="form-control" name="city" value="<?php echo $fetch['city']; ?>" required>
                    </div>
                </div><br>

                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label text-secondary">Tour Type:</label>
                        <select class="form-control" name="tour_type" required>
                            <option value="indian" <?php if($fetch['tour_type'] == 'indian') echo 'selected'; ?>>Indian Tour</option>
                            <option value="global" <?php if($fetch['tour_type'] == 'global') echo 'selected'; ?>>Global Tour</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-secondary">Category:</label>
                        <select class="form-control" name="category" required>
                            <option value="adventure" <?php if($fetch['category'] == 'adventure') echo 'selected'; ?>>Adventure</option>
                            <option value="cultural" <?php if($fetch['category'] == 'cultural') echo 'selected'; ?>>Cultural</option>
                            <option value="religious" <?php if($fetch['category'] == 'religious') echo 'selected'; ?>>Religious</option>
                            <option value="wildlife" <?php if($fetch['category'] == 'wildlife') echo 'selected'; ?>>Wildlife</option>
                            <option value="beach" <?php if($fetch['category'] == 'beach') echo 'selected'; ?>>Beach</option>
                            <option value="hill_station" <?php if($fetch['category'] == 'hill_station') echo 'selected'; ?>>Hill Station</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-secondary">Transportation:</label>
                        <select class="form-control" name="transport_type" required>
                            <option value="">Select Transportation</option>
                            <option value="bus" <?php if($fetch['transport_type'] == 'bus') echo 'selected'; ?>>Bus</option>
                            <option value="train" <?php if($fetch['transport_type'] == 'train') echo 'selected'; ?>>Train</option>
                            <option value="flight" <?php if($fetch['transport_type'] == 'flight') echo 'selected'; ?>>Flight</option>
                        </select>
                    </div>
                </div><br>

                <label class="form-label text-secondary">Included Services:</label>
                <textarea class="form-control" name="included_services" rows="3" required><?php echo $fetch['included_services']; ?></textarea><br>

                <label class="form-label text-secondary">Itinerary Highlights:</label>
                <textarea class="form-control" name="itinerary" rows="4" required><?php echo $fetch['itinerary']; ?></textarea><br>

                <label class="form-label text-secondary">Package Description:</label>
                <textarea class="form-control" name="package_description" rows="4" required><?php echo $fetch['package_description']; ?></textarea><br>

                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label text-secondary">Maximum Participants:</label>
                        <input type="number" class="form-control" name="max_participants" value="<?php echo $fetch['max_participants']; ?>" min="1" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-secondary">Package Image:</label>
                        <input type="file" class="form-control" name="package_image" accept="image/*">
                        <small class="text-muted">Current image: <?php echo $fetch['package_image']; ?></small>
                    </div>
                </div><br>

                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label text-secondary">Latitude:</label>
                        <input type="number" class="form-control" name="latitude" step="any" value="<?php echo $fetch['latitude']; ?>" placeholder="e.g. 32.2432" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-secondary">Longitude:</label>
                        <input type="number" class="form-control" name="longitude" step="any" value="<?php echo $fetch['longitude']; ?>" placeholder="e.g. 77.1892" required>
                    </div>
                </div><br>

                <div class="text-center">
                    <input type="submit" class="btn" name="update_package" value="Update Package">
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    }
}

if(isset($_POST['update_package'])){
    $id = $_POST['id'];
    $package_name = mysqli_real_escape_string($conn, $_POST['package_name']);
    $departure_city = mysqli_real_escape_string($conn, $_POST['departure_city']);
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $duration = $_POST['duration'];
    $price = $_POST['price'];
    $region = mysqli_real_escape_string($conn, $_POST['region']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    // In the update query section:
    $tour_type = $_POST['tour_type'];
    $category = $_POST['category'];
    $transport_type = $_POST['transport_type'];
    $included_services = mysqli_real_escape_string($conn, $_POST['included_services']);
    $itinerary = mysqli_real_escape_string($conn, $_POST['itinerary']);
    $package_description = mysqli_real_escape_string($conn, $_POST['package_description']);
    $max_participants = $_POST['max_participants'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    
    $old_image = $_POST['old_image'];
    $package_image = $_FILES['package_image']['name'];
    $package_image_tmp_name = $_FILES['package_image']['tmp_name'];
    $package_image_folder = '../uploaded_img/'.$package_image;

    if(!empty($package_image)){
        if($old_image){
            unlink('../uploaded_img/'.$old_image);
        }
        move_uploaded_file($package_image_tmp_name, $package_image_folder);
    }else{
        $package_image = $old_image;
    }

    $update = mysqli_query($conn, "UPDATE `packages` SET 
        package_name = '$package_name',
        departure_city = '$departure_city',
        start_date = '$start_date',
        end_date = '$end_date',
        duration = '$duration',
        price = '$price',
        region = '$region',
        city = '$city',
        tour_type = '$tour_type',
        category = '$category',
        transport_type = '$transport_type',
        included_services = '$included_services',
        itinerary = '$itinerary',
        package_description = '$package_description',
        max_participants = '$max_participants',
        package_image = '$package_image',
        latitude = '$latitude',
        longitude = '$longitude'
        WHERE id = '$id'") or die('query failed');

    if($update){
        echo "<script>alert('Package updated successfully!'); window.location.href='all_packages.php';</script>";
    }else{
        echo "<script>alert('Failed to update package!'); window.location.href='all_packages.php';</script>";
    }
}

include('footer.php');
?>

<style>
    .card{
        margin-top:30px;
    }
    .card-header{
        border:2px solid;
    }
    .card-body{
        border:2px solid;
    }
    .form-control{
        border:1px solid;
        padding: 8px 10px;
    }
    .btn{
        background-color:#da9eec;
        color: #600070;
        font-weight:600;
        font-size:large;
        border: 2px solid;
        border-color:#600070;
        width:160px;
    }
    select.form-control {
        cursor: pointer;
    }
</style>