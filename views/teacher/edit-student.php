<?php
include 'header.php';
session_start();
?>
<link rel="stylesheet" href="edit-student-styles.css">
<?php
// Edit message logic goes here
include $_SERVER['DOCUMENT_ROOT'] . '/models/users.php';
$usersModel = new Users();
$studentId = isset($_GET['student_id']) ? intval($_GET['student_id']) : 0;
$student = $usersModel->getUserById($studentId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $student_id = isset($_POST['student_id']) ? intval($_POST['student_id']) : 0;
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phonenumber = isset($_POST['phonenumber']) ? $_POST['phonenumber'] : '';

    $usersModel->updateUserForTeacher($student_id, $username, $email, $name, $phonenumber);
    header('Location: index.php');
}
?>

<div class="container">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="student_id" value="<?php echo isset($_GET['student_id']) ? intval($_GET['student_id']) : 0; ?>">


        <label for="userId">UserId:</label>
        <input type="text" name="user_id" id="user_id" value="<?php echo $student['user_id']; ?>" disabled>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $student['username']; ?>" required>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $student['name']; ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $student['email']; ?>" required>

        <label for="phonenumber">Phone Number:</label>
        <input type="tel" id="phonenumber" name="phonenumber" value="<?php echo $student['phonenumber']; ?>" required>

        <button type="submit" name="action" value="saveChanges">Save Changes</button>
    </form>
</div>

<?php include 'footer.php'; ?>