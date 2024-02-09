<?php
// Include your database connection file (spoj.php)
include "spoj.php";
include "session_handler.php";
include "nav.php";
include "head.php";
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
                        <button class="btn like-btn" onclick="toggleLike(<?php echo $news['id']; ?>)">
                            <i id="heart<?php echo $news['id']; ?>" class="far fa-heart"></i>
                        </button>
                        <div id="content<?php echo $news['id']; ?>" class="news-content" style="display: none;">
                            <p><?php echo $news['content']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>

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

        function toggleLike(newsId) {
            // Send an AJAX request to the server to like/unlike the news article
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'like_news.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Request successful, handle response
                        if (xhr.responseText.trim() === "Like") {
                            // News article is liked
                            updateLikeState(newsId, true);
                        } else if (xhr.responseText.trim() === "Unlike") {
                            // News article is unliked
                            updateLikeState(newsId, false);
                        } else {
                            // Handle other responses or errors
                            console.error('Error:', xhr.responseText.trim());
                        }
                    } else {
                        // Error handling for non-200 HTTP status codes
                        console.error('HTTP Error:', xhr.status);
                    }
                }
            };
            // Send the newsId as POST data
            xhr.send('newsId=' + newsId);
        }

        function updateLikeCount(newsId, likeCount) {
            // Update the like count in the UI
            var likeCountSpan = document.getElementById('like-count-' + newsId);
            if (likeCountSpan) {
                likeCountSpan.textContent = likeCount;
            }
        }

        function updateLikeState(newsId, isLiked) {
    // Update the like button state (heart icon) based on the isLiked parameter
    var heartIcon = document.getElementById('heart' + newsId);
    if (heartIcon) {
        if (isLiked) {
            heartIcon.classList.remove('far');
            heartIcon.classList.add('fas');
            heartIcon.style.color = '#D29D39'; // Liked color
        } else {
            heartIcon.classList.remove('fas');
            heartIcon.classList.add('far');
            heartIcon.style.color = 'initial'; // Reset to default color
        }
    }
}

        document.addEventListener('DOMContentLoaded', function() {
            // Iterate over all news articles
            var newsElements = document.querySelectorAll('.news');
            newsElements.forEach(function(news) {
                // Extract the news ID from the news element ID
                var newsId = news.id.replace('news', '');

                // Check if the liked status is stored in localStorage
                var isLiked = localStorage.getItem('liked_' + newsId);

                // Check if the user is logged in before sending the AJAX request
                if (isUserLoggedIn()) {
                    // Send an AJAX request to check the like state from the server
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'check_like_state.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                // Request successful, handle response
                                if (xhr.responseText.trim() === "Liked") {
                                    // News article is liked
                                    updateLikeState(newsId, true);
                                } else {
                                    // News article is not liked
                                    updateLikeState(newsId, false);
                                }
                            } else {
                                // Error handling for non-200 HTTP status codes
                                console.error('HTTP Error:', xhr.status);
                            }
                        }
                    };
                    // Send the newsId as POST data
                    xhr.send('newsId=' + newsId);
                }
            });
        });

        function isUserLoggedIn() {
            return <?php echo isset($_SESSION['userId']) ? 'true' : 'false'; ?>;
        }
    </script>
</body>
