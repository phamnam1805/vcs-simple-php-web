<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/database.php";

class Submissions
{
    private $databaseConnection;
    private $databaseReference;

    public function __construct()
    {
        $this->databaseReference = new Database();
        $this->databaseConnection = $this->databaseReference->connect();
    }

    function getSubmissionByStudentId($studentId)
    {
        $sql = "SELECT * FROM submissions WHERE student_id='$studentId'";
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

    function createSubmission($assignmentId, $studentId, $filePath)
    {
        $sql = "INSERT INTO submissions (assignment_id, student_id, file_path)
					VALUES ('$assignmentId', '$studentId' , '$filePath')";
        $this->databaseConnection->query($sql);
    }

    function getSubmissionsByAssignmentId($assignmentId)
    {
        $sql = "SELECT * FROM submissions WHERE assignment_id='$assignmentId'";
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
}
