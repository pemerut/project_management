<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Tasks</title>
</head>
<body>
    <h1>Manage Tasks</h1>
    
    <a href="index.php" class="button-link">Home</a>
    <a href="manage_projects.php" class="button-link">Projects</a>
    <a href="manage_tasks.php" class="button-link">Tasks</a>

    <form action="task_actions.php" method="post">
        <input type="text" name="task_name" placeholder="Task Name" required>
        <input type="date" name="due_date" required>
        <select name="project_id" required>
            <option value="">Select Project</option>
            <?php
            $projectResult = $project->read();
            while ($projectRow = $projectResult->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $projectRow['id'] . "'>" . $projectRow['name'] . "</option>";
            }
            ?>
        </select>
        <button type="submit" name="action" value="add_task">Add Task</button>
    </form>
    <div>
    <h2>Existing Tasks</h2>
    <?php
    $taskResult = $task->read();
    while ($taskRow = $taskResult->fetch(PDO::FETCH_ASSOC)) {
        echo "<div>";
        echo "Task Name: " . $taskRow['name'] . " | Due Date: " . $taskRow['due_date'];
        echo " <a href='manage_tasks.php?edit=" . $taskRow['id'] . "'>Edit</a>";
        echo " | <a href='task_actions.php?action=delete_task&id=" . $taskRow['id'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>";
        echo "</div>";
    }
    ?>

</div>
</body>
</html>