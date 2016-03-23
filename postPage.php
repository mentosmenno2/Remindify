<?php

    require "login/login.php";

?>

<html>
<head>
    <meta charset="utf-8">
    <title>Remindify</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="viewport" content="minimal-ui, target-densitydpi=device-dpi, width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/png" href="afbeeldingen/favicon.png?v=2"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="twitter/style.css" />
    <link rel="stylesheet" href="style.css">

</head>
<body>

<audio id="audioPreview" preload="auto" autoplay>
    <source id="audioSource" src="" type="audio/mpeg">
</audio>

<nav id="nav">
        <img id="logo" src="afbeeldingen/logo-home.png"/>
        <div id="profile">
            <img id="profilePicture" src="afbeeldingen/user42.png"/>
            <a id="myPage"></a>
            <a id="logout">logout</a>
        </div>
</nav>

<div id="postHandler">

        <button id="postTwitter" class="posthandlerMenu"><img class="socialMediaIcon" src="afbeeldingen/twitter.png"/> Twitter</button>
        <button id="postFacebook" class="posthandlerMenu"><img class="socialMediaIcon" src="afbeeldingen/facebook.png"/> Facebook</button>
        <button id="postGoogle" class="posthandlerMenu"><img class="socialMediaIcon" src="afbeeldingen/google4.png"/> Google+</button>
        <span>&larr; Import text from social media</span>

    <form action="setPostInDatabase.php" method="post" id="formData">
        <fieldset>

            <textarea rows="4" cols="50" name="textUser" id="textUser" placeholder= "Write your memories down" autofocus></textarea>


            <input type="text" name="song" id="song" placeholder= "Song that holds your memory"/>
            <div id="searchResultDropdown"></div>
            <label for="fileToUpload">Choose a picture (optional):</label>
            <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*">

            <input type="submit" name="post" value="Remember it" id="submit">

        </fieldset>

    </form>

</div>
    <div id="posts"></div>
    <section id="twitterPostsSection">
            <div id="twitterMenuBar">
                <div id='closeTwitter'>X</div>
                <label>@</label><input type='text' name='twitterUserName' id='twitterUserName' placeholder= "Twitter username"/>
                <button id='submitTwitterUserName'><img id="submutTwitterUserNameImage" src="afbeeldingen/vergrootglas.png" /> Search</button>
            </div>
            <section id="twitterPosts">
            </section>
    </section>


<!-- Latest compiled Jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


<!-- Latest compiled JavaScript -->

<!-- Deze code staat nu in de js -->
<!-- <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script> -->
<script src="twitter/js/javascript.js"></script>
<script type="text/javascript" src="picture.js"></script>
<script type="text/javascript" src="posts.js"></script>

</body>

</html>