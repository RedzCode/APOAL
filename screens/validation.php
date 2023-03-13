<?php
require_once('../settings/connexion.php');
require __DIR__ . '/../sqlQuery.php';

$texte = "Cet échange n'existe pas!";
$request_method = strtoupper($_SERVER['REQUEST_METHOD']);
if ($request_method === 'GET') {
    if (!empty($_GET['num']) and !empty($_GET['code'])) { //verify secret code
        $num = $_GET['num'];
        $index = strrpos($num, '-', 0);
        $numExchange = substr($num, $index + 1);

        $res = getExchange($pdo, $numExchange)->fetchAll();
        if (!empty($res)) {
            $code1 = $res[0]['code1'];
            $code2 = $res[0]['code2'];
            $code = $_GET['code'];

            if ($code ==  $code1 || $code == $code2) {
                $exchangeValidated = false;
                if ($code ==  $code1) {
                    setValidate($pdo, $numExchange, 1);
                    if ($res[0]['validate2'] == true)
                        $exchangeValidated = true;
                } else if ($code ==  $code2) {
                    setValidate($pdo, $numExchange, 2);
                    if ($res[0]['validate1'] == true)
                        $exchangeValidated = true;
                }

                if ($exchangeValidated) {
                    $mail1 = $res[0]['mail1'];
                    $mail2 = $res[0]['mail2'];
                    $stmt = exchangeNumber($pdo, $mail1, $mail2);
                    //wait exchange has been successful
                    $stmt = deleteExchange($pdo, $numExchange);
                    $texte = "Vos numéros ont été échangé! Que la chance soit avec vous !";
                    //mail confirmation ech ?
                } else {
                    $texte = "Merci d'avoir validé ! Echange en cours... En attente de votre partenaire";
                }
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
    <h1>Validation échange</h1>
    <section class="container">
        <div class='wrapper-form'>
            <?= $texte ?>
        </div>
    </section>
    <?php require("../includes/footer.php") ?>
</body>

</html>