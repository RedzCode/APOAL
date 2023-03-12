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
    <table id="table" data-show-columns="true" data-search="true" data-url="json/data1.json" data-mobile-responsive="true" data-check-on-init="true">
        <thead>
            <tr>
                <th data-field="id" data-sortable="true">ID</th>
                <th data-field="name" data-sortable="true">Item Name</th>
                <th data-field="price" data-sortable="true">Item Price</th>
            </tr>
        </thead>
    </table>

    <script>
        $(function() {
            $('#table').bootstrapTable()
        })
    </script>
</body>

</html>