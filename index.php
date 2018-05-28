
<?php
require 'controlers/movie.php';

// routeur
switch($_GET['page']) {
    
    case 'home':
    indexPage();
    break;
    
    case 'detail':
    detailPage($_GET['id']);
    break;
    
}
?>

