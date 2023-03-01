<?php
require_once('../settings/connexion.php');
require __DIR__ . '/../sqlQuery.php';
$request_method = strtoupper($_SERVER['REQUEST_METHOD']);
if ($request_method === 'GET') {
    if (!empty($_GET['mail1']) and !empty($_GET['mail2'])) {
        $mail1 = $_GET['mail1'];
        $mail2 = $_GET['mail2'];
        $stmt = exchangeNumber($pdo, $mail1, $mail2);
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