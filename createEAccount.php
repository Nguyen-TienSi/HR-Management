<?php
include "db_conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['user_name'];
    $password = $_POST['password'];

    do {
        if (empty($email)) {
            header("Location: createEAccount.php?error=email is required");
            exit;
        } elseif (empty($password)) {
            header("Location: createEAccount.php?error=password is required");
            exit;
        } else {
            $sql = "INSERT INTO accounts (user_name, password, role)
                    VALUES ($email, $password, 'E')";
            $result = $connection->query($sql);

            if (!$result) {
                die("Invalid query " . $connection->error);
                break;
            }

            header("Location: index.php");
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
</head>

<body>
    <form action="" method="post">
        <?php
        if (isset($_GET['error'])) {
            echo '<p class="error">' . $_GET['error'] . '</p>';
        }
        ?>
        <label>Email: </label>
        <input type="text" name="user_name" /><br>
        <label>Password: </label>
        <input type="password" name="password" /><br>

        <input type="submit" />
    </form>
</body>

</html>