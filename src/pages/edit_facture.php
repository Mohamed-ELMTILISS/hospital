<?php 
    include 'connect.php';

    print_r($_POST);

    $id_F = $_POST['id_F'];
    $total = $_POST['total'];
    $avance = $_POST['avance'];
    $date_sortie = $_POST['date_sortie'];
    $date_paiment = $_POST['date_paiment'];

    $sql = "UPDATE `facture` SET total='".$total."', avance='".$avance."', date_paiment='".$date_paiment."', date_sortie='".$date_sortie."' WHERE id_F = '".$id_F."'";

    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    header('Location: facture.php');
?>