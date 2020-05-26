<?php
function connexpdo($base, $user, $password){
    try{
        $dbh=new PDO($base, $user, $password);
        return $dbh;
    } catch (PDOException $e){
        echo 'Connexion échouée '.$e->getMessage();
    }
}