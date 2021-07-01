<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Rendez Vous</title>
    <link rel="stylesheet" href="../css/patient.css">
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
                            <th class="th-table">Rendez-vous</th>
                            <th class="th-table">Telephone</th>
                            <th class="th-table">Observation</th>
                            <th class="th-table">Action</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-table">
                        <?php
                    include_once 'connect.php';
                    $sql = "SELECT `id_RV`, r.cin_P, p.nom, p.prenom, p.tel, `date_RV`, `observation` FROM patient p RIGHT JOIN rendez_vous r ON p.cin_P = r.cin_P";
                    $result = $conn->query($sql);
                    $i = 0;
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo '
                                    <tr class="tr-table-main row_' . $row['id_RV'] . '"';
                                    $date_RV = explode('-', $row['date_RV']);
                                    if ($date_RV[0] <= date("Y")) {
                                        if ($date_RV[1] <= date("m")) {
                                            if ($date_RV[2] <= date("d")) {
                                                echo 'style="background-color: #6f405e;"';
                                            }
                                        }
                                    }

                                    echo '>
                                        <td class="td-table cin_p">' . $row['cin_P'] . '</td>
                                        <td class="td-table nom">' . $row['nom'] . '</td>
                                        <td class="td-table prenom">' . $row['prenom'] . '</td>
                                        <td class="td-table sex-' . $i . '">' . $row['date_RV'] . '</td>
                                        <td class="td-table tele">+212' . $row['tel'] . '</td>
                                        <td class="td-table tele">' . $row['observation'] . '</td>
                                        <td class="td-table">
                                            <a onclick="varif_delete('."'".$row['cin_P']."'".')" style="cursor: pointer;"><i class="fas fa-trash-alt"></i></a>
                                            <a id="'.$row['cin_P'].'" href="delete_rendez_vous.php?cin_P='.$row['cin_P'].'"></a>
                                        </td>
                                    </tr>
                                    
                                ';
                            $i++;
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
                    <form method="post" action="add_new_RV.php">
                        <table style="border-collapse: collapse;width: 100%;">
                            <tr class="tr-table add">
                                <td class="td-table">
                                    <input type="text" name="cin_P" id="cin" placeholder="Enter your CIN" required>
                                </td>
                                <td class="td-table">
                                    <input type="text" name="nom" id="Nom" placeholder="Enter your Nom" required>
                                </td>
                                <td class="td-table">
                                    <input type="text" name="prenom" id="Prenom" placeholder="Enter your Prenom" required>
                                </td>
                                <td class="td-table">
                                    <input type="date" name="date_RV" id="date-RV" required min="<?php echo date("Y-m-d")?>">
                                </td>
                                <td class="td-table">
                                    +212<input type="tel" name="tel" id="tel" placeholder="Telephone" required>
                                </td>
                                <td class="td-table">
                                    <input type="text" name="Observation" id="Observation" placeholder="Observation">
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

            function varif_delete(cin_P) {
                if (confirm("Sure!")) {
                    document.getElementById(cin_P).click()
                }
            }
        </script>
</body>

</html>