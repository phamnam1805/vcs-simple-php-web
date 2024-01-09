<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/database.php";

class Assignments
{
    private $databaseConnection;
    private $databaseReference;

    public function __construct()
    {
        $this->databaseReference = new Database();
        $this->databaseConnection = $this->databaseReference->connect();
    }

    function getAllAssignments()
    {
        $sql = "SELECT *
                FROM assignments;";
        $result = $this->databaseConnection->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            $resultSet = array();
            while ($row = $result->fetch_assoc()) {
                $resultSet[] = $row;
            }
            return $resultSet;
        } else {
            return null;
        }
    }
    function createAssignment($teacherId, $filePath)
    {
        $sql = "INSERT INTO assignments (teacher_id, file_path)
					VALUES ('$teacherId', '$filePath')";
        $this->databaseConnection->query($sql);
    }

    function deleteAssignment($assignment_id){
        $sql = "DELETE FROM assignments WHERE assignment_id='$assignment_id'";
        $this->databaseConnection->query($sql);
    }
}
