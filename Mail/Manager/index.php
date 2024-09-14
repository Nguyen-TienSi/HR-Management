<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMPLOYEE MAIL</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container my-5">
        <h2>EMPLOYEE'S MAIL</h2>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>FROM</th>
                        <th>DATE</th>
                        <th>RESPONSE STATUS</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "../../db_conn.php";

                    $sql = "SELECT * FROM mails ORDER BY sending_date DESC";
                    $result = $connection->query($sql);

                    if (!$result) {
                        die("Invalid query: " . $connection->connect_error);
                    }

                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>$row[fr]</td>
                            <td>$row[sending_date]</td>
                            <td>$row[response_status]</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='respond.php?id=$row[id]'>More details</a>
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