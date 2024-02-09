<?php
include "spoj.php";
include "session_handler.php";
include "nav.php";

// Check if the delete_news_id parameter is set in the POST data
if(isset($_POST['delete_news_id'])) {
    $newsId = $_POST['delete_news_id'];
    
    $sql = "DELETE FROM news WHERE id = $newsId";
    $result = mysqli_query($spoj, $sql);
    if($result) {
        echo "News item deleted successfully";
    } else {
         echo "Error deleting news item: " . mysqli_error($spoj);
    }
}
?>

<body class="member">
    <div class="member_page">
        <h1>My news</h1>
        <div class="member_content">
        <div class="container">
        <?php foreach ($newsArray as $news): ?>
            <div class="news" id="news<?php echo $news['id']; ?>">
                <h2><?php echo $news['headline']; ?></h2>
                <button class="btn" onclick="toggleNews('content<?php echo $news['id']; ?>')">Read</button>
                <button class="btn edit-btn" onclick="editNews(<?php echo $news['id']; ?>)">Edit</button>
                <button class="btn delete-btn" onclick="deleteNews(<?php echo $news['id']; ?>)">Delete</button>
                <div id="content<?php echo $news['id']; ?>" class="news-content" style="display: none;">
                    <p><?php echo $news['content']; ?></p>
                    <!-- Display other news details as needed -->
                </div>
            </div>
        <?php endforeach; ?>
        <button class="btn" style="background-color: #D29D39;" onclick="toggleCreateForm()">+ New</button>

        <div id="news-form" style="display: none;" class="news">
        <form id="create-news-form" method="POST" action="create_news.php">
            <input type="text" name="headline" class="news-input" placeholder="Enter headline" required><br>
            <textarea name="content" class="news-textarea" placeholder="Enter content" required></textarea><br>
            <input type="text" name="picture_url" class="news-input" placeholder="Enter picture URL"><br>
            <input type="submit" value="Submit" class="btn">
        </form>
    </div>

            </div>
        </div>
    </div>

    <script>
        function toggleNews(contentId) {
            var content = document.getElementById(contentId);
            if (content.style.display === "none") {
                content.style.display = "block";
            } else {
                content.style.display = "none";
            }
        }

function deleteNews(newsId) {
    console.log('Deleting news with ID:', newsId); // Log the ID to ensure it's received correctly
    if (confirm("Are you sure you want to delete this news?")) {
        // Create a hidden form element to send the news ID
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = 'adminNews.php'; // Submit to the same page
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'delete_news_id';
        input.value = newsId;
        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
    }
}

function toggleCreateForm() {
        var newsForm = document.getElementById('news-form');
        if (newsForm.style.display === "none") {
            newsForm.style.display = "block";
        } else {
            newsForm.style.display = "none";
        }
}

function editNews(newsId) {
    window.location.href = 'edit_news.php?id=' + newsId;
}
    </script>
</body>