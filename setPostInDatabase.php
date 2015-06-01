<?php
/**
 * Created by PhpStorm.
 * User: Maarten
 * Date: 16-3-2015
 * Time: 11:51
 */
/*-----------------connect to database-----------------*/
session_start();
require("databaseConnection.php");

/*-----------------set post in database----------------*/

if(isset($_GET["text"])) {
    debug_to_console("textisset");

    $text = $_GET["text"];
    $song = $_GET["song"];
    $path = $_GET["direction"];
    $userId = $_SESSION["userId"];

    debug_to_console($text);
    debug_to_console($song);

    setPostInDatabse($userId, $text, $song ,$path, $mysqli);


}


function setPostInDatabse($userId, $text, $song, $path, $mysqli) {

    debug_to_console( "setPostInDatabase" );


    $sql = "INSERT INTO `posts` (`post_id`, `user_id`, `text`, `emotion`, `song_id`, `path`) VALUES (NULL,'$userId' , '$text', '1', '$song', '$path')";// de query om values in  database te zetten
    if ($mysqli->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}





function debug_to_console( $data ) {

    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}