<?php
/**
 * Created by PhpStorm.
 * User: Kalle
 * Date: 23-3-2015
 * Time: 15:36
 */

//$clientId = "2933cd5a1b894b21af028e160adc06f8";
//$clientSecret = "4b6ca2b958264f6087b7bacbc1ab5b05";
//$redirectUri = "http://localhost/imp03/spotify/site/";


if (isset ($_GET["q"])) {
    $searchQuery = urlencode($_GET["q"]);
    $searchResultsCoded = "https://api.spotify.com/v1/search?q=$searchQuery&type=track&market=NL&limit=5";
    $results = file_get_contents($searchResultsCoded);
    $resultsJson = json_decode($results, true);


    $searchResultsArray = array();
    foreach ($resultsJson["tracks"]["items"] as $item) {

        $songArtist = $item["artists"][0]["name"];
        $songName = $item["name"];
        $songId = $item["id"];
        $popularity = $item["popularity"];
        $preview = $item["preview_url"];
        $infoArray = array("songName" => $songName, "songArtist" => $songArtist, "songId" => $songId, "popularity" => $popularity, "preview" => $preview);
        $result = array_push($searchResultsArray, $infoArray);
    };

    $songDataJson = json_encode($searchResultsArray);
    echo $songDataJson;

}






