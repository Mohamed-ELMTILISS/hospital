<?php 

    include 'connect.php';
    $cin_U_init = $_POST['cin_U_init'];
    $cin_U = $_POST['cin_U'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $admin = $_POST['admin'];

    $sql = "UPDATE `utilisateur` SET `cin_U`='".$cin_U."',`nom`='".$nom."',`prenom`='".$prenom."',`user_name`='".$user_name."',`password`='".$password."',`email`='".$email."',`Admin`='".$admin."' WHERE cin_U = '".$cin_U_init."'";

    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    header("Location: utilisateur.php");

?>