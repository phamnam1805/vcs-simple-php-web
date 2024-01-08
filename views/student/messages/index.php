<?php
include 'header.php'; // Assuming you have a StudentModel class
session_start();
?>
<link rel="stylesheet" href="styles.css">
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/models/messages.php';
$messagesModel = new Messages();
$user = $_SESSION['user'];
$messages = $messagesModel->getMessages($user['user_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $messageId = isset($_POST['message_id']) ? intval($_POST['message_id']) : 0;

    if ($_POST['action'] === 'delete') {
        $messagesModel->deleteMessage($messageId);
    }
}

?>

<div class="container">
    <div class="container">
        <button type="button" onclick="redirectToAddPage(<?php echo $user['user_id']; ?>)">Add message</button>
        <h2>List messages</h2>
        <table>
            <thead>
                <tr>
                    <th>Sender ID</th>
                    <th>Receiver ID</th>
                    <th>Content</th>
                    <th>Timestamp</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($messages as $message) : ?>
                    <tr>
                        <td><?php echo $message['sender_id']; ?></td>
                        <td><?php echo $message['receiver_id']; ?></td>
                        <td><?php echo $message['content']; ?></td>
                        <td><?php echo $message['timestamp']; ?></td>
                        <td>
                            <?php if ($user['user_id'] == $message['sender_id']) : ?>
                                <button type="button" onclick="redirectToEditPage(<?php echo $message['message_id']; ?>)">Edit</button>
                                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    <input type="hidden" name="message_id" value="<?php echo $message['message_id']; ?>">
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
    function redirectToEditPage(messageId) {
        window.location.href = 'edit-message.php?message_id=' + messageId;
    }

    function redirectToAddPage(userId) {
        window.location.href = 'add-message.php?sender_id=' + userId;
    }
</script>

<?php include 'footer.php'; ?>