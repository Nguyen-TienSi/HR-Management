<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    include "db_conn.php";

    $sql = "DELETE FROM employees WHERE id=$id";
    $connection->query($sql);
}

header("location: /hr_management/index.php");
exit;
?>