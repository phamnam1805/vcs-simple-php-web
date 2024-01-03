<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <?php
    include 'header.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/models/users.php';
    session_start();
    ob_start();

    $usersModel = new Users();

    // Initialize variables to store user input
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validate the username and password
        $user = $usersModel->checkLogin($username, $password);
        if ($user) {
            // Successful login
            if ($user['role'] == 0) {
                $_SESSION['user'] = $user;
                $_SESSION['role'] = 0;
                header('Location: views/student/index.php');
                echo '<div class="container">Login successful as student!</div>';
            } else {
                $_SESSION['user'] = $user;
                $_SESSION['role'] = 1;
                header('Location: views/teacher/index.php');
                echo '<div class="container">Login successful as teacher!</div>';
            }
        } else {
            // Failed login
            echo '<div class="container">Invalid username or password. Please try again.</div>';
        }
    }
    ?>

    <div class="container">
        <form action="" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Login">
        </form>
    </div>

    <?php include 'footer.php'; ?>

</body>

</html>