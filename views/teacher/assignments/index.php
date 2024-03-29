<?php
include 'header.php'; // Assuming you have a StudentModel class
session_start();
?>
<link rel="stylesheet" href="styles.css">
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/models/users.php';
include $_SERVER['DOCUMENT_ROOT'] . '/models/assignments.php';
$usersModel = new Users();
$assignmentsModel = new Assignments();
$user = $_SESSION['user'];
$assignments = $assignmentsModel->getAllAssignments();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/storages/";
    $target_file = $target_dir . rand() . "-" . basename($_FILES["fileToUpload"]["name"]);
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
    $assignmentsModel->createAssignment($user['user_id'], $target_file);

    header("Refresh:0");
}

?>

<div class="container">
    <div class="container">
        <form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            Select file to upload:
            <input type="file" name="fileToUpload" id="fileToUpload" required>
            <input type="submit" value="Upload Assignment" name="submit" action="upload">
        </form>
    </div>
    <div class="container">
        <h2>List Assignments</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Assignment ID</th>
                    <th>Teacher ID</th>
                    <th>File</th>
                    <th>Action</th>
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
                        <td>
                            <button type="button" onclick="redirectToDetailPage(<?php echo $assignment['assignment_id']; ?>)">Detail</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function redirectToDetailPage(assignmentId) {
        window.location.href = 'detail/index.php?assignment_id=' + assignmentId;
    }
</script>

<?php

include 'footer.php';
