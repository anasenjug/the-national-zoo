<?php
include "spoj.php"; 
include "session_handler.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $headline = $_POST['headline'];
    $content = $_POST['content'];
    $picture_url = $_POST['picture_url']; // Optional field

    // Get user ID from session (assuming user is logged in)
    $createdBy = $_SESSION['id'];

    // Check if the user ID exists in the 'user' table
    $userCheckQuery = "SELECT id FROM user WHERE id = $createdBy";
    $userCheckResult = $spoj->query($userCheckQuery);

    if ($userCheckResult && $userCheckResult->num_rows > 0) {
        // Insert news into the database with 'likedBy' as the current user ID
        $insertQuery = "INSERT INTO news (headline, content, picture_url, createdBy, creationDate) 
                        VALUES ('$headline', '$content', '$picture_url', $createdBy, NOW())";

        if ($spoj->query($insertQuery) === TRUE) {
            // News inserted successfully
            header("Location: adminNews.php");
            exit();
        } else {
            // Error occurred
            echo "Error creating news: " . $spoj->error;
        }
    } else {
        echo "Invalid user ID."; // Handle the scenario where the user ID is invalid
    }


}
?>

