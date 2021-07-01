<?php 
    include 'connect.php';

    $cin_D = $_POST['CIN'];
    $nom = $_POST['Nom'];
    $prenom = $_POST['Prenom'];
    $tel = $_POST['tel'];

    $sql = "insert into docteur values ('".$cin_D."','".$nom."','".$prenom."','".$tel."')";

    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    header('Location: docteur.php');
?>