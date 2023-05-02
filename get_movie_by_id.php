<?php
    header('Content-Type: application/json');
    require_once('connection.php');

    $response = array();
    // movie id was provided
    if(isset($_GET['id'])){

        $id = $_GET['id'];

        $stat = $conn->prepare("SELECT id, title, storyLine, lang, genre, release_date, box_office, run_time, stars FROM movies where title = ? ");

        $stat->bind_param("i",$id);

        if($stat->execute()){

            $stat->bind_result($id, $title, $storyLine, $lang, $genre, $release_date, $box_office, $run_time, $stars);

            $stat->fetch();

            $movies = array(
                'id'=>$id,
                'title'=>$title,
                'storyLine'=>$storyLine,
                'lang'=>$lang,
                'genre'=>$genre,
                'release_date'=>$release_date,
                'box_office'=>$box_office,
                'run_time'=>$run_time,
                'stars'=>$stars,
            );

            $response['error'] = false;
            $response['movies'] = $movies;
            $response['message'] = "movies returned successfully"; 
            $response['response_status'] = 200;

        }else{

            $response['error'] = true;
            $response['message'] = "movies didnt returned";
            $response['response_status'] = 400;

        }
    }else{
        // no movie id was provided
            $response['error'] = true;
            $response['message'] = "provide movies title please";
            $response['response_status'] = 400;

    }

    echo json_encode($response);

?>    