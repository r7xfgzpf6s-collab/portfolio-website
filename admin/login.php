<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "portfolio_db");

$error = "";

if(isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username == "admin" && $password == "1234") {

        $_SESSION['admin'] = $username;

        header("Location: dashboard.php");
        exit();

    } else {

        $error = "Invalid Username or Password";

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <link rel="stylesheet" href="/portfolio/css/style.css">
</head>
<body>

<section class="hero">

    <div class="hero-text">

        <h1>Admin Login</h1>

        <?php if($error != "") { ?>
            <p style="color:red;"><?php echo $error; ?></p>
        <?php } ?>

        <form method="POST">

            <input
                type="text"
                name="username"
                placeholder="Username"
                required
            >

            <br><br>

            <input
                type="password"
                name="password"
                placeholder="Password"
                required
            >

            <br><br>

            <button
                type="submit"
                name="login"
                class="btn"
            >
                Login
            </button>

        </form>

    </div>

</section>

</body>
</html>