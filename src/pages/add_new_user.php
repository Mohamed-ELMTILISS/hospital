<?php 
    include 'connect.php';

    $cin_U = $_POST['CIN'];
    $nom = $_POST['Nom'];
    $prenom = $_POST['Prenom'];
    $user_name = $_POST['User_name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $admin = $_POST['admin'];

    $sql = "INSERT INTO `utilisateur`(`cin_U`, `nom`, `prenom`, `user_name`, `password`, `email`, `Admin`) VALUES ('".$cin_U."','".$nom."','".$prenom."','".$user_name."','".$password."','".$email."','".$admin."')";

    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    header('Location: utilisateur.php');
    

?>