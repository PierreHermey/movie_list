
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
          
//     case 'detail':
//          detailPage();
//          break;
//
//     default:
//          header('HTTP/1.0 404 Not Found');
//          require './views/404.php';
//          break;
}
?>

