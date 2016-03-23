<?php
	
	session_start();

	$client_id = "";
	$client_secret = "";
	$redirect_uri = "http:%2F%2Fstud.cmi.hro.nl%2F0894225%2FOP3%2Fproject%2Fremindify%2FpostPage.php";
	//$redirect_uri = "http:%2F%2Flocalhost%3A1337%2Fremindify%2FpostPage.php";

	//login function
	if (isset($_GET['error'])) { //error handling
		header("Location: index.php");
		die();
	}
	else if (isset($_COOKIE['access_token']) && $_COOKIE['access_token'] !== NULL && $_COOKIE['access_token'] !== "" && $_COOKIE['access_token'] !== false) {

	}
	else if (isset($_GET['code'])) { //if a code is received get access token
		$code = $_GET['code'];

		$url = "https://accounts.spotify.com/api/token?grant_type=authorization_code&redirect_uri=$redirect_uri&code=$code";
		//$url = "https://accounts.spotify.com/api/token?grant_type=authorization_code&redirect_uri=http:%2F%2Flocalhost%2FOP3%2Fproject%2Fremindify%2FpostPage.html&code=AQBsOyok3G5W7w8FmTj1tpGeh9MGXC-xIPKccZo9uAoFilC9AHrXcKaw4_tw6_ygo-uW4TfkIZrxjCUuqN4y2x6pg-YiVyA1xyopp5u8KClcjsn0H4LyyCbv4D2XCoBNN4vT5A5pOVOr3WrKHL9kn2xM3FanBitBk4dhO0a3bzY6e2YZq0ZrQu59kZYNW641QNQk_WEYnzIIGR7rgGK4wJr-8ttTSQQdSmEm2NE3URgclkryeEdioWOSloS4javYcuyDnm6-FQ1bPt60ZxE";

		$postdata = http_build_query(
			array(
				'grant_type' => 'authorization_code',
				'redirect_uri' => $redirect_uri,
				'client_id' => $client_id,
				'client_secret' => $client_secret,
				'code' => $code
			)
		);
		
		$opts = array(
			'http'=>array(
				'method'=>"POST",
				'header'=>'Content-type: application/x-www-form-urlencoded',
				'content' => $postdata
			)
		);

		$context = stream_context_create($opts);

		// Open the file using the HTTP headers set above
		$file = file_get_contents($url, false, $context);
		$data = json_decode($file);
		setcookie("access_token", $data->access_token, time()+3600, "/");
		// $_SESSION["access_token"] = $data->access_token;
		// $_SESSION["refresh_token"] = $data->refresh_token;
		// $_SESSION["expires_in"] = $data->expires_in;
		header("Location: postPage.php");
		die();
	}
	else { //if no code is given and user is not logged in
		$loginUrl = "https://accounts.spotify.com/nl/authorize?client_id=$client_id&response_type=code&redirect_uri=$redirect_uri&scope=user-read-private%20user-read-email&show_dialog=true";
//      $login_url = "https://accounts.spotify.com/nl/authorize?client_id=2933cd5a1b894b21af028e160adc06f8&response_type=code&redirect_uri=http:%2F%2Flocalhost%2FOP3%2Fproject%2Fremindify%2FpostPage.html&scope=user-read-private%20user-read-email&state=34fFs29kd09";
		header("Location: " . $loginUrl);
	}

?>