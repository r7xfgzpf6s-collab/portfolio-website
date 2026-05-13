<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "portfolio_db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM projects ORDER BY id DESC";
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
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/portfolio/css/style.css">
</head>
<body>

<header>
    <nav>
        <h2 class="logo">Admin Dashboard</h2>

        <ul>
            <li><a href="/portfolio/index.php">View Website</a></li>
            <li><a href="add_project.php">Add Project</a></li>
            <li><a href="messages.php">Messages</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<main>
    <section class="hero">
        <div class="hero-text">

            <h1>Welcome, <?php echo $_SESSION['admin']; ?></h1>

            <p>You are logged in successfully.</p>

            <a href="add_project.php" class="btn">Add New Project</a>

            <div class="projects-container">

                <?php while ($project = mysqli_fetch_assoc($result)) { ?>

                    <div class="project-card">

                        <img src="../images/<?php echo $project['image']; ?>" alt="Project Image">

                        <h3><?php echo $project['title']; ?></h3>

                        <p><?php echo $project['description']; ?></p>

                        <div style="margin-top:15px;">
                            <a href="edit_project.php?id=<?php echo $project['id']; ?>" class="btn">
                                Edit
                            </a>

                            <a href="delete_project.php?id=<?php echo $project['id']; ?>"
                               class="btn"
                               style="background:red;"
                               onclick="return confirm('Are you sure you want to delete this project?');">
                                Delete
                            </a>
                        </div>

                    </div>

                <?php } ?>

            </div>

        </div>
    </section>
</main>

</body>
</html>