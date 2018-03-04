<?php
//Ajwinder Singh
//3/2/2018
//dbfunctions.php

//CREATE TABLE STATEMENT
//create table Members(
//    member_idIndex int(40) Not Null AUTO_INCREMENT,
//	  fname	text,
// 	  lname	text,
//	  age	tinyint(10),
//	  gender text,
//	  phone	char(20),
//	  email	char(40),
//	  state	char(10),
//	  seeking text,
//	  bio text,
//	  premium tinyint(1),
//	  image	char(40),
//	  interests	text,
//    PRIMARY key(member_id)
//)


/**
 * Class Dbfunctions
 *
 * This class defines the database functionality.
 *
 * This calss is used to get students and show in a table, show indiviual info,
 * insert student, to and from a database.
 *
 * @author Ajwinder Singh
 * @copyright 2018
 *
 */
class Dbfunctions
{
    /**
     * This method is used to connect to the database.
     *
     * @return PDO|void
     */
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

    /**
     * This method is used to get a single user info and show in a different html file.
     * It checks in the database and tries to match the first name.
     *
     * @param $fname
     * @return single Members Table row
     */
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

        //fetch the results
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        //return $result
        return $result;

    }

    /**
     * This method is used to get all the members, and show it in a table.
     * Sorted in alphabeticall order by last name.
     *
     * @return array of all the Members table rows.
     */
    function getMembers()
    {
        global $dbh;

        //select from the database in last name order
        $sql = "SELECT * FROM Members ORDER BY lname, fname";

        //prepare the statement
        $statement = $dbh->prepare($sql);

        //execute the statement
        $statement->execute();

        //fetch the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        //return $success
        return $result;
    }

    /**
     * This method is used to insert a memebers profile info to a database with following parameters as values.
     *
     * @param $memberID member id
     * @param $fname first name
     * @param $lname last name
     * @param $age age
     * @param $gender gender
     * @param $phone phone
     * @param $email email
     * @param $state state
     * @param $seeking seeking
     * @param $bio bio
     * @param $premium premium
     * @param $image image
     * @param $interests interests
     * @return retuns the execute statement
     */
    function insertMember($memberID, $fname, $lname, $age, $gender, $phone, $email, $state, $seeking, $bio, $premium, $image, $interests)
    {
        global $dbh;

        //insert to db
        $sql = "INSERT INTO Members VALUES (:memberID, :fname, :lname, :age, :gender, :phone, :email, :state, :seeking, :bio, :premium, :image, :interests)";

        //prepare statement
        $statement = $dbh->prepare($sql);

        //bind params
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

        //execute statement
        $success = $statement->execute();

        //return $success
        return $success;
    }
}

