<?php

require_once 'db.php';

class Task {
    private $conn;
    private $table = 'tasks';
    public $id;
    public $name;
    public $due_date;
    public $project_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' (name, due_date, project_id) VALUES (:name, :due_date, :project_id)';
        
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->due_date = htmlspecialchars(strip_tags($this->due_date));
        $this->project_id = htmlspecialchars(strip_tags($this->project_id));

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':due_date', $this->due_date);
        $stmt->bindParam(':project_id', $this->project_id);

        if($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    public function readByProject($projectId) {
        $query = 'SELECT id, name, due_date FROM ' . $this->table . ' WHERE project_id = ? ORDER BY due_date ASC';
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $projectId);
        $stmt->execute();
        
        return $stmt;
    }

    public function update() {
        $query = 'UPDATE ' . $this->table . ' SET name = :name, due_date = :due_date WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->due_date = htmlspecialchars(strip_tags($this->due_date));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':due_date', $this->due_date);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    public function delete() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}
?>