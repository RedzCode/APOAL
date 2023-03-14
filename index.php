<?php
require(__DIR__ . '/vendor/autoload.php');
require_once('settings/connexion.php');
require('sqlQuery.php');
//header("Location: apoal/players.php");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PoulpyShow</title>
    <link rel="stylesheet" href="style/index.css">
    <link href="style/style.css" rel="stylesheet">
    <link href="style/players.css" rel="stylesheet">
    <link href="style/nav.css" rel="stylesheet">
    <link href="style/exchange.css" rel="stylesheet">
    <link href="style/footer.css" rel="stylesheet">

    <!-- Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>

    <!-- Font-awesome -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js"
        integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="container">
        <div class="banniere" id="banniere-web">
            <a href="apoal/registration.php"><img class="banniere-img" src="/assets/banniere.PNG" alt="banniere"></a>
        </div>
        <div class="banniere" id="banniere-mobile">
            <a href="apoal/registration.php"><img class="banniere-img" src="/assets/banniere-mobile.PNG"
                    alt="banniere"></a>
        </div>
        <div class="planning">
            <img class="planning-img" src="/assets/planning.png" alt="planning">
        </div>

    </div>
    <?php require("includes/footer.php") ?>
</body>

</html>