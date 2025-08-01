<?php

include('connect.php');

if(isset($_GET['id'])) {
    $package_id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM packages WHERE id = '$package_id'";
    $result = mysqli_query($conn, $query) or die('query failed');
    $package = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/nav.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/footer.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css"> 
</head>
<body>

    <?php include 'includes/navbar.php'; ?>
    <!-- Rest of your page content -->
 <div class="container-fluid" style="padding-top: 100px;
                                     padding-left:50px;
                                     padding-right:50px;">
    <?php if(isset($package)) { ?>
        <div class="row">
            <div class="col-md-8">
                <img src="uploaded_img/<?php echo $package['package_image']; ?>" class="img-fluid rounded" alt="Package Image">
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title" style="color:#600070;"><?php echo $package['package_name']; ?></h2>
                        <hr>
                        <p class="package-detail"><strong>Departure From:</strong> <?php echo $package['departure_city']; ?></p>
                        <p class="package-detail"><strong>Duration:</strong> <?php echo $package['duration']; ?> Days</p>
                        <p class="package-detail"><strong>Location:</strong> <?php echo $package['city']; ?>, <?php echo $package['region']; ?></p>
                        <p class="package-detail"><strong>Transportation:</strong> <?php echo ucfirst($package['transport_type']); ?></p>
                        <p class="package-detail"><strong>Price:</strong> ₹<?php echo $package['price']; ?></p>
                        <p class="package-detail"><strong>Tour Type:</strong> <?php echo ucfirst($package['tour_type']); ?></p>
                        <p class="package-detail">
                            <strong>Location Coordinates:</strong> 
                            <a href="https://www.google.com/maps?q=<?php echo $package['latitude']; ?>,<?php echo $package['longitude']; ?>" 
                               target="_blank" class="map-link">
                                <i class="fas fa-map-marker-alt"></i>
                                <?php echo $package['latitude']; ?>°N, <?php echo $package['longitude']; ?>°E
                            </a>
                        </p>
                        <p class="package-detail"><strong>Category:</strong> <?php echo ucfirst($package['category']); ?></p>
                        <p class="package-detail"><strong>Max Participants:</strong> <?php echo $package['max_participants']; ?></p>
                        <p class="package-detail"><strong>Start Date:</strong> <?php echo date('d M Y', strtotime($package['start_date'])); ?></p>
                        <p class="package-detail"><strong>End Date:</strong> <?php echo date('d M Y', strtotime($package['end_date'])); ?></p>
                        <a href="javascript:void(0)" onclick="window.print()" class="btn w-100 mb-2">
                            <i class="fas fa-print me-2"></i>Print Details
                        </a>
                        <a href="book_package.php?id=<?php echo $package['id']; ?>" class="btn w-100">Book Now</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
          <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 style="color:#600070;">About This Package</h4>
                    </div>
                    <div class="card-body">
                        <p class="lead"><?php echo nl2br($package['package_description']); ?></p>
                    </div>
                </div>
             </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 style="color:#600070;">Detailed Itinerary</h4>
                    </div>
                    <div class="card-body">
                        <?php 
                        $days = explode("\n", $package['itinerary']);
                        foreach($days as $index => $day) {
                            if(trim($day) != '') {
                                echo '<div class="day-item mb-2">
                                        <span class="day-badge me-2">Day ' . ($index + 1) . '</span>
                                        <span class="day-text">' . trim($day) . '</span>
                                    </div>';
                            }
                        }
                        ?>
                    </div>
                </div>
              </div>
        </div>         
            <div class="row mt-4">
              <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 style="color:#600070;">Important Information</h4>
                    </div>
                    <div class="card-body">
                        <h5>Cancellation Policy</h5>
                        <p>- Free cancellation up to 7 days before the trip<br>
                           - 50% refund between 3-7 days before the trip<br>
                           - No refund within 3 days of the trip</p>
                        
                        <h5>What to Bring</h5>
                        <p>- Valid ID proof<br>
                           - Comfortable walking shoes<br>
                           - Weather appropriate clothing<br>
                           - Personal medications if any</p>
                        
                        <h5>Additional Notes</h5>
                        <p>- Report at meeting point 30 mins early<br>
                           - Follow tour guide instructions<br>
                           - Keep valuables safe</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 style="color:#600070;">Included Services</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <?php 
                            $services = explode("\n", $package['included_services']);
                            foreach($services as $service) {
                                if(trim($service) != '') {
                                    echo "<li><i class='fas fa-check-circle text-success me-2'></i>" . trim($service) . "</li>";
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 style="color:#600070;">Location Map</h4>
                    </div>
                    <div class="card-body p-0">
                        <iframe 
                            width="100%" 
                            height="450" 
                            frameborder="0" 
                            scrolling="no" 
                            marginheight="0" 
                            marginwidth="0" 
                            src="https://www.openstreetmap.org/export/embed.html?bbox=<?php echo ($package['longitude']-0.01).','.$package['latitude'].','.$package['longitude'].','.$package['latitude']; ?>&amp;layer=mapnik&amp;marker=<?php echo $package['latitude'].','.$package['longitude']; ?>">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
      </div>
    <?php } else { ?>
        <div class="alert alert-danger">Package not found!</div>
    <?php } ?>
 </div>

        <!-- Reviews Section -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 style="color:#600070;">Reviews</h4>
                        <?php if(isset($_SESSION['user_id'])) { ?>
                            <button class="btn" data-bs-toggle="modal" data-bs-target="#reviewModal">
                                <i class="fas fa-star me-2"></i>Write a Review
                            </button>
                        <?php } else { ?>
                            <a href="login.php" class="btn"><i class="fas fa-sign-in-alt me-2"></i>Login to Review</a>
                        <?php } ?>
                    </div>
                    <div class="card-body">
                        <?php
                        $review_query = "SELECT r.*, u.name as user_name FROM reviews r 
                                        JOIN user_form u ON r.user_id = u.id 
                                        WHERE r.package_id = '$package_id' 
                                        ORDER BY r.created_at DESC";
                        $review_result = mysqli_query($conn, $review_query);
                        
                        if(mysqli_num_rows($review_result) > 0) {
                            while($review = mysqli_fetch_assoc($review_result)) { ?>
                                <div class="review-item mb-4 p-3 border rounded">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h5 class="mb-0"><?php echo htmlspecialchars($review['user_name']); ?></h5>
                                        <div class="stars">
                                            <?php
                                            for($i = 1; $i <= 5; $i++) {
                                                if($i <= $review['rating']) {
                                                    echo '<i class="fas fa-star text-warning"></i>';
                                                } else {
                                                    echo '<i class="far fa-star text-warning"></i>';
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <p class="mb-1"><?php echo nl2br(htmlspecialchars($review['review_text'])); ?></p>
                                    <small class="text-muted"><?php echo date('d M Y', strtotime($review['created_at'])); ?></small>
                                </div>
                            <?php }
                        } else { ?>
                            <p class="text-center mb-0">No reviews yet. Be the first to review this package!</p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Review Modal -->
        <div class="modal fade" id="reviewModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" style="color:#600070;">Write a Review</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="submit_review.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="package_id" value="<?php echo $package_id; ?>">
                            <div class="mb-3">
                                <label class="form-label">Rating</label>
                                <div class="rating">
                                    <?php for($i = 5; $i >= 1; $i--) { ?>
                                        <input type="radio" name="rating" value="<?php echo $i; ?>" id="star<?php echo $i; ?>" required>
                                        <label for="star<?php echo $i; ?>"><i class="far fa-star"></i></label>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Your Review</label>
                                <textarea class="form-control" name="review_text" rows="4" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn">Submit Review</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php include 'includes/footer.php';?>

 <style>
    /* Add at the top of your style section */
   
    nav {
        z-index: 1000;
     }

    .container-fluid {
        position: relative;
        z-index: 1;
     }

     .package-detail {
            font-size: 1rem;
            margin-bottom: 0.8rem;
        }
        .package-detail strong {
            color: #600070;
            font-size: 1.15rem;
        }
        .card {
            border: 2px solid #600070;
            margin-bottom: 20px;
        }
        .btn {
            background-color: #da9eec;
            color: #600070;
            font-weight: 600;
            border: 2px solid #600070;
        }
        .btn:hover {
            background-color: #600070;
        }

        /* Star Rating Styles */
        .rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }

        .rating input {
            display: none;
        }

        .rating label {
            cursor: pointer;
            font-size: 1.5rem;
            padding: 0 0.2rem;
            color: #ddd;
        }

        .rating label:hover,
        .rating label:hover ~ label,
        .rating input:checked ~ label {
            color: #ffd700;
        }

        .rating label:hover i.far.fa-star::before,
        .rating label:hover ~ label i.far.fa-star::before,
        .rating input:checked ~ label i.far.fa-star::before {
            content: "\f005";
            font-weight: 900;
        }

        .review-item .stars {
            color: #ffd700;
        }

        .review-item {
            background-color: #fff;
            transition: all 0.3s ease;
        }

        .review-item:hover {
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        
            color: #fff;
        }
        .card-header {
            border-bottom: 2px solid #600070;
            background-color: #fff;
        }
        .list-unstyled li {
            margin-bottom: 10px;
        }
        .package-image-container {
            max-height: 400px;
          overflow: hidden;
         display: flex;
       align-items: center;
       justify-content: center;
        }

   .img-fluid {
     width: 100%;
     height: auto;
     object-fit: cover;
     max-height: 600px;
    }

        .day-badge {
        background-color: #600070;
        color: white;
        padding: 2px 8px;
        border-radius: 4px;
        font-size: 0.9rem;
        font-weight: 600;
        display: inline-block;
        min-width: 70px;
        text-align: center;
      }
     .day-text {
        display: inline-block;
        vertical-align: top;
     }
     .day-item {
        padding: 5px 0;
        border-bottom: 1px dashed #e0e0e0;
     }
     .day-item:last-child {
        border-bottom: none;
     }

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
        margin-bottom: 10px;
     }
     .map-link {
            color: #600070;
            text-decoration: none;
            transition: 0.3s;
        }
        .map-link:hover {
            color: #da9eec;
        }
        .fa-map-marker-alt {
            margin-right: 5px;
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

    @media print {
    nav, footer, .btn, #footer {
        display: none !important;
        visibility: hidden !important;
    }
    body {
        padding: 20px;
        margin: 0;
        min-height: 0 !important;
    }
    .card {
        border: 1px solid #000 !important;
        break-inside: avoid;
        page-break-inside: avoid;
    }
    .container-fluid {
        padding: 0 !important;
        margin: 0 !important;
    }
    .img-fluid {
        max-height: 300px !important;
    }
    @page {
        margin: 0.5cm;
        size: A4;
    }
    #footer, .footer, footer * {
        display: none !important;
        visibility: hidden !important;
        height: 0 !important;
        padding: 0 !important;
        margin: 0 !important;
    }
    .main-content {
        margin-bottom: 0 !important;
        padding-bottom: 0 !important;
    }
   }
 </style>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
