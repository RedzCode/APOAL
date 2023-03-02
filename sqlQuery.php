<?php
function getAllPlayers($pdo)
{
    $query = "SELECT Name, FamilyName, Email, LastExchangeDate, NumBox FROM player";

    $stmt = $pdo->prepare($query);
    $stmt->execute();

    return $stmt;
}

function getNumBoxes($pdo, $mail1, $mail2)
{
    $query = "SELECT NumBox FROM player Where Email in ( :mail1, :mail2)";

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':mail1', $mail1);
    $stmt->bindValue(':mail2', $mail2);
    $stmt->execute();

    return $stmt;
}

function exchangeNumber($pdo, $mail1, $mail2)
{
    $numBoxes = getNumBoxes($pdo, $mail1, $mail2)->fetchAll();

    $numbox1 = $numBoxes[0]['NumBox'];
    $numbox2 = $numBoxes[1]['NumBox'];

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

function createExchange($pdo, $mail1, $mail2)
{
    $query = "Insert Into exchange (`mail1`, `mail2`) VALUES (:mail1,:mail2) ";

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':mail1', $mail1);
    $stmt->bindValue(':mail2', $mail2);
    $success = $stmt->execute();

    return $success;
}

function getNumExchange($pdo, $mail1, $mail2)
{
    $query = "SELECT numExchange FROM exchange Where mail1 = :mail1 and mail2 = :mail2";

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':mail1', $mail1);
    $stmt->bindValue(':mail2', $mail2);
    $stmt->execute();

    return $stmt;
}

function getEmailsPlayers($pdo, $num)
{
    $query = "SELECT mail1, mail2 FROM exchange Where numExchange = :num";

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':num', $num);
    $stmt->execute();

    return $stmt;
}

function deleteExchange($pdo, $num)
{
    $query = "DELETE FROM `exchange` WHERE numExchange = :num";

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':num', $num);
    $stmt->execute();

    return $stmt;
}