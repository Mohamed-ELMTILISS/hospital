<?php
    include 'connect.php';
    print_r($_POST);
    $cin = $_POST['CIN'];
    $name = $_POST['Nom'];
    $prenom = $_POST['Prenom'];
    $sexe = $_POST['sexe'];
    $tel = $_POST['tel'];
    $date_entree = $_POST['date_entree'];

    $sql0 = "SELECT * FROM etat_patient";
    $result = $conn->query($sql0);
    $i = TRUE;
    $random_id_Etat = mt_rand(10000,99999);
    if ($result->num_rows > 0) {
        while ($i == TRUE) {
            while ($row = $result->fetch_assoc()) {
                if ($row['id_E'] == $random_id_Etat) {
                    $random_id_Etat = mt_rand(10000,99999);
                }
            }
            $i = FALSE;
        }
    }


    $sql00 = "SELECT * FROM facture";
    $result = $conn->query($sql00);
    $i = TRUE;
    $random_id_facture = mt_rand(10000,99999);
    if ($result->num_rows > 0) {
        while ($i == TRUE) {
            while ($row = $result->fetch_assoc()) {
                if ($row['id_F'] == $random_id_facture) {
                    $random_id_facture = mt_rand(10000,99999);
                }
            }
            $i = FALSE;
        }
    }


    $sql = "INSERT INTO patient (`cin_P`, `nom`, `prenom`, `sex`, `tel`, `date_entree`) VALUES ('" . $cin . "', '" . $name . "', '" . $prenom . "', '" . $sexe . "' , '" . $tel . "','" . $date_entree . "')";

    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql1 = "INSERT INTO etat_patient (`id_E`, `cin_P`, `Etat`, `cin_D`, `chamber_id`) VALUES (". $random_id_Etat .",'" . $cin . "', NULL, NULL, NULL)";

    if ($conn->query($sql1) === TRUE) {
    } else {
        echo "Error: " . $sql1 . "<br>" . $conn->error;
    }

    $sql2 = "INSERT INTO `facture`(`id_F`, `cin_P`, `total`, `avance`, `date_paiment`, `date_sortie`) VALUES (". $random_id_facture .",'" . $cin . "', NULL, NULL, NULL, NULL)";

    if ($conn->query($sql2) === TRUE) {
    } else {
        echo "Error: " . $sql2 . "<br>" . $conn->error;
    }


    $conn->close();

    header('Location: index.php');
?>