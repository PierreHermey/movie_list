<?php 
    try{
        $bdd = new PDO('mysql:host=localhost;dbname=movies;charset=utf8', 'psaulay', '');
      }
      catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
      }
      
    if(isset($_POST['submit'])){
        $title = $_POST['title'];
        $year = $_POST['year'];
        $description = $_POST['description'];
        $director_firstname = $_POST['director_firstname'];
        $director_lastname = $_POST['director_lastname'];
        $actor_firstname = $_POST['actor_firstname'];
        $actor_lastname = $_POST['actor_lastname'];
        $gender = $_POST['gender'];
        $location = '/home/psaulay/Projets/movies/img/';
        $name       = $title.'.jpg';  
        $temp_name  = $_FILES['uploaded_file']['tmp_name'];  
        $target_file = $location . basename($_FILES["uploaded_file"]["name"]);
        //echo '<pre>'; var_dump($target_file); echo '</pre>'; die();
        $filename = $_FILES['uploaded_file']['name'];
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if($imageFileType != "jpg" &&  $imageFileType != "jpeg"  ){
            echo "Sorry, only JPG, JPEG files are allowed.";
        }else{
            if(isset($name)){
                if(!empty($name)){            
                    if(move_uploaded_file($temp_name, $location.$name)){

                        $movie = $bdd->prepare("INSERT INTO movie(title, description, year) VALUES('$title', '$description', '$year')");
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

                        $gender = $bdd->prepare("INSERT INTO gender(gender) VALUES('$gender')");
                        $gender->execute();
                        $gender_request = $bdd->prepare("SELECT max(id) FROM gender");
                        $gender_request->execute();
                        $gender_id = $gender_request->fetchAll();
                        $gender_id = $gender_id["0"]["max(id)"];



                        $movie_actor = $bdd->prepare("INSERT INTO movie_actor(movie_id, actor_id) VALUES('$movie_id', '$actor_id')");
                        $movie_actor->execute();
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


