<?php
include 'header.php'; // Assuming you have a StudentModel class
session_start();
?>
<link rel="stylesheet" href="styles.css">
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/models/assignments.php';
include $_SERVER['DOCUMENT_ROOT'] . '/models/submissions.php';
$assignmentsModel = new Assignments();
$submissionsModel = new Submissions();
$user = $_SESSION['user'];
$assignments = $assignmentsModel->getAllAssignments();
$submissions = $submissionsModel->getSubmissionByStudentId($user['user_id']);
$notCompletedAssignments = $assignmentsModel->getNotCompletedAssignmentsByStudentId($user['user_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/storages/";
    $target_file = $target_dir . rand() . "-" . basename($_FILES["fileToUpload"]["name"]);
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

    $studentId = isset($_POST['student_id']) ? intval($_POST['student_id']) : 0;
    $assignmentId = isset($_POST['assignment_id']) ? intval($_POST['assignment_id']) : 0;
    $submissionsModel->createSubmission($assignmentId, $studentId, $target_file);
    header("Refresh:0");
}
?>

<div class="container">
    <div class="container">
        <form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="file">File:</label>
            <input type="file" name="fileToUpload" id="fileToUpload" required>

            <input type="hidden" name="student_id" id="student_id" value="<?php echo $user['user_id'] ?>">

            <label for="assignment_id">Assignment:</label>
            <select name="assignment_id" id="assignment_id" required>
                <?php foreach ($notCompletedAssignments as $notCompletedAssignment) : ?>
                    <option value="<?php echo $notCompletedAssignment['assignment_id']; ?>"><?php echo $notCompletedAssignment['assignment_id']; ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" value="Upload Assignment" name="submit" action="upload">
        </form>
    </div>
    <div class="container">
        <h2>List Submissions</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Submission ID</th>
                    <th>Assignment ID</th>
                    <th>File</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($submissions as $submission) : ?>
                    <tr>
                        <td><?php echo $submission['submission_id']; ?></td>
                        <td><?php echo $submission['assignment_id']; ?></td>
                        <td>
                            <?php if (file_exists($submission['file_path'])) : ?>
                                <a href="download.php?file=<?php echo urlencode($submission['file_path']) ?>" download>
                                    <button>Download File</button>
                                </a>
                            <?php else : ?>
                                File not available
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="container">
        <h2>List Assignments</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Assignment ID</th>
                    <th>Teacher ID</th>
                    <th>File</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($assignments as $assignment) : ?>
                    <tr>
                        <td><?php echo $assignment['assignment_id']; ?></td>
                        <td><?php echo $assignment['teacher_id']; ?></td>
                        <td>
                            <?php if (file_exists($assignment['file_path'])) : ?>
                                <a href="download.php?file=<?php echo urlencode($assignment['file_path']) ?>" download>
                                    <button>Download File</button>
                                </a>
                            <?php else : ?>
                                File not available
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<?php

include 'footer.php';
