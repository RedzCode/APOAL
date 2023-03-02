<?php
require_once('../settings/connexion.php');
require __DIR__ . '/../sqlQuery.php';
$request_method = strtoupper($_SERVER['REQUEST_METHOD']);
if ($request_method === 'GET') {
    if (!empty($_GET['num'])) { //verify secret code
        $code = $_GET['num'];
        $num = $code[strlen($code) - 1];
        $emails = getEmailsPlayers($pdo, $num)->fetchAll();
        $mail1 = $emails[0]['mail1'];
        $mail2 = $emails[0]['mail2'];
        $stmt = exchangeNumber($pdo, $mail1, $mail2);
        // Check both validate
        //Then delete
        $stmt = deleteExchange($pdo, $num);
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
    <h1>Validation échange</h1>
    <section>
        <div class='wrapper-form'>
            Vos numéros ont été échangé! Que la chance soit avec vous !
        </div>
    </section>
</body>

</html>