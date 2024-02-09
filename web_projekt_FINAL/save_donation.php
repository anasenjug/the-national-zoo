<?php
include "spoj.php"; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['amount'])) {
    $donationAmount = $_POST['amount'];

    // Insert donation amount into the database (example)
    $query = "INSERT INTO donations (amount) VALUES ($donationAmount)";
    $result = $spoj->query($query);

    if ($result) {
        
        $totalDonationQuery = "SELECT SUM(amount) AS total_amount, COUNT(*) AS total_donors FROM donations";
        $totalResult = $spoj->query($totalDonationQuery);
        $row = $totalResult->fetch_assoc();
        $totalDonation = $row['total_amount'];
        $totalDonors = $row['total_donors'];

        $response = [
            'totalDonation' => $totalDonation,
            'totalDonors' => $totalDonors
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    } else {
        echo "Error saving donation to the database";
    }
}
?>
