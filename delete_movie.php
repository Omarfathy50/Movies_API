<?php
    header('Content-Type: application/json');
    require_once('connection.php');

    $response = array();
    // movie id was provided
    if(isset($_POST['id'])){

        $id = $_POST['id'];

        $stat = $conn->prepare("DELETE FROM movies WHERE id=? LIMIT 1");

        $stat->bind_param("i",$id);

        if($stat->execute()){

            $response['error'] = false;
            $response['message'] = "movie deleted successfully"; 
            $response['response_status'] = 204;

        }else{

            $response['error'] = true;
            $response['message'] = "movies didnt dleted";
            $response['response_status'] = 400;

        }
    }else{
        // no movie id was provided
            $response['error'] = true;
            $response['message'] = "provide movies id please";
            $response['response_status'] = 400;

    }

    echo json_encode($response);

?>