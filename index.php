<?php
require(__DIR__ . '/vendor/autoload.php');
require_once('settings/connexion.php');
require __DIR__ . 'sqlQuery.php';
//header("Location: apoal/players.php");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PoulpyShow</title>

    <!-- Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>

    <!-- Font-awesome -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="container">
        <div></div>
        <div class="calendar">
            <div class="timeline">
                <div class="spacer"></div>
                <div class="time-marker">9 AM</div>
                <div class="time-marker">10 AM</div>
                <div class="time-marker">11 AM</div>
                <div class="time-marker">12 PM</div>
                <div class="time-marker">1 PM</div>
                <div class="time-marker">2 PM</div>
                <div class="time-marker">3 PM</div>
                <div class="time-marker">4 PM</div>
                <div class="time-marker">5 PM</div>
                <div class="time-marker">6 PM</div>
            </div>
            <div class="days">
                <div class="day mon">
                    <div class="date">
                        <p class="date-num">9</p>
                        <p class="date-day">Mon</p>
                    </div>
                    <div class="events">
                        <div class="event start-2 end-5 securities">
                            <p class="title">Securities Regulation</p>
                            <p class="time">2 PM - 5 PM</p>
                        </div>
                    </div>
                </div>
                <div class="day tues">
                    <div class="date">
                        <p class="date-num">12</p>
                        <p class="date-day">Tues</p>
                    </div>
                    <div class="events">
                        <div class="event start-10 end-12 corp-fi">
                            <p class="title">Corporate Finance</p>
                            <p class="time">10 AM - 12 PM</p>
                        </div>
                        <div class="event start-1 end-4 ent-law">
                            <p class="title">Entertainment Law</p>
                            <p class="time">1PM - 4PM</p>
                        </div>
                    </div>
                </div>
                <div class="day wed">
                    <div class="date">
                        <p class="date-num">11</p>
                        <p class="date-day">Wed</p>
                    </div>
                    <div class="events">
                        <div class="event start-12 end-1 writing">
                            <p class="title">Writing Seminar</p>
                            <p class="time">11 AM - 12 PM</p>
                        </div>
                        <div class="event start-2 end-5 securities">
                            <p class="title">Securities Regulation</p>
                            <p class="time">2 PM - 5 PM</p>
                        </div>
                    </div>
                </div>
                <div class="day thurs">
                    <div class="date">
                        <p class="date-num">12</p>
                        <p class="date-day">Thurs</p>
                    </div>
                    <div class="events">
                        <div class="event start-10 end-12 corp-fi">
                            <p class="title">Corporate Finance</p>
                            <p class="time">10 AM - 12 PM</p>
                        </div>
                        <div class="event start-1 end-4 ent-law">
                            <p class="title">Entertainment Law</p>
                            <p class="time">1PM - 4PM</p>
                        </div>
                    </div>
                </div>
                <div class="day fri">
                    <div class="date">
                        <p class="date-num">13</p>
                        <p class="date-day">Fri</p>
                    </div>
                    <div class="events">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require("../includes/footer.php") ?>
</body>

</html>