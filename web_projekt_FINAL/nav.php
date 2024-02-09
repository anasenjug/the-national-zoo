<?php
include "spoj.php"; 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$query = "SELECT * FROM news WHERE deleted != 1"; 
$result = $spoj->query($query);

$newsArray = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $newsArray[] = $row; 
    }
}


include "head.php";
?>

<div class="navbar">
        <span class="menu-icon"><img src="images/tnzlogo.svg" alt=""></span>
        <nav>
            <ul>
                <li id="home_button"><a href="home.php"><img src="images/thenationalzoologo.svg" alt="tnz_logo"></a></li>
               
                <li id="name_display"><?php
                    if (isset($_SESSION['fname'])) {
                        echo 'Hi ' . $_SESSION['fname'] .'!';
                        echo '<li class="btn"><button onclick="logout()">Logout</button></li>';
                    } else {
                        
                        echo 'Welcome!';
                        echo '<li id="reg_button"><a href="register.php">REGISTER</a></li>
                        <li id="login_button"><a href="login.php">Login</a></li>';
                    }
                    ?></li>
                <li id="explore_button"><a href="news.php">News</a></li>
                <li id="explore_button"><a href="contact_support.php">Contact</a></li>
                <li id="explore_button"><a href="explore.php">Explore</a></li>
            </ul>
        </nav>
</div>

<script>

    function logout() {
        window.location.href = "logout.php";
    }



</script>