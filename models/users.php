<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/database.php";
class Users
{
    private $databaseConnection;
    private $databaseReference;

    public function __construct()
    {
        $this->databaseReference = new Database();
        $this->databaseConnection = $this->databaseReference->connect();
    }

    public function getAllUsers()
    {
        $sql = "SELECT user_id, username, email, name, phonenumber, role 
                FROM users 
                WHERE is_deleted = 0";
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

    public function getUserById($userId)
    {
        $sql = "SELECT user_id, username, email, name, phonenumber, role
                FROM users 
                WHERE is_deleted = 0 AND user_id = '$userId'";
        $result = $this->databaseConnection->query($sql);
        if ($result->num_rows == 1) {
            $resultSet = array();
            while ($row = $result->fetch_assoc()) {
                $resultSet[] = $row;
            }
            return $resultSet[0];
        }
        return null;
    }

    public function createUser($username, $password, $name, $email, $phonenumber, $avatar, $role)
    {
        $sql = "INSERT INTO users (username, password, email, name, phonenumber, avatar, role)
					VALUES ('$username', '$password', '$email', '$name',  '$phonenumber', '$avatar', '$role')";
        $this->databaseConnection->query($sql);
    }

    public function deleteUser($userId)
    {
        $sql = "UPDATE users SET is_deleted = 1 WHERE user_id = '$userId'";
        $result = $this->databaseConnection->query($sql);
        return $result;
    }

    public function updateUserForTeacher($userId, $username, $email, $name, $phonenumber)
    {
        $sql = "UPDATE users 
			SET username = '$username', 
				email = '$email', 
				name = '$name', 
				phonenumber = '$phonenumber'
			WHERE user_id = '$userId'";
        $result = $this->databaseConnection->query($sql);
        return $result;
    }

    public function updateUserForStudent($userId, $email, $phonenumber)
    {

        $sql = "UPDATE users 
			SET email = '$email', 
				phonenumber = '$phonenumber'
			WHERE user_id = '$userId'";
        $this->databaseConnection->query($sql);
    }
    public function updatePassword($userId, $password)
    {
        $sql = "UPDATE users 
			SET password = '$password'
			WHERE user_id = '$userId'";
        $this->databaseConnection->query($sql);
    }

    public function checkLogin($username, $password)
    {
        $sql = "SELECT * FROM users WHERE username = '$username' and password = '$password'";
        $result = $this->databaseConnection->query($sql);
        if ($result->num_rows == 1) {
            $resultSet = array();
            while ($row = $result->fetch_assoc()) {
                $resultSet[] = $row;
            }
            return $resultSet[0];
        }
        return null;
    }
}
