<!DOCTYPE html>
<html>

<head>
    <title>Document</title>
    <link rel="stylesheet" href="../css/patient.css" />
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
                <div class="add-new">
                    <section class="container">
                        <button class="add-new-button" data-hover="Add new patient" id="add-new-button" onclick="add_new()">
                        <div><i class="fas fa-plus-square"></i></div>
                    </button>
                    </section>
                </div>
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
                            <th class="th-table">Sexe</th>
                            <th class="th-table">Telephone</th>
                            <th class="th-table">Date entree</th>
                            <th class="th-table">Action</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-table">
                        <?php
                    include_once 'connect.php';
                    $sql = "SELECT p.cin_P, nom, prenom, sex, tel, date_entree, id_RV, date_RV, observation FROM patient p LEFT JOIN rendez_vous r ON p.cin_P = r.cin_P;";
                    $result = $conn->query($sql);


                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo '
                                    <tr class="tr-table-main row_' . $row['cin_P'] . '">
                                        <td class="td-table cin_p">' . $row['cin_P'] . '</td>
                                        <td class="td-table nom">' . $row['nom'] . '</td>
                                        <td class="td-table prenom">' . $row['prenom'] . '</td>
                                        <td class="td-table sex">' . $row['sex'] . '</td>
                                        <td class="td-table tele">+212' . $row['tel'] . '</td>
                                        <td class="td-table date_entrer">';
                                            if(isset($row['date_RV']) AND $row['date_entree'] == '0000-00-00'){
                                                echo "rendez vous";
                                            }else if ($row['date_entree'] == '0000-00-00') {
                                                echo "Update me";
                                            }else{
                                                echo $row['date_entree'];
                                            }
                                            echo '</td>
                                        <td class="td-table">
                                            <a href="#" onclick="showinput('."'row_".$row['cin_P']."'".')"><i class="fas fa-edit"></i></a>
                                            <a onclick="varif_delete('."'".$row['cin_P']."'".')"><i class="fas fa-trash-alt"></i></a>
                                            <a id="'.$row['cin_P'].'" href="delete_patient.php?cin_P='.$row['cin_P'].'"></a>
                                        </td>
                                    </tr>
                                    <tr class="tr-table hide hide_row_'.$row['cin_P'].'">
                                        <td colspan="7" style="padding: 0;">
                                            <form method="post" action="edit_patient.php">
                                                <table style="border-collapse: collapse;width: 100%;">
                                                    <tr class="tr-table">
                                                        <input type="hidden" name="cin_P_init" value="'.$row['cin_P'].'" />
                                                        <td class="td-table"><input type="text" name="cin_P" value="'.$row['cin_P'].'"></td>
                                                        <td class="td-table"><input type="text" name="nom" value="'.$row['nom'].'"></td>
                                                        <td class="td-table"><input type="text" name="prenom" value="'.$row['prenom'].'"></td>
                                                        <td class="td-table">
                                                        <label>H<input type="radio" name="sex" value="H" checked /></label>
                                                        <label>F<input type="radio" name="sex" value="F" /></label>
                                                        </td>
                                                        <td class="td-table">+212<input type="tel" name="tel" value="'.$row['tel'].'"></td>
                                                        <td class="td-table"><input type="date" name="date_entree" value="'.$row['date_entree'].'"></td>
                                                        <td class="td-table">
                                                        <input type="submit" id="'.$row['cin_P'].'" value="Enregistre" name="enregistre_patien">
                                                        <i class="fas fa-times-circle" onclick="deleteinput('."'row_".$row['cin_P']."'".')"></i>
                                                    </td>
                                                    </tr>
                                                </table>
                                            </form>
                                        </td>
                                    </tr>
                                ';
                        }
                    } else {
                        echo "  <tr class='tr-table'>
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
            $(document).ready(function(){
                $("#search").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $(".tr-table-main").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });

            function add_new() {
                var add = document.createElement("TR")
                add.classList.add('add-new-ontable')
                add.innerHTML = `
                <td colspan='7'>
                    <form method="post" action="add_new.php">
                        <table style="border-collapse: collapse;width: 100%;">
                            <tr class="tr-table add">
                                <td class="td-table">
                                    <input type="text" name="CIN" id="cin" required>
                                </td>
                                <td class="td-table">
                                    <input type="text" name="Nom" id="Nom" required>
                                </td>
                                <td class="td-table">
                                    <input type="text" name="Prenom" id="Prenom" required>
                                </td>
                                <td class="td-table">
                                    <label for="H">H: </label><input type="radio" name="sexe" id="sexe" value="H">
                                    <label for="F">F: </label><input type="radio" name="sexe" id="sexe" value="F">
                                </td>
                                <td class="td-table">
                                    +212<input type="tel" name="tel" id="tel">
                                </td>
                                <td class="td-table">
                                    <input type="date" name="date_entree" id="date-entree" min="<?php echo date("Y-m-d")?>" required>
                                </td>
                                <td class="td-table">
                                    <input type="submit" value="Enregistre" onclick="myFunction()" name="enregistre_patien">
                                    <i class="fas fa-times-circle" onclick="deleteinputt()"></i>
                                </td>
                            </tr>
                        </table>
                    </form>
                </td>
            `
                document.getElementsByClassName('tbody-table')[0].appendChild(add)
                document.getElementById('add-new-button').disabled = true
            }

            function deleteinputt() {
                document.getElementsByClassName("add-new-ontable")[0].remove()
                document.getElementById('add-new-button').disabled = false
            }


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


            function varif_delete(cin_P) {
                if (confirm("Sure!")) {
                    document.getElementById(cin_P).click()
                }else{
                    document.getElementById(cin_P).unclick()
                }
            }
        </script>
</body>

</html>