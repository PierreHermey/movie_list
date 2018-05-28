
<?php
require 'controlers/movie.php';

// routeur
switch($_GET['page']) {
    
    case 'home':
    indexPage();
    break;
    
    case 'detail':
    include "model.php";
    $id = $_GET['id'];
    $title = $bdd->prepare("SELECT title FROM movie where id LIKE $id");
    $title->execute();
    $title = $title->fetchAll();
    $title = str_replace(' ', '+', $title[0]['title']);
    detailPage($id, $title);
    break;
    
}
?>

