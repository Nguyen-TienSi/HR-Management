<?php
session_start();
include "db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password']) && isset($_POST['role'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);
    $role = $_POST['role'];

    if (empty($uname)) {
        header("Location: login.php?error=User Name is required");
        exit();
    } elseif (empty($pass)) {
        header("Location: login.php?error=Password is required");
        exit();
    } elseif (empty($role)) {
        header("Location: login.php?error=Your role is required");
        exit();
    } else {
        $sql = "SELECT * FROM accounts 
        WHERE user_name = '$uname' 
        AND password = '$pass' 
        AND role = '$role' 
        AND working = '1'";
        $result = $connection->query($sql);

        if ($result && $result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if ($row['user_name'] === $uname && $row['password'] === $pass) {
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['role'] = $row['role'];
                if ($role == "M") {
                    header("Location: index.php");
                    exit();
                } else {
                    header("Location: Mail/Employee/index.php");
                    exit();
                }
            } else {
                header("Location: login.php?error=Incorrect User name or Password");
                exit();
            }
        } else {
            header("Location: login.php?error=Incorrect User name or Password");
            exit();
        }
    }
} else {
    header("Location: login.php");
    exit();
}