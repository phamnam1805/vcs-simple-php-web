<?php
include 'header.php'; // Assuming you have a StudentModel class
session_start();
?>
<link rel="stylesheet" href="add-message-styles.css">
<?php
// Edit message logic goes here
include $_SERVER['DOCUMENT_ROOT'] . '/models/users.php';
include $_SERVER['DOCUMENT_ROOT'] . '/models/messages.php';
$senderId = isset($_GET['sender_id']) ? intval($_GET['sender_id']) : 0;
$usersModel = new Users();
$messagesModel = new Messages();
$users = $usersModel->getAllUsers();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission here

    $receiverId = isset($_POST['receiver_id']) ? intval($_POST['receiver_id']) : 0;
    $content = isset($_POST['content']) ? $_POST['content'] : '';

    $messagesModel->createMessage(isset($_POST['sender_id']) ? intval($_POST['sender_id']) : 0, $receiverId, $content);
    // Redirect to the message list page or another page
    header('Location: index.php');
}
?>

<div class="container">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="sender_id" value="<?php echo $senderId ?>">

        <label for="content">Content:</label>
        <input type="text" name="content" id="content" required>

        <label for="receiver_id">Receiver:</label>
        <select name="receiver_id" id="receiver_id" required>
            <?php foreach ($users as $user) : ?>
                <?php if ($user['user_id'] != $senderId) : ?>
                    <option value="<?php echo $user['user_id']; ?>"><?php echo $user['user_id']; ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>

        <button type="submit">Add Message</button>
    </form>
</div>

<?php include 'footer.php'; ?>