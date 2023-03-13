<?php
require_once('../settings/connexion.php');
require __DIR__ . '/../sqlQuery.php';

$request_method = strtoupper($_SERVER['REQUEST_METHOD']);
if ($request_method === 'POST') {
    if (!empty($_POST['nom']) and !empty($_POST['prenom']) and !empty($_POST['email'])) {
        $name = $_POST['prenom'];
        $famName = $_POST['nom'];
        $email = $_POST['email'];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Separate string by @ characters (there should be only one)
            $parts = explode('@', $email);

            // Remove and return the last part, which should be the domain
            $domain = array_pop($parts);
            var_dump($domain);

            if ($domain == "@esnc.fr") {
                var_dump("here");
                createPlayer($pdo, $name, $famName, $email);
            }
        }
    }
}
?>

<!doctype html>
<html>

<?php
$pageTitle = "Joueurs";
require_once("../includes/head.php") ?>

<body>
    <?php require("../includes/navigation.php") ?>
    <div class="container">

        <h1 class="pb-2">Inscription</h1>
        <section>
            <div class="wrapper-sect">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom-register" name="nom" required>
                    </div>
                    <div class="mb-3">
                        <label for="prenom" class="form-label">Prenom</label>
                        <input type="text" class="form-control" id="prenom-register" name="prenom" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email ENSC</label>
                        <input type="email" class="form-control" id="email-register" name="email" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-apoal">S'inscrire</button>
                </form>
            </div>
        </section>

        <div style="text-align: center; margin-top: 2%;"> <img src="../assets/registration_player.gif" alt="meme-gif-Deal-or-not-deal">
        </div>

    </div>
    <?php require("../includes/footer.php") ?>
</body>

</html>