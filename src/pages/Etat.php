<!DOCTYPE html>
<html>

<head>
    <title>Etat de passion</title>
    <link rel="stylesheet" href="../css/Etat_&_facture.css">
</head>

<body>
    <?php
        session_start();
        if (!isset($_SESSION['username']) and !isset($_SESSION['cin_user'])) {
            echo '<script>alert("please login");';
            echo 'window.location.assign("../../index.php")</script>';
        }
        include_once 'side__bar.html';
        ?>

        <main class="main">
            <div class="sub_main">
                <div class="search__div">
                    <div class="wrap">
                        <div class="search">
                            <input type="text" id="search" onkeyup="search()" class="searchTerm" placeholder="What are you looking for?">
                            <button type="submit" class="searchButton">
                            <i class="fa fa-search"></i>
                        </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-table" id="container-table">
                <table class="table-table" id="table-table">
                    <thead class="thead-table">
                        <tr class="tr-table-head">
                            <th class="th-table">CIN</th>
                            <th class="th-table">Nom</th>
                            <th class="th-table">Prenom</th>
                            <th class="th-table">Etat</th>
                            <th class="th-table">Doctor</th>
                            <th class="th-table">Chamber</th>
                            <th class="th-table">Action</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-table">
                        <?php
                        include_once 'connect.php';
                        $sql = "SELECT id_E, e.cin_P, p.nom, p.prenom, Etat, d.cin_D, d.nom AS D_nom, d.prenom AS D_prenom, chamber_id, r.date_RV FROM etat_patient e LEFT JOIN docteur d ON e.cin_D = d.cin_D JOIN patient p ON p.cin_P = e.cin_P LEFT JOIN rendez_vous r ON e.cin_P = r.cin_P";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo '
                                <tr class="tr-table row_'.$row['id_E'].'">
                                    <td class="td-table">'.$row['cin_P'].'</td>
                                    <td class="td-table">'.$row['nom'].'</td>
                                    <td class="td-table">'.$row['prenom'].'</td>
                                    <td class="td-table">';
                                        if ($row['Etat'] == "Ergence") {
                                            echo $row['Etat'];
                                        }else {
                                            echo $row['date_RV'];
                                        }
                                    echo '</td>
                                    <td class="td-table">'.$row['D_nom'].' '.$row['D_prenom'].'</td>
                                    <td class="td-table">'.$row['chamber_id'].'</td>
                                    <td class="td-table">
                                        <a href="#" onclick="showinput('."'row_".$row['id_E']."'".')"><i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                                <tr class="tr-table hide hide_row_'.$row['id_E'].'">
                                    <td colspan="7" style="padding: 0;">
                                        <form method="post" action="edit_etat.php">
                                            <table style="border-collapse: collapse;width: 100%;">
                                                <tr class="tr-table add">
                                                    <td class="td-table">'.$row['cin_P'].'</td>
                                                    <td class="td-table">'.$row['nom'].'</td> 
                                                    <input type="hidden" name="cin_P" value="'.$row['cin_P'].'"/>
                                                    <td class="td-table">'.$row['prenom'].'</td>
                                                    <td class="td-table">
                                                        <label>Ergence<input type="radio" name="Etat" value="Ergence" checked /></label>
                                                        <label>Rendez-vous<input type="radio" name="Etat" value="Rendez-vous" /></label>
                                                        <br/>
                                                        <select name="Rendez-vous" id="Rendez-vous" style="display: none;">
                                                            ';
                                                            $sql1 = "SELECT * FROM `rendez_vous` WHERE cin_P = '".$row['cin_P']."'";
                                                            $result1 = $conn->query($sql1);
                                                            if ($result1->num_rows > 0) {
                                                                // output data of each row
                                                                while ($row1 = $result1->fetch_assoc()) {
                                                                    echo '<option value="' . $row1['id_RV'].'">CIN: ' . $row1['cin_P'].' En: '.$row1['date_RV'].'</option>';
                                                                }
                                                            }
                                                        echo '
                                                        </select>
                                                        </td>
                                                    <td class="td-table">
                                                        <select name="docteur" id="docteur">
                                                            ';
                                                            $sql2 = "SELECT * FROM docteur";
                                                            $result2 = $conn->query($sql2);
                                                            if ($result2->num_rows > 0) {
                                                                // output data of each row
                                                                while ($row2 = $result2->fetch_assoc()) {
                                                                    echo '<option value="'. $row2['cin_D'] .'">' . $row2['nom'] .' '. $row2['prenom'].'</option>';
                                                                }
                                                            }
                                                        echo '
                                                        </select>
                                                    </td>
                                                    <td class="td-table">
                                                        <select name="chamber" id="chamber">
                                                            ';
                                                            $sql3 = "SELECT * FROM chamber";
                                                            $result3 = $conn->query($sql3);
                                                            if ($result3->num_rows > 0) {
                                                                // output data of each row
                                                                while ($row3 = $result3->fetch_assoc()) {
                                                                    if ($row3['is_empty'] == true) {
                                                                        echo '<option value="' . $row3['chamber_id'] .'">' . $row3['chamber_id'] .'</option>';
                                                                    }
                                                                }
                                                            }
                                                        echo '
                                                        </select>
                                                    </td>
                                                    <td class="td-table">
                                                        <input type="submit" value="Enregistre" onclick="" name="enregistre_patien">
                                                        <i class="fas fa-times-circle" onclick="deleteinput('."'row_".$row['id_E']."'".')"></i>
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>
                                    </td>
                                </tr>
                            ';
                            }
                        } else {
                            echo "<tr class='tr-table'>
                                        <td class='td-table' colspan='7'>0 results</td>
                                </tr>";
                        }
                        $conn->close();
                    ?>
                    </tbody>
                </table>
            </div>

        </main>
        <script>
            function search() {
                var input, filter, table, tr, td, i, txtValue
                input = document.getElementById("search")
                filter = input.value.toUpperCase()
                table = document.getElementById("table-table")
                tr = table.getElementsByClassName("tr-table")
                for (i = 0; i < tr.length; i++) {
                    for (j = 0; j < 3; j++) {
                        td = tr[i].getElementsByClassName("td-table")[j]
                        if (td) {
                            txtValue = td.textContent || td.innerText;
                            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = ""
                            } else {
                                tr[i].style.display = "none"
                            }
                        }
                    }
                }
            }


            if (document.querySelector('input[name="Etat"]')) {
                document.querySelectorAll('input[name="Etat"]').forEach((elem) => {
                    elem.addEventListener("change", function(event) {
                    var item = event.target.value;
                        if (item == 'Rendez-vous') {
                            document.querySelector('#Rendez-vous').style.display = 'block'
                        }else if (item == 'Ergence') {
                            document.querySelector('#Rendez-vous').style.display = 'none'
                        }
                    });
                });
            }

            
            function showinput(hide) {
                var cell = document.getElementsByClassName(hide)[0]
                cell.style.display = 'none';
                var input = document.querySelector('.hide_' + hide)
                input.style.display = 'table-row';
            }


            function deleteinput(hide) {
                var cell = document.getElementsByClassName(hide)[0]
                cell.style.display = 'table-row';
                var input = document.querySelector('.hide_' + hide)
                input.style.display = 'none';
            }
        </script>
</body>

</html>