<?php
require '../vendor/autoload.php';
require_once('../settings/connexion.php');
require_once('../sendmail.php');
require __DIR__ . '/../sqlQuery.php';
session_start();

$emails = getAllEmails($pdo)->fetchAll();
$success = "";
$request_method = strtoupper($_SERVER['REQUEST_METHOD']);
if ($request_method === 'POST') {
    if (!empty($_POST['mail1']) and !empty($_POST['mail2'])) {
        $mail1 = $_POST['mail1'];
        $mail2 = $_POST['mail2'];
        $code1 = random_int(0, 499);
        $code2 = random_int(500, 1000);

        $lastExchangePlayer1 = (getLastExchangePlayer($pdo, $mail1)->fetch())[0];
        $lastExchangePlayer2 = (getLastExchangePlayer($pdo, $mail2)->fetch())[0];

        if ($lastExchangePlayer1 == $mail2 && $lastExchangePlayer2 == $mail1) {
            $error = "Impossible de faire un échange entre deux même joueurs à la suite. \nAu moins un des joueurs doit faire un échange avec un autre joueur";
        } else {
            if (createExchange($pdo, $mail1, $mail2, $code1, $code2)) {
                $resnum = getNumExchange($pdo, $mail1, $mail2)->fetchAll();
                $num = $resnum[sizeof($resnum) - 1]['numExchange'];
                $numCrypted = password_hash($num, PASSWORD_BCRYPT);

                $content1 = 'Confirmez vous l echange ? Cliquez sur ce lien: https://www.poulpy-show.com/screens/validation.php?num='
                    . $numCrypted . '-' . $num . '&code=' . $code1;
                $content2 = 'Confirmez vous l echange ? Cliquez sur ce lien: https://www.poulpy-show.com/screens/validation.php?num='
                    . $numCrypted . '-' . $num . '&code=' . $code2;

                SendEmail::SendMailConfirmation($mail1, $content1);
                SendEmail::SendMailConfirmation($mail2, $content2);

                $success = "Un mail a été envoyé aux 2 joueurs";
            } else {
                $error = "Impossible d'échanger vos numéros... Contactez nous soit sur le mail PoulpyShow@ensc.fr, soit le messenger poulpyshow, soit en personne";
            }
        }
    } else {
        $error = "Vous n'avez pas rempli tout les champs";
    }

    $_SESSION['error'] = $error;
    header("Location: exchange.php", true, 303);
    exit();
} elseif ($request_method === 'GET') {
    if (isset($_SESSION['error'])) {
        $error = $_SESSION['error'];
        unset($_SESSION['error']);
    }
}


?>

<!doctype html>
<html>

<?php
$pageTitle = "Echange";
require_once("../includes/head.php") ?>

<body>
    <?php require("../includes/navigation.php") ?>
    <div class="container">
        <h1 class="pb-2">Echange numéros boites</h1>
        <section>
            <div class="wrapper-sect">
                <?php if (!empty($error) && $error != "") { ?>
                    <div class="alert alert-danger">
                        <strong>Erreur !</strong>
                        <?= $error ?>
                    </div>
                <?php } ?>
                <?php if (!empty($success) && $success != "") { ?>
                    <div class="alert alert-success">
                        <strong>Génial !</strong>
                        <?= $success ?>
                    </div>
                <?php } ?>
                <form method="post" action="">
                    <label for="mail1">Email joueur 1</label>
                    <select name="mail1" id="mail1" required>
                        <option value="">--- Choisi un email ---</option>
                        <?php foreach ($emails as $email) { ?>
                            <option value=<?= $email["email"]  ?>><?= $email["email"]  ?></option>
                        <?php }; ?>
                    </select>

                    <label for="mail2">Email joueur 2</label>
                    <select name="mail2" id="mail2" required>
                        <option value="">--- Choisi un email ---</option>
                        <?php foreach ($emails as $email) { ?>
                            <option value=<?= $email["email"]  ?>><?= $email["email"] ?></option>
                        <?php }; ?>
                    </select>
                    <input type="submit" value="Valider" id="btn-exchange" disabled>
                </form>
            </div>
        </section>

    </div>
    <?php require("../includes/footer.php") ?>
</body>
<script src="../js/exchange.js"></script>

</html>