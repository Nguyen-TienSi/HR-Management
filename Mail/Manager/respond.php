<?php
include "../../db_conn.php";

$id = "";
$from = "";
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
        header("location: /hr_management/Mail/Manager/index.php");
        exit;
    }

    $from = $row['fr'];
    $subject = $row['subject'];
    $content = $row['content'];
    $response = $row['response'];
    $response_date = $row['response_date'];
} else {
    $id = $_POST['id'];
    $response = $_POST['respond'];

    do {
        if (!empty($response)) {
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $date = date("Y-m-d h:i:s");

            $sql = "UPDATE mails 
            SET response_status = 'Y', response_date = '$date', response = '$response'
            WHERE id='$id'";
            $result = $connection->query($sql);

            header("location: /hr_management/Mail/Manager/index.php");
            exit;
        }
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
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <label>From:</label>
        <?php echo $from; ?><br>
        <label>Subject:</label>
            <div class="subject"><?php echo $subject; ?></div>
        <br>
        <label>Content:</label>
            <div class="content"><?php echo $content; ?></div>
        <br>

        <label>Response:</label>
        <?php
        if (empty($response)) {
            echo "<br>";
            echo "<textarea rows='5' cols='50' name='respond'></textarea><br>";
            echo "<button type='submit'>Send</button>";
        } else {
            echo "<div class='response'>";
            echo $response;
            echo "<br>";
            echo "<label>Response date: {$response_date}</label>";
            echo "</div>";
        }
        ?>
    </form>
</body>

</html>