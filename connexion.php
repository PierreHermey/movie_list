<?php    

try{
        $bdd = new PDO('mysql:host=localhost;dbname=movies;charset=utf8', 'psaulay', '');
      }
      catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
      }
      
      
    $reponse_login = $bdd->prepare('SELECT login FROM connexion'); 
    $reponse_password = $bdd->prepare('SELECT mdp FROM connexion'); 
    $reponse_login->execute();
    $login = $reponse_login->fetch();
    $login = $login['login'];
    $reponse_password->execute();
    $mdp = $reponse_password->fetch();
    $mdp = $mdp['mdp'];
    

    $submit_login = $_POST['login'];
    $submit_password = $_POST['mdp'];
      
    if ($submit_login == $login && $submit_password == $mdp){
      echo '<a href="../movies/upload_form">ici</a>';
    }else{
     echo "les identifiants renseignés sont incorrecte";
    }

?>

