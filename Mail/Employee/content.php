<?php
include "../../db_conn.php";

$subject = "";
$content = "";
$response = "";
$response_date = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET["id"];

    $sql = "SELECT * FROM mails WHERE id='$id'";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /hr_management/Mail/Employee/index.php");
        exit;
    }

    $subject = $row['subject'];
    $content = $row['content'];
    $response = $row['response'];
    $response_date = $row['response_date'];
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
    <label>Subject:</label>
            <div class="subject"><?php echo $subject; ?></div>
        <br>
        <label>Content:</label>
            <div class="content"><?php echo $content; ?></div>
        <br>

        <?php
        if (!empty($response)) {
            echo "<label>Response:</label>";
            echo "<div class='response'>";
            echo $response;
            echo "<br>";
            echo "<label>Respond date: {$response_date}</label>";
            echo "</div>";
        }
        ?>
    </form>
</body>

</html>