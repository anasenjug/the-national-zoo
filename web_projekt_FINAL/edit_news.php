<?php
include "spoj.php";
include "session_handler.php";
include "nav.php";

if(isset($_GET['id'])) {
    $newsId = $_GET['id'];
    // Query the database to fetch the news details for editing
    $sql = "SELECT * FROM news WHERE id = $newsId";
    $result = mysqli_query($spoj, $sql);
    if(mysqli_num_rows($result) > 0) {
        $news = mysqli_fetch_assoc($result);
        // Here you can display a form with the news details for editing
        // For example:
        echo '<form id="edit-news-form" method="POST" action="update_news.php">';
        echo '<input type="hidden" name="news_id" value="' . $news['id'] . '">';
        echo '<input type="text" name="headline" class="news-input" value="' . $news['headline'] . '" required><br>';
        echo '<textarea name="content" class="news-textarea" required>' . $news['content'] . '</textarea><br>';
        echo '<input type="text" name="picture_url" class="news-input" value="' . $news['picture_url'] . '"><br>';
        echo '<input type="submit" value="Update" class="btn">';
        echo '</form>';
    } else {
        echo "News not found";
    }
} else {
    echo "News ID not provided";
}
?>
