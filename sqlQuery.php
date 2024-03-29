<?php
function getAllPlayers($pdo)
{
    $query = "SELECT * FROM player ORDER BY CountExchange DESC, Name";

    $stmt = $pdo->prepare($query);
    $stmt->execute();

    return $stmt;
}

function getNamePlayer($pdo, $email)
{
    $query = "SELECT Name, FamilyName FROM player where Email=:email ";

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':email', $email);
    $stmt->execute();

    return $stmt;
}

function getInfoPlayer($pdo, $email)
{
    $query = "SELECT Name, FamilyName, Email, NumBox FROM player where Email=:email ";

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':email', $email);
    $stmt->execute();

    return $stmt;
}


function createPlayer($pdo, $name, $familyName, $email)
{
    $numbox = getNextNumBox($pdo);

    $query = "INSERT INTO `player` (`Name`, `FamilyName`, `Email`, `NumBox`) VALUES (:name,:familyName,:email,:numbox) ";

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':familyName', $familyName);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':numbox', $numbox);
    $stmt->execute();

    return $stmt;
}


function getNextNumBox($pdo)
{
    $query = "SELECT MAX(NumBox) FROM player";

    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $val = (int) ($stmt->fetch())[0];
    $val++;

    return $val;
}



function getNumBox($pdo, $mail)
{
    $query = "SELECT NumBox FROM player Where Email = :mail";

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':mail', $mail);
    $stmt->execute();

    return $stmt;
}

function exchangeNumber($pdo, $mail1, $mail2)
{
    $numbox1 = (getNumBox($pdo, $mail1)->fetch())['NumBox'];
    $numbox2 = (getNumBox($pdo, $mail2)->fetch())['NumBox'];

    $query = "UPDATE player SET NumBox = :numbox WHERE Email= :email";

    $stmttmp = $pdo->prepare($query);
    $stmttmp->bindValue(':numbox', $numbox2 * -1);
    $stmttmp->bindValue(':email', $mail1);

    $success = $stmttmp->execute();

    if ($success) {
        $stmt1 = $pdo->prepare($query);
        $stmt1->bindValue(':numbox', $numbox1);
        $stmt1->bindValue(':email', $mail2);

        $stmt2 = $pdo->prepare($query);
        $stmt2->bindValue(':numbox', $numbox2);
        $stmt2->bindValue(':email', $mail1);

        $success = $stmt1->execute();
        $success = $stmt2->execute();
    }

    return $success;
}

function createExchange($pdo, $mail1, $mail2, $code1, $code2)
{
    $query = "Insert Into ongoingexchange (`mail1`, `mail2`,`code1`, `code2`) VALUES (:mail1,:mail2, :code1, :code2) ";

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':mail1', $mail1);
    $stmt->bindValue(':mail2', $mail2);
    $stmt->bindValue(':code1', $code1);
    $stmt->bindValue(':code2', $code2);
    $success = $stmt->execute();

    return $success;
}

function getNumExchange($pdo, $mail1, $mail2)
{
    $query = "SELECT numExchange FROM ongoingexchange Where mail1 = :mail1 and mail2 = :mail2";

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':mail1', $mail1);
    $stmt->bindValue(':mail2', $mail2);
    $stmt->execute();

    return $stmt;
}

function getExchange($pdo, $numExchange)
{
    $query = "SELECT * FROM ongoingexchange Where numExchange = :numExchange";

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':numExchange', $numExchange);
    $stmt->execute();

    return $stmt;
}

function setValidate($pdo, $numExchange, $nb)
{
    if ($nb == 1)
        $query = "UPDATE ongoingexchange SET validate1 = 1 WHERE numExchange = :numExchange";
    else
        $query = "UPDATE ongoingexchange SET validate2 = 1 WHERE numExchange = :numExchange";

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':numExchange', $numExchange);
    $stmt->execute();

    return $stmt;
}


function getEmailsPlayers($pdo, $num)
{
    $query = "SELECT mail1, mail2 FROM ongoingexchange Where numExchange = :num";

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':num', $num);
    $stmt->execute();

    return $stmt;
}

function getAllEmails($pdo)
{
    $query = "SELECT email FROM player";

    $stmt = $pdo->prepare($query);
    $stmt->execute();

    return $stmt;
}

function saveExchange($pdo, $mail1, $mail2, $date, $numero1, $numero2)
{

    $query = "INSERT INTO `doneexchange` (`mail1`, `mail2`, `ExchangeDate`,`NumBox1`,`NumBox2`	) VALUES (:mail1,:mail2,:date, :numero1, :numero2) ";

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':mail1', $mail1);
    $stmt->bindValue(':mail2', $mail2);
    $stmt->bindValue(':date', $date);
    $stmt->bindValue(':numero1', $numero1);
    $stmt->bindValue(':numero2', $numero2);
    $stmt->execute();

    return $stmt;
}

function deleteExchange($pdo, $numExchange, $mail1, $mail2, $date)
{
    $numero1 = (getNumBox($pdo, $mail2)->fetch())[0];
    $numero2 = (getNumBox($pdo, $mail1)->fetch())[0];

    $stmt = saveExchange($pdo, $mail1, $mail2, $date, $numero1, $numero2);
    if ($stmt) {
        $stmt1 = updatePlayersInfos($pdo, $mail1, $mail2);
        $stmt2 = updatePlayersInfos($pdo, $mail2, $mail1);
        if ($stmt1 and $stmt2) {
            $query = "DELETE FROM `ongoingexchange` WHERE numExchange = :numExchange";

            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':numExchange', $numExchange);
            $stmt->execute();
        }
    }

    return $stmt;
}

function updatePlayersInfos($pdo, $emailPlayer, $emailOpponent)
{

    $query = "UPDATE player SET CountExchange = CountExchange + 1, LastExchangeMail = :emailOpponent  WHERE Email= :emailPlayer";

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':emailOpponent', $emailOpponent);
    $stmt->bindValue(':emailPlayer', $emailPlayer);
    $success = $stmt->execute();

    return $success;
}

function getAllDoneExchange($pdo)
{
    $query = "SELECT * FROM doneexchange";

    $stmt = $pdo->prepare($query);
    $stmt->execute();

    return $stmt;
}

function getLastExchangePlayer($pdo, $emailPlayer)
{
    $query = "SELECT LastExchangeMail FROM player WHERE Email = :emailPlayer";

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':emailPlayer', $emailPlayer);
    $stmt->execute();

    return $stmt;
}

function loadBox($pdo)
{
    for ($i = 15; $i <= 200; $i++) {
        $query = "INSERT INTO `box`(`NumBox`, `NbExchange`) VALUES ($i,'0')";
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        $j = $i * -1;
        $query = "INSERT INTO `box`(`NumBox`, `NbExchange`) VALUES ($j,'0')";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
    }
    return $stmt;
}
