<?php
try
        {
	        $bdd = new PDO('mysql:host=localhost:3308;dbname=gbaf2;charset=utf8', 'root', '');
        }
            catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
