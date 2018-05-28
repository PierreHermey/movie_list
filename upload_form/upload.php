<?php 
    try{

        $bdd = new PDO('mysql:host=localhost;dbname=movies;charset=utf8', 'root', 'stagiaire');
      }
      catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
      }
      
      if(isset($_POST['submit'])){
        $title = $_POST['title'];
        $year = $_POST['year'];
        $description = addslashes($_POST['description']);
        $trailer = $_POST['trailer'];
        $director_firstname = $_POST['director_firstname'];
        $director_lastname = $_POST['director_lastname'];
        $actor_firstname = $_POST['actor_firstname'];
        $actor_lastname = $_POST['actor_lastname'];
        $actor2_firstname = $_POST['actor2_firstname'];
        $actor2_lastname = $_POST['actor2_lastname'];
        $actor3_firstname = $_POST['actor3_firstname'];
        $actor3_lastname = $_POST['actor3_lastname'];
        $gender = $_POST['gender'];
        $location = '/home/stagiaire/projets/php/movieFinal/img/';
        $name       = $title.'.jpg';  
        $temp_name  = $_FILES['uploaded_file']['tmp_name'];  
        $target_file = $location . basename($_FILES["uploaded_file"]["name"]);
        $filename = $_FILES['uploaded_file']['name'];
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if($imageFileType != "jpg" &&  $imageFileType != "jpeg"  ){
            echo "Sorry, only JPG, JPEG files are allowed.";
        }else{
            if(isset($name)){
                if(!empty($name)){            
                    if(move_uploaded_file($temp_name, $location.$name)){

                        $movie = $bdd->prepare("INSERT INTO movie(title, description, year, trailer) VALUES('$title', '$description', '$year', '$trailer')");
                        $movie->execute();
                        $movie_request = $bdd->prepare("SELECT max(id) FROM movie");
                        $movie_request->execute();
                        $movie_id = $movie_request->fetchAll();
                        $movie_id = $movie_id["0"]["max(id)"];

                        $director = $bdd->prepare("INSERT INTO director(first_name, last_name) VALUES('$director_firstname', '$director_lastname')");
                        $director->execute();
                        $director_request = $bdd->prepare("SELECT max(id) FROM director");
                        $director_request->execute();
                        $director_id = $director_request->fetchAll();
                        $director_id = $director_id["0"]["max(id)"];

                        $actor = $bdd->prepare("INSERT INTO actor(first_name, last_name) VALUES('$actor_firstname', '$actor_lastname')");
                        $actor->execute();
                        $actor_request = $bdd->prepare("SELECT max(id) FROM actor");
                        $actor_request->execute();
                        $actor_id = $actor_request->fetchAll();
                        $actor_id = $actor_id["0"]["max(id)"];

                        $actor2 = $bdd->prepare("INSERT INTO actor(first_name, last_name) VALUES('$actor2_firstname', '$actor2_lastname')");
                        $actor2->execute();
                        $actor2_request = $bdd->prepare("SELECT max(id) FROM actor");
                        $actor2_request->execute();
                        $actor2_id = $actor2_request->fetchAll();
                        $actor2_id = $actor2_id["0"]["max(id)"];

                        $actor3 = $bdd->prepare("INSERT INTO actor(first_name, last_name) VALUES('$actor3_firstname', '$actor3_lastname')");
                        $actor3->execute();
                        $actor3_request = $bdd->prepare("SELECT max(id) FROM actor");
                        $actor3_request->execute();
                        $actor3_id = $actor3_request->fetchAll();
                        $actor3_id = $actor3_id["0"]["max(id)"];

                        $gender = $bdd->prepare("INSERT INTO gender(gender) VALUES('$gender')");
                        $gender->execute();
                        $gender_request = $bdd->prepare("SELECT max(id) FROM gender");
                        $gender_request->execute();
                        $gender_id = $gender_request->fetchAll();
                        $gender_id = $gender_id["0"]["max(id)"];



                        $movie_actor = $bdd->prepare("INSERT INTO movie_actor(movie_id, actor_id) VALUES('$movie_id', '$actor_id')");
                        $movie_actor->execute();
                        $movie_actor2 = $bdd->prepare("INSERT INTO movie_actor(movie_id, actor_id) VALUES('$movie_id', '$actor2_id')");
                        $movie_actor2->execute();
                        $movie_actor3 = $bdd->prepare("INSERT INTO movie_actor(movie_id, actor_id) VALUES('$movie_id', '$actor3_id')");
                        $movie_actor3->execute();
                        $movie_director = $bdd->prepare("INSERT INTO movie_director(movie_id, director_id) VALUES('$movie_id', '$director_id')");
                        $movie_director->execute();
                        $movie_gender = $bdd->prepare("INSERT INTO movie_gender(movie_id, gender_id) VALUES('$movie_id', '$gender_id')");
                        $movie_gender->execute();

                        echo 'Film uploaded successfully';

                    }
                }       
            }else{
                echo 'You should select a file to upload !!';
            }
        }
    }
?>



