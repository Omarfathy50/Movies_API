<?php
    header('Content-Type: application/json');
    require_once('connection.php');

    $response = array();
    // movie id was provided
    if(isset($_POST['title']) && isset($_POST['storyLine']) && isset($_POST['lang']) && isset($_POST['genre' ]) 
    && isset($_POST['release_date' ]) && isset($_POST['box_office' ]) && isset($_POST['run_time' ]) && isset($_POST['stars' ])){

        $title = $_POST['title'];
        $storyLine = $_POST['storyLine'];
        $lang = $_POST['lang'];
        $genre = $_POST['genre'];
        $release_date = $_POST['release_date'];
        $box_office = $_POST['box_office'];
        $run_time = $_POST['run_time'];
        $stars = $_POST['stars'];

        $stat = $conn->prepare("INSERT INTO  movies (title, storyLine, lang, genre, release_date, box_office, run_time, stars)
                                VALUE (?,?,?,?,?,?,?,?) ");

        $stat->bind_param("sssssdsd",$title, $storyLine, $lang, $genre, $release_date, $box_office, $run_time, $stars);        

        if($stat->execute()){

            $response['error'] = false;
            $response['message'] = "movie created successfully"; 
            $response['response_status'] = 201;

        }else{

            $response['error'] = true;
            $response['message'] = "movies didnt created";
            $response['response_status'] = 400;

        }
    }else{
        // no movie id was provided
            $response['error'] = true;
            $response['message'] = "provide movies body please";
            $response['response_status'] = 400;

    }

    echo json_encode($response);

?>