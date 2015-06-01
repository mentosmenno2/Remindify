<?php
/**
 * Created by PhpStorm.
 * User: Maarten
 * Date: 24-3-2015
 * Time: 14:01
 */
session_start();
require("databaseConnection.php");

if (isset($_SESSION["userId"])) {
    $userId = $_SESSION["userId"];
/*    debug_to_console($userId);
    debug_to_console("refresh");*/

    getAllPosts($userId, $mysqli);


}

function getAllPosts($userId, $mysqli)
{
   /* debug_to_console("getAllPosts");*/
    $arrayPosts = array();
    $sql = "SELECT post_id, song_id, text, emotion, path  FROM posts WHERE posts.user_id = $userId ";
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
                $postId = $row["post_id"];
                $songId = $row["song_id"];
                $text = $row["text"];
                $emotion = $row["emotion"];
                $image = $row["path"];/*getImage($userId, $item[0], $mysqli); -----only for multiple images in future*/
                $arrayInfoPost = array("postId" => $postId, "text" => $text, "songId" => $songId, "emotion" => $emotion, "image" => $image);
                array_push($arrayPosts, $arrayInfoPost);
        }
        print_r(json_encode($arrayPosts));
    }
    else {
        echo "[]";
    }
    

}
/*
 * this is for multiple images in the future
 *
function getImage($userId, $postId, $mysqli){

    $sqlImage = "SELECT path  FROM posts , jnct_post_has_images, pictures  WHERE posts.user_id = $userId AND posts.post_id = $postId AND posts.post_id = jnct_post_has_images.post_id AND jnct_post_has_images.picture_id = pictures.id";
    $queryExecuteImage = mysqli_query($mysqli, $sqlImage);
    $resultImage = mysqli_fetch_all($queryExecuteImage);
    if ($resultImage == NULL){
        return "no image";
    }

        else {
            return $resultImage[0][0];
        }
}*/

function debug_to_console($data)
{

    if (is_array($data))
        $output = "<script>console.log( 'Debug Objects: " . implode(',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}
