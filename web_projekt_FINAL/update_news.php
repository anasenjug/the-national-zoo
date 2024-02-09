<?php
include "spoj.php";
include "session_handler.php";
include "nav.php";

if(isset($_POST['news_id'])) {
    $newsId = $_POST['news_id'];
    $headline = $_POST['headline'];
    $content = $_POST['content'];
    $pictureUrl = $_POST['picture_url'];
    
    // Update the news item in the database
    $sql = "UPDATE news SET headline = '$headline', content = '$content', picture_url = '$pictureUrl' WHERE id = $newsId";
    $result = mysqli_query($spoj, $sql);
    if($result) {
        echo "News item updated successfully";
        // Redirect back to the adminNews.php page or any other appropriate page
        header("Location: adminNews.php");
        exit();
    } else {
         echo "Error updating news item: " . mysqli_error($spoj);
    }
} else {
    echo "News ID not provided";
}
?>
