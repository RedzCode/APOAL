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
    <section>
        <div class='wrapper'>
            <div class='row'>
                <?php
                foreach ($players as $player) { ?>
                    <div class='column'>
                        <div>
                            <?php echo $player['Name'] ?> |
                            <?php echo $player['FamilyName'] ?> |
                            <?php echo $player['Email'] ?> |
                            <?php echo $player['LastExchangeDate'] ?> |
                            <?php echo $player['NumBox'] ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
</body>
<!-- https://codepen.io/ajlohman/pen/GRWYWw -->

</html>