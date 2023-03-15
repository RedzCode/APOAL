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
                            <th data-sortable="true"><?= "\u{1F381}" ?></th>
                            <th data-sortable="true">Prénom</th>
                            <th data-sortable="true">Nom</th>
                            <th data-sortable="true">Email</th>
                            <th data-sortable="true">Nombre échanges</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($players as $player) { ?>
                            <tr>
                                <td class="number-box" data-title="<?= "\u{1F381}" ?> Numéro"><?= $player['NumBox'] ?> </td>
                                <td data-title="Prénom"> <?= $player['Name'] ?> </td>
                                <td data-title="Nom"><?= $player['FamilyName'] ?></td>
                                <td data-title="Email"><?= $player['Email'] ?></td>
                                <td data-title="Echanges"><?= $player['CountExchange'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
    <?php require("../includes/footer.php") ?>
</body>

</html>