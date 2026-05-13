<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "portfolio_db");

$message = "";

if (isset($_POST['add_project'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    $sql = "INSERT INTO projects (title, description, image)
            VALUES ('$title', '$description', '$image')";

    if (mysqli_query($conn, $sql)) {
        $message = "Project added successfully!";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Project</title>
    <link rel="stylesheet" href="/portfolio/css/style.css">
</head>
<body>

<header>
    <nav>
        <h2 class="logo">Add Project</h2>

        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="/portfolio/projects.php">View Projects</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<main>
    <section class="hero">
        <div class="hero-text">
            <h1>Add New Project</h1>

            <?php
            if ($message != "") {
                echo "<p style='color:green; margin-bottom:20px;'>$message</p>";
            }
            ?>

            <form method="POST">
                <input type="text" name="title" placeholder="Project Title" required>

                <textarea name="description" placeholder="Project Description" required></textarea>

                <input type="text" name="image" placeholder="Image name e.g. project1.jpg">

                <button type="submit" name="add_project" class="btn">
                    Add Project
                </button>
            </form>
        </div>
    </section>
</main>

</body>
</html>