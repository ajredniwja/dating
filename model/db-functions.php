<?php

function connect()
{
    try {
        //Instantiate a database object
        $dbh = new PDO(DB_DSN, DB_USERNAME,
            DB_PASSWORD );
        //echo "Connected to database!!!";
        return $dbh;
    }
    catch (PDOException $e) {
        echo $e->getMessage();
        return;
    }
}

function getMember($fname)
{

    global $dbh;

    //select from database
    $sql = "SELECT * FROM Members WHERE fname = :fname";

    $statement = $dbh->prepare($sql);

    //bind paramas
    $statement->bindParam(':fname', $fname, PDO::PARAM_INT);

    //execute
    $statement->execute();

    $result = $statement->fetch(PDO::FETCH_ASSOC);

    return $result;

}

function getMembers()
{
    global $dbh;

    $sql = "SELECT * FROM Members ORDER BY lname, fname";

    $statement = $dbh->prepare($sql);

    $statement->execute();

    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function insertStudent($memberID, $fname, $lname, $age, $gender, $phone, $email, $state, $seeking, $bio, $premium, $image, $interests)
{
    global $dbh;

    $sql = "INSERT INTO Members VALUES (:memberID, :fname, :lname, :age, :gender, :phone, :email, :state, :seeking, :bio, :premium, :image, :interests)";

    $statement = $dbh->prepare($sql);

    $statement->bindParam(':memberID', $memberID, PDO::PARAM_STR);
    $statement->bindParam(':fname', $fname, PDO::PARAM_STR);
    $statement->bindParam(':lname', $lname, PDO::PARAM_STR);
    $statement->bindParam(':age', $age, PDO::PARAM_STR);
    $statement->bindParam(':gender', $gender, PDO::PARAM_STR);
    $statement->bindParam(':phone', $phone, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':state', $state, PDO::PARAM_STR);
    $statement->bindParam(':seeking', $seeking, PDO::PARAM_STR);
    $statement->bindParam(':bio', $bio, PDO::PARAM_STR);
    $statement->bindParam(':premium', $premium, PDO::PARAM_STR);
    $statement->bindParam(':image', $image, PDO::PARAM_STR);
    $statement->bindParam(':interests', $interests, PDO::PARAM_STR);

    $success = $statement->execute();

    return $success;

}