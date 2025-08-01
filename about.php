<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Adventour</title>
    <link rel="icon" href="./assets/files/logo.png">
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/nav.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Paytone+One&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>
<?php include 'includes/navbar.php'; ?>
<body class="aboutbody">
   

    <section class="about">
        <div class="main">
            <div class="abt-text">
                <h1><marquee>About <span>Us</span></marquee></h1>
                <img src="./assets/files/cover.jpg" alt="Adventure Tours">
                <hr>
                <p>Welcome to Adventour, where every journey is an adventure waiting to unfold. Since our inception, we've been dedicated to crafting extraordinary travel experiences that push boundaries and create lasting memories.<br><br>

                At Adventour, we believe that true adventure lies in discovering the world's most breathtaking destinations while challenging yourself in new and exciting ways. From scaling majestic peaks in New Zealand to exploring the mystical deserts of Dubai, and experiencing the cultural richness of France, we curate experiences that combine thrill, culture, and comfort.<br><br>

                Our team consists of passionate adventure enthusiasts and travel experts who personally vet each destination and activity to ensure both excitement and safety. We understand that every adventurer is unique, which is why we offer a diverse range of packages - from heart-pumping adrenaline activities to cultural immersions with a dash of adventure.<br><br>

                What sets us apart is our commitment to responsible tourism and sustainable practices. We work closely with local communities, respect environmental guidelines, and ensure that our adventures leave positive footprints in the places we visit.<br><br>

                Join us in creating stories worth telling, memories worth keeping, and adventures worth sharing. Whether you're a seasoned thrill-seeker or a first-time adventurer, Adventour is your gateway to extraordinary experiences.</p>
                
                <a href="contact.php" class="connectbtn">Connect with us!</a>

               
            </div>
        </div>
    </section>

   <?php include 'includes/footer.php';?>
   <style>.aboutbody {
    background: #f8f8f8;
    font-family: 'Poppins', sans-serif;
}

.about {
    padding: 80px 0;
}

.main {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.abt-text {
    text-align: center;
}

.abt-text h1 {
    font-size: 42px;
    color: #600070;
    margin-bottom: 30px;
    font-family: 'Paytone One', sans-serif;
}

.abt-text h1 span {
    color: #da9eec;
}

.abt-text img {
    max-width: 100%;
    height: 500px; /* Increased height */
    width: 800px;  /* Added specific width */
    object-fit: cover; /* Ensures image covers area without distortion */
    border-radius: 10px;
    margin: 20px 0;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    transition: transform 0.3s ease; /* Smooth transition for hover effect */
}

.abt-text img:hover {
    transform: scale(1.02); /* Slight zoom on hover */
}

@media (max-width: 768px) {
    .abt-text img {
        height: 300px; /* Adjusted height for mobile */
        width: 100%;
    }
}
.abt-text hr {
    width: 60%;
    margin: 30px auto;
    border: 1px solid #da9eec;
}

.abt-text p {
    color: #666;
    font-size: 16px;
    line-height: 1.8;
    margin: 20px 0;
    text-align: justify;
    padding: 0 50px;
}

.connectbtn {
    display: inline-block;
    padding: 12px 30px;
    background: #da9eec;
    color: #600070;
    border-radius: 5px;
    font-weight: 600;
    transition: 0.3s;
    text-decoration: none;
    margin: 30px 0;
    border: 2px solid #600070;
}

.connectbtn:hover {
    background: #600070;
    color: #fff;
    transform: scale(1.1);
}

.connect-section {
    margin-top: 30px;
}

.social-icons {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 20px;
}

.social-icons a {
    color: #600070;
    font-size: 24px;
    transition: 0.3s;
}

.social-icons a:hover {
    color: #da9eec;
    transform: translateY(-5px);
}

@media (max-width: 768px) {
    .about {
        padding: 40px 0;
    }

    .abt-text h1 {
        font-size: 32px;
    }

    .abt-text p {
        padding: 0 20px;
        font-size: 14px;
    }

    .connectbtn {
        padding: 10px 25px;
        font-size: 14px;
    }
}
   </style></body>
</html>