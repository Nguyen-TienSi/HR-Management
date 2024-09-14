<?php
session_start();

if (isset($_SESSION['user_name'])) {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>EMPLOYEE</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    </head>

    <body>
        <div class="container my-5">
            <a type="button" href="../../logout.php">
                <button>Logout</button>
            </a>
            <a href="../../changePassword.php">
                <button>Change password</button>
            </a>
            <h2>My Mail List</h2>
            <a class="btn btn-primary" href="mailForm.php" role="button">New Mail</a>
            <div class="table-responsive">
                <table class="table" id="mailTable">
                    <thead>
                        <tr>
                            <th>DATE</th>
                            <th>RESPONSE STATUS</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "../../db_conn.php";

                        // read all rows from the database table
                        $sql = "SELECT * FROM mails " .
                            "WHERE fr = '{$_SESSION['user_name']}' " .
                            "ORDER BY sending_date DESC";
                        $result = $connection->query($sql);

                        if (!$result) {
                            die("Invalid query: " . $connection->connect_error);
                        }

                        // read data from each row
                        while ($row = $result->fetch_assoc()) {
                            echo "
                            <tr>
                                <td>$row[sending_date]</td>
                                <td>$row[response_status]</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='content.php?id=$row[id]'>More details</a>
                            </td>
                            </tr>
                        ";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>

    </html>

<?php
} else {
    header("Location: authenticateLogin.php");
    exit;
}
?>