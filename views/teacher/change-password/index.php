<?php
include 'header.php'; // Assuming you have a StudentModel class
session_start();
?>
<link rel="stylesheet" href="styles.css">
<?php
$user = $_SESSION['user'];

include $_SERVER['DOCUMENT_ROOT'] . '/models/users.php';

$usersModel = new Users();

// Initialize variables to store user input
$oldPassword = isset($_POST['oldPassword']) ? $_POST['oldPassword'] : '';
$newPassword1 = isset($_POST['newPassword1']) ? $_POST['newPassword1'] : '';
$newPassword2 = isset($_POST['newPassword2']) ? $_POST['newPassword2'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($user['password'] === $oldPassword) {
        // Check if new password and confirm new password match
        if ($newPassword1 === $newPassword2) {
            // Update the user's password (You should use a secure method for password hashing)
            $usersModel->updatePassword($user['user_id'], $newPassword1);
            $user['password'] = $newPassword1;
            $_SESSION['user'] = $user;
            $successMessage = 'Password changed successfully!';
        } else {
            $errorMessage = 'New password and confirm new password do not match.';
        }
    } else {
        $errorMessage = 'Incorrect old password. Please try again.';
    }
}
?>

<div class="container">
    <h2>Change Password</h2>

    <form action="index.php" method="post">
        <label for="oldPassword">Old password:</label>
        <input type="password" id="oldPassword" name="oldPassword" required>

        <label for="newPassword1">New password:</label>
        <input type="password" id="newPassword1" name="newPassword1" required>

        <label for="newPassword2">Confirm new password:</label>
        <input type="password" id="newPassword2" name="newPassword2" required>

        <?php if (isset($successMessage)) : ?>
            <p style="color: green;"><?php echo $successMessage; ?></p>
        <?php endif; ?>

        <?php if (isset($errorMessage)) : ?>
            <p style="color: red;"><?php echo $errorMessage; ?></p>
        <?php endif; ?>

        <input type="submit" value="Save changes">
    </form>
</div>

<?php include 'footer.php'; ?>