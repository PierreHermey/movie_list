<?php
try{
    $bdd = new PDO('mysql:host=localhost;dbname=DB_Movie2;charset=utf8', 'root', 'root');
  }
  catch (Exception $e){
    die('Erreur : ' . $e->getMessage());
  }
  
  ?>