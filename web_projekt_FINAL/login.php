<?php
include "spoj.php"; 

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE email = '$email' LIMIT 1";
    $result = $spoj->query($query);

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if($password === $user['password']){
            $_SESSION['email']=$user['email'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['fname'] = $user['fname'];
            $_SESSION['lname'] = $user['lname'];
            $_SESSION['id']=$user['id'];
            header("Location: home.php");
            exit();
        } else {
            $error_message = "Invalid password";
        }
    } else {
        $error_message = "User not found!";
    }
}

include "head.php"
?>


<body class="animal_background">
    <div class="register">
        <div><a href="home.php"><img id="tnzlogo" src="images/tnzlogo.svg" alt=""></a></div>
        <div class="register_form">    
            <h2>Log in</h2>
            <?php if(isset($error_message)) { ?>
                <p><?php echo $error_message; ?></p>
            <?php } ?>
            <form action="login.php" method="post">
                <label for="email">E-mail</label><br>
                <input type="email" name="email" id="email" required><br>
                <label for="password">Password</label><br>
                <input type="password" name="password" id="password" required><br>
                <button type="submit">LOG IN</button>
            </form>
        </div>
    </div>
</body>
