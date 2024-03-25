<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Projects</title>
</head>
<body>
    <h1>Manage Projects</h1>

    <a href="index.php" class="button-link">Home</a>
    <a href="manage_projects.php" class="button-link">Projects</a>
    <a href="manage_tasks.php" class="button-link">Tasks</a>

    <form action="project_actions.php" method="post">
        <input type="text" name="project_name" placeholder="Project Name" required>
        <button type="submit" name="action" value="add_project">Add Project</button>
    </form>
    <div>
    <h2>Existing Projects</h2>
    <?php
    $projectResult = $project->read();
    while ($row = $projectResult->fetch(PDO::FETCH_ASSOC)) {
        echo "<div>";
        echo "Project Name: " . $row['name'];
        echo " <a href='manage_projects.php?edit=" . $row['id'] . "'>Edit</a>";
        echo " | <a href='project_actions.php?action=delete_project&id=" . $row['id'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>";
        echo "</div>";
    }
    ?>

</div>
</body>
</html>