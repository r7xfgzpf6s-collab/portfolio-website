<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = mysqli_connect("localhost", "root", "", "portfolio_db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    $sql = "INSERT INTO contacts (name, email, message)
            VALUES ('$name', '$email', '$message')";

    if (mysqli_query($conn, $sql)) {
        $success = "Message sent successfully!";
    } else {
        $success = "Error: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contact</title>

    <link rel="stylesheet" href="/portfolio/css/style.css">
</head>

<script src="/portfolio/js/script.js"></script>

<body>

<header>
    <nav>

        <h2 class="logo">My Portfolio</h2>

        <ul>
            <li><a href="/portfolio/index.php">Home</a></li>

            <li><a href="/portfolio/about.php">About</a></li>

            <li><a href="/portfolio/projects.php">Projects</a></li>

            <li><a href="/portfolio/contact.php">Contact</a></li>
        </ul>

    </nav>
</header>

<main>

<section class="hero">

<div class="hero-text">

    <h1>Contact Me</h1>

    <?php
    if (!empty($success)) {
        echo "<p style='color:green; margin-bottom:20px;'>$success</p>";
    }
    ?>

    <form method="POST" onsubmit="return validateContactForm()">

        <input
            type="text"
            name="name"
            placeholder="Your Name"
            required
        >

        <input
            type="email"
            name="email"
            placeholder="Your Email"
            required
        >

        <textarea
            name="message"
            placeholder="Your Message"
            required
        ></textarea>

        <button type="submit" class="btn">
            Send Message
        </button>

    </form>

</div>

</section>

</main>

<footer>
    <p>&copy; 2026 My Portfolio</p>
</footer>

</body>
</html>