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
$status = "";

$row = "";

$errorMessage = "";
// $successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("location: /hr_management/index.php");
        exit;
    }

    $id = $_GET["id"];

    // read the row of the selected employee from database table
    $sql = "SELECT * FROM employees WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /hr_management/index.php");
        exit;
    }

    $name = $row["name"];
    $gender = $row["gender"];
    $email = $row["email"];
    $phone = $row["phone"];
    $address = $row["address"];
    $department = $row["department"];
    $position = $row["position"];
    $status = $row["working"];
} else {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $department = $_POST["department"];
    $position = $_POST["position"];
    $status = $_POST["status"];

    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/' . $image;

    do {
        if (empty($name) || empty($gender) || empty($email) || empty($phone)
            || empty($department) || empty($position)) {
            $errorMessage = "All the fields are required";
            break;
        }

        if (!empty($image)) {
            if ($image_size > 2000000) {
                $errorMessage = "Image is too large";
                break;
            }
            $sql = "UPDATE employees " .
            "SET image = '$image' " .
            "WHERE id = '$id'";
            $result = $connection->query($sql);

            if (!$result) {
                $errorMessage = "Invalid query: " . $connection->error;
                break;
            }
            move_uploaded_file($image_tmp_name, $image_folder);
        }

        $sql = "UPDATE employees " .
        "JOIN accounts ON employees.email = accounts.user_name " .
        "SET employees.name = '$name', employees.gender = '$gender', employees.email = '$email', employees.phone = '$phone', 
            employees.address = '$address', employees.department = '$department', employees.position = '$position', 
            employees.working = '$status', accounts.user_name = '$email', accounts.working = '$status' " .
        "WHERE employees.id = '$id'";

        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        // $successMessage = "Employee updated correctly";

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

                reader.onload = function (e) {
                    document.getElementById('previewImage').setAttribute('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</head>

<body>
    <div class="container my-5">
        <h2>Employee's Information</h2>

        <?php
        if ($row['image'] == '') {
            echo '<img src="images/default-avatar.png" id="previewImage">';
        } else {
            echo '<img src="uploaded_img/' . $row['image'] . '" id="previewImage">';
        }

        $date = $row['start_working_date_at'] != '' ? $row['start_working_date_at'] : date("Y-m-d h:i:s");

        include "input_form.php";
        ?>
    </div>
</body>

</html>