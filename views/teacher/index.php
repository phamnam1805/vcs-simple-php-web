<?php
include 'header.php'; // Assuming you have a StudentModel class
session_start();
?>
<link rel="stylesheet" href="styles.css">
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/models/users.php';
$usersModel = new Users();
$user = $_SESSION['user'];
$users = $usersModel->getAllUsers();

// Function to display personal information
function seePersonalInformation()
{
    $personalInfo = $_SESSION['user']; // Replace with actual method
    echo '<div class="container">';
    echo '<h2>Personal Information</h2>';
    echo '<p>User ID: ' . $personalInfo['user_id'] . '</p>';
    echo '<p>Username: ' . $personalInfo['username'] . '</p>';
    echo '<p>Email: ' . $personalInfo['email'] . '</p>';
    echo '<p>Name: ' . $personalInfo['name'] . '</p>';
    echo '<p>Phone number: ' . $personalInfo['phonenumber'] . '</p>';
    echo '<button onclick="location.href=\'personal-information/index.php\';">Edit Personal Information</button>';
    echo '<button onclick="location.href=\'change-password/index.php\';">Change password</button>';
    echo '</div>';
}

// Function to display a list of other users
function seeListOfOtherUsers($usersModel)
{
    $otherUsers = $usersModel->getAllUsers(); // Replace with actual method
    echo '<div class="container">';
    echo '<h2>List of Other Users</h2>';
    echo '<ul>';
    foreach ($otherUsers as $user) {
        echo '<li>' . $user['name'] . ' - ' . $user['user_id'] . '</li>';
    }
    echo '</ul>';
    echo '</div>';
}

// Check if a specific action is requested
$action = isset($_GET['action']) ? $_GET['action'] : '';

?>

<div class="container">
    <h2>Welcome, <?php echo $user['name']; ?>!</h2>

    <div class="container">
        <button onclick="location.href='messages/index.php'">Messages</button>
        <button onclick="location.href='assignments/index.php'">Assignments</button>
    </div>

    <div class="container">
        <h2>Personal Information</h2>
        <p>User ID: <?php echo $user['user_id'] ?> </p>
        <p>Username: <?php echo $user['username'] ?>192.168.88.128 </p>
        <p>Email: <?php echo $user['email'] ?> </p>
        <p>Name: <?php echo $user['name'] ?> </p>
        <p>Phonenumber: <?php echo $user['phonenumber'] ?> </p>
        <button onclick="location.href='personal-information/index.php';">Edit Personal Information</button>
        <button onclick="location.href='change-password/index.php';">Change Password</button>
    </div>

    <div class="container">
        <h2>List users</h2>
        <button onclick="location.href='add-student.php';">Add Student</button>
        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?php echo $user['user_id']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['name']; ?></td>
                        <td><?php echo $user['phonenumber']; ?></td>
                        <td><?php echo ($user['role'] == 0) ? 'Student' : 'Teacher'; ?></td>
                        <td>
                            <?php if ($user['role'] == 0) : ?>
                                <button type="button" onclick="redirectToEditStudentPage(<?php echo $user['user_id']; ?>)">Edit</button>
                                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    <input type="hidden" name="message_id" value="<?php echo $user['user_id']; ?>">
                                    <button type="submit" name="action" value="delete">Delete</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    function redirectToEditStudentPage(studentId) {
        window.location.href = 'edit-student.php?student_id=' + studentId;
    }

    function redirectToAddPage(userId) {
        window.location.href = 'add-message.php?sender_id=' + userId;
    }
</script>

<?php

include 'footer.php';
