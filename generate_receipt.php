<?php
session_start();
include('connect.php');
require('fpdf/fpdf.php');  // Updated path to point to fpdf folder

if(!isset($_SESSION['user_id']) || !isset($_GET['booking_id'])) {
    header('location:login.php');
    exit();
}

// Fetch booking details
$query = "SELECT b.*, p.package_name, p.price, p.start_date, u.name, u.email 
          FROM bookings b 
          JOIN packages p ON b.package_id = p.id 
          JOIN user_form u ON b.user_id = u.id
          WHERE b.id = '".mysqli_real_escape_string($conn, $_GET['booking_id'])."' 
          AND b.user_id = '".$_SESSION['user_id']."'";
$result = mysqli_query($conn, $query);
$booking = mysqli_fetch_assoc($result);

if(!$booking || $booking['payment_status'] != 'paid') {
    header('location:my_bookings.php');
    exit();
}

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 20);
        $this->Cell(0, 10, 'Travel Booking Receipt', 0, 1, 'C');
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 10, 'Your Travel Partner', 0, 1, 'C');
        $this->Line(10, 40, 200, 40);
        $this->Ln(10);
    }
    
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page '.$this->PageNo().'/{nb}', 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

// Customer Details
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Customer Details', 0, 1, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 7, 'Name:', 0);
$pdf->Cell(0, 7, $booking['name'], 0, 1);
$pdf->Cell(40, 7, 'Email:', 0);
$pdf->Cell(0, 7, $booking['email'], 0, 1);

$pdf->Ln(5);

// Booking Details
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Booking Details', 0, 1, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(60, 7, 'Booking ID:', 0);
$pdf->Cell(0, 7, $booking['id'], 0, 1);
$pdf->Cell(60, 7, 'Package Name:', 0);
$pdf->Cell(0, 7, $booking['package_name'], 0, 1);
$pdf->Cell(60, 7, 'Travel Date:', 0);
$pdf->Cell(0, 7, date('d M Y', strtotime($booking['start_date'])), 0, 1);
$pdf->Cell(60, 7, 'Number of Participants:', 0);
$pdf->Cell(0, 7, $booking['participants'], 0, 1);
$pdf->Ln(5);

// Payment Details
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Payment Details', 0, 1, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(60, 7, 'Price per Person:', 0);
$pdf->Cell(0, 7, 'Rs. '.number_format($booking['price']), 0, 1);
$pdf->Cell(60, 7, 'Total Amount:', 0);
$pdf->Cell(0, 7, 'Rs. '.number_format($booking['price'] * $booking['participants']), 0, 1);
$pdf->Cell(60, 7, 'Payment Status:', 0);
$pdf->Cell(0, 7, ucfirst($booking['payment_status']), 0, 1);

// Footer Note
$pdf->Ln(10);
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0, 10, 'Thank you for choosing us for your travel needs!', 0, 1, 'C');
$pdf->Cell(0, 10, 'For any queries, please contact our support team.', 0, 1, 'C');

$pdf->Output('D', 'Booking_Receipt_'.$booking['id'].'.pdf');
?>