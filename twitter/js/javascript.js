$(document).ready(function () {
    console.log("document ready");
    $("#submitTwitterUserName").on("click", function (e) {
        console.log("searching twitter user");
        e.preventDefault;
        loadTwitterPosts($("#twitterUserName").val());
    });

    $("#postTwitter").on("click", function (e) {
        console.log("click twitter");
        $("body").css({
            "pointer-events": "none"
        });
        $("#twitterPostsSection").css({
            "display": "block",
            "pointer-events": "auto"
        });
    });

    $("#closeTwitter").on("click", function (e) {
        console.log("closeTwitter");
        e.preventDefault;
        $("#twitterPostsSection").css({
            "display": "none"
        });
        $("body").css({
            "pointer-events": "auto"
        });
    });

});

$('#twitterUserName').on('input', function(e){
    console.log(e);
    $('#twitterUserName').val($('#twitterUserName').val().trim()).trim();
});

function loadTwitterPosts(name) {
    $("#twitterPosts").empty();
    $("#twitterPosts").append("<img id='loadingTwitterPostsImg' src='afbeeldingen/loading.gif' alt='Loading...' />");

    console.log("function twitter");
    $.ajax({
        dataType: "json",
        url: "twitter/getTwitterPosts.php",
        data: {name: name},
        method: "GET"
    })
        .done(function (json) {
            $("#twitterPosts").empty();
            console.log("Aantal twitter posts: " + json.length);
            if (json.length === 0) {
                $("#twitterPosts").prepend($("<h1>", { id:"headerTwitter"}).text("This account has no (public) tweets"));
                console.log("No twitter posts found")
            }
            else if (json[0] == "error"){
                 $("#twitterPosts").prepend($("<h1>", { id:"headerTwitter"}).text("This account doesn't exist"));
            }
            else {
                $.each(json, function (i) {
                    var postHtml = " \
							<div class='twitterPost' id=" + json[i].id + "'> \
								<i>" + json[i].time + "</i> \
								<br /> \
								" + json[i].text + " \
								<br /> \
						";

                    if (typeof json[i].media !== 'undefined' && json[i].media.length > 0) {
                        postHtml += " \
								<img class='twitterImg' src='" + json[i].media[0].url + "' /> \
							";
                    }

                    postHtml += " \
							</div> \
						";

                    $("#twitterPosts").append(postHtml);


                    $(".twitterPost").click(function () {
                        $("#textUser").val($(this).text().trim().replace("<br />", /\n/g));
                        $("#twitterPostsSection").css({
                            "display": "none"
                        });
                        $("body").css({
                            "pointer-events": "auto",
                        });
                    });

                });

                $("#twitterPosts").prepend($("<h1>", { id:"headerTwitter"}).text("Choose your tweet"));
            }

        })
}
