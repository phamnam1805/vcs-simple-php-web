<?php
include $_SERVER['DOCUMENT_ROOT'] . "/database.php";

class Messages
{
    private $databaseConnection;
    private $databaseReference;

    public function __construct()
    {
        $this->databaseReference = new Database();
        $this->databaseConnection = $this->databaseReference->connect();
    }

    public function getMessages($senderId)
    {
        $sql = "SELECT * FROM messages WHERE send_id = '$senderId'";
        $result = $this->databaseConnection->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            $resultSet = array();
            while ($row = $result->fetch_assoc()) {
                $resultSet[] = $row;
            }
            return $resultSet;
        } else {
            return null;
        }
    }

    public function createMessage($senderId, $receiverId, $content)
    {
        $sql = "INSERT INTO messages (sender_id, receiver_id, content)
					VALUES ('$senderId', '$receiverId', '$content')";
        $result = $this->databaseConnection->query($sql);
        return $result;
    }

    public function updateMessage($messageId, $content)
    {
        $sql = "UPDATE messages
				SET content = '$content'
				WHERE message_id = '$messageId'";
        $result = $this->databaseConnection->query($sql);
        return $result;
    }

    public function deleteMessage($messageId)
    {
        $sql = "DELETE FROM message WHERE message_id = $messageId";
        $result = $this->databaseConnection->query($sql);
        return $result;
    }
}
