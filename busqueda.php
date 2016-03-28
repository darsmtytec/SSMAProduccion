<!DOCTYPE html>
<html lang="en">
<?php
include 'header.php';
?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="busqueda/busqueda.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/socicon/socicon.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet"
      type="text/css"/>
<link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
<script src="https://maps.googleapis.com/maps/api/js"
        async defer></script>
<script async src='//cdn.embedly.com/widgets/platform.js' charset='UTF-8'></script>
<script src="//platform.instagram.com/en_US/embeds.js"></script>


<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="assets/apps/css/todo-2.min.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL STYLES -->
<!--==============================
    Search Section
==================================-->
<div id="section-search" class="section">
    <div class="row">
        <!--==============================
            Config
        ==================================-->
        <div class="col-md-6">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="icon-settings font-red-sunglo"></i>
                        <span class="caption-subject bold uppercase"> Configuración de Búsqueda</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form role="form">
                        <div class="form-body">
                            <div class="form-group form-md-line-input has-info form-md-floating-label">
                                <div class="input-group input-group-lg">
                                    <div class="input-group-control">
                                        <input id="terms-main-input" type="text" class="form-control">
                                        <label for="form_control">Agrega los términos de búsqueda</label>
                                    </div>
                                    <span id="terms-main-btn" class="input-group-btn btn-right">
                                        <button class="btn green-meadow" type="button">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <a id="advanced" class="tooltips" data-original-title="Configuraciones de búsqueda extras">Opciones
                                Avanzadas...</a>
                            <!--ADVANCED------------------------------------------------------->
                            <p>
                            </p>
                            <!--SocialIcons--------------------------------------------------->
                            <div id="section-advanced" class="section" style="display: none">
                                <h4>Redes Sociales</h4>
                                <div class="socicons">
                                    <a class="socicon-btn socicon-btn-circle socicon-solid bg-green font-white bg-hover-grey-salsa socicon-twitter tooltips"
                                       data-original-title="Twitter"></a>
                                    <a class="socicon-btn socicon-btn-circle socicon-solid bg-blue-steel font-white bg-hover-grey-salsa socicon-facebook tooltips"
                                       data-original-title="Facebook"></a>
                                    <a class="socicon-btn socicon-btn-circle socicon-solid bg-grey-gallery font-white bg-hover-grey-salsa socicon-instagram tooltips"
                                       data-original-title="Instagram"></a>
                                    <a class="socicon-btn socicon-btn-circle socicon-solid bg-blue-chambray font-white bg-hover-grey-salsa socicon-tumblr tooltips"
                                       data-original-title="Tumblr"></a>
                                    <a class="socicon-btn socicon-btn-circle socicon-solid bg-red font-white bg-hover-grey-salsa socicon-youtube tooltips"
                                       data-original-title="Youtube"></a>
                                    <a class="socicon-btn socicon-btn-circle socicon-solid bg-blue-hoki font-white bg-hover-grey-salsa socicon-linkedin tooltips"
                                       data-original-title="Linkedin"></a>
                                    <a class="socicon-btn socicon-btn-circle socicon-solid bg-red font-white bg-hover-grey-salsa socicon-pinterest tooltips"
                                       data-original-title="Pinterest"></a>
                                    <a class="socicon-btn socicon-btn-circle socicon-solid bg-red font-white bg-hover-grey-salsa socicon-google tooltips"
                                       data-original-title="Google"></a>
                                    <a class="socicon-btn socicon-btn-circle socicon-solid bg-yellow-gold font-white bg-hover-grey-salsa socicon-blogger tooltips"
                                       data-original-title="Blogger"></a>
                                    <a class="socicon-btn socicon-btn-circle socicon-solid bg-red-flamingo font-white bg-hover-grey-salsa socicon-reddit tooltips"
                                       data-original-title="Reddit"></a>
                                </div>
                                <!--SocialIcons-->
                                <div class="form-group form-md-checkboxes">
                                    <label>NSFW (Not Safe for Work)</label>
                                    <div class="md-checkbox-inline">
                                        <div class="md-checkbox tooltips"
                                             data-original-title="Búsquedas de contenido gráfico / ofensivo">
                                            <input type="checkbox" id="checkbox7" class="md-check" checked="">
                                            <label for="checkbox7">
                                                <span class="inc"></span>
                                                <span class="check"></span>
                                                <span class="box"></span>
                                                18+</label>
                                        </div>
                                    </div>
                                </div>
                                <p></p>
                                <p>
                                </p>
                                <div class="form-group form-md-line-input has-info">
                                    <select id="terms-select" class="form-control" id="form_control_1">
                                        <option class="font-blue-sharp" value="1">Se incluyen todas las palabras...
                                        </option>
                                        <option class="font-yellow-soft" value="2">Se incluyen algunas de las
                                            palabras...
                                        </option>
                                        <option class="font-red-intense" value="0">No se incluyen las palabras...
                                        </option>
                                    </select>
                                    <label for="form_control_1">Opciones de términos</label>
                                </div>
                                <p></p>
                                <p>
                                </p>
                                <div class="form-group form-md-line-input has-info form-md-floating-label">
                                    <div class="input-group input-group-lg">
                                        <div class="input-group-control">
                                            <input id="terms-extra-input" type="text" class="form-control">
                                            <label for="form_control">Agrega los términos de búsqueda</label>
                                        </div>
                                    <span id="terms-extra-btn" class="input-group-btn btn-right">
                                        <button class="btn blue-madison" type="button">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </span>
                                    </div>
                                </div>
                                <p></p>
                            </div>
                            <div class="form-actions noborder">
                                <a id="search-btn" class="btn btn-lg btn-primary">
                                    Buscar <i class="fa fa-search"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                    <!--PortletBody-->
                </div>
                <!--Portlet-->
            </div>
        </div>
        <!--==============================
            Terms
            ==================================-->
        <div class="col-md-6">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="icon-fire font-red-sunglo"></i>
                        <span class="caption-subject bold uppercase"> Términos de Búsqueda</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form role="form">
                        <div id="terms-global-container" class="form-body">
                            <div id="terms-main-container">
                                <h4>Términos de Búsqueda</h4>
                                <ul id="terms-main-search" class="list-inline">
                                    <!--li class="search-label bg-green-meadow font-white">Incluye&nbsp;<a class="fa fa-times"></a></li-->
                                </ul>
                            </div>
                            <div id="terms-defo-container" style="display: none;">
                                <h4>Incluye...</h4>
                                <ul id="terms-defo-search" class="list-inline">
                                    <!--li class="search-label bg-blue-sharp font-white">Incluye&nbsp;<a class="fa fa-times"></a></li-->
                                </ul>
                            </div>
                            <div id="terms-maybe-container" style="display: none;">
                                <h4>Puede contener...</h4>
                                <ul id="terms-maybe-search" class="list-inline">
                                    <!--li class="search-label bg-yellow-soft font-white">Contiene&nbsp;<a class="fa fa-times"></a></li-->
                                </ul>
                            </div>
                            <div id="terms-not-container" style="display: none;">
                                <h4>Se excluye...</h4>
                                <ul id="terms-not-search" class="list-inline">
                                    <!--li class="search-label bg-red-intense font-white">Excluido&nbsp;<a class="fa fa-times"></a></li-->
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End Config Row-->
</div>
<!--End Search Section-->
<!--==============================
    Contents Section
==================================-->
<div id="section-posts">
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN TODO SIDEBAR -->
            <div class="todo-ui">
                <div class="todo-sidebar">
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption" data-toggle="collapse" data-target=".todo-project-list-content">
                                <span class="caption-subject font-green-sharp bold uppercase">REDES SOCIALES </span>
                                <span class="caption-helper visible-sm-inline-block visible-xs-inline-block">click para ver la lista</span>
                            </div>
                        </div>
                        <div class="portlet-body todo-project-list-content" style="height: auto;">
                            <div class="todo-project-list">
                                <ul id="nav-red" class="nav nav-stacked">
                                    <li class="active">
                                        <a href="#tab_twitter" data-toggle="tab">
                                            <span id="tweet-count" class="badge bg-green"
                                                  data-content="social-twitter-count">0</span>
                                            Twitter
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab_instagram" data-toggle="tab">
                                            <span id="instagram-count" class="badge bg-grey-gallery"
                                                  data-content="social-instagram-count"> 0 </span> Instagram
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab_youtube" data-toggle="tab">
                                            <span id="youtube-count" class="badge badge-danger"
                                                  data-content="social-youtube-count"> 0 </span> Youtube
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab_facebook" data-toggle="tab">
                                            <span class="badge badge-info"> 0 </span> Facebook
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab_tumblr" data-toggle="tab">
                                            <span id="tumblr-count" class="badge badge-warning"
                                                  data-content="social-tumblr-count"> 0 </span> Tumblr
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab_reddit" data-toggle="tab">
                                            <span id="reddit-count" class="badge"
                                                  data-content="social-reddit-count"> 0 </span> Reddit
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption" data-toggle="collapse" data-target=".todo-project-list-content-tags">
                                <span class="caption-subject font-red bold uppercase">TAGS </span>
                                <span class="caption-helper visible-sm-inline-block visible-xs-inline-block">click to view</span>
                            </div>
                        </div>
                        <div class="portlet-body todo-project-list-content todo-project-list-content-tags"
                             style="height: auto;">
                            <div class="todo-project-list">
                                <ul class="nav nav-pills nav-stacked">
                                    <li>
                                        <a href="javascript:;">
                                            <span class="badge badge-danger"> 6 </span> #TecMty </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="badge badge-info"> 2 </span> #logo </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="badge badge-success"> 14 </span> #EXATEC </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="badge badge-warning"> 6 </span> #JirafasLocas </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END TODO SIDEBAR -->
                <!-- BEGIN TODO CONTENT -->
                <div class="todo-content">
                    <div class="portlet light ">
                        <!-- PROJECT HEAD -->
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-bar-chart font-green-sharp hide"></i>
                                <span class="caption-helper">Término Buscado:</span> &nbsp;
                                <span id='termBuscado' data-content=""
                                      class="caption-subject font-green-sharp bold uppercase"></span>
                            </div>
                            <div class="actions">
                                <div class="btn-group">
                                    <a class="btn green btn-circle btn-sm" href="javascript:;" data-toggle="dropdown"
                                       data-hover="dropdown" data-close-others="true"> Opciones
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a href="javascript:;"> Lista </a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="javascript:;"> Exportar
                                                <span class="label label-danger pull-right"><span
                                                        class="fa fa-upload"></span></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- end PROJECT HEAD -->
                        <div id="portlet-body-content" class="portlet-body">
                            <div class="row">
                                <div class="col-md-5 col-sm-4"><!---->
                                    <div class="tab-content">

                                        <div class="tab-pane active" id="tab_twitter">

                                            <h3 class="font-blue sbold"><i class="fa fa-twitter">&nbsp;</i>Twitter</h3>
                                            <div id="tweetLoad" class="todo-tasklist">
                                                <div class='loading1 loading-tweet' style='display:none;'><img id=''
                                                                                                               src='busqueda/img/loading.gif'
                                                                                                               width='36'
                                                                                                               height='36'
                                                                                                               alt='loading gif'/>
                                                </div>
                                                <div id="todo-tasklist-twitter" class="todo-tasklist-item "
                                                     style="display: none;">
                                                    <img data-content="foto_perfil" class="todo-userpic pull-left"
                                                         src="busqueda/img/twitter-egg.jpeg" width="27px" height="27px">
                                                    <div class="todo-tasklist-item-title">
                                                        <span data-content="nombre_usuario">Nombre</span>
                                                        <a>
                                                            <small class="font-grey-salsa" data-content="screen_name">
                                                                @screenName
                                                            </small>
                                                        </a>
                                                <span class="pull-right">
                                                    <i class="fa fa-star font-grey-salsa""></i>
                                                    <i class="fa fa-flag font-grey-salsa""></i>
                                                </span>
                                                    </div>
                                                    <div class="todo-tasklist-item-text" data-content="text_tweet">
                                                        Lorem dolor sit amet ipsum dolor sit consectetuer dolore.
                                                    </div>
                                                    <div class="todo-tasklist-controls pull-left">
                                                        <span class="todo-tasklist-date" data-content="created_at">
                                                            <i class="fa fa-twitter"></i> 01 Jan 2016
                                                        </span>
                                                        <span class="todo-tasklist-date" data-content="cant_retweet">
                                                            <i class="fa fa-retweet"></i>0
                                                        </span>
                                                        <span
                                                            class="todo-tasklist-badge badge badge-roundless bg-yellow-gold klout">K</span>
                                                        <span data-content="klout">0</span>
                                                    </div>
                                                    <div class="todo-tasklist-controls pull-right">
                                                <span class="todo-tasklist-badge badge badge-roundless"
                                                      data-content="sentimiento">
                                                    Sentiment
                                                </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab_instagram">
                                            <h3 class="font-grey-gallery sbold"><i class="fa fa-instagram">&nbsp;</i>Instagram
                                            </h3>
                                            <div id="instaLoad" class="todo-tasklist">
                                                <div class='loading1 loading-instagram' style='display:none;'><img id=''
                                                                                                                   src='busqueda/img/loading.gif'
                                                                                                                   width='36'
                                                                                                                   height='36'
                                                                                                                   alt='loading gif'/>
                                                </div>
                                                <div id="todo-tasklist-instagram" class="todo-tasklist-item"
                                                     style="display: none;">
                                                    <img data-content="foto_perfil" class="todo-userpic pull-left"
                                                         src="busqueda/img/instagram-default.jpg" width="27px"
                                                         height="27px">
                                                    <div class="todo-tasklist-item-title">
                                                        <a data-content="nombre_usuario">Nombre</a>
                                                <span class="pull-right">
                                                    <i class="fa fa-star font-grey-salsa""></i>
                                                    <i class="fa fa-flag font-grey-salsa""></i>
                                                </span>
                                                    </div>
                                                    <div class="todo-tasklist-item-text" data-content="text_clean"> orem
                                                        ipsum dolor sit amet, consectetur adipiscing elit. Sed non
                                                        condimentum orci. Praesent sed risus vulputate, elementum dui a,
                                                        vulputate quam. Nam porta ornare nunc quis elementum. Curabitur
                                                        efficitur massa neque, a aliquam magna scelerisque at.
                                                    </div>
                                                    <div class="todo-tasklist-controls pull-left">
                                                        <span class="todo-tasklist-date" data-content="created_at">
                                                            <i class="fa fa-instagram"></i> 01 Jan 2016
                                                        </span>
                                                        <span class="todo-tasklist-date" data-content="likes">
                                                            <i class="fa fa-heart"></i>0
                                                        </span>
                                                        <span class="todo-tasklist-date" data-content="count">
                                                            <i class="fa fa-commenting"></i>0
                                                        </span>
                                                    </div>
                                                    <div class="todo-tasklist-controls pull-right">
                                                        <span class="todo-tasklist-badge badge badge-roundless"
                                                              data-content="sentimiento">
                                                            Sentiment
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab_youtube">
                                            <h3 class="font-red-haze sbold"><i class="fa fa-youtube"></i>&nbsp;YouTube
                                            </h3>
                                            <div id="youtubeLoad" class="todo-tasklist">
                                                <div class='loading1 loading-youtube' style='display:none;'>
                                                    <img id='' src='busqueda/img/loading.gif' width='36' height='36' alt='loading gif'/>
                                                </div>
                                                <div id="todo-tasklist-youtube" class="todo-tasklist-item "
                                                     style="display: none;">
                                                    <!--<img data-content="foto_perfil" class="todo-userpic pull-left"
                                                    src="busqueda/img/twitter-egg.jpeg" width="27px" height="27px">-->
                                                    <div class="todo-tasklist-item-title">
                                                        <span data-content="title">Titulo</span></br>
                                                        <small class="font-grey-salsa" data-content="channelTitle">
                                                            screenName
                                                        </small>
                                                    </div>
                                                    <div class="todo-tasklist-item-text" data-content="description">
                                                        Lorem dolor sit amet ipsum dolor sit consectetuer dolore.
                                                    </div>
                                                </div>
                                            </div>
                                         </div>
                                    <div class="tab-pane" id="tab_facebook">
                                        <h3 class="font-blue-hoki sbold"><i class="fa fa-facebook"></i>&nbsp;Facebook
                                        </h3>
                                    </div>

                                    <div class="tab-pane" id="tab_tumblr">
                                        <h4 class="font-blue-hoki sbold"><i class="fa fa-tumblr"></i>&nbsp;Tumblr
                                        </h4>
                                        <div id="tumblrLoad" class="todo-tasklist">
                                            <div class='loading1 loading-tumblr' style='display:none;'>
                                                <img id='' src='busqueda/img/loading.gif' width='36' height='36' alt='loading gif'/>
                                            </div>
                                            <div id="todo-tasklist-tumblr" class="todo-tasklist-item "
                                                 style="display: none;">
                                                <!--<img data-content="foto_perfil" class="todo-userpic pull-left"
                                                src="busqueda/img/twitter-egg.jpeg" width="27px" height="27px">-->
                                                <div class="todo-tasklist-item-title">
                                                    <span data-content="title">Titulo</span>
                                                    <small class="font-grey-salsa" data-content="name">
                                                        @screenName
                                                    </small>
                                                </div>
                                                <div class="todo-tasklist-item-text" data-content="description">
                                                    Lorem dolor sit amet ipsum dolor sit consectetuer dolore.
                                                </div>
                                                <div class="todo-tasklist-controls pull-left">

                                                    <span class="todo-tasklist-date" data-content="posts">
                                                            <i class="fa fa-eye"></i>0
                                                    </span>
                                                    <span class="todo-tasklist-date" data-content="nsfw">

                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab_reddit">
                                        <h3 class="font-blue sbold"><i class="fa fa-reddit">&nbsp;</i>Reddit</h3>
                                        <div id="redditLoad" class="todo-tasklist">
                                            <div class='loading1 loading-reddit' style='display:none;'>
                                                <img id='' src='busqueda/img/loading.gif' width='36' height='36' alt='loading gif'/>
                                            </div>
                                            <div id="todo-tasklist-reddit" class="todo-tasklist-item " style="display: none;">
                                                <div class="todo-tasklist-item-title">
                                                    <div class="todo-tasklist-item-title">
                                                        <span data-content="title">Titulo</span></br>
                                                        <small class="font-grey-salsa" data-content="nombre_usuario">
                                                            screenName
                                                        </small>
                                                    </div>
                                                    </div>
                                                    <div class="todo-tasklist-item-text" data-content="text_clean">
                                                        Lorem dolor sit amet ipsum dolor sit consectetuer dolore.
                                                    </div>
                                                    <div class="todo-tasklist-controls pull-left">
                                                        <span class="todo-tasklist-date" data-content="likes">
                                                            <i class="fa fa-heart"></i>0
                                                        </span>
                                                        <span class="todo-tasklist-date" data-content="count">
                                                            <i class="fa fa-commenting"></i>0
                                                        </span>
                                                    </div>
                                                    <div class="todo-tasklist-controls pull-right">
                                                <span class="todo-tasklist-badge badge badge-roundless"
                                                      data-content="sentimiento">
                                                    Sentiment
                                                </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>

                            <div class="col-md-7 col-sm-8">

                                <form action="#" class="form-horizontal">
                                    <!-- TASK HEAD -->
                                    <div id="panel" class="" style="">
                                        <div id="panel-tweet" class="tweet-view">
                                            <div class="form">
                                                <!-- END TASK HEAD -->
                                                <!-- TASK TITLE -->
                                                <div id='tweet-body'></div>
                                                <!-- TASK TAGS -->
                                                <div class="form-group">
                                                    <div class="col-md-6 sentimiento-class">
                                                        <select id="sentimientoSelect"
                                                                class="form-control todo-taskbody-tags selectpicker"
                                                                tabindex="-1" aria-hidden="true">
                                                            <option value="MuyPositivo">Muy Positivo</option>
                                                            <option value="Positivo">Positivo</option>
                                                            <option value="Neutral">Neutral</option>
                                                            <option value="Negativo">Negativo</option>
                                                            <option value="MuyNegativo">Muy Negativo</option>
                                                            <option value="NoAsignado">No Asignado</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                            <span
                                                                class="todo-tasklist-badge badge badge-roundless bg-yellow-gold klout">K</span>
                                                        <span id="klout" data-content="klout">0</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="panel-instagram">

                                        </div>
                                        <div id="panel-youtube">
                                            <h2 id="v-title"> </h2>
                                            <div id="player" class="videoWrapper">

                                            </div>
                                            <a id="v-channel" href="" class="font-red-haze" data-content="channelTitle">

                                            </a>
                                            <p id="v-description">

                                            </p>

                                        </div>
                                        <div id="panel-tumblr">
                                            <div id="tumblr" >

                                            </div>
                                        </div>
                                        <div id="panel-reddit">
                                            <div id="reddit-content" >

                                            </div>
                                            <div id="reddit-comments" class="comments"> </div>
                                        </div>
                                        <div class="tabbable-line">
                                            <ul class="nav nav-tabs ">
                                                <!--                                                <li class="active">-->
                                                <!--                                                    <a href="#tab_1" data-toggle="tab"> Respuestas </a>-->
                                                <!--                                                </li>-->
                                                <li class="active">
                                                    <a href="#tab_2" data-toggle="tab"> Mapa </a>
                                                </li>
                                            </ul>
                                            <div class="">
                                                <!--                                                <div class="tab-pane active" id="tab_1">-->
                                                <!-- TASK COMMENTS -->
                                                <!--                                                    <div class="form-group">-->
                                                <!--                                                        <div class="col-md-12">-->
                                                <!--                                                            <ul class="media-list">-->
                                                <!--                                                                <li class="media">-->
                                                <!--                                                                    <a class="pull-left" href="javascript:;">-->
                                                <!--                                                                        <img class="todo-userpic" src="busqueda/img/twitter-egg.jpeg" width="27px" height="27px"> </a>-->
                                                <!--                                                                    <div class="media-body todo-comment">-->
                                                <!--                                                                        <button type="button" class="todo-comment-btn btn btn-circle btn-default btn-sm">&nbsp; Reply &nbsp;</button>-->
                                                <!--                                                                        <p class="todo-comment-head">-->
                                                <!--                                                                            <span class="todo-comment-username">José Carlos</span> &nbsp;-->
                                                <!--                                                                            <span class="todo-comment-date">17 Ene 2015 at 2:05pm</span>-->
                                                <!--                                                                        </p>-->
                                                <!--                                                                        <p class="todo-text-color"> Excelente espacio para desplegar tweets. </p>-->
                                                <!--                                                                        <!-- Nested media object -->
                                                <!--                                                                        <div class="media">-->
                                                <!--                                                                            <a class="pull-left" href="javascript:;">-->
                                                <!--                                                                                <img class="todo-userpic" src="busqueda/img/twitter-egg.jpeg" width="27px" height="27px"> </a>-->
                                                <!--                                                                            <div class="media-body">-->
                                                <!--                                                                                <p class="todo-comment-head">-->
                                                <!--                                                                                    <span class="todo-comment-username">Edgardo Acosta</span> &nbsp;-->
                                                <!--                                                                                    <span class="todo-comment-date">17 Ene 2016 at 4:30pm</span>-->
                                                <!--                                                                                </p>-->
                                                <!--                                                                                <p class="todo-text-color"> Muy Cierto, muy cierto </p>-->
                                                <!--                                                                            </div>-->
                                                <!--                                                                        </div>-->
                                                <!--                                                                    </div>-->
                                                <!--                                                                </li>-->
                                                <!--                                                            </ul>-->
                                                <!--                                                        </div>-->
                                                <!--                                                    </div>-->
                                                <!--                                                    <!-- END TASK COMMENTS -->
                                                <!--                                                    <!-- TASK COMMENT FORM -->
                                                <!--                                                    <div class="form-group">-->
                                                <!--                                                        <div class="col-md-12">-->
                                                <!--                                                            <ul class="media-list">-->
                                                <!--                                                                <li class="media">-->
                                                <!--                                                                    <a class="pull-left" href="javascript:;">-->
                                                <!--                                                                        <img class="todo-userpic" src="busqueda/img/twitter-egg.jpeg" width="27px" height="27px"> </a>-->
                                                <!--                                                                    <div class="media-body">-->
                                                <!--                                                                        <textarea class="form-control todo-taskbody-taskdesc" rows="4" placeholder="Type comment..."></textarea>-->
                                                <!--                                                                    </div>-->
                                                <!--                                                                </li>-->
                                                <!--                                                            </ul>-->
                                                <!--                                                            <button type="button" class="pull-right btn btn-sm btn-circle green"> &nbsp; Submit &nbsp; </button>-->
                                                <!--                                                        </div>-->
                                                <!--                                                    </div>-->
                                                <!-- END TASK COMMENT FORM -->
                                                <!--                                                </div>-->
                                                <div class="tab-pane" id="tab_2">
                                                    <!-- MAP SECTION -->
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <div id="map">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- EN MAP SECTION -->
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END TODO CONTENT -->
        </div>
    </div>
    <!-- END PAGE CONTENT-->
</div>
</div>
<!--==============================
    Scripts Section
==================================-->
<?php include 'footer.php'; ?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/apps/scripts/todo-2.min.js" type="text/javascript"></script>
<script src="//twemoji.maxcdn.com/twemoji.min.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN PERSONAL SCRIPTS -->
<script src="busqueda/busqueda_v1.js"></script>
<!-- END PERSONAL SCRIPTS -->
</html>


