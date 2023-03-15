<?php
require_once('../settings/connexion.php');
require __DIR__ . '/../sqlQuery.php';
session_start();


$texte = "";
$request_method = strtoupper($_SERVER['REQUEST_METHOD']);
if ($request_method === 'GET') {
    if (!empty($_GET['email'])) {
        $email = $_GET['email'];

        $emails = getAllEmails($pdo)->fetchAll();

        $identique = false;
        foreach ($emails as $emailTaken) {
            if (strtolower($email) == strtolower($emailTaken[0])) {
                $identique = true;
            }
        }

        if ($identique) {
            $player = getInfoPlayer($pdo, $email)->fetch();
            $prenom = $player['Name'];
            $nom = $player['FamilyName'];
            $email = $player['Email'];
        } else {
            $texte = "Le joueur n'existe pas";
        }
    } else {
        $texte = "Le joueur n'existe pas";
    }
}
?>

<!doctype html>
<html>

<?php
$pageTitle = "Information";
require_once("../includes/head.php") ?>

<body>
    <?php require("../includes/navigation.php") ?>
    <div class="container">

        <h1 class="pb-2">Information joueur</h1>
        <section>
            <?php if (!empty($texte) and $texte != "") {
            ?>
                <div class='wrapper-sect'>
                    <?= $texte ?>
                </div>
            <?php } else { ?>
                <div class='wrapper-sect'>
                    <p>Le joueur <?= $prenom ?> <?= $nom ?> (<?= $email ?>) a le numéro : </p>
                    <h2><?= $numéro ?></h2>
                </div>
            <?php  } ?>
        </section>

        <div style="text-align: center; margin-top: 2%;"> <img class="img-gif" src="../assets/registration_player.gif" alt="meme-gif-Deal">
        </div>

    </div>
    <?php require("../includes/footer.php") ?>
</body>

</html>