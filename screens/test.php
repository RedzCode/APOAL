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
    <h1>Test</h1>
    <div class="m-4">
        <div class="table-responsive">
            <table class="table">
                <thead>
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
                        <td>1</td>
                        <td>Clark</td>
                        <td>Kent</td>
                        <td>clarkkent@mail.com</td>
                        <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>John</td>
                        <td>Carter</td>
                        <td>johncarter@mail.com</td>
                        <td>Vestibulum consectetur scelerisque bibendum scelerisque purus.</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Peter</td>
                        <td>Parker</td>
                        <td>peterparker@mail.com</td>
                        <td>Integer pulvinar leo id risus interdum vel metus dignissim.</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p class="mt-4"><strong>Note:</strong> Change the editor layout/orientation to see how responsive table works.
        </p>
    </div>
</body>

</html>