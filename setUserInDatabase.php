<?php
/**
 * Created by PhpStorm.
 * User: Maarten
 * Date: 10-4-2015
 * Time: 11:14
 */
session_start();
require("databaseConnection.php");

$name = $_GET["name"];
$mail = $_GET["mail"];
$picture = $_GET["picture"];
$spotifyId = $_GET["spotifyId"];
debug_to_console( $spotifyId );

$loginQuery = "SELECT * FROM users
         WHERE spotify_Id = '$spotifyId'
         ";

$result = $mysqli->query($loginQuery);
/*debug_to_console( $row["user_id"] );*/
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo $row["user_id"];
        if ($row["user_id"] > 0 ) {

            $_SESSION["IsLoggedIn"] = TRUE;
            $_SESSION["mail"] = $mail;
            $_SESSION["name"] = $name;
            $_SESSION["spotifyId"] = $spotifyId;
            $_SESSION["userId"] = $row["user_id"];
                
            }
        else {


        }
    }
}
else {
    echo "no results";
    $sql = "INSERT INTO `users` (name , email, picture, user_id, spotify_Id) VALUES ('$name', '$mail' , '$picture', 'NULL', '$spotifyId')";
            if ($mysqli->query($sql) === TRUE) {
                echo "User saved in database";
            } else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }

            $loginQuery = "SELECT * FROM users
                 WHERE spotify_Id = '$spotifyId'
                 ";

            $result = $mysqli->query($loginQuery);
            /*debug_to_console( $row["user_id"] );*/
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {

                    $_SESSION["IsLoggedIn"] = TRUE;
                    $_SESSION["mail"] = $mail;
                    $_SESSION["name"] = $name;
                    $_SESSION["spotifyId"] = $spotifyId;
                    $_SESSION["userId"] = $row["user_id"];
                }
            }
}
    


function debug_to_console( $data ) {

    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}





