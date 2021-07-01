<!DOCTYPE html>
<html>

<head>
    <title>Etat de passion</title>
    <link rel="stylesheet" href="../css/Etat_&_facture.css">
    <style>
        .th-table,.td-table {
            width: 12.5%;
        }
    </style>
</head>

<body>
    <?php
        session_start();
        if (!isset($_SESSION['username']) and !isset($_SESSION['cin_user'])) {
            echo '<script>alert("please login");';
            echo 'window.location.assign("../../index.php")</script>';
        }
        include_once 'side__bar.php';
        ?>

        <main class="main">
            <div class="sub_main">
                <div class="search__div">
                    <div class="wrap">
                        <div class="search">
                            <input type="text" id="search" class="searchTerm" placeholder="What are you looking for?">
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
                            <th class="th-table">Total</th>
                            <th class="th-table">Avance</th>
                            <th class="th-table">Date Paiment</th>
                            <th class="th-table">Date Sortie</th>
                            <th class="th-table">Action</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-table">
                        <?php
                        include_once 'connect.php';
                        $sql = "SELECT id_F, f.cin_P, nom, prenom, total, avance, date_paiment, date_sortie FROM facture f, patient p WHERE p.cin_P = f.cin_P";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo '
                                <tr class="tr-table-main row_'.$row['id_F'].'"';
                                if ($row['avance'] >= $row['total'] AND $row['avance'] != NULL AND $row['total'] != NULL) {
                                    echo 'style="background-color: #409d81;"';
                                }
                                echo '>
                                    <td class="td-table">'.$row['cin_P'].'</td>
                                    <td class="td-table">'.$row['nom'].'</td>
                                    <td class="td-table">'.$row['prenom'].'</td>
                                    <td class="td-table">'.$row['total'].' dh</td>
                                    <td class="td-table">'.$row['avance'].' dh</td>
                                    <td class="td-table">'.$row['date_paiment'].'</td>
                                    <td class="td-table">'.$row['date_sortie'].'</td>
                                    <td class="td-table">
                                        <a href="#"  onclick="showinput('."'row_".$row['id_F']."'".')"><i class="fas fa-edit"></i></a>
                                        <a href="print_facture.php?cin_P='.$row['cin_P'].'"><i class="fas fa-print" style="font-width: 600 !important"></i></a>
                                    </td>
                                </tr>
                                <tr class="tr-table hide hide_row_'.$row['id_F'].'">
                                        <td colspan="8" style="padding: 0;">
                                            <form method="post" action="edit_facture.php">
                                                <table style="border-collapse: collapse;width: 100%;">
                                                    <tr class="tr-table">
                                                        <input type="hidden" name="id_F" value="'.$row['id_F'].'" />
                                                        <td class="td-table">'.$row['cin_P'].'</td>
                                                        <td class="td-table">'.$row['nom'].'</td>
                                                        <td class="td-table">'.$row['prenom'].'</td>
                                                        <td class="td-table"><input type="number" name="total" value="'.$row['total'].'" min="0"></td>
                                                        <td class="td-table"><input type="number" name="avance" value="'.$row['avance'].'" min="0"></td>
                                                        <td class="td-table"><input type="date" name="date_paiment" value="'.$row['date_paiment'].'" require></td>
                                                        <td class="td-table"><input type="date" name="date_sortie" value="'.$row['date_sortie'].'" require></td>
                                                        <td class="td-table">
                                                        <input type="submit" id="'.$row['id_F'].'" value="Enregistre" name="enregistre_patien">
                                                        <i class="fas fa-times-circle" onclick="deleteinput('."'row_".$row['id_F']."'".')"></i>
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
                                        <td class='td-table' colspan='8'>0 results</td>
                                </tr>";
                        }
                        $conn->close();
                    ?>
                    </tbody>
                </table>
            </div>

        </main>
        <script>
            $(document).ready(function(){
                $("#search").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $(".tr-table-main").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });

            
            function showinput(hide) {
                var cell = document.getElementsByClassName(hide)[0]
                cell.style.display = 'none';
                var input = document.getElementsByClassName('hide_' + hide)[0]
                input.style.display = 'table-row';
            }


            function deleteinput(hide) {
                var cell = document.getElementsByClassName(hide)[0]
                cell.style.display = 'table-row';
                var input = document.getElementsByClassName('hide_' + hide)[0]
                input.style.display = 'none';
            }
        </script>
</body>

</html>