<?php 
session_start();
if(!isset($_SESSION['admin_id'])) {
  header('location:admin_login.php');
  exit();
}
include("header.php");
include("../connect.php");

// Add to PHP processing section at top
if(isset($_POST['add_package'])){
    $package_name = mysqli_real_escape_string($conn, $_POST['package_name']);
    $departure_city = mysqli_real_escape_string($conn, $_POST['departure_city']);
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $duration = $_POST['duration'];
    $price = $_POST['price'];
    $region = mysqli_real_escape_string($conn, $_POST['region']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $tour_type = $_POST['tour_type'];
    $category = $_POST['category'];
    $transport_type = $_POST['transport_type'];
    $included_services = mysqli_real_escape_string($conn, $_POST['included_services']);
    $itinerary = mysqli_real_escape_string($conn, $_POST['itinerary']);
    $package_description = mysqli_real_escape_string($conn, $_POST['package_description']);
    $max_participants = $_POST['max_participants'];
    $latitude = $_POST['latitude'];
      $longitude = $_POST['longitude'];

    $package_image = $_FILES['package_image']['name'];
    $image_size = $_FILES['package_image']['size'];
    $image_tmp_name = $_FILES['package_image']['tmp_name'];
    $image_folder = '../uploaded_img/'.$package_image;

    $select = mysqli_query($conn, "SELECT * FROM `packages` WHERE package_name = '$package_name'") 
    or die('query failed');

    if(mysqli_num_rows($select) > 0){
        echo "<script>alert('Package already exists!'); window.location.href='addpack.php';</script>";
    }else{
      
      // Update the INSERT query by adding latitude and longitude
      $insert = mysqli_query($conn, "INSERT INTO `packages`(package_name, departure_city, start_date, end_date, duration, price, region, city, tour_type, category, transport_type, included_services, itinerary, package_description, max_participants, package_image, latitude, longitude) 
      VALUES('$package_name', '$departure_city', '$start_date', '$end_date', '$duration', '$price', '$region', '$city', '$tour_type', '$category', '$transport_type', '$included_services', '$itinerary', '$package_description', '$max_participants', '$package_image', '$latitude', '$longitude')") or die('query failed');
              
            if($insert){
                move_uploaded_file($image_tmp_name, $image_folder);
                echo "<script>alert('Package added successfully!'); window.location.href='all_packages.php';</script>";
            }else{
                echo "<script>alert('Failed to add package!'); window.location.href='addpack.php';</script>";
            }
          }
        }
?>



<div class="container" style="padding:90px;">
 <div class="row justify-content-center">
  <div class="col-lg-12">
    <div class="card">
    <div class="card-header">
           <h2 class="text-center" style="color:#600070;">Add Tour Package</h2>
    </div>
    <div class="card-body">
      <form action="#" method="POST" enctype="multipart/form-data">
      <div class="row">
          <div class="col-md-6">
            <label class="form-label text-secondary">Package Name:</label>
            <input type="text" class="form-control" name="package_name" required>
          </div>
          <div class="col-md-6">
            <label class="form-label text-secondary">Departure City:</label>
            <input type="text" class="form-control" name="departure_city" required>
          </div>
        </div><br>

        <div class="row">
          <div class="col-md-4">
            <label class="form-label text-secondary">Start Date:</label>
            <input type="date" class="form-control" name="start_date" required>
          </div>
          <div class="col-md-4">
            <label class="form-label text-secondary">End Date:</label>
            <input type="date" class="form-control" name="end_date" required>
          </div>
          <div class="col-md-4">
            <label class="form-label text-secondary">Duration (Days):</label>
            <input type="number" class="form-control" name="duration" min="1" required>
          </div>
        </div><br>

        <div class="row">
        <div class="col-md-4">
            <label class="form-label text-secondary">Price (₹):</label>
            <input type="number" class="form-control" name="price" min="0" required>
          </div>
          <div class="col-md-4">
            <label class="form-label text-secondary">Region/State:</label>
            <input type="text" class="form-control" name="region" required>
          </div>
          <div class="col-md-4">
            <label class="form-label text-secondary">City:</label>
            <input type="text" class="form-control" name="city" required>
          </div>
        </div><br>

        <div class="row">
          <div class="col-md-4">
            <label class="form-label text-secondary">Tour Type:</label>
            <select class="form-control" name="tour_type" required>
              <option value="">Select Tour Type</option>
              <option value="indian">Indian Tour</option>
              <option value="global">Global Tour</option>
            </select>
          </div>
          <div class="col-md-4">
            <label class="form-label text-secondary">Category:</label>
            <select class="form-control" name="category" required>
              <option value="">Select Category</option>
              <option value="adventure">Adventure</option>
              <option value="cultural">Cultural</option>
              <option value="religious">Religious</option>
              <option value="wildlife">Wildlife</option>
              <option value="beach">Beach</option>
              <option value="hill_station">Hill Station</option>
            </select>
          </div>
          <div class="col-md-4">
            <label class="form-label text-secondary">Transportation:</label>
            <select class="form-control" name="transport_type" required>
              <option value="">Select Transportation</option>
              <option value="bus">Bus</option>
              <option value="train">Train</option>
              <option value="flight">Flight</option>
            </select>
          </div>
        </div><br>

        <label class="form-label text-secondary">Included Services:</label>
        <textarea class="form-control" name="included_services" rows="3" placeholder="Enter included services (e.g., Hotel, Transport, Meals, etc.)" required></textarea><br>

        <label class="form-label text-secondary">Itinerary Highlights:</label>
        <textarea class="form-control" name="itinerary" rows="4" placeholder="Enter day-wise itinerary highlights" required></textarea><br>

        <label class="form-label text-secondary">Package Description:</label>
        <textarea class="form-control" name="package_description" rows="7" placeholder="Enter detailed description" required></textarea><br>


        <div class="row">
          <div class="col-md-6">
            <label class="form-label text-secondary">Maximum Participants:</label>
            <input type="number" class="form-control" name="max_participants" min="1" required>
          </div>
          <div class="col-md-6">
            <label class="form-label text-secondary">Package Image:</label>
            <input type="file" class="form-control" name="package_image" accept="image/*" required><br>
            
          </div>
        </div><br>
        <div class="row">
          <div class="col-md-6">
            <label class="form-label text-secondary">Latitude:</label>
            <input type="number" class="form-control" name="latitude" step="any" placeholder="e.g. 32.2432" required>
          </div>
          <div class="col-md-6">
            <label class="form-label text-secondary">Longitude:</label>
            <input type="number" class="form-control" name="longitude" step="any" placeholder="e.g. 77.1892" required>
          </div>
        </div><br>
       

        <div class="text-center">
          <input class="btn" type="submit" name="add_package" value="Submit">
        </div>
      </form>
    </div>
  </div>
  </div>
  </div>
</div>

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
        width:120px;
    }
    select.form-control {
        cursor: pointer;
    }

    @media (max-width: 768px) {
        .container {
            padding: 20px !important;
        }
        
        .card {
            margin-top: 15px;
        }
        
        .card-body {
            padding: 15px;
        }
        
        .row {
            margin-left: 0;
            margin-right: 0;
        }
        
        .col-md-4, .col-md-6 {
            margin-bottom: 15px;
        }
        
        textarea.form-control {
            min-height: 100px;
        }
        
        .btn {
            width: 100%;
            max-width: 200px;
        }
    }
</style>

<?php include('footer.php'); ?>