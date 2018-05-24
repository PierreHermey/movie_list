<?php

try{
    $bdd = new PDO('mysql:host=localhost;dbname=movies;charset=utf8', 'psaulay', '');
  }
  catch (Exception $e){
    die('Erreur : ' . $e->getMessage());
  }
  
  ?>