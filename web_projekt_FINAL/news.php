<?php
include "spoj.php"; 
include "nav.php";

if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    header("Location: adminNews.php");
    exit();
}else if(isset($_SESSION['role']) && $_SESSION['role']=='user'){
    header("Location: userNews.php");
    exit();
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
                    <div id="content<?php echo $news['id']; ?>" class="news-content" style="display: none;">
                        <p><?php echo $news['content']; ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
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
    </script>
</body>