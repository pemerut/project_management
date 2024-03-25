<?php
require_once 'db.php';
require_once 'project.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

$database = new Database();
$db = $database->connect();

$project = new Project($db);

$action = $_POST['action'] ?? $_GET['action'];

switch ($action) {
    case 'add_project':
        $project->name = $_POST['project_name'];
        if ($project->create()) {
            header("Location: manage_projects.php");
        } else {
            echo "Error adding project";
        }
        break;
    case 'delete_project':
        $project->id = $_GET['id'];
        if ($project->delete()) {
            header("Location: manage_projects.php");
        } else {
            echo "Error deleting project";
        }
        break;
    case 'update_project':
        $project->id = $_POST['project_id'];
        $project->name = $_POST['project_name'];

        if ($project->update()) {
            header("Location: manage_projects.php");
        } else {
            echo "Error updating project";
        }
        break;
}

?>