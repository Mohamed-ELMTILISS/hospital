<?php 

    include 'connect.php';
    $cin_P_init = $_POST['cin_P_init'];
    $cin_P = $_POST['cin_P'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $sex = $_POST['sex'];
    $tel = $_POST['tel'];
    $date_entree = $_POST['date_entree'];

    $sql = "UPDATE `patient` SET `cin_P`='".$cin_P."',`nom`='".$nom."',`prenom`='".$prenom."',`sex`='".$sex."',`tel`='".$tel."',`date_entree`='".$date_entree."' WHERE cin_P = '".$cin_P_init."'";

    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    header("Location: index.php");

?>