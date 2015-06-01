<?php
	
	if(isset($_GET['id'])) {
	    $tweetId = $_GET['id'];
	}
	else {
		$tweetId = "544085421290819585";
	}

	require "twitteroauth-master/autoload.php";

	use Abraham\TwitterOAuth\TwitterOAuth;

	$consumerKey = "fDYshsdZzEo2OT9wZLxRCCFka";
	$consumerSecret = "YuqJdX1eb8MBcWNTGCUepTdBocHlnCRTjF6WMswMHF1AXgZzkR";
	$ownerId = "623997498";
	$accessToken = "623997498-xdl1cNQmWie4sQtRYTVvF1Lrlshqt22dRsqVq7MX";
	$accessTokenSecret = "IxDtWzsqrxulWYNnIVOJCiRHLYWIvDJrFIwtXWUVJbHnV";

	$connection = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
	$timeline = $connection->get("statuses/show", array("id" => $tweetId));
	// echo "<pre>";
	// print_r($timeline);
	// echo "</pre>";

	$generatedJson = [];
	foreach ($timeline as $value) { //do the following for every picture in the json
		$id = $value->id;
		$time = $value->created_at;
		$text = $value->text;
		$mediaArray = [];
		if (isset($value->entities->media)) {
			foreach ($value->entities->media as $media) {
				if (isset($media->type) && !empty($media->type)) {
					$mediaType = $media->type;
					$mediaUrl = $media->media_url;
					$mediaDataArray = array("type" => $mediaType, "url" => $mediaUrl);
					array_push($mediaArray, $mediaDataArray);
				}
			}
		}
		$postArray = array("id" => $id, "time" => $time, "text" => $text, "media" => $mediaArray); //make an array of the data

		array_push($generatedJson, $postArray);
	}
	
	$postsEncoded = json_encode($generatedJson);
	//echo $postsEncoded;
	echo "<pre>";
	print_r($timeline);
	echo "</pre>";
?>