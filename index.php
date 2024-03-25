<?php
require_once 'db.php';
require_once 'project.php';
require_once 'task.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

$database = new Database();
$db = $database->connect();

$project = new Project($db);
$task = new Task($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Management Tool</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Projects and Tasks</h1>
    <a href="index.php" class="button-link">Home</a>
    <a href="manage_projects.php" class="button-link">Projects</a>
    <a href="manage_tasks.php" class="button-link">Tasks</a>

    <div>
        <?php
        $result = $project->read();
        echo "<table><tr><th>Project Name</th><th>Tasks</th></tr>";
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>";
            $taskResult = $task->readByProject($row['id']);
            while ($taskRow = $taskResult->fetch(PDO::FETCH_ASSOC)) {
                echo $taskRow['name'] . " (Due: " . $taskRow['due_date'] . ")<br>";
            }
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
        ?>
    </div>
</body>
</html>