<?php
include "spoj.php"; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all necessary fields are filled
    if (isset($_POST['email'], $_POST['password'], $_POST['fname'], $_POST['lname'])) {
        // Retrieve user input from the form
        $email = $_POST['email'];
        $password = $_POST['password'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $defaultRole = 'user';

        // Interpolate user input directly into the SQL query (vulnerable to SQL injection)
        $query = "INSERT INTO user (email, password, fname, lname, role) VALUES ('$email', '$password', '$fname', '$lname', '$defaultRole')";

        // Execute the SQL query
        $result = $spoj->query($query);

        if ($result) {
            // Redirect to the member home page after successful registration
            header("Location: home.php");
            exit();
        } else {
            echo "Error in executing SQL query: " . $spoj->error;
        }
    } else {
        echo "Invalid or missing data!";
    }
}
include "head.php";
?>

<body class="animal_background">
    <div class="register">
        <div><a href="home.php"><img id="tnzlogo" src="images/tnzlogo.svg" alt=""></a></div>
        <div class="register_form">    
            <h2>Register</h2>
            <form action="register.php" method="post">
                <label for="email">E-mail</label><br>
                <input type="email" name="email" id="email"><br>
                <label for="password">Password</label><br>
                <input type="password" name="password" id="password"><br>
                <label for="fname">First name</label><br>
                <input type="text" name="fname" id="fname"><br>
                <label for="lname">Last name</label><br>
                <input type="text" name="lname" id="lname"><br>
                <button type="submit">REGISTER</button>
            </form>
        </div>
    </div>
</body>
