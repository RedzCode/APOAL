<?php
require_once('../settings/connexion.php');
$request_method = strtoupper($_SERVER['REQUEST_METHOD']);
if ($request_method === 'POST') {
    if (!empty($_POST['mail1']) and !empty($_POST['mail2'])) {
        $mail1 = $_POST['mail1'];
        $mail2 = $_POST['mail2'];
        $content = 'Confirmez vous l echange ? Cliquez sur ce lien: http://localhost/apoal/screens/validation.php?mail1=' . $mail1 . '&mail2=' . $mail2;
        echo $content;
        echo "<script>alert('Un mail de confirmation a été envoyé aux 2 joueurs')</script>";
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
    <h1>Echange entre joueurs</h1>
    <section>
        <div class='wrapper-form'>
            <form method="post" action="">
                <label for="mail1">Email joueur 1</label>
                <input type="email" id="mail1" name="mail1" placeholder="Email du joueur 1" required>

                <label for="mail2">Email joueur 2</label>
                <input type="email" id="mail2" name="mail2" placeholder="Email du joueur 2" required>

                <input type="submit" value="Valider">
            </form>
        </div>
    </section>
</body>

</html>