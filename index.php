<?php
session_start();

if (isset($_SESSION['user_name'])) {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    </head>

    <body>
        <div class="container my-5">
            <a type="button" href="logout.php">
                <button>Logout</button>
            </a>
            <a href="changePassword.php">
                <button>Change password</button>
            </a>
            <h2>Employee List</h2>
            <a class="btn btn-primary" href="/hr_management/create.php" role="button">New Employee</a>
            <a href="Mail/Manager/index.php">
                <i class="material-icons">email</i>
            </a>
            <br><br>
            <input type="text" name="search" id="search" onkeyup="searchFunction()" placeholder="Search">
            <!-- <input type="text" name="search" id="search" placeholder="Search"> -->
            <div class="table-responsive">
                <table class="table" id="employeeTable">
                    <thead>
                        <tr>
                            <th class="tblColText">Name</th>
                            <th class="tblColText">Gender</th>
                            <th class="tblColText">Email</th>
                            <th class="tblColText">Phone</th>
                            <th class="tblColText">Department</th>
                            <th class="tblColText">Position</th>
                            <th class="tblColText">Working Status</th>
                            <th class="tblColText">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "db_conn.php";

                        // read all rows from the database table
                        $sql = "SELECT * FROM employees " .
                            "ORDER BY name ASC";
                        $result = $connection->query($sql);

                        if (!$result) {
                            die("Invalid query: " . $connection->connect_error);
                        }

                        // read data from each row
                        while ($row = $result->fetch_assoc()) {
                            echo "
                        <tr>
                            <td>$row[name]</td>
                            <td>$row[gender]</td>
                            <td>$row[email]</td>
                            <td>$row[phone]</td>
                            <td>$row[department]</td>
                            <td>$row[position]</td>
                            <td>$row[working]</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='/hr_management/edit.php?id=$row[id]'>More details</a>
                            </td>
                        </tr>
                        ";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script src="script.js"></script>
    </body>

    </html>

<?php
} else {
    header("Location: authenticateLogin.php");
    exit;
}
?>

<!-- <a class='btn btn-danger btn-sm' href='/hr_management/delete.php?id=$row[id]'>Delete</a> -->