<?php
include 'header.php'; // Assuming you have a StudentModel class
session_start();
?>
<link rel="stylesheet" href="add-student-styles.css">
<?php
// Edit message logic goes here
include $_SERVER['DOCUMENT_ROOT'] . '/models/users.php';

$usersModel = new Users();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission here

    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phonenumber = isset($_POST['phonenumber']) ? trim($_POST['phonenumber']) : '';
    if (empty($username) || empty($password) || empty($name) || empty($email) || empty($phonenumber)) {
        echo '<div class="container">Invalid input</div>';
    } else {
        $usersModel->createUser($username, $password, $name, $email, $phonenumber, '', 0);
        header('Location: index.php');
    }
}
?>

<div class="container">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>

        <label for="password">Password:</label>
        <input type="text" name="password" id="password" required>

        <label for="email">Email:</label>
        <input type="text" name="email" id="email" required>

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="phonenumber">Phonenumber:</label>
        <input type="tel" name="phonenumber" id="phonenumber" required>


        <button type="submit">Add Student</button>
    </form>
</div>

<?php include 'footer.php'; ?>