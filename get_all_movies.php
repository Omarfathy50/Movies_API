<?php
    header('Content-Type: application/json');
    require_once('connection.php');

    $response = array();
    $stat = $conn->prepare("SELECT * FROM movies");

    if($stat->execute()){
        
        // this array store of the results
        $movies = array();
        // get all the results from the db
        $result = $stat->get_result();
        // loop and get each single row
        while($row = $result->fetch_array(MYSQLI_ASSOC)){

            $movies [] = $row;
        }
        $response['error'] = false;
        $response['movies'] = $movies;
        $response['message'] = "movies returned successfully"; 
        $response['response_status'] = 200;

    }else{

        $response['error'] = true;
        $response['message'] = "movies didnt returned";
        $response['response_status'] = 400;
    }

    echo json_encode($response);
    ?>
