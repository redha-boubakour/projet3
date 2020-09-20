<?php

require 'bdd.php';

function getEmailIfExist($email) {
    global $bdd;
        $requser = $bdd->prepare('SELECT * FROM user WHERE email = ?');
        $requser->execute(array($email));
        return $requser->fetch();
    }

function getUserEmailIfExist($email) {
    global $bdd;
        $req = $bdd->prepare('SELECT * FROM user WHERE email = ?');
        $req->execute(array($email));
        return $req->rowCount();
    }

function getUserUsernamefExist($username) {
    global $bdd;
        $req = $bdd->prepare('SELECT * FROM user WHERE username = ?');
        $req->execute(array($username));
        return $req->rowCount();
    }

function getUser($loginconnect) {
    global $bdd;
        $req =  $bdd->prepare('SELECT * FROM user WHERE username = ?');
        $req->execute(array($loginconnect));
        return $req->fetch();
    }

function getActor() {
    global $bdd;
        $req = $bdd->query("SELECT * FROM actor WHERE id = '{$_GET[ "id" ]}'");
        return $req->fetch();
    }

function getActors() {
    global $bdd;
        $req = $bdd->query('SELECT * FROM actor ORDER BY id ASC');
        return $req->fetchall();
    }

function getVote() {
    global $bdd;
        $req = $bdd->query("SELECT * FROM vote WHERE (login_id = '{$_SESSION['id']}' AND actor_id = '{$_GET[ "id" ]}')");
        return $req->fetch();
    }

function getTotalCommentsByActor() {
    global $bdd;
        $req = $bdd->query("SELECT * FROM comment WHERE actor_id = '{$_GET[ "id" ]}'");
        return $req->rowCount();
    }

function addUser($new_username, $new_email, $pass_hache, $new_question, $new_answer, $new_firstname, $new_lastname, $created_at) {
    global $bdd;
        $req = $bdd->prepare('
            INSERT INTO user(username, email, password, question, answer, firstname, lastname, created_at)
            VALUES(:username, :email, :password, :question, :answer, :firstname, :lastname, :created_at)
        ');
        $req->execute(array(
            'username' => $new_username,
            'email' => $new_email,
            'password' => $pass_hache,
            'question' => $new_question,
            'answer' => $new_answer,
            'firstname' => $new_firstname,
            'lastname' => $new_lastname,
            'created_at' => $created_at
        ));
    }

function addComment($insert_comment, $created_at, $actor_id, $login_id) {
    global $bdd;
        $req = $bdd->prepare('
            INSERT INTO comment(content, created_at, actor_id, login_id)
            VALUES(:content, :created_at, :actor_id, :login_id)
        ');
        $req->execute(array(
            'content' => $insert_comment,
            'created_at' => $created_at,
            'actor_id' => $actor_id,
            'login_id' => $login_id
        ));
    }

function addPositiveVote($positive_vote, $actor_id, $login_id) {
    global $bdd;
        $req = $bdd->prepare('
            INSERT INTO vote(vote, actor_id, login_id)
            VALUES(:vote, :actor_id, :login_id)
        ');
        $req->execute(array(
            'vote' => $positive_vote,
            'actor_id' => $actor_id,
            'login_id' => $login_id
        ));
    }

function addNegativeVote($negative_vote, $actor_id, $login_id) {
    global $bdd;
        $req = $bdd->prepare('
            INSERT INTO vote(vote, actor_id, login_id)
            VALUES(:vote, :actor_id, :login_id)
        ');
        $req->execute(array(
            'vote' => 0,
            'actor_id' => $actor_id,
            'login_id' => $login_id
        ));
    }

function joinCommentUserById() {
    global $bdd;
        $req = $bdd->query('
            SELECT comment.content, comment.created_at, comment.actor_id, user.username
            FROM comment
            INNER JOIN user
            ON comment.login_id = user.id
            ORDER BY created_at DESC
        ');
        return $req->fetchAll();
    }

function updatePositiveVoteForActor() {
    global $bdd;
        $req = $bdd->prepare("
            UPDATE actor
            SET positive_vote = positive_vote + 1
            WHERE id = '{$_GET[ "id" ]}'
        ");
        return $req->execute();
    }

function updateNegativeVoteForActor() {
    global $bdd;
        $req = $bdd->prepare("
            UPDATE actor
            SET negative_vote = negative_vote + 1
            WHERE id = '{$_GET[ "id" ]}'
        ");
        return $req->execute();
    }

function updateUsername($new_username, $id) {
    global $bdd;
        $req = $bdd->prepare("
            UPDATE user
            SET username = '$new_username'
            WHERE id = '$id'
        ");
        $req->execute();
    }

function updatePass($pass_hache, $email) {
    global $bdd;
        $req = $bdd->prepare("
            UPDATE user
            SET password = '$pass_hache'
            WHERE email = '$email'
                    ");
        $req->execute();
    }

function updateEmail($new_email, $id) {
    global $bdd;
        $req = $bdd->prepare("
            UPDATE user
            SET email = '$new_email'
            WHERE id = '$id'
        ");
        $req->execute();
    }

function updateFirstname($new_firstname, $id) {
    global $bdd;
        $req = $bdd->prepare("
            UPDATE user
            SET firstname = '$new_firstname'
            WHERE id = '$id'
        ");
        $req->execute();
    }

function updateLastname($new_lastname, $id) {
    global $bdd;
        $req = $bdd->prepare("
            UPDATE user
            SET lastname = '$new_lastname'
            WHERE id = '$id'
        ");
        $req->execute();
    }

function updateQuestion($new_question, $id) {
    global $bdd;
        $req = $bdd->prepare("
            UPDATE user
            SET question = '$new_question'
            WHERE id = '$id'
        ");
        $req->execute();
    }

function updateAnswer($new_answer, $id) {
    global $bdd;
        $req = $bdd->prepare("
            UPDATE user
            SET answer = '$new_answer'
            WHERE id = '$id'
        ");
        $req->execute();
    }