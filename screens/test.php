<?php
require_once('../settings/connexion.php');
require __DIR__ . '/../sqlQuery.php';
$players = getAllPlayers($pdo)->fetchAll();

?>

<!doctype html>
<html>

<?php
$pageTitle = "test";
require_once("../includes/head.php") ?>

<body>
    <h1 class="pb-2">Liste des joueurs</h1>

    <div class="table-responsive" id="no-more-tables">
        <table class="table table-bordered  bg-white  table-striped" id="player-table" data-toggle="table" data-locale="fr-FR" data-search="true" data-pagination="true" data-page-list="[10, 25, 50, 100, all]">
            <thead class="bg-dark text-light">
                <tr>
                    <th data-sortable="true">#</th>
                    <th data-sortable="true">First Name</th>
                    <th data-sortable="true">Last Name</th>
                    <th data-sortable="true">Email</th>
                    <th data-sortable="true">Biography</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td data-title="#">1</td>
                    <td data-title="First Name">Clark</td>
                    <td data-title="Last Name">Kent</td>
                    <td data-title="Email">clarkkent@mail.com</td>
                    <td data-title="Biography">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</td>
                </tr>
                <tr>
                    <td data-title="#">1</td>
                    <td data-title="First Name">Clark</td>
                    <td data-title="Last Name">Kent</td>
                    <td data-title="Email">clarkkent@mail.com</td>
                    <td data-title="Biography">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</td>
                </tr>
                <tr>
                    <td data-title="#">1</td>
                    <td data-title="First Name">Clark</td>
                    <td data-title="Last Name">Kent</td>
                    <td data-title="Email">clarkkent@mail.com</td>
                    <td data-title="Biography">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</td>
                </tr>
            </tbody>
        </table>
    </div>

</body>
<script src="../js/table.js"></script>

</html>