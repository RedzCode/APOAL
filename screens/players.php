<?php
require_once('../settings/connexion.php');
require __DIR__ . '/../sqlQuery.php';
$players = getAllPlayers($pdo)->fetchAll();

?>

<!doctype html>
<html>

<?php
$pageTitle = "Joueurs";
require_once("../includes/head.php") ?>

<body>
    <?php require("../includes/navigation.php") ?>
    <div class="container">
        <h1 class="pb-2">Liste des joueurs</h1>
        <section>
            <div class="table-responsive" id="no-more-tables">
                <table class="table table-bordered  bg-white  table-striped display" id="player-table" data-toggle="table" data-locale="fr-FR" data-search="true" data-pagination="true" data-page-list="[5, 25, 50, 100, all]">
                    <thead class="bg-dark text-light">
                        <tr>
                            <th data-sortable="true">#</th>
                            <th data-sortable="true">Prénom</th>
                            <th data-sortable="true">Nom</th>
                            <th data-sortable="true">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($players as $player) { ?>
                            <tr>
                                <td data-title="#"><?= $player['NumBox'] ?> </td>
                                <td data-title="First Name"> <?= $player['Name'] ?> </td>
                                <td data-title="Last Name"><?= $player['FamilyName'] ?></td>
                                <td data-title="Email"><?= $player['Email'] ?></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td data-title="#">2</td>
                            <td data-title="First Name"> POOO </td>
                            <td data-title="Last Name">TOOO</td>
                            <td data-title="Email">POPOP</td>
                        </tr>
                        <tr>
                            <td data-title="#">2</td>
                            <td data-title="First Name"> POOO </td>
                            <td data-title="Last Name">TOOO</td>
                            <td data-title="Email">POPOP</td>
                        </tr>
                        <tr>
                            <td data-title="#">2</td>
                            <td data-title="First Name"> POOO </td>
                            <td data-title="Last Name">TOOO</td>
                            <td data-title="Email">POPOP</td>
                        </tr>
                        <tr>
                            <td data-title="#">2</td>
                            <td data-title="First Name"> POOO </td>
                            <td data-title="Last Name">TOOO</td>
                            <td data-title="Email">POPOP</td>
                        </tr>
                        <tr>
                            <td data-title="#">2</td>
                            <td data-title="First Name"> POOO </td>
                            <td data-title="Last Name">TOOO</td>
                            <td data-title="Email">POPOP</td>
                        </tr>
                        <tr>
                            <td data-title="#">2</td>
                            <td data-title="First Name"> POOO </td>
                            <td data-title="Last Name">TOOO</td>
                            <td data-title="Email">POPOP</td>
                        </tr>
                        <tr>
                            <td data-title="#">2</td>
                            <td data-title="First Name"> POOO </td>
                            <td data-title="Last Name">TOOO</td>
                            <td data-title="Email">POPOP</td>
                        </tr>
                        <tr>
                            <td data-title="#">2</td>
                            <td data-title="First Name"> POOO </td>
                            <td data-title="Last Name">TOOO</td>
                            <td data-title="Email">POPOP</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </section>
    </div>
    <?php require("../includes/footer.php") ?>
</body>

</html>