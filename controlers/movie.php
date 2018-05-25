<?php

require 'models/movies.php';
require_once 'vendor/autoload.php';

function indexPage() {
    $films = getAllMovies();
    
    $loader = new Twig_Loader_Filesystem('templates');
    $twig = new Twig_Environment($loader);
    
    echo $twig->render('index.html', array(
        'movies' => $films
    ));
}

function detailPage($id) {
    $films = getAllMovies();
    $film = getMovie($id);
    $films = getAllMovies();
    $actor = getActor($id);
    $director = getDirector($id);
    $gender = getGender($id);
    
    $loader = new Twig_Loader_Filesystem('templates');
    $twig = new Twig_Environment($loader, array(
        'debug' => true,
    ));
    $twig->addExtension(new Twig_Extension_Debug());
    
    echo $twig->render('detail.html', array(
        'movie' => $film,
        'movies' => $films,
        'director' => $director,
        'actor' => $actor,
        'gender' => $gender,
        
    ));
}

?>     