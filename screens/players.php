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
    <h1>Liste des joueurs</h1>
    <section>
        <div class='wrapper'>
            <div class='row'>
                <?php
                foreach ($players as $player) { ?>
                <div class='column'>
                    <div>
                        Nom |
                        Prénom |
                        Email |
                        Date dernier échange |
                        Numéro
                    </div>
                </div>
                <?php } ?>
            </div>
            </br>
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

</html>