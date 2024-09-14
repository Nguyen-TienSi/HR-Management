<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        img {
            display: flex;
            margin: 0 auto;
            border-radius: 50%;
            width: 50px;
            height: 50px;
        }

        .radio {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        label {
            color: #000;
        }

        .password {
            display: flex;
            position: relative;
        }
        
        .pass-icon {
            position: absolute;
            top: 13px;
            right: 20px;
            width: 33px;
            height: 33px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <form action="authenticateLogin.php" method="post">
        <div class="avatar">
            <img src="images/default-avatar.png" alt="Default Avatar">
        </div>

        <?php
        if (isset($_GET['error'])) {
            echo '<p class="error">' . $_GET['error'] . '</p>';
        }
        ?>

        <input type="text" name="uname" placeholder="User Name">
        <div class="password">
            <input type="password" name="password" placeholder="Password">
            <img src="images/pass-hide.png" onclick="showPassword()" class="pass-icon" id="pass-icon">
        </div>
        <div class="radio">
            <input type="radio" name="role" id="radio1" value="M">
            <label for="radio1">Manager</label>
            <input type="radio" name="role" id="radio2" value="E">
            <label for="radio2">Employee</label>
        </div>

        <button type="submit">Login</button>
    </form>
    <script>
        var a = 0;
        function showPassword() {
            if (a == 1) {
                document.getElementsByName('password')[0].type = 'password';
                document.getElementById('pass-icon').src = 'images/pass-hide.png';
                a = 0;
            } else {
                document.getElementsByName('password')[0].type = 'text';
                document.getElementById('pass-icon').src = 'images/pass-show.png';
                a = 1;
            }
        }
    </script>
</body>

</html>