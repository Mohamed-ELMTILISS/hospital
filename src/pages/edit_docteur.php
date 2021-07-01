<?php 
    include 'connect.php';

    $cin_D_init = $_POST['cin_D_init'];
    $cin_D = $_POST['cin_D'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $tel = $_POST['tel'];
    $sql = "UPDATE `docteur` SET `cin_D`='".$cin_D."',`nom`='".$nom."',`prenom`='".$prenom."',`tel`='".$tel."' WHERE cin_D = '".$cin_D_init."'";

    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    header("Location: docteur.php");

?>