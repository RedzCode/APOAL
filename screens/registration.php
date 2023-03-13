<?php
require_once('../settings/connexion.php');
require __DIR__ . '/../sqlQuery.php';
var_dump(createPlayer($pdo, "defg", "ddd", "fef"));
$request_method = strtoupper($_SERVER['REQUEST_METHOD']);
if ($request_method === 'POST') {
    if (!empty($_POST['nom']) and !empty($_POST['prenom']) and !empty($_POST['email'])) {
        $name = $_POST['prenom'];
        $famName = $_POST['nom'];
        $email = $_POST['email'];
        createPlayer($pdo, $name, $famName, $email);
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
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email-register" name="email" required>
                </div>
                <button type="submit" class="btn btn-primary">S'inscrire</button>
            </form>

        </section>
        <div style="text-align: center;"> <img src="../assets/registration_player.gif" alt="meme-gif-Deal-or-not-deal">
        </div>

    </div>
    <?php require("../includes/footer.php") ?>
</body>

</html>