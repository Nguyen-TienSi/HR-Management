<?php
session_start();
include "db_conn.php";

if (isset($_POST['oldPassword']) && isset($_POST['newPassword']) && isset($_POST['confirmPassword'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    $oldPass = validate($_POST['oldPassword']);
    $newPass = validate($_POST['newPassword']);
    $confPass = validate($_POST['confirmPassword']);
    $userName = $_SESSION['user_name'];
    $role = $_SESSION['role'];

    if (empty($oldPass)) {
        header("Location: changePassword.php?error=Old password is required");
        exit();
    } elseif (empty($newPass)) {
        header("Location: changePassword.php?error=New password is required");
        exit();
    } elseif (empty($confPass)) {
        header("Location: changePassword.php?error=Confirm password is required");
        exit();
    } elseif ($newPass != $confPass) {
        header("Location: changePassword.php?error=Confirm password is not correct");
        exit();
    } else {
        $sql = "SELECT * FROM accounts 
        WHERE user_name = '$userName' AND role = '$role'";

        $result = $connection->query($sql);

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if ($row['password'] === $oldPass) {
                $sql = "UPDATE accounts 
                SET password = '$newPass'
                WHERE user_name = '$userName' AND role = '$role'";
                $result = $connection->query($sql);

                if (!$result) {
                    header("Location: changePassword.php?error=" . urlencode($connection->connect_error));
                    exit;
                }

                if ($role == 'M') {
                    header("Location: index.php");
                    exit();
                } else {
                    header("Location: mail/employee/index.php");
                    exit();
                }
            } else {
                header("Location: changePassword.php?error=Old password is not correct");
                exit();
            }
        }
    }
} else {
    header("Location: changePassword.php");
    exit();
}
