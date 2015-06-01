<!doctype html>

<html>

	<head>

		<script src="js/jquery-2.1.3.min.js"></script>

		<script src="js/javascript.js"></script>
		
		<link rel="stylesheet" href="style.css" />

		<meta name="viewport" content="width=device-width, initial-scale=1">
		
	</head>

	<body>
		<!-- tweet it button -->
		<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://localhost/remindify" data-text="Check my remindify post @" data-count="none">Tweet</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

			<img class="logo" src="http://a3.twimg.com/a/1313785223/images/logos/logo_twitter_withbird_1000_allblack.png" />
			<form>
				<textarea rows="4" cols="50" type="text" name="text" id="text"></textarea>
				<input type="submit" />
			</form>
		<section id="twitterPosts">

		</section>
	</body>

</html>