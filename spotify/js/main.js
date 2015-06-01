/**
 * Created by Kalle on 23-3-2015.
 */

$('#searchInput').on('input', searchSongs);

function searchSongs (e) {
    e.preventDefault();
    var q = $("#searchInput").val();
    console.log(q);
        $.ajax({
        url: "main.php",
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
            alert('you fail')
        }
    })
}

