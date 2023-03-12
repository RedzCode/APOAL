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
        <table class="table bg-white">
            <thead class="bg-dark text-light">
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Biography</th>
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

</html>