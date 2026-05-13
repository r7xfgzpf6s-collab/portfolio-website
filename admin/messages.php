<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "portfolio_db");

$query = "SELECT * FROM contacts ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Messages</title>
    <link rel="stylesheet" href="/portfolio/css/style.css">
</head>
<body>

<header>
    <nav>
        <h2 class="logo">Messages</h2>

        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="add_project.php">Add Project</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<main>
<section class="hero">
<div class="hero-text">

<h1>Contact Messages</h1>

<div class="projects-container">

<?php while ($msg = mysqli_fetch_assoc($result)) { ?>

    <div class="project-card">
        <h3><?php echo $msg['name']; ?></h3>
        <p><strong>Email:</strong> <?php echo $msg['email']; ?></p>
        <p><?php echo $msg['message']; ?></p>
    </div>

<?php } ?>

</div>

</div>
</section>
</main>

</body>
</html>