<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = mysqli_connect("localhost", "root", "", "portfolio_db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM projects";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
    <link rel="stylesheet" href="/portfolio/css/style.css">
</head>
<body>

<header>
    <nav>
        <h2 class="logo">My Portfolio</h2>

        <ul>
            <li>
             <button onclick="toggleDarkMode()" class="dark-btn">
               Dark Mode
             </button> 
            </li>
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
            <h1>My Projects</h1>

            <div class="projects-container">

                <?php while ($project = mysqli_fetch_assoc($result)) { ?>

                    <div class="project-card">
                        <h3><?php echo $project['title']; ?></h3>
                        <img src="images/<?php echo $project['image']; ?>" alt="">

                        <p><?php echo $project['description']; ?></p>
                    </div>

                <?php } ?>

            </div>
        </div>
    </section>
</main>

<footer>
    <p>&copy; 2026 My Portfolio</p>
</footer>

<script src="/portfolio/js/script.js"></script>

</body>
</html>