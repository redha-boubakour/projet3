<?php

require 'bdd.php';

function getUserIfExist($email) {
            global $bdd;
                $req = $bdd->prepare('SELECT * FROM user WHERE email = ?');
                $req->execute(array($email));
                return $req->rowCount();
            }