<?php 
    include 'connect.php';

    print_r($_POST);
    $cin_P = $_POST['cin_P'];
    $Etat_init = $_POST['Etat'];

    $sql1 = "SELECT id_RV, e.cin_P, date_RV FROM etat_patient e JOIN rendez_vous r ON e.cin_P = r.cin_P WHERE e.cin_P = '".$cin_P."' AND date_RV = ". date("Y-m-d");
    $result = $conn->query($sql1);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            if ($row['cin_P'] = $cin_P) {
                $Etat = $row['id_RV'];
                $RV = TRUE;
            }
        }
    }else{
        if ($Etat_init == "Ergence") {
            $Etat = $Etat_init;
        }else {
            $Etat = $_POST['Rendez-vous'];
        }
    }
    
    
    
    $docteur = $_POST['docteur'];
    $chamber = $_POST['chamber'];

    $sql = "UPDATE `etat_patient` SET `Etat`='".$Etat."',`cin_D`='".$docteur."',`chamber_id`='".$chamber."' WHERE cin_P = '".$cin_P."'";

    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    header('Location: Etat.php');


?>