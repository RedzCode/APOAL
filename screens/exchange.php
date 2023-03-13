<?php

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require '../vendor/autoload.php';
require_once('../settings/connexion.php');
require __DIR__ . '/../sqlQuery.php';
$emails = getAllEmails($pdo)->fetchAll();

// handle error

$request_method = strtoupper($_SERVER['REQUEST_METHOD']);
if ($request_method === 'POST') {
    $log = new Logger('name');
    $log->pushHandler(new StreamHandler('php://stderr', Level::Warning));

    $log->warning('Foo');
    if (!empty($_POST['mail1']) and !empty($_POST['mail2'])) {
        $mail1 = $_POST['mail1'];
        $mail2 = $_POST['mail2'];
        $code1 = random_int(0, 499);
        $code2 = random_int(500, 1000);

        if (createExchange($pdo, $mail1, $mail2, $code1, $code2)) {
            $resnum = getNumExchange($pdo, $mail1, $mail2)->fetchAll();
            $num = $resnum[sizeof($resnum) - 1]['numExchange'];
            $numCrypted = password_hash($num, PASSWORD_BCRYPT);

            $content1 = 'Confirmez vous l echange ? Cliquez sur ce lien: https://www.poulpy-show.com/screens/validation.php?num='
                . $numCrypted . '-' . $num . '&code=' . $code1;
            $content2 = 'Confirmez vous l echange ? Cliquez sur ce lien: https://www.poulpy-show.com/screens/validation.php?num='
                . $numCrypted . '-' . $num . '&code=' . $code2;
            echo $content1;
            echo '</br>';
            echo $content2;
            echo "<script>alert('Un mail de confirmation a été envoyé aux 2 joueurs')</script>";
        }

        $log = new Logger('other');
        $log->pushHandler(new StreamHandler('php://stderr', Level::Warning));

        $log->warning('intoooooooooooooooooooooo');
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom("poulpyshow@ensc.fr", "poulpyShow");
        $email->setSubject("Confirmation échange");
        $email->addTo("maefortune@ensc.fr", "joueur");
        $email->addContent("text/plain", "Confirmation échange https://www.poulpy-show.com");
        $email->addContent(
            "text/html",
            "<strong>o gogogo </strong>"
        );
        $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
        try {
            $response = $sendgrid->send($email);
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
        } catch (Exception $e) {
            echo 'Caught exception: ' . $e->getMessage() . "\n";
        }

        /*  $content = 'Confirmez vous l echange ? Cliquez sur ce lien: http://localhost/apoal/screens/validation.php?mail1=' . $mail1 . '&mail2=' . $mail2;
        echo $content;
        echo "<script>alert('Un mail de confirmation a été envoyé aux 2 joueurs')</script>";*/
        /*$retour = mail($mail1, 'Confirmation échange', $content, 'From:' . $mail2);
        if ($retour) {
            echo '<p>Votre message a bien été envoyé.</p>';
            echo "<script>alert('Un mail de confirmation a été envoyé aux 2 joueurs')</script>";
        }*/
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
    <section>
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
</body>
<script src="../js/exchange.js"></script>

</html>