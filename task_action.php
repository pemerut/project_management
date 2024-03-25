<?php
require_once 'db.php';
require_once 'task.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

$database = new Database();
$db = $database->connect();

$task = new Task($db);

$action = $_POST['action'] ?? $_GET['action'];

switch ($action) {
    case 'add_task':
        $task->name = $_POST['task_name'];
        $task->due_date = $_POST['due_date'];
        $task->project_id = $_POST['project_id'];
        if ($task->create()) {
            header("Location: manage_tasks.php");
        } else {
            echo "Error adding task";
        }
        break;
    case 'delete_task':
        $task->id = $_GET['id'];
        if ($task->delete()) {
            header("Location: manage_tasks.php");
        } else {
            echo "Error deleting task";
        }
        break;
    case 'update_task':
        $task->id = $_POST['task_id'];
        $task->name = $_POST['task_name'];
        $task->due_date = $_POST['due_date'];
        $task->project_id = $_POST['project_id'];

        if ($task->update()) {
            header("Location: manage_tasks.php");
        } else {
            echo "Error updating task";
        }
        break;
}

?>