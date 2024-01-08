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
$email = isset($_POST['email']) ? $_POST['email'] : '';
$phonenumber = isset($_POST['phonenumber']) ? $_POST['phonenumber'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usersModel->updateUserForStudent($user['user_id'], $email, $phonenumber);
    $user = $usersModel->getUserById($user['user_id']);
    $_SESSION['user'] = $user;
}
?>

<div class="container">
    <h2>Edit Personal Information</h2>

    <form action="index.php" method="post">
        <label for="userId">User ID:</label>
        <input type="text" id="userId" name="userId" value="<?php echo $user['user_id']; ?>" disabled>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" disabled>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>" disabled>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>

        <label for="phonenumber">Phone Number:</label>
        <input type="tel" id="phonenumber" name="phonenumber" value="<?php echo $user['phonenumber']; ?>" required>

        <input type="submit" value="Save Changes">
    </form>
</div>

<?php include 'footer.php'; ?>