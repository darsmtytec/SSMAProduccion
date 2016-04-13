/**
 * Created by Davo on 1/15/2016.
 */
var term, termClone, termOption;
var cloneTweet;
var portHeight;
var items = [];
var jsonTweets;
var twt, fb, inst, tmblr, lkin, blgr, rd, yt, pint, gg;
twt = fb = inst = tmblr = lkin = blgr = rd = yt = pint = gg = true;

$(function(){
    $('#advanced').click(function(){
        $('#section-advanced').toggle(500);
    });
});

$(function(){
    $('#checkbox7').click(function(){
        console.log($(this).prop('checked'));
    });
});

/*
* Método que se ejecuta al darle clic a Buscar
*
* */

function submitSearch(){
    $('#search-btn').click(function(){
        //$('#tweetLoad').empty();
        //location.reload();
        if(typeof items != "undefined" && items != null && items.length > 0) {
            scrollTo('#section-posts');

            //$('#todo-tasklist-twitter').empty();
            $('#termBuscado').text(items);
            loadGif();
            loadTweets();
            loadInstagram();
            loadYoutube();
            loadTumblr();
            loadReddit();


        }else {
            alert("No has seleccionado Topicos");
        }


    });


}

function loadGif(){
    $('#tweet-count').html("<div class='loading1 loading-tweet' style='display:none;'><img id='' src='busqueda/img/loading.gif' width='16' height='16' alt='loading gif'/></div>");
    $('#instagram-count').html("<div class='loading1 loading-tweet' style='display:none;'><img id='' src='busqueda/img/loading.gif' width='16' height='16' alt='loading gif'/></div>");
    $('#youtube-count').html("<div class='loading1 loading-youtube' style='display:none;'><img id='' src='busqueda/img/loading.gif' width='16' height='16' alt='loading gif'/></div>");
    $('#tumblr-count').html("<div class='loading1 loading-tumblr' style='display:none;'><img id='' src='busqueda/img/loading.gif' width='16' height='16' alt='loading gif'/></div>");
    $('#reddit-count').html("<div class='loading1 loading-reddit' style='display:none;'><img id='' src='busqueda/img/loading.gif' width='16' height='16' alt='loading gif'/></div>");
    $('.loading-tweet').show();
    $('.loading-instagram').show();
    $('.loading-youtube').show();
    $('.loading-tumblr').show();
    $('.loading-reddit').show();
}


function selectSocial(){
    $('.socicons').on('click', 'a', function(){
        var socialMediaSearch = {};
        var icon = $(this);
        //console.log(icon.data('original-title'));
        switch (icon.data('original-title')){
            case 'Twitter': twt = !twt; icon.toggleClass('bg-green');
                break;
            case 'Facebook': fb = !fb; icon.toggleClass('bg-blue-steel');
                break;
            case 'Instagram': inst = !inst; icon.toggleClass('bg-grey-gallery');
                break;
            case 'Tumblr': tmblr = !tmblr; icon.toggleClass('bg-blue-chambray');
                break;
            case 'Linkedin': lkin = !lkin; icon.toggleClass('bg-blue-hoki');
                break;
            case 'Blogger': blgr = !blgr; icon.toggleClass('bg-yellow-gold');
                break;
            case 'Reddit': rd = !rd; icon.toggleClass('bg-red-flamingo');
                break;
            case 'Youtube': yt = !yt; icon.toggleClass('bg-red');
                break;
            case 'Pinterest': pint = !pint; icon.toggleClass('bg-red');
                break;
            case 'Google': gg = !gg; icon.toggleClass('bg-red');
                break;
        }
        socialMediaSearch.Twitter = twt; socialMediaSearch.Instagram = inst; socialMediaSearch.Tumblr = tmblr; socialMediaSearch.LinkedIn = lkin; socialMediaSearch.Blogger = blgr;
        socialMediaSearch.Reddit = rd; socialMediaSearch.YouTube = yt; socialMediaSearch.Pinterest = pint; socialMediaSearch.Google = gg; socialMediaSearch.Facebook = fb;
        icon.toggleClass('bg-grey-salsa');
        console.log(socialMediaSearch);
    });
}

function addMainTerms(){
    $('#terms-main-btn').click(function(){
        term = $('#terms-main-input');
        if (term.val()) {
            //console.log(buscarItem(term.val()));
            if (buscarItem(term.val())<0) {
                $('#terms-main-search').append($('<li class="search-label bg-green-meadow font-white"></li>').html(term.val() + '&nbsp;<a class="fa fa-times"></a>'));
                //console.log(term.val());
                items.push(""+term.val());
            }else{

            }
        }
        term.val('');
    });

    $('#terms-main-input').keypress(function(e){
        if(e.which == 13){//Enter key pressed
            $('#terms-main-btn').click();//Trigger search button click event
        }
    });

}

function addExtraTerms(){
    $('#terms-extra-btn').click(function(){
        term = $('#terms-extra-input');
        termOption = $('#terms-select');
        console.log(term.val() + '  ' + termOption.val());
        if(!term.val()){
        }else{
            switch (termOption.val()){
                case '1':
                    console.log('Enter');
                    $('#terms-defo-container').fadeIn(200);
                    $('#terms-defo-search').append($('<li class="search-label bg-blue-sharp font-white"></li>').html(term.val() + '&nbsp;<a class="fa fa-times"></a>'));
                    break;
                case '2':
                    $('#terms-maybe-container').fadeIn(200);
                    $('#terms-maybe-search').append($('<li class="search-label bg-yellow-soft font-white"></li>').html(term.val() + '&nbsp;<a class="fa fa-times"></a>'));
                    break;
                case '0':
                    $('#terms-not-container').fadeIn(200);
                    $('#terms-not-search').append($('<li class="search-label bg-red-intense font-white"></li>').html(term.val() + '&nbsp;<a class="fa fa-times"></a>'));
                    break;
            }
        }
        term.val('');
    });
    $('#terms-extra-input').keypress(function(e){
        if(e.which == 13){//Enter key pressed
            $('#terms-extra-btn').click();//Trigger search button click event
        }
    });
}

function removeTerms(){
    $('#terms-global-container').on('click','a', function(){
        item = $.trim($(this).closest('li').text());

        $(this).closest('li').remove();
        if($('#terms-defo-search').find('li').length < 1){
            $('#terms-defo-container').fadeOut(200);
        }
        if($('#terms-maybe-search').find('li').length < 1){
            $('#terms-maybe-container').fadeOut(200);
        }
        if($('#terms-not-search').find('li').length < 1){
            $('#terms-not-container').fadeOut(200);
        }

        var x = buscarItem(item);
        items.splice(x, 1);

    });
}

function buscarItem(item){
    var index;

    if(items.length == 0)
        return -1;

    for	(index = 0; index < items.length; index++) {
        console.log(items[index] + "-" + item);
        if(items[index] == item) {

            return index;
        }
    }
    return -1;
}

function scrollTo(section){
        $('html, body').animate({
            scrollTop: $(section).offset().top
        }, 800);
}

function getTweet(obj, key, val) {
    var objects = [];
    for (var i in obj) {
        if (!obj.hasOwnProperty(i)) continue;
        if (typeof obj[i] == 'object') {
            objects = objects.concat(getTweet(obj[i], key, val));
        } else if (i == key && obj[key] == val) {
            objects.push(obj);
        }
    }
    return objects;
}

function displayTweet(data){

}

function loadTweets (){
    var dataItems= {
        topic: items
    };

    $.post('web_service/API/twitter_API.php', dataItems, function(data, textStatus) {

    }, "json").done(function(data) {
            $('[data-content="social-twitter-count"]').text(data.length);
            //jsonTweets = data;

            for (i = 0; i < data.length; i++) {

                cloneTweet = $('#todo-tasklist-twitter').clone().removeAttr('id').show();
                cloneTweet.find('[data-content="nombre_usuario"]').text(data[i].nombre_usuario);
                cloneTweet.find('[data-content="screen_name"]').text('@' + data[i].screen_name);
                cloneTweet.find('[data-content="text_tweet"]').text(data[i].text_clean);
                var date = new Date(data[i].created_at).toDateString();
                cloneTweet.find('[data-content="created_at"]').html('<i class="fa fa-twitter"></i>' + date);
                cloneTweet.find('[data-content="klout"]').text(data[i].Klout);
                cloneTweet.find('[data-content="foto_perfil"]').attr('src', data[i].foto_perfil);
                cloneTweet.data('id_tweet', data[i].id_tweet);
                cloneTweet.data('klout', data[i].Klout);
                cloneTweet.data('location', data[i].location);
                if (parseInt(data[i].cant_retweet) != 0) {
                    cloneTweet.find('[data-content="cant_retweet"]').html('<i class="font-blue fa fa-retweet"></i>' + data[i].cant_retweet);
                } else {
                    cloneTweet.find('[data-content="cant_retweet"]').html('<i class="fa fa-retweet"></i>' + data[i].cant_retweet);
                }

                if (!data[i].sentimiento) {
                    cloneTweet.find('[data-content="sentimiento"]').text('No asignado');

                } else {
                    switch (data[i].sentimiento) {
                        case 'P+':
                            cloneTweet.find('[data-content="sentimiento"]').addClass('bg-yellow-soft').html('Muy positivo&nbsp;<i class="fa fa-plus"></i>');
                            cloneTweet.addClass('todo-tasklist-item-border-green');
                            cloneTweet.data('sentimiento', "MuyPositivo");
                            break;
                        case 'P':
                            cloneTweet.find('[data-content="sentimiento"]').addClass('bg-yellow-positive').html('Positivo&nbsp;<i class="fa fa-plus"></i>');
                            cloneTweet.addClass('todo-tasklist-item-border-green');
                            cloneTweet.data('sentimiento', "Positivo");
                            break;
                        case 'NEU':
                            cloneTweet.find('[data-content="sentimiento"]').text('Neutral');
                            cloneTweet.addClass('todo-tasklist-item-border-blue');
                            cloneTweet.data('sentimiento', "Neutral");
                            break;
                        case 'N':
                            cloneTweet.find('[data-content="sentimiento"]').addClass('bg-red-sunglo').html('Negativo&nbsp;<i class="fa fa-minus"></i>');
                            cloneTweet.addClass('todo-tasklist-item-border-red');
                            cloneTweet.data('sentimiento', "Negativo");
                            break;
                        case 'N+':
                            cloneTweet.find('[data-content="sentimiento"]').addClass('bg-red-mint').html('Muy Negativo&nbsp;<i class="fa fa-minus"></i>');
                            cloneTweet.addClass('todo-tasklist-item-border-red');
                            cloneTweet.data('sentimiento', "MuyNegativo");
                            break;
                        case 'NONE':
                            cloneTweet.find('[data-content="sentimiento"]').text('No asignado');
                            cloneTweet.data('sentimiento', "NoAsignado");
                            break;
                        default:
                            cloneTweet.find('[data-content="sentimiento"]').text('No asignado');
                            cloneTweet.data('sentimiento', "NoAsignado");
                            break;
                    }
                }
                $('#tweetLoad').append(cloneTweet);
            }
        //console.log('Loading Tweets');
        //loadInstagram();
        $('.loading-tweet').hide();
        }).fail(function(data){
        console.log(data);
    });

   //loadInstagram();
}
function loadInstagram(){
    var dataItems= {
        topic: items
    };
    $.post('web_service/API/instagram_API.php', dataItems, function(data, textStatus) {
        //console.log(data);
    }, "json").done(function(data){
        //console.log(data);
        $('[data-content="social-instagram-count"]').text(data.length);
        for(i = 0; i < data.length; i++){
            cloneInstagram = $('#todo-tasklist-instagram').clone().removeAttr('id').show();
            cloneInstagram.find('[data-content="foto_perfil"]').attr('src',data[i].foto_perfil);
            cloneInstagram.find('[data-content="nombre_usuario"]').text(data[i].nombre_usuario);
            cloneInstagram.find('[data-content="text_clean"]').text(data[i].text_clean);
            var date = new Date(parseInt(data[i].created_time)*1000).toDateString();
            cloneInstagram.find('[data-content="created_at"]').html('<i class="fa fa-instagram"></i>'+date);

            cloneInstagram.data('id_post',data[i].id_post);
            cloneInstagram.data('url',data[i].url);
            cloneInstagram.data('location',data[i].location);

            if(parseInt(data[i].likes) != 0){
                cloneInstagram.find('[data-content="likes"]').html('<i class="font-red-haze fa fa-heart"></i>' + data[i].likes);
            }else{
                cloneInstagram.find('[data-content="likes"]').html('<i class="fa fa-heart"></i>'+ data[i].likes);
            }
            if(parseInt(data[i].comments['count']) != 0){
                cloneInstagram.find('[data-content="count"]').html('<i class="font-blue fa fa-commenting"></i>'+ data[i].comments.count);
            }else{
                cloneInstagram.find('[data-content="count"]').html('<i class="fa fa-commenting"></i>'+ data[i].comments.count);
            }

            if(!data[i].sentiment){
                cloneInstagram.find('[data-content="sentimiento"]').text('No asignado');
            }else{
                switch (data[i].sentiment){
                    case '+2':
                        cloneInstagram.find('[data-content="sentimiento"]').addClass('bg-yellow-soft').html('Muy positivo&nbsp;<i class="fa fa-plus"></i>');
                        cloneInstagram.addClass('todo-tasklist-item-border-green');
                        break;
                    case '+1':
                        cloneInstagram.find('[data-content="sentimiento"]').addClass('bg-yellow-positive').html('Positivo&nbsp;<i class="fa fa-plus"></i>');
                        cloneInstagram.addClass('todo-tasklist-item-border-green');
                        break;
                    case '0':
                        cloneInstagram.find('[data-content="sentimiento"]').text('Neutral');
                        cloneInstagram.addClass('todo-tasklist-item-border-blue');
                        break;
                    case '-1':
                        cloneInstagram.find('[data-content="sentimiento"]').addClass('bg-red-sunglo').html('Negativo&nbsp;<i class="fa fa-minus"></i>');
                        cloneInstagram.addClass('todo-tasklist-item-border-red');
                        break;
                    case '-2':
                        cloneInstagram.find('[data-content="sentimiento"]').addClass('bg-red-mint').html('Muy Negativo&nbsp;<i class="fa fa-minus"></i>');
                        cloneInstagram.addClass('todo-tasklist-item-border-red');
                        break;
                    default:
                        cloneInstagram.find('[data-content="sentimiento"]').text('No asignado');
                        break;
                }
            }
            $('#instaLoad').append(cloneInstagram);
        }
        $('.loading-instagram').hide();
    });
}

function loadYoutube () {
    var dataItems = {
        topic: items
    };

    $.post('web_service/API/youtube_API.php', dataItems, function (data, textStatus) {

    }, "json").done(function (data) {
        $('[data-content="social-youtube-count"]').text(data.length);
        for (i = 0; i < data.length; i++) {

            cloneYoutube = $('#todo-tasklist-youtube').clone().removeAttr('id').show();
            cloneYoutube.find('[data-content="title"]').text(data[i].title);
            cloneYoutube.find('[data-content="channelTitle"]').html("<i class='fa fa-youtube-play'></i>" + data[i].channelTitle);
            cloneYoutube.find('[data-content="description"]').text(data[i].description);
            cloneYoutube.data('id', data[i].id);

            $('#youtubeLoad').append(cloneYoutube);
        }

        $('.loading-youtube').hide();
    }).fail(function (data) {
        console.log(data);
    });
}


function loadTumblr () {
    var dataItems = {
        topic: items
    };

    $.post('web_service/API/tumblr_API.php', dataItems, function (data, textStatus) {

    }, "json").done(function (data) {
        $('[data-content="social-tumblr-count"]').text(data.length-1);
        for (i = 1; i < data.length; i++) {

            cloneTumblr = $('#todo-tasklist-tumblr').clone().removeAttr('id').show();
            cloneTumblr.find('[data-content="title"]').text(data[i].title);
            cloneTumblr.find('[data-content="name"]').text('@' + data[i].name);
            cloneTumblr.find('[data-content="description"]').text(data[i].text_clean);
            cloneTumblr.find('[data-content="updated"]').text(data[i].updated);
            cloneTumblr.find('[data-content="posts"]').html('<i class="fa fa-tumblr"></i>' + data[i].posts);
            cloneTumblr.data('url', data[i].url);

            if(data[i].nsfw == 'false'){
                cloneTumblr.find('[data-content="nsfw"]').html('<i class="fa fa-eye"></i>');

            }else{
                cloneTumblr.find('[data-content="nsfw"]').html('<i class="fa fa-exclamation-circle"></i>');
            }

            $('#tumblrLoad').append(cloneTumblr);
        }

        $('.loading-tumblr').hide();
    }).fail(function (data) {
        console.log(data);
    });
}

function loadReddit(){
    var dataItems= {
        topic: items
    };

    $.post('web_service/API/reddit_API.php', dataItems, function(data, textStatus) {

    }, "json").done(function(data) {
        $('[data-content="social-reddit-count"]').text(data.length);
        //jsonTweets = data;
        for (i = 0; i < data.length; i++) {
            cloneReddit = $('#todo-tasklist-reddit').clone().removeAttr('id').show();
            cloneReddit.find('[data-content="title"]').text(data[i].title);
            cloneReddit.find('[data-content="nombre_usuario"]').text('@' + data[i].nombre_usuario);
            cloneReddit.find('[data-content="text_clean"]').text(data[i].text_clean);


            cloneReddit.data('id', data[i].id);
            cloneReddit.data('url', data[i].url);
            cloneReddit.data('permalink', data[i].permalink);

            if(parseInt(data[i].score) != 0){
                cloneReddit.find('[data-content="likes"]').html('<i class="font-yellow fa fa-star"></i>' + data[i].score);
            }else{
                cloneReddit.find('[data-content="likes"]').html('<i class="fa fa-star-o"></i>'+ data[i].score);
            }
            if(parseInt(data[i].num_comments) != 0){
                cloneReddit.find('[data-content="count"]').html('<i class="font-blue fa fa-commenting"></i>'+ data[i].num_comments);
            }else{
                cloneReddit.find('[data-content="count"]').html('<i class="fa fa-commenting-o"></i>'+ data[i].num_comments);
            }


            if (!data[i].sentiment) {
                cloneReddit.find('[data-content="sentimiento"]').text('No asignado');

            } else {
                switch (data[i].sentiment) {
                    case 'P+':
                        cloneReddit.find('[data-content="sentimiento"]').addClass('bg-yellow-soft').html('Muy positivo&nbsp;<i class="fa fa-plus"></i>');
                        cloneReddit.addClass('todo-tasklist-item-border-green');
                        cloneReddit.data('sentimiento', "MuyPositivo");
                        break;
                    case 'P':
                        cloneReddit.find('[data-content="sentimiento"]').addClass('bg-yellow-positive').html('Positivo&nbsp;<i class="fa fa-plus"></i>');
                        cloneReddit.addClass('todo-tasklist-item-border-green');
                        cloneReddit.data('sentimiento', "Positivo");
                        break;
                    case 'NEU':
                        cloneReddit.find('[data-content="sentimiento"]').text('Neutral');
                        cloneReddit.addClass('todo-tasklist-item-border-blue');
                        cloneReddit.data('sentimiento', "Neutral");
                        break;
                    case 'N':
                        cloneReddit.find('[data-content="sentimiento"]').addClass('bg-red-sunglo').html('Negativo&nbsp;<i class="fa fa-minus"></i>');
                        cloneReddit.addClass('todo-tasklist-item-border-red');
                        cloneReddit.data('sentimiento', "Negativo");
                        break;
                    case 'N+':
                        cloneReddit.find('[data-content="sentimiento"]').addClass('bg-red-mint').html('Muy Negativo&nbsp;<i class="fa fa-minus"></i>');
                        cloneReddit.addClass('todo-tasklist-item-border-red');
                        cloneReddit.data('sentimiento', "MuyNegativo");
                        break;
                    case 'NONE':
                        cloneReddit.find('[data-content="sentimiento"]').text('No asignado');
                        cloneReddit.data('sentimiento', "NoAsignado");
                        break;
                    default:
                        cloneReddit.find('[data-content="sentimiento"]').text('No asignado');
                        cloneReddit.data('sentimiento', "NoAsignado");
                        break;
                }
            }
            $('#redditLoad').append(cloneReddit);
        }
        //console.log('Loading Tweets');
        //loadInstagram();
        $('.loading-reddit').hide();
    }).fail(function(data){
        console.log(data);
    });

    //loadInstagram();
}



function selectTweet(){
    $('#tweetLoad').on('click','.todo-tasklist-item',function(event){
        $("#panel").show();
        $("#panel-instagram").empty().hide();
        $("#panel-youtube").hide();
        $("#panel-tumblr").hide();
        $("#panel-tweet").show();
        changeSelect($(this));

        $.getJSON("https://api.twitter.com/1/statuses/oembed.json?id="+$(this).data('id_tweet')+"&align=center&callback=?",
            function(data){$('#panel-tweet').html(data.html);});
        $('#klout').text($(this).data('klout'));

        console.log($(this).data('location'));
        if($(this).data('location') != "" || $(this).data('location')!= null ) {
            var embed = "<iframe width='425' height='350' frameborder='0' scrolling='no' marginheight='0' marginwidth='0'src='https://maps.google.com/maps?&amp;q=" + encodeURIComponent($(this).data('location')) + "&amp;output=embed'> </iframe>";
            $('#map').html(embed);
        }else{
            $('#map').html("<h1>No tiene Ubicación");
        }
    });
}

function selectInstagram(){
    $('#instaLoad').on('click','.todo-tasklist-item',function(event){
        $("#panel").show();
        $("#panel-tweet").empty().hide();
        $("#panel-youtube").hide();
        $("#panel-tumblr").hide();
        $("#panel-instagram").show();
        changeSelect($(this));

        var URL = "http://api.instagram.com/oembed?url="+encodeURIComponent($(this).data('url'))+"";
        $.ajax({
            url: URL,
            dataType: "jsonp", // this is important to circumvent cross-domain issues
            cache: false,
            success: function (response) {

                $("#panel-instagram").html(response.html);
                if ( typeof window.instgrm !== 'undefined' ) {
                    window.instgrm.Embeds.process();
                }
            },
            error: function () {
                $("#panel-instagram").html("<p>There was an error in the ajax call</p>");
            }
        });
        if($(this).data('location')!= null ) {
            loc = $(this).data('location');
            lat = loc.latitude;
            long = loc.longitude;
            console.log(lat);
            console.log(long);
            var embed = "<iframe width='425' height='350' frameborder='0' scrolling='no' marginheight='0' marginwidth='0'src='https://maps.google.com/maps?&amp;q="+lat+","+long+ "&amp;output=embed'> </iframe>";
                $('#map').html(embed);
        }else{
            $('#map').html("<h1>No tiene Ubicación");
        }
    });
}

function selectYoutube(){
    $('#youtubeLoad').on('click','.todo-tasklist-item',function(event){
        $("#panel").show();
        $("#panel-tweet").empty().hide();
        $("#panel-instagram").empty().hide();
        $("#panel-tumblr").hide();
        $("#panel-youtube").show();
        changeSelect($(this));

        id = $(this).data('id');
        title = $(this).find('[data-content="title"]').text();
        description = $(this).find('[data-content="description"]').text();
        channel = $(this).find('[data-content="channelTitle"]').text();
        console.log(channel);

        $("#player").html("<iframe id='player1' type='text/html' width='640' height='390' src='http://www.youtube.com/embed/"+ id+"?showinfo=0' frameborder='0'></iframe>");
        $("#v-title").text(title);
        $("#v-description").text(description);
        $("#v-channel").attr("href", "https://www.youtube.com/user/"+channel+"").html("<i class='font-red-haz fa fa-youtube-play'></i>" + channel);



        if($(this).data('location')!= null ) {
            loc = $(this).data('location');
            lat = loc.latitude;
            long = loc.longitude;
            console.log(lat);
            console.log(long);
            var embed = "<iframe width='425' height='350' frameborder='0' scrolling='no' marginheight='0' marginwidth='0'src='https://maps.google.com/maps?&amp;q="+lat+","+long+ "&amp;output=embed'> </iframe>";
            $('#map').html(embed);
        }else{
            $('#map').html("<h1>No tiene Ubicación");
        }
    });
}


function selectTumblr(){
    $('#tumblrLoad').on('click','.todo-tasklist-item',function(event){
        $("#panel").show();
        $("#panel-instagram").empty().hide();
        $("#panel-youtube").hide();
        $("#panel-tweet").empty().hide();
        $("#panel-tumblr").show();
        changeSelect($(this));

        name= $(this).find('[data-content="name"]').text();
        description= $(this).find('[data-content="description"]').text();
        url = $(this).data('url');

        var html = "<blockquote class='embedly-card' " +
            "data-card-key='8aee65e60371439ebb8cb9c54038521e' " +
            "data-card-controls='0'>" +
            "<h4><a href='"+url+"'>" +
            name +
            "</a>" +
            "</h4><p>" +
            description +
            "</p></blockquote>";

        $('#tumblr').html(html);


        if($(this).data('location')!= null ) {
            location = $(this).data('location');
            var embed = "<iframe width='425' height='350' frameborder='0' scrolling='no' marginheight='0' marginwidth='0'" +
                "src='https://maps.google.com/maps?&amp;q=" + encodeURIComponent(location) + "&amp;output=embed'> </iframe>";
                $('#map').html(embed);
        } else {
            $('#map').html("<h1>No tiene Ubicación");
        }
    });
}

function selectReddit(){
    $('#redditLoad').on('click','.todo-tasklist-item',function(event){

        $("#panel").show();
        $("#panel-instagram").empty().hide();
        $("#panel-youtube").hide();
        $("#panel-tumblr").hide();
        $("#panel-tweet").hide();
        $("#panel-reddit").show();

        changeSelect($(this));
        var permalink = $(this).data('permalink');

        url = "https://www.reddit.com"+ permalink +".json";
        console.log(url);
        $("#reddit-comments").empty();
        $.getJSON(url, function(data) {
            addComments($('.comments'), data[1].data.children);
        });

        function addComments(parentElem, comments)
        {
            for (comment in comments)
            {
                var commentData = comments[comment].data;
                var bodyElem = '<div class="body"><p>' + commentData.body + '</p></div>';
                var $commentElem = $('<div id="comment-' + commentData.parent_id + '" class="comment" style="margin-left: 10px">' + bodyElem + '</div>');
                parentElem.append($commentElem);

                if (commentData.replies)
                {
                    var $replyElem = $('<div class="replies"> </div>');
                    $commentElem.append($replyElem);
                    addComments($replyElem, commentData.replies.data.children);
                }
            }
        }
        console.log($(this).data('location'));
        if($(this).data('location') != "" || $(this).data('location')!= null || $(this).data('location')=== undefined) {
            var embed = "<iframe width='425' height='350' frameborder='0' scrolling='no' marginheight='0' marginwidth='0'src='https://maps.google.com/maps?&amp;q=" + encodeURIComponent($(this).data('location')) + "&amp;output=embed'> </iframe>";
            $('#map').html(embed);
        }else{
            $('#map').html("<h1>No tiene Ubicación");
        }

    });
}

function changeSelect(object){
    $('.selected-item').removeClass('selected-item');
    object.addClass('selected-item');
}


function faveFlagContent(){
    $('#tweetLoad').on('click','.fa',function(event){
        event.stopPropagation();
        $(this).toggleClass('font-grey-salsa');
        if($(this).hasClass('fa-star')){
            $(this).toggleClass('font-yellow-saffron');
        }else if($(this).hasClass('fa-flag')){
            $(this).toggleClass('font-red-haze');
        }
    });
}

function hidePost(){
    $('#nav-red').click(function(){

        $("#panel").hide();
    });
}


$(document).ready(function(){
    $('#page-breadcrumb').html('B&uacute;squeda');
    $('#menu-busqueda').addClass('active');

    addMainTerms();
    addExtraTerms();
    removeTerms();
    submitSearch();
    //loadTweets();
    //loadInstagram();
    //loadReddit();
    //loadReddit();
    selectTumblr();
    selectYoutube();
    selectInstagram();
    selectTweet();
    selectSocial();
    hidePost();
    faveFlagContent();
    selectReddit();
    portHeight = $('#portlet-body-content').height();
    $('.todo-tasklist').slimScroll({
        color: '#32C5D2',
        railVisible: true,
        height: portHeight-100,
        alwaysVisible: true
    });
});
