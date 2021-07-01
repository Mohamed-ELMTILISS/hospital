<?php 
    include 'connect.php';

    $cin_U = $_GET['cin_U'];

    $sql_backup = "INSERT INTO hospital_backup.utilisateur SELECT * FROM utilisateur WHERE cin_U = '".$cin_U."'";
    $sql = "DELETE FROM utilisateur WHERE cin_U ='" . $cin_U."'";

    if ($conn->query($sql_backup) === TRUE) {
    } else {
        echo "Error: " . $sql_backup . "<br>" . $conn->error;
    }

    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    header('Location:utilisateur.php');

?>