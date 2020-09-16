<?php

require 'bdd.php';

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