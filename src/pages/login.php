<?php
include_once 'connect.php';
session_start();
$sql = 'SELECT * FROM utilisateur';

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        if ($_POST['user'] == $row['user_name']) {
            if ($_POST['password'] == $row['password']) {
                $_SESSION['username'] = $row['user_name'];
                $_SESSION['cin_user'] = $row['cin_U'];
                $_SESSION['Admin'] = $row['Admin'];
                $_SESSION['password'] = $row['password'];
                $login = true;
                echo "<script>window.location.assign('index.php');</script>";
                break;
            } else {
                $login = false;
            }
        } else {
            $login = false;
        }
    }
} else {
    echo "0 results";
}
if ($login == false) {
    echo "<script>alert('user or pass incorrect');</script>";
    echo "<script>window.location.assign('../../index.php');</script>";
}

?>