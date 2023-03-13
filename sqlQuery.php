<?php
function getAllPlayers($pdo)
{
    $query = "SELECT * FROM player";

    $stmt = $pdo->prepare($query);
    $stmt->execute();

    return $stmt;
}

function createPlayer($pdo, $name, $familyName, $email)
{
    $numbox = 15;

    /*   $query = "INSERT INTO `player` (`Name`, `FamilyName`, `Email`, `NumBox`) VALUES (:name,:familyName,:email,:numbox) ";

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':familyName', $familyName);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':numbox', $numbox);
    $stmt->execute();

    return $stmt;*/
    return getNextNumBox($pdo);
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

function saveExchange($pdo, $num)
{
    $emails = getEmailsPlayers($pdo, $num)->fetchAll();
    $query = "INSERT INTO `doneexchange` (`mail1`, `mail2`) VALUES (:mail1,:mail2) ";

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':mail1', $emails[0]['mail1']);
    $stmt->bindValue(':mail2', $emails[0]['mail2']);
    $stmt->execute();

    return $stmt;
}

function deleteExchange($pdo, $num)
{
    $stmt = saveExchange($pdo, $num);
    if ($stmt) {
        $query = "DELETE FROM `ongoingexchange` WHERE numExchange = :num";

        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':num', $num);
        $stmt->execute();
    }

    return $stmt;
}

function getAllDoneExchange($pdo)
{
    $query = "SELECT * FROM doneexchange";

    $stmt = $pdo->prepare($query);
    $stmt->execute();

    return $stmt;
}
