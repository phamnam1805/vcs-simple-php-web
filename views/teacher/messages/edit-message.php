<?php
include 'header.php'; // Assuming you have a StudentModel class
session_start();
?>
<link rel="stylesheet" href="edit-message-styles.css">
<?php
// Edit message logic goes here
include $_SERVER['DOCUMENT_ROOT'] . '/models/messages.php';
$messagesModel = new Messages();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $messageId = isset($_POST['message_id']) ? intval($_POST['message_id']) : 0;
    $editedContent = isset($_POST['editedContent']) ? $_POST['editedContent'] : '';

    $messagesModel->updateMessage($messageId, $editedContent);
    header('Location: views/student/index.php');
}
?>

<div class="container">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="message_id" value="<?php echo isset($_GET['message_id']) ? intval($_GET['message_id']) : 0; ?>">
        <label for="editedContent">Edited Content:</label>
        <input type="text" name="editedContent" id="editedContent" required>
        <button type="submit" name="action" value="saveChanges">Save Changes</button>
    </form>
</div>

<?php include 'footer.php'; ?>