<?php

include('connect.php');

// Base query
$query = "SELECT * FROM `packages` WHERE tour_type = 'indian'";

// Apply filters if set
if(isset($_GET['category'])) {
    $category = mysqli_real_escape_string($conn, $_GET['category']);
    $query .= " AND category = '$category'";
}

if(isset($_GET['price_range'])) {
    switch($_GET['price_range']) {
        case '0-20000':
            $query .= " AND price <= 20000";
            break;
        case '20000-50000':
            $query .= " AND price BETWEEN 20000 AND 50000";
            break;
        case '50000-100000':
            $query .= " AND price BETWEEN 50000 AND 100000";
            break;
        case '100000+':
            $query .= " AND price >= 100000";
            break;
    }
}

if(isset($_GET['duration'])) {
    switch($_GET['duration']) {
        case '1-3':
            $query .= " AND duration BETWEEN 1 AND 3";
            break;
        case '4-7':
            $query .= " AND duration BETWEEN 4 AND 7";
            break;
        case '8+':
            $query .= " AND duration >= 8";
            break;
    }
}

$select_packages = mysqli_query($conn, $query) or die('query failed');
?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./assets/css/nav.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/footer.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">  <!-- Add this line -->
</head>
<body>

    <?php include 'includes/navbar.php'; ?>
    <!-- Rest of your page content -->
<div class="container-fluid" style="padding: 30px;">
<h2 class="text-center mb-4" style="color:#600070;">Indian Tour Packages</h2>
    <div class="row">
        <!-- Sidebar Filters -->
        <div class="col-md-3">
            <div class="card filter-card">
                <div class="card-header">
                    <h4 style="color:#600070;">Filters</h4>
                </div>
                <div class="card-body">
                    <form action="" method="GET">
                        <h5>Category</h5>
                        <div class="mb-3">
                            <select name="category" class="form-control">
                                <option value="">All Categories</option>
                                <option value="adventure">Adventure</option>
                                <option value="cultural">Cultural</option>
                                <option value="religious">Religious</option>
                                <option value="wildlife">Wildlife</option>
                                <option value="beach">Beach</option>
                                <option value="hill_station">Hill Station</option>
                            </select>
                        </div>

                        <h5>Price Range</h5>
                        <div class="mb-3">
                            <select name="price_range" class="form-control">
                                <option value="">All Prices</option>
                                <option value="0-20000">Under ₹20,000</option>
                                <option value="20000-50000">₹20,000 - ₹50,000</option>
                                <option value="50000-100000">₹50,000 - ₹1,00,000</option>
                                <option value="100000+">Above ₹1,00,000</option>
                            </select>
                        </div>

                        <h5>Duration</h5>
                        <div class="mb-3">
                            <select name="duration" class="form-control">
                                <option value="">Any Duration</option>
                                <option value="1-3">1-3 Days</option>
                                <option value="4-7">4-7 Days</option>
                                <option value="8+">8+ Days</option>
                            </select>
                        </div>

                        <button type="submit" class="btn w-100">Apply Filters</button>
                        <a href="india.php" class="btn w-100 mt-2">Clear Filters</a>
                    </form>
                </div>
            </div>
            
        </div>

        <!-- Packages Display -->
        <div class="col-md-9">    
            <div class="row">
                <h4 align="center">Indian Packages</h4>
                <?php 
                if(mysqli_num_rows($select_packages) > 0) {
                    while($package = mysqli_fetch_assoc($select_packages)){ 
                ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="uploaded_img/<?php echo $package['package_image']; ?>" class="card-img-top" alt="Package Image">
                            <div class="card-body">
                                <h6 class="card-title"><?php echo $package['package_name']; ?></h6>
                                <p class="card-text">
                                    <strong>Duration:</strong> <?php echo $package['duration']; ?> Days<br>
                                    <strong>Location:</strong> <?php echo $package['city']; ?>, <?php echo $package['region']; ?><br>
                                    <strong>Price:</strong> ₹<?php echo $package['price']; ?>
                                </p>
                              
                                    <a href="package_details.php?id=<?php echo $package['id']; ?>" class="btn w-100">View Details</a>
                                    <a href="book_package.php?id=<?php echo $package['id']; ?>" class="btn w-100 mt-2">Book Now</a>
                            
                            </div>
                        </div>
                    </div>
                <?php 
                    }
                } else {
                    echo '<div class="col-12"><p class="text-center">No packages found matching your criteria.</p></div>';
                }
                ?>
            </div>
        </div>
    </div>
    
</div>
<?php include 'includes/footer.php'; ?>

<style>
  .container-fluid {
            padding-top: 30px;
            padding-bottom: 30px;
        }
  .filter-card {
            position: sticky;
            top: 30px;
            border: 2px solid #600070;
            margin-bottom: 20px;
  }
   .card {
    border: 2px solid #600070;
    transition: transform 0.3s;

  }
  .card:hover {
    transform: translateY(-5px);
  }
  .card-img-top {
    height: 170px;
    object-fit: cover;
  }
  .btn {
    background-color: #da9eec;
    color: #600070;
    font-weight: 600;
    border: 2px solid #600070;
}
.btn:hover {
    background-color: #600070;
    color: #fff;
}
select.form-control {
    border: 1px solid #600070;
    margin-bottom: 10px;
}


    /* Update the nav button styles */
    nav .btn {
            background-color: #600070;
            color: white;
            border: none;
            padding: 4px 15px;
            border-radius: 5px;
            transition: 0.3s;
            margin-left: 10px;
            font-size: 14px;
            line-height: 1;
            height: 45px;
            width: auto;
            margin-bottom: 15px;
            display: inline-flex;
            align-items: center;
        }
    
    
    nav .btn:hover {
        background-color: #da9eec;
        color: #600070;
    }
    
    nav .btn a {
        color: white;
        text-decoration: none;
        display: inline-block;
    }
    
    nav .btn:hover a {
        color: #600070;
    }

    nav {
        z-index: 1000;
        display: flex;
        align-items: center;
        padding: 15px 40px;
    }

    .navbar {
        display: flex;
        align-items: center;
    }

    nav .navbar li {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    nav .navbar li a {
        display: flex;
        align-items: center;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
