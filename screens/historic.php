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
    <h1>Liste des échanges</h1>
    <section>
        <div class='wrapper'>
            <div class='row'>
                <?php
                foreach ($exchanges as $exchange) { ?>
                <div class='column'>
                    <div>
                        échange
                    </div>
                </div>
                <?php } ?>
            </div>
            </br>
            <div class='row'>
                <?php
                foreach ($exchanges as $exchange) { ?>
                <div class='column'>
                    <div>
                        <?php echo $exchange['numExchange'] ?> |
                        <?php echo $exchange['mail1'] ?> |
                        <?php echo $exchange['mail2'] ?> |
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
</body>

</html>