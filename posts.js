/**
 * Created by Maarten on 16-3-2015.
 */

/*---------------document ready--------------------------*/
/*
 * onclick submitHandler
 * */


//random background image
/*
var images = ['Simple-Colored-Geometric-Forms-Wallpaper.jpg', 'Material_Design_Wallpaper_WALLPAPERDNA.png', 'gj_2010_10_21_left_by_greyjasper-d318jn6.jpg'];
$('body').css({'background': 'url(afbeeldingen/' + images[Math.floor(Math.random() * images.length)] + ') no-repeat center center fixed'});
*/

$(document).ready(function () {
    getAccessTokenJson();
    $("#submit").on("click", submitHandler);
    $("#logout").on("click", logoutHandler);

    $("#audioPreview").bind('ended', function(e){
            e.preventDefault;
            $(".playPreview").css("background-image", "url('afbeeldingen/play-icon.svg')");
            $("#audioPreview").stop();
            $("#audioSource").attr("src", "");
            $("#audioPreview").load();
    });
    $("#postFacebook").on("click", function (e) {
        alert("This is not available (yet)");
    });
    $("#postGoogle").on("click", function (e) {
        alert("This is not available (yet)");
    });
});
   


function submitHandler(e) {

    e.preventDefault();
    if ($("#textUser").val() == "")
    {
        alert("Please enter your memory");
    }
    else if (song == "" || $("#song").val() == "") {
        alert("Please select a song");
    }
    else {
        postHandler();
    }
}

/*---------------set post in database--------------------------*/
/*
 * verkrijgt input values
 * call naar databse. In de php in database opgeslagen.
 * */
var song = "";
function postHandler() {
    console.log("posthandler");
    var text = htmlEntities($("#textUser").val());
    //var song = $("#song").val();
    console.log("song" + song);
    $.ajax({

        url: "setPostInDatabase.php",
        data: {text: text, song: song, direction: direction}

    }).done(function () {
        $("#textUser").val("");
        $("#song").val("");
        $("#fileToUpload").val("");
        direction = "";
        song = "";
        $("#audioPreview").stop();
        $("#audioSource").attr("src", "");
        $("#audioPreview").load();
        $("#searchResultDropdown").empty()
        console.log("postHandlerDone");
        console.log(song);
        loadPostsDatabaseCallback();
    })
}

function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

/*-------------------------------when posts set in database is success-----------------------------
 * get all post. because the new post is now also on the page
 * */

function loadPostsDatabaseCallback() {

    /*getLatestPost();*///nadat de post in de datbase wordt gezet. moet deze onmidelijk verschijnen in het overzicht.
    // Daarom wordt hier een call naar de server gedaan om de posts op te halen.
    console.log("loadPostsDatabaseCallback");
    getPosts();

}

/*-------------------------------get posts with ajax from database-----------------------------
 * all post from user. search with userid
 * JSON result is all post
 * */

function getPosts() {

    console.log("getPosts");
    $("#posts").prepend("<img id='loadingPostsImg' src='afbeeldingen/loading.gif' alt='Loading...' />");
    $.ajax({
        dataType: "json",
        url: "refreshPosts.php",
        method: "GET",

    }).done(function (json) {
        postsOnPage(json);
    }).fail(function (json) {
        console.log(json);
    });
}


/*-------------------------------set post on page-----------------------------
 * variable is the json from ajax. in the json are all the posts
 * print the post on the page
 * */
function postsOnPage(json) {
    console.log(json);
    console.log("postsOnPage");
    $("#posts").empty();

    if (json.length > 0) {
        $.each(json, function (i) {
            makePostText(json[i]['postId'], json[i]['text'], json[i]['songId'], json[i]['emotion'], json[i]['image'])
        });
    }
    else {
            $("#posts").prepend($("<h1 id='noPostsText'>&uarr; Enter your first memory above</h1>"));
    }
}


/*-------------------------------post-----------------------------*/
function makePostText(postId, text, songId, emotion, image) {
    console.log("makePostText");
    this.postId = postId;
    this.text = text;
    this.songId = songId;
    this.emotion = emotion;
    this.image = image;

    $("#posts").prepend($("<div>", {id: this.postId, class: "post"}));
    $('#' + this.postId).append("<p class='text'>" + this.text + "</p> ", {
        id: "post" + this.postId,
        class: "post"
    })
        .append("<a href='https://twitter.com/share' class='twitter-share-button' data-url='http://stud.cmi.hro.nl/0894225/OP3/project/remindify/' data-text='" + this.text + "' data-count='none'>Tweet</a>")
        .append("<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>");


    if (this.image != "no image" && this.image != "") {
        // $('#' + this.postId).prepend($('<img>', {src: this.image, class: "imagePost"}));
        $('#' + this.postId).prepend("<a href='" + this.image + "' target='_blank' ><img src='" + this.image + "' class='imagePost' /></a>");
    }

    $('#' + this.postId).prepend("<img src='afbeeldingen/loading.gif' class='spotifyEmbedLoading' id='spotifyEmbedLoading" + this.postId + "'/><iframe id='spotifyEmbed" + this.postId + "' class='spotifyEmbed' src='https://embed.spotify.com/?uri=spotify%3Atrack%3A" + this.songId + "' width='100%' height='80' frameborder='0' allowtransparency='true' onload='hideSpotifyEmbedLoadingImg(" + this.postId + ")'></iframe>")

}

function hideSpotifyEmbedLoadingImg(postId) {
    $("#spotifyEmbedLoading" + postId ).remove();
    console.log("loaded the iframe for post" + postId);
}

var files;
var direction;
/*var direction = "uploads/".files[0].name;*/

// Add events
$('input[type=file]').on('change', getName);

// Grab the files and set them to our variable
function getName(event) {
    files = event.target.files;
    console.log(files);
    console.log("joepie");
    console.log(files[0].name);
    console.log("Uploads/" + files[0].name);
    direction = "Uploads/" + files[0].name;

}

/*-------------------------search songs---------------------------------
 *
 * */

$('#song').on('input', searchSongs);


function searchSongs(e) {
    e.preventDefault();

    song = "";
    $(".clickImageSearch").css({"background-color": "transparent"});
    $("#audioPreview").stop();
    $("#audioSource").attr("src", "");
    $("#audioPreview").load();
    $(".playPreview").css("background-image", "url('afbeeldingen/play-icon.svg')");

    var q = $("#song").val();

    console.log(q);
    if (q != "") {
        $.ajax({
            url: "spotify/main.php",
            data: {
                q: q
            },
            method: "GET",
            dataType: "json",
            success: function (data) {//de data die ik terug krijg is alles wat ik print in de main.php
                searchResult(data);
            },
            error: function (data) {
                console.log(data);
                console.log("Something went wrong when searching for songs");
            }
        })
    }
}

var songId = "";
function searchResult(json) {

    $("#searchResultDropdown").empty()
        .append($("<ul>", {id: 'dropdownUl'}));

    if (json.length > 0) {
        $.each(json, function (i) {

            var songName = json[i]['songName'];
            var artist = json[i]['songArtist'];
            var songId = json[i]['songId'];
            var popularity = json[i]['popularity'];
            var preview = json[i]['preview'];

            var listElement = $("<li>", {id: songId, class: "clickImageSearch"}).text(artist + " - " + songName)
                    .append($("<div>", {class: "playPreview", data: preview})
                        .on("click", function (event) {
                            playPreview(preview, event, this);
                        })
                )


                ;
            console.log(listElement);
            $("#dropdownUl").append(listElement);

        });

        $(".clickImageSearch").on("click", function () {
            song = this.id;
            $("#song").val($(this).text());
            console.log(song);

            $(".clickImageSearch").css({"background-color": "transparent"});
            $(this).css({"background-color": "#2196F3"});
            // $("#dropdownUl").empty(); //werkt niet, bug met muziek preview afspelen
        });
    }
    else {
        $("#dropdownUl").append($("<li>", {class: "clickImageSearch"}).text("No songs found"));
    }

    function playPreview(preview, event, clickedElement) {
        event.preventDefault();
        $playButtonEvent = event;
        console.log(event);
        console.log(preview);
        $(".playPreview").css("background-image", "url('afbeeldingen/play-icon.svg')");

        if ($("#audioSource").attr("src") == preview){
            console.log("same audio playing already");
            $("#audioPreview").stop();
            $("#audioSource").attr("src", "");
            $("#audioPreview").load();

        }
        else {
            $("#audioPreview").stop();
            $("#audioSource").attr("src", preview);
            $("#audioPreview").load();
            $(clickedElement).css("background-image", "url('afbeeldingen/pause-icon.svg')");
        }
    }

}


function getAccessTokenJson() {
console.log("getAccessTokenJson");
    $.ajax({
        dataType: "json",
        url: "accessTokenJson.php",
        method: "GET"

    }).done(function (json) {
        getUserData(json);
    }).fail(function (json) {
        console.log(json);
    });


}


function getUserData(json) {
    console.log("getUserData");
    console.log(json);
    var accessToken = json[0];
    $.ajax({
        url: 'https://api.spotify.com/v1/me',
        headers: {
            'Authorization': 'Bearer ' + accessToken
        }
    }).done(function (json) {
        console.log(json);
        setUserDataDatbase(json);
    }).fail(function (json) {
        console.log(json);
    });

}

var profilePicture = "afbeeldingen/user42.png";
function setUserDataDatbase(json){

    if (typeof json['display_name'] != 'undefined' && json['display_name'] != null) {
        var name = json["display_name"];
    }
    else {
        var name = json["email"];
    }
    if (json["images"].length > 0) {
        console.log("profilePicture Set");
        profilePicture = json["images"][0]["url"];
    }
    var mail = json["email"];
    var userId = json["id"];
    console.log(json["id"]);
    displayUserInfo(name, profilePicture);

    $.ajax({
        url: "setUserInDatabase.php",
        method: "GET",
        data: {name: name, picture: profilePicture, mail:mail, spotifyId: userId}

    }).done(function (json) {
        console.log(json);
    }).fail(function (json) {
        console.log(json);
    });

    getPosts();

}

function displayUserInfo(name, profilePicture) {
    $("#profilePicture").attr("src", profilePicture);
    $("#myPage").text("Welkom " + name);
}

function logoutHandler(e) {
    e.preventDefault;
    console.log("logout");
    $.ajax({
        dataType: "json",
        url: "logout.php"
    }).done(function (data) {
        window.location.replace("index.php");
    }).fail(function (data) {
        window.location.replace("index.php");
    });
}