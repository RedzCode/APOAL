<?php
require '../vendor/autoload.php';
require_once('../settings/connexion.php');
require_once('../sendmail.php');
require __DIR__ . '/../sqlQuery.php';
$emails = getAllEmails($pdo)->fetchAll();

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
            var_dump("Vous avez déjà fait un échange enseemble");
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

                echo "<script>alert('Un mail de confirmation a été envoyé aux 2 joueurs')</script>";
            }
        }
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
    <!-- <h1>Echange entre joueurs</h1> -->
    <section class="container">
        <div class='wrapper-form'>
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
    <?php require("../includes/footer.php") ?>
</body>
<script src="../js/exchange.js"></script>

</html>