<?php
session_start();
include "../../db_conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $from = $_SESSION['user_name'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];

    do {
        $sql = "INSERT INTO mails (fr, subject, content)" .
                "VALUES ('$from', '$subject', '$content')";
        $result = $connection->query($sql);

        if (!$result) {
            die("Invalid query: " . $connection->error);
            break;
        }

        header("location: /hr_management/mail/employee/index.php");
        exit;
    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <form action="" method="post">
        <label>Subject: </label>
        <textarea rows="5" cols="50" name="subject"></textarea><br>
        <label>Content: </label>
        <textarea rows="5" cols="50" name="content"></textarea><br>

        <button type="submit">Send</button>
    </form>
</body>

</html>