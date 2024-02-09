<?php
include "spoj.php";
include "session_handler.php";

// Check if the user is logged in
if (isset($_SESSION['id'])) {
    // Get the user ID from the session
    $userId = $_SESSION['id'];

    // Check if the request method is POST and the newsId parameter is set
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["newsId"])) {
        // Sanitize the input (prevent SQL injection)
        $newsId = intval($_POST["newsId"]);

        // Check if the user has already liked the news article
        $query = "SELECT COUNT(*) AS num_likes FROM news_likes WHERE user_id = $userId AND news_id = $newsId";
        $result = mysqli_query($spoj, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $numLikes = intval($row["num_likes"]);
            if ($numLikes > 0) {
                // User has already liked the news article, so unlike it
                $query = "DELETE FROM news_likes WHERE user_id = $userId AND news_id = $newsId";
                $success = mysqli_query($spoj, $query);
                if ($success) {
                    echo "Unlike"; // Return status
                } else {
                    echo "Error: Failed to unlike the news article";
                }
            } else {
                // User has not liked the news article, so like it
                $query = "INSERT INTO news_likes (user_id, news_id) VALUES ($userId, $newsId)";
                $success = mysqli_query($spoj, $query);
                if ($success) {
                    echo "Like"; // Return status
                } else {
                    echo "Error: Failed to like the news article";
                }
            }
        } else {
            echo "Error: Failed to check if the user has already liked the news article";
        }
    } else {
        echo "Error: Invalid request";
    }
} else {
    echo "Error: User is not logged in";
}
?>
