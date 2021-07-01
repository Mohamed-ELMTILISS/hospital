<?php 
    include 'connect.php';
    $cin_P = $_GET['cin_P'];
    $sql0_backup = "INSERT INTO hospital_backup.facture SELECT * FROM facture WHERE cin_P='" . $cin_P."'";
    $sql1_backup = "INSERT INTO hospital_backup.etat_patient SELECT * FROM etat_patient WHERE cin_P='" . $cin_P."'";
    $sql2_backup = "INSERT INTO hospital_backup.patient SELECT * FROM patient WHERE cin_P='" . $cin_P."'";
    $sql3_backup = "INSERT INTO hospital_backup.rendez_vous SELECT * FROM rendez_vous WHERE cin_P='" . $cin_P."'";

    if ($conn->query($sql2_backup) === TRUE) {
    } else {
        echo "Error: " . $sql2_backup . "<br>" . $conn->error;
    }

    
    if ($conn->query($sql1_backup) === TRUE) {
    } else {
        echo "Error: " . $sql1_backup . "<br>" . $conn->error;
    }
    
    if ($conn->query($sql0_backup) === TRUE) {
    } else {
        echo "Error: " . $sql0_backup . "<br>" . $conn->error;
    }

    if ($conn->query($sql3_backup) === TRUE) {
    } else {
        echo "Error: " . $sql3_backup . "<br>" . $conn->error;
    }

    $sql = "DELETE FROM patient WHERE cin_P='" . $cin_P."'";
    
    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    header("Location:rendez_vous.php");



?>