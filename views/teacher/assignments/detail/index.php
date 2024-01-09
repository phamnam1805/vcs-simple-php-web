<?php
include 'header.php'; // Assuming you have a StudentModel class
session_start();
?>
<link rel="stylesheet" href="styles.css">
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/models/submissions.php';
include $_SERVER['DOCUMENT_ROOT'] . '/models/assignments.php';
$submissionsModel = new Submissions();
$assignmentsModel = new Assignments();

$assignmentId = isset($_GET['assignment_id']) ? intval($_GET['assignment_id']) : 0;
$submissions = $submissionsModel->getSubmissionsByAssignmentId($assignmentId);
?>

<div class="container">
    <h2>List Submissions For Assignment <?php echo $assignmentId; ?></h2>
    <table border="1">
        <thead>
            <tr>
                <th>Submission ID</th>
                <th>Student ID</th>
                <th>File</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($submissions as $submission) : ?>
                <tr>
                    <td><?php echo $submission['submission_id']; ?></td>
                    <td><?php echo $submission['student_id']; ?></td>
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

<?php

include 'footer.php';
