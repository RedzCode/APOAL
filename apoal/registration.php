<?php
require_once('../settings/connexion.php');
require __DIR__ . '/../sqlQuery.php';
session_start();

$request_method = strtoupper($_SERVER['REQUEST_METHOD']);
if ($request_method === 'POST') {
    if (!empty($_POST['nom']) and !empty($_POST['prenom']) and !empty($_POST['email'])) {
        $name = $_POST['prenom'];
        $famName = $_POST['nom'];
        $email = $_POST['email'];

        $emails = getAllEmails($pdo)->fetchAll();

        $identique = false;
        foreach ($emails as $emailTaken) {
            if (strtolower($email) == strtolower($emailTaken[0])) {
                $identique = true;
            }
        }
        if ($identique) {
            $error = "L'email " . $email . " est déjà utilisé";
        } else if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Separate string by @ characters (there should be only one)
            $parts = explode('@', $email);

            // Remove and return the last part, which should be the domain
            $domain = array_pop($parts);

            if ($domain == "ensc.fr") {
                createPlayer($pdo, $name, $famName, $email);
                $_SESSION['email'] = $email;
                $success = "Votre profil de joueur a été crée!";
            } else {
                $error = "L'email doit être un mail ensc.fr";
            }
        } else {
            $error = "L'email n'est pas dans un format correct ex: email@ensc.fr";
        }
    } else {
        $error = "Vous n'avez pas rempli tout les champs";
    }

    $_SESSION['error'] = $error;

    $_SESSION['success'] = $success;
    header("Location: registration.php", true, 303);
    exit();
} elseif ($request_method === 'GET') {
    if (isset($_SESSION['error'])) {
        $error = $_SESSION['error'];
        unset($_SESSION['error']);
    }
    if (isset($_SESSION['success'])) {
        $success = $_SESSION['success'];
        unset($_SESSION['success']);
    }
    if (isset($_SESSION['email'])) {
        $emailPlayer = $_SESSION['email'];
        unset($_SESSION['email']);
    }
}
?>

<!doctype html>
<html>

<?php
$pageTitle = "Inscription";
require_once("../includes/head.php") ?>

<body>
    <?php require("../includes/navigation.php") ?>
    <div class="container">

        <h1 class="pb-2">Inscription APOAL</h1>
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
                        <p><a href="player.php?email=<?= $emailPlayer ?>">Voir votre profil</a></p>
                    </div>
                <?php } ?>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="prenom" class="form-label">Prenom</label>
                        <input type="text" class="form-control" id="prenom-register" name="prenom" required>
                    </div>
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom-register" name="nom" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email ENSC</label>
                        <input type="email" class="form-control" id="email-register" name="email" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-apoal">S'inscrire</button>
                </form>
            </div>
        </section>

        <div style="text-align: center; margin-top: 2%;"> <img class="img-gif" src="../assets/registration_player.gif" alt="meme-gif-Deal">
        </div>

    </div>
    <?php require("../includes/footer.php") ?>
</body>

</html>