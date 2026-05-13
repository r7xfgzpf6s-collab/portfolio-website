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

$id = $_GET['id'];

$query = "SELECT * FROM projects WHERE id = $id";
$result = mysqli_query($conn, $query);

$project = mysqli_fetch_assoc($result);

$message = "";

if (isset($_POST['update_project'])) {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    $update_query = "UPDATE projects 
                     SET title='$title',
                         description='$description',
                         image='$image'
                     WHERE id=$id";

    if (mysqli_query($conn, $update_query)) {
        $message = "Project updated successfully!";
    } else {
        $message = "Error updating project.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project</title>
    <link rel="stylesheet" href="/portfolio/css/style.css">
</head>
<body>

<header>
    <nav>
        <h2 class="logo">Edit Project</h2>

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

            <h1>Edit Project</h1>

            <?php
            if ($message != "") {
                echo "<p style='color:green; margin-bottom:20px;'>$message</p>";
            }
            ?>

            <form method="POST">

                <input type="text"
                       name="title"
                       value="<?php echo $project['title']; ?>"
                       required>

                <textarea name="description" required><?php echo $project['description']; ?></textarea>

                <input type="text"
                       name="image"
                       value="<?php echo $project['image']; ?>"
                       required>

                <button type="submit"
                        name="update_project"
                        class="btn">
                    Update Project
                </button>

            </form>

        </div>
    </section>
</main>

</body>
</html>