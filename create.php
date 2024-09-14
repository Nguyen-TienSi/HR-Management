<?php
include "db_conn.php";

$id = "";
$name = "";
$gender = "";
$email = "";
$phone = "";
$address = "";
$department = "";
$position = "";
$status = "1";

$errorMessage = "";
// $successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $gender = isset($_POST["gender"]) ? $_POST["gender"] : "";
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $department = $_POST["department"];
    $position = $_POST["position"];

    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/' . $image;

    do {
        if (
            empty($name) || empty($gender) || empty($email) || empty($phone)
            || empty($department) || empty($position)
        ) {
            $errorMessage = "All the fields are required";
            break;
        }

        // Check if email already exists
        $emailQuery = "SELECT * FROM employees WHERE email = '$email'";
        $emailQueryResult = $connection->query($emailQuery);
        if ($emailQueryResult->num_rows > 0) {
            $errorMessage = "Email already exists";
            break;
        }

        // Check if phone already exists
        $phoneQuery = "SELECT * FROM employees WHERE phone = '$phone'";
        $phoneQueryResult = $connection->query($phoneQuery);
        if ($phoneQueryResult->num_rows > 0) {
            $errorMessage = "Phone already exists";
            break;
        }

        if (!empty($image)) {
            if ($image_size > 2000000) {
                $errorMessage = "Image is too large";
                break;
            }
            move_uploaded_file($image_tmp_name, $image_folder);
        }

        //add new employee to database
        $sql = "INSERT INTO employees (name, gender, email, phone, address, 
        department, position, working, image)" .
            "VALUES ('$name', '$gender', '$email', '$phone', '$address', 
                '$department', '$position', '$status', '$image')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        // $name = "";
        // $email = "";
        // $phone = "";
        // $address = "";

        // $successMessage = "Employee added correctly";

        header("location: /hr_management/index.php");
        exit;
    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* This style sets the width of all images to 100%: */
        img {
            display: block;
            margin: 0 auto;
            border-radius: 50%;
            /* width: 100%; */
            height: 128px;
            width: 128px;
            margin-bottom: 40px;
        }
    </style>
    <script>
        function displayImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById('previewImage').setAttribute('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</head>

<body>
    <div class="container my-5">
        <h2>New Employee</h2>

        <img src="images/default-avatar.png" id="previewImage">

        <?php
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $date = date("Y-m-d h:i:s");

        include "input_form.php";
        ?>
    </div>
</body>

</html>