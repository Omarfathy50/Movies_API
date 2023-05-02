<?php
    header('Content-Type: application/json');
    require_once('connection.php');

    $response = array();
    // movie id was provided
    if(isset($_POST['id']) && isset($_POST['storyLine']) && isset($_POST['box_office']) && isset($_POST['stars'])){

        $id = $_POST['id'];
        $storyLine = $_POST['storyLine'];
        $box_office = $_POST['box_office'];
        $stars = $_POST['stars'];

        $stat = $conn->prepare("UPDATE movies SET id='$id', storyLine='$storyLine', box_office='$box_office', stars='$stars' where id='$id' ");

        if($stat->execute()){

            $response['error'] = false;
            $response['message'] = "movie updated successfully"; 

        }else{

            $response['error'] = true;
            $response['message'] = "movies didnt updated";

        }
    }else{
        // no movie id was provided
            $response['error'] = true;
            $response['message'] = "provide movies id please";

    }

    echo json_encode($response);

?>