<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHANGE PASSWORD</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        img {
            display: block;
            margin: 0 auto;
            border-radius: 50%;
            width: 50px;
            height: 50px;
        }
    </style>
</head>

<body>
    <form action="authenticateChangePassword.php" method="post">
        <div class="avatar">
            <img src="images/default-avatar.png">
        </div>

        <?php
        if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        
        <input type="password" name="oldPassword" placeholder="Old password">

        <input type="password" name="newPassword" placeholder="New password">

        <input type="password" name="confirmPassword" placeholder="Confirm new password">

        <button type="submit">Submit</button>
    </form>
</body>

</html>