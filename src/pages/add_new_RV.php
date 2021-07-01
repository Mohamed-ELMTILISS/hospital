<?php 
    include 'connect.php'; 
    try {
        $cin_P = $_POST['cin_P'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $tel = $_POST['tel'];

        $date_RV = $_POST['date_RV'];
        $Observation = $_POST['Observation'];


        $sql0 = "INSERT INTO `patient`(`cin_P`, `nom`, `prenom`, `sex`, `tel`, `date_entree`) VALUES ('".$cin_P."','".$nom."','".$prenom."', NULL, '".$tel."','0000-00-00')";
        if ($conn->query($sql0) === TRUE) {
        } else {
            echo "Error: " . $sql0 . "<br>" . $conn->error;
        }



        $sql01 = "SELECT * FROM rendez_vous";
        $result01 = $conn->query($sql01);
        $i01 = TRUE;
        $random_id_RV = mt_rand(10000,99999);
        if ($result01->num_rows > 0) {
            while ($i01 == TRUE) {
                while ($row01 = $result01->fetch_assoc()) {
                    if ($row01['id_RV'] == $random_id_RV) {
                        $random_id_RV = mt_rand(10000,99999);
                    }
                }
                $i01 = FALSE;
            }
        }

        $sql = "INSERT INTO `rendez_vous`(`id_RV`, `cin_P`, `date_RV`, `observation`) VALUES ('".$random_id_RV."','".$cin_P."','".$date_RV."','".$Observation."')";

        if ($conn->query($sql) === TRUE) {
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

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
        
        $sql1 = "INSERT INTO etat_patient (`id_E`, `cin_P`, `Etat`, `cin_D`, `chamber_id`) VALUES (". $random_id_Etat .",'" . $cin_P . "', NULL, NULL, NULL)";

        if ($conn->query($sql1) === TRUE) {
        } else {
            echo "Error: " . $sql1 . "<br>" . $conn->error;
        }

        $sql2 = "INSERT INTO `facture`(`id_F`, `cin_P`, `total`, `avance`, `date_paiment`, `date_sortie`) VALUES (". $random_id_facture .",'" . $cin_P . "', NULL, NULL, NULL, NULL)";

        if ($conn->query($sql2) === TRUE) {
        } else {
            echo "Error: " . $sql2 . "<br>" . $conn->error;
        }
        header('Location: rendez_vous.php');

    }
    catch (Exception $e){
        echo "Error: " . $e;
    }

?>