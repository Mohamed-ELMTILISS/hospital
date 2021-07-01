<?php 
    include 'connect.php';
    $cin_P = $_GET['cin_P'];
    $sql0 = "DELETE FROM facture WHERE cin_P='" . $cin_P."'";
    $sql0_backup = "INSERT INTO hospital_backup.facture SELECT * FROM facture WHERE cin_P='" . $cin_P."'";
    $sql1 = "DELETE FROM etat_patient WHERE cin_P='" . $cin_P."'";
    $sql1_backup = "INSERT INTO hospital_backup.etat_patient SELECT * FROM etat_patient WHERE cin_P='" . $cin_P."'";
    $sql2 = "DELETE FROM patient WHERE cin_P='" . $cin_P."'";
    $sql2_backup = "INSERT INTO hospital_backup.patient SELECT * FROM patient WHERE cin_P='" . $cin_P."'";


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




    if ($conn->query($sql0) === TRUE) {
    } else {
        echo "Error: " . $sql0 . "<br>" . $conn->error;
    }

    if ($conn->query($sql1) === TRUE) {
    } else {
        echo "Error: " . $sql1 . "<br>" . $conn->error;
    }

    if ($conn->query($sql2) === TRUE) {
    } else {
        echo "Error: " . $sql2 . "<br>" . $conn->error;
    }


    header('Location: index.php');

?>