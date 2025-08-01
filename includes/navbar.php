<?php
 include 'connect.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav>
    <img src="./assets/files/logo.png" class="logo" alt="Logo" title="FirstFlight Travels">
    <div class="nav-links">
        <a href="index.php#home">Home</a>
        <div class="dropdown">
            <a href="index.php#package" class="dropbtn">Packages</a>
            <div class="dropdown-content">
                <a href="india.php">Indian Tours</a>
                <a href="global.php">Global Tours</a>
            </div>
        </div>
        <a href="index.php#locations">Locations</a>
        <a href="./about.php">About Us</a>
        <a href="./contact.php">Contact Us</a>
        <?php if(isset($_SESSION['user_id'])): ?>
            <a href="my_bookings.php">My Bookings</a>
            <li><a href="my_messages.php">My Messages</a></li>
            <a href="profile.php">My Profile</a>
            <a href="logout.php" class="nav-btn">LOGOUT</a>
        <?php else: ?>
            <a href="login.php" class="nav-btn">LOGIN</a>
        <?php endif; ?>
    </div>
</nav>