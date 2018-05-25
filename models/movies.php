<?php

function getAllMovies() {
    // requete
    include "model.php";
    $query = $bdd->query("SELECT * FROM `movie`");
    $resultat = $query->fetchAll();
    return $resultat;
}

function getMovie($id) {
    include "model.php";
    $query = $bdd->query("SELECT * FROM `movie` WHERE id = ".$id);
    $resultat = $query->fetch();
    return $resultat;
}

function getActor($id) {
    include "model.php";
    $actor = $bdd->prepare('SELECT * FROM actor INNER JOIN movie_actor ON movie_actor.actor_id = actor.id WHERE movie_actor.movie_id = '.$id);
    $actor->execute();
    $actorAnswer = $actor->fetchAll();
    return $actorAnswer;
}
function getGender($id) {
    include "model.php";
    $gender = $bdd->prepare('SELECT * FROM gender INNER JOIN movie_gender ON movie_gender.gender_id = gender.id WHERE movie_gender.movie_id = '.$id);
    $gender->execute();
    $genderAnswer = $gender->fetchAll();
    return $genderAnswer;
}
function getDirector($id) {
    include "model.php";
    $director = $bdd->prepare('SELECT * FROM director INNER JOIN movie_director ON movie_director.director_id = director.id WHERE movie_director.movie_id = '.$id);
    $director->execute();
    $directorAnswer = $director->fetchAll();
    return $directorAnswer;
}
?>