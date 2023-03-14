<?php
require_once('../settings/connexion.php');
require __DIR__ . '/../sqlQuery.php';
$exchanges = getAllDoneExchange($pdo)->fetchAll();

?>

<!doctype html>
<html>

<?php
$pageTitle = "echanges";
require_once("../includes/head.php") ?>

<body>
    <?php require("../includes/navigation.php") ?>
    <div class="container">
        <h1 class="pb-2">Historique</h1>
        <section>
            <div class="table-responsive" id="no-more-tables">
                <table class="table table-bordered  bg-white  table-striped display" id="player-table"
                    data-toggle="table" data-locale="fr-FR" data-search="true" data-pagination="true"
                    data-page-list="[5, 25, 50, 100, all]">
                    <thead class="bg-dark text-light">
                        <tr>
                            <th data-sortable="true">Joueur1</th>
                            <th data-sortable="true">Joueur2</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($exchanges as $exchange) { ?>
                        <tr>
                            <td data-title="Joueur 1"> <?= $exchange['mail1'] ?> </td>
                            <td data-title="Joueur 2"><?= $exchange['mail2'] ?></td>
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