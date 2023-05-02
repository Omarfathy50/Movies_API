<?php

    $conn = mysqli_connect('localhost', 'root', '', 'movies_api');

    if(!$conn){
        echo "we cant connect";
    }

?>    