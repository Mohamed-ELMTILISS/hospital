<?php 
    include 'connect.php';

    $cin_D = $_GET['cin_D'];

    $sql_backup = "INSERT INTO hospital_backup.docteur SELECT * FROM docteur WHERE cin_D = '".$cin_D."'";
    $sql = "DELETE FROM docteur WHERE cin_D ='" . $cin_D."'";

    if ($conn->query($sql_backup) === TRUE) {
    } else {
        echo "Error: " . $sql_backup . "<br>" . $conn->error;
    }

    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    header('Location:docteur.php');

?>