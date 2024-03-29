<?php
require '../vendor/autoload.php';
require_once('../settings/connexion.php');
require_once('../sendmail.php');
require __DIR__ . '/../sqlQuery.php';
session_start();

$emails = getAllEmails($pdo)->fetchAll();

$request_method = strtoupper($_SERVER['REQUEST_METHOD']);
if ($request_method === 'POST') {
    if (!empty($_POST['mail1']) and !empty($_POST['mail2'])) {
        $mail1 = $_POST['mail1'];
        $mail2 = $_POST['mail2'];

        $identique1 = false;
        $identique2 = false;
        foreach ($emails as $emailTaken) {
            if (strtolower($mail1) == strtolower($emailTaken[0])) {
                $identique1 = true;
            }
            if (strtolower($mail2) == strtolower($emailTaken[0])) {
                $identique2 = true;
            }
        }

        if ($identique1 && $identique2) {
            $code1 = random_int(0, 499);
            $code2 = random_int(500, 1000);

            $lastExchangePlayer1 = (getLastExchangePlayer($pdo, $mail1)->fetch())[0];
            $lastExchangePlayer2 = (getLastExchangePlayer($pdo, $mail2)->fetch())[0];

            if ($lastExchangePlayer1 == $mail2 && $lastExchangePlayer2 == $mail1) {
                $error = "Impossible de faire un échange entre deux même joueurs à la suite. \nAu moins un des joueurs doit faire un échange avec un autre joueur";
            } else {
                if (createExchange($pdo, $mail1, $mail2, $code1, $code2)) {
                    $resnum = getNumExchange($pdo, $mail1, $mail2)->fetchAll();
                    $num = $resnum[sizeof($resnum) - 1]['numExchange'];
                    $numCrypted = password_hash($num, PASSWORD_BCRYPT);

                    $content1 = 'https://www.poulpy-show.com/apoal/validation.php?num='
                        . $numCrypted . '-' . $num . '&code=' . $code1;
                    $content2 = 'https://www.poulpy-show.com/apoal/validation.php?num='
                        . $numCrypted . '-' . $num . '&code=' . $code2;

                    $opponent1 = getNamePlayer($pdo, $mail2)->fetch();
                    $opponent2 = getNamePlayer($pdo, $mail1)->fetch();
                    SendEmail::SendMailConfirmation($mail1, $opponent1['Name'] . " " . $opponent1['FamilyName'], $content1);
                    SendEmail::SendMailConfirmation($mail2, $opponent2['Name'] . " " . $opponent2['FamilyName'], $content2);

                    $success = "Un mail a été envoyé aux 2 joueurs";
                } else {
                    $error = "Impossible d'échanger vos numéros... Contactez nous soit sur le mail PoulpyShow@ensc.fr, soit le messenger poulpyshow, soit en personne";
                }
            }
        } else {
            $error = "L'un des mails n'appartient à aucun des deux joueurs!";
        }
    } else {
        $error = "Vous n'avez pas rempli tout les champs";
    }

    $_SESSION['error'] = $error;
    $_SESSION['success'] = $success;
    header("Location: exchange.php", true, 303);
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
}


?>

<!doctype html>
<html>

<?php
$pageTitle = "Echange";
require_once("../includes/head.php") ?>

<body>
    <?php require("../includes/navigation.php") ?>
    <div class="container">
        <h1 class="pb-2">Echange numéros boites</h1>
        <section>
            <div class="wrapper-sect">
                <div class="alert alert-danger">
                    <strong>Le jeu est fini ! Il n'est plus possible de faire des échanges.</strong>
                    <?= $error ?>
                </div>
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
                    </div>
                <?php } ?>
                <form method="post" action="">
                    <div><label for="mail1">Email joueur 1</label>
                        <div id="myDropdown1" class="dropdown-content">
                            <input type="email" name="mail1" placeholder="Search.." id="myInput1" class="myInput" onkeyup="filterFunction(this)" onclick="toggleList(this)" required>
                            <div id="dropdow-hidden1" class="dropdown-hidden">
                                <?php foreach ($emails as $email) { ?>
                                    <p onclick="selectMail(this)" class="mails1"><?= $email["email"]  ?></p>
                                <?php }; ?>
                            </div>
                        </div>
                        <label for="mail2">Email joueur 2</label>
                        <div id="myDropdown2" class="dropdown-content">
                            <input type="email" name="mail2" placeholder="Search.." id="myInput2" class="myInput" onkeyup="filterFunction(this)" onclick="toggleList(this)" required>
                            <div id="dropdow-hidden2" class="dropdown-hidden">
                                <?php foreach ($emails as $email) { ?>
                                    <p onclick="selectMail(this)" class="mails2"><?= $email["email"]  ?></p>
                                <?php }; ?>
                            </div>
                        </div>
                    </div>
                    <input type="submit" value="Valider" id="btn-exchange" disabled>
                </form>
            </div>
        </section>

    </div>
    <?php require("../includes/footer.php") ?>
</body>
<script src="../js/exchange.js"></script>
<script>
    function selectMail(element) {
        var input;
        if (element.classList.contains("mails1")) {
            input = document.getElementById("myInput1");
        } else {
            input = document.getElementById("myInput2");
        }
        input.textContent = element.textContent;
        input.value = element.textContent;
        filterFunction(input);
    }

    function filterFunction(element) {
        var input, filter, ul, li, a, i;
        console.log(element);
        input = element;
        if (element.id == "myInput1") {
            div = document.getElementById("dropdow-hidden1");
        } else if (element.id == "myInput2") {
            div = document.getElementById("dropdow-hidden2");
        }

        filter = input.value.toUpperCase();
        a = div.getElementsByTagName("p");
        for (i = 0; i < a.length; i++) {
            txtValue = a[i].textContent || a[i].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                a[i].style.display = "";
            } else {
                a[i].style.display = "none";
            }
        }
    }

    function toggleList(element) {
        var input;
        input = element;
        if (element.id == "myInput1") {
            div = document.getElementById("dropdow-hidden1");
            div.classList.toggle("show");
        } else if (element.id == "myInput2") {
            div = document.getElementById("dropdow-hidden2");
            div.classList.toggle("show");
        }
    }
</script>

</html>