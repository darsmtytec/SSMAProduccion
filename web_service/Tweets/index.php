<html hola_ext_inject="disabled" slick-uniqueid="3">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title> gigatweeter - stream twitter trending topics live </title>

    <link rel="stylesheet" href="content/css/tweet-search.css" type="text/css">

    <link rel="stylesheet" href="content/css/tweet-search.css" type="text/css">

    <script src="content/js/mootools-core-1.4.5.js" type="text/javascript"></script>
    <script src="content/js/mootools-more-1.4.0.1.js" type="text/javascript"></script>
    <script src="content/js/ts-lib.js" type="text/javascript"></script>
    <script src="content/js/tweet-stream.js" type="text/javascript"></script>

    <script type="text/javascript">
        var _is_prod = true;
        window.addEvent('load', Ui.init.bind(Ui));
    </script>

    <script type="text/html" id="tmpl-tweet">

        <div class='t-item'>
            <div>
                <div class='left profile-pic'><img src='#{profile_image_url}' title='#{from_user}'
                                                   style='width: 48px; height: 48px'></div>

                <span><a href='http://twitter.com/#{from_user}'><b>#{from_user}</b></a></span>
                #{text}
                <span class='t-time'>#{created_time}</span>
                #{popular_tag}
                <div class='clear'></div>
            </div>
        </div>

    </script>

    <script id="tmpl-tweet-col" type="text/html">
        <td id='tc-#{column_id}' class='tweet-col'>
            <form class='t-search-form'
                  onsubmit='Ui.start_search.bind(Ui)("t-search-#{column_id}", "#{column_id}"); return false;'>
                <input id='t-search-#{column_id}' type='text' value='#{query}'/>
                <a class='close-link' href='javascript:Ui.delete_column.bind(Ui)("#{column_id}")'>�</a>
            </form>

            <div class='t-feed-info'>
                <span id='t-rate-#{column_id}'>0 tweets/min</span>
                (
                <a class='pause-link' href='javascript:void(0);'
                   onclick='Ui.toggle_pause.bind(Ui)(this, "#{column_id}")'>pause</a> |
                <a class='pause-link' href='javascript:void(0);' onclick='Ui.clear_search.bind(Ui)("#{column_id}")'>clear</a>
                )
            </div>

            <div id='pop-tweets-alert-#{column_id}' class='pop-tweets-alert'
                 onclick='Ui.toggle_popular.bind(Ui)("#{column_id}")' style='display:none'>5 popular tweets. Click to
                show.
            </div>
            <div id='pop-tweets-#{column_id}' class='pop-tweets' style='display:none'></div>
            <div id='tweet-list-#{column_id}' class='tweet-list'></div>
        </td>
    </script>


    <script type="text/javascript" charset="utf-8" async=""
            src="https://platform.twitter.com/js/button.71000885400e222c3c0eec823f8f93f0.js"></script>
</head>
<body cz-shortcut-listen="true">

<div id="wrapper">

    <div class="cd-header">
        <div>
            <div class="cd-main-heading"><a href="./">gigatweet<span style="color:#ccc;">/stream</span></a></div>
            <div class="cd-sub-heading"></div>
        </div>
    </div>

    <div id="tab-row">
        <div id="ad-row" class="right">
            <span><a href="http://itunes.apple.com/us/app/bluetick/id397093103"><b>BlueTick</b> - get organized with
                    todoist.com on your iPhone</a></span>
        </div>

        <a href="./counter">counter</a>
        <a href="./stream" class="t-active-tab">stream</a>

	<span id="t-retweet">
		<iframe id="twitter-widget-0" scrolling="no" frameborder="0" allowtransparency="true"
                class="twitter-share-button twitter-share-button-rendered twitter-tweet-button"
                title="Twitter Tweet Button"
                src="http://platform.twitter.com/widgets/tweet_button.fd774b599f565016d763dd860cb31c79.en.html#dnt=false&amp;id=twitter-widget-0&amp;lang=en&amp;original_referer=http%3A%2F%2Fgigatweeter.com%2Fstream&amp;size=m&amp;text=gigatweeter%20-%20stream%20twitter%20trending%20topics%20live&amp;time=1461256757860&amp;type=share&amp;url=http%3A%2F%2Fgigatweeter.com%2Fstream"
                style="position: static; visibility: visible; width: 60px; height: 20px;"></iframe>
		<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
	</span>

        <div class="clear"></div>

    </div>

    <div id="t-body">

        <div id="select-bar" class="left">
	<span>
		<b>language:</b>
		<a id="ll-en" href='javascript:Ui.change_language("en")'>en</a> |
		<a id="ll-fr" href='javascript:Ui.change_language("fr")'>fr</a> |
		<a id="ll-it" href='javascript:Ui.change_language("it")'>it</a> |
		<a id="ll-de" href='javascript:Ui.change_language("de")'>de</a> |
		<a id="ll-es" href="#" style="color: black;">es</a> |
		<a id="ll-ja" href='javascript:Ui.change_language("ja")'>ja</a> |
		<a id="ll-pt" href='javascript:Ui.change_language("pt")'>pt</a>
	</span>

	<span id="tt-list" style="display:none">
		<b>trending:</b>
	</span>
        </div>

        <div id="col-edit-bar" class="right">
            <a id="t-add-col" href="javascript:Ui.add_column()">+</a>
        </div>

        <div class="clear"></div>

        <table id="tweet-table">
            <tbody>
            <tr id="t-columns">
                <td id="tc-C28" class="tweet-col">
                    <form class="t-search-form"
                          onsubmit="Ui.start_search.bind(Ui)(&quot;t-search-C28&quot;, &quot;C28&quot;); return false;">
                        <input id="t-search-C28" type="text" value="itesm"> <a class="close-link"
                                                                               href='javascript:Ui.delete_column.bind(Ui)("C28")'>�</a>
                    </form>
                    <div class="t-feed-info"><span id="t-rate-C28">0.36 tweets/min</span> ( <a class="pause-link"
                                                                                               href="javascript:void(0);"
                                                                                               onclick="Ui.toggle_pause.bind(Ui)(this, &quot;C28&quot;)">pause</a>
                        | <a class="pause-link" href="javascript:void(0);"
                             onclick="Ui.clear_search.bind(Ui)(&quot;C28&quot;)">clear</a> )
                    </div>
                    <div id="pop-tweets-alert-C28" class="pop-tweets-alert"Alumnos
    </div>
                    <div id="pop-tweets-C28" class="pop-tweets" style="display:none">
                        <div class="t-item" style="opacity: 1; visibility: visible;">
                            <div>
                                <div class="left profile-pic"><img
                                        src="http://pbs.twimg.com/profile_images/701763580983537664/jTw8HJIX_normal.png"
                                        title="Tec de Monterrey �" style="width: 48px; height: 48px"></div>
                                <span><a href="http://twitter.com/Tec de Monterrey �"><b>Tec de Monterrey
                                            �</b></a></span> Vive tu carrera mientras la construyes, decide lo que m�s
                                te gusta con el modelo <a href="javascript:Ui.add_column('#LAEt')">#LAEt</a>
                                https://t.co/giFBlS7hdV https://t.co/yLKqVyNwmg <span class="t-time">07:15PM</span>
                                <span class="pop-tweet-tag">22 retweets</span>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="t-item" style="opacity: 1; visibility: visible;">
                            <div>
                                <div class="left profile-pic"><img
                                        src="http://pbs.twimg.com/profile_images/581297755252920320/NMNLVYUy_normal.png"
                                        title="El Economista" style="width: 48px; height: 48px"></div>
                                <span><a href="http://twitter.com/El Economista"><b>El Economista</b></a></span>
                                �Estudias en la UNAM, ITESM o IPN? Eres alumno de las universidades mejor rankeadas.
                                Mira toda la lista aqu�: https://t.co/TANPG9qmV3 <span class="t-time">05:39PM</span>
                                <span class="pop-tweet-tag">60 retweets</span>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                    <div id="tweet-list-C28" class="tweet-list">

                    </div>
                </td>
            </tr>
            </tbody>
        </table>

    </div>


    <div id="push"></div>
</div>


<div id="#f-wrapper">
</div>

<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-57284-12']);
    _gaq.push(['_trackPageview']);

    (function () {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();

</script>


<iframe id="rufous-sandbox" scrolling="no" frameborder="0" allowtransparency="true" allowfullscreen="true"
        style="position: absolute; visibility: hidden; display: none; width: 0px; height: 0px; padding: 0px; border: none;"></iframe>
</body>
</html>