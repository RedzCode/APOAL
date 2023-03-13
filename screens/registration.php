<?php
require_once('../settings/connexion.php');
require __DIR__ . '/../sqlQuery.php';
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
            <form>
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
                    <input type="mail" class="form-control" id="email-register" name="email" required>
                </div>
                <button type="submit" class="btn btn-primary">S'inscrire</button>
            </form>
            <img src="../assets/registration_player.gif" alt="meme-gif-Deal-or-not-deal">
        </section>
    </div>
    <?php require("../includes/footer.php") ?>
</body>

</html>