<!DOCTYPE html>
<html lang="en">
<?php include 'header.php'; ?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/socicon/socicon.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="historico/search.min.css" rel="stylesheet" type="text/css" />
<link href="historico/historico.css" rel="stylesheet" type="text/css" />
<link href="assets/sweetalert/sweetalert2.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL STYLES -->

<div class="search-page search-content-2">
    <div class="row">
        <div class="col-lg-4">
            <div class="search-filter ">
                <div class="search-label uppercase">Buscar...</div>
                <div class="input-icon right">
                    <i class="icon-magnifier"></i>
                    <input type="text" class="form-control" placeholder="Término" id="searchWord" />
                </div>
                <!--SocialIcons--------------------------------------------------->
                <div id="section-advanced" class="section">
                    <h4>Redes Sociales</h4>
                    <div class="socicons">
                        <a class="socicon-btn socicon-btn-circle socicon-solid bg-green font-white bg-hover-grey-salsa socicon-twitter tooltips"
                           data-original-title="Twitter"></a>
                        <a class="socicon-btn socicon-btn-circle socicon-solid bg-grey-gallery font-white bg-hover-grey-salsa socicon-instagram tooltips"
                           data-original-title="Instagram"></a>

                    </div>
                    <input type="hidden" id="apis" value="ti"/>
                </div>
                    <!--SocialIcons-->
               <!-- <div class="search-label uppercase">Ordenar por</div>
                <select class="form-control">
                    <option>Option 1</option>
                    <option>Option 2</option>
                    <option>Option 3</option>
                </select>-->

                <div class="search-label uppercase">Fecha</div>
                <div class="input-group input-large date-picker input-daterange input-icon right" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
                    <i class="icon-calendar"></i>
                    <input type="text" class="form-control" name="from" placeholder="Fecha Inicio..." id="startDate"/>
                    <span class="input-group-addon"> a </span>
                    <i class="icon-calendar"></i>
                    <input type="text" class="form-control" name="to" placeholder="Fecha Fin..." id="endDate" />
                </div>
                <button class="btn green bold uppercase btn-block" id="searchbtn">Buscar <i class="fa fa-search"></i></button>
                <div class="search-filter-divider"></div>
            </div>
        </div>
        <div class="col-md-12" id="divResults" style="display:none;">
            <div class="search-container ">
                <ul class="search-title">
                    <li class="search-item-header">
                        <h2 id="countPosts"><i class="font-blue-hoki fa fa-archive"></i>Resultados Búsqueda</h2>
                        <!--
                          <h2  class="col-sm-6" style="text-align: right;">Exportar<i id="exportResults" class="font-blue-hoki fa fa-download"></i></h2>
                       <form id="formExport" action="/ssma/web_service/exportData.php" target="_blank" method="post"> <input type="hidden" id="arrayExport" name="arrayExport" /></form>
                          -->
                    </li>
                </ul>
                <ul id="listRow">
                    <li class="search-item clearfix" id="baseRow" style="display: none;">
                        <div class="search-content">
                            <div class="row">
                                <div class="col-sm-1">
                                     <img src="historico/profile.png" onerror="this.src='historico/profile.png'" width=80 id="pic" style="border-radius: 40px;"/>
                                </div>
                                <div class="col-sm-5">
                                    <h4 class="search-title" id="post" style="font-size:14px;">texto post</h4>
                                </div>
                                <div class="col-sm-2">
                                    <a target="_blank" id="urlpic"><h4 class="search-title" id="user" style="font-size:14px;">nombre de usuario</h4></a>
                                </div>
                                <div class="col-sm-1"  id="likes" style="text-align: center;">
                                   <img src="historico/like.png" width=30/>0
                                </div>
                                <div class="col-sm-1" style="text-align: center;">
                                    <p class="search-counter-number" id="sentiment"><i class="font-yellow-soft fa fa-smile-o"></i></p>
                                </div>
                                <div class="col-sm-1" style="text-align: center;" id="iconPost">
                                    <a href="https://www.instagram.com/p/BCx_ZGJHFSN/" target="_blank"><img src="historico/instagram.png" width=30/></a>
                                </div>
                               <!-- <div class="col-sm-1" style="text-align: center;" id="datepic">
                                    <img src="historico/date.png" width=30  />
                                </div>-->
                                <div class="col-sm-1" style="text-align: center;" id="map">
                                    <a target="_blank"><img src="historico/map.png" width=35/></a>
                                </div>
                               <!-- <div class="col-sm-1" style="text-align: center;">
                                    <div class="btn-group">
                                        <p class="search-counter-number dropdown-toggle"  data-toggle="dropdown" aria-expanded="false"><a class="font-dark fa fa-ellipsis-v"></a></p>
                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a href="javascript:;" id="sentimentEdit"><i class="fa fa-pencil-square-o"></i>Sentimiento</a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" id="refreshPic"><i class="fa fa-refresh"></i>Foto Perfil</a>
                                            </li>
                                            <li class="divider"> </li>
                                            <li>
                                                <a href="javascript:;"><i class="font-red-intense fa fa-times"></i>Opción 3</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>-->
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="search-pagination">
                    <ul class="pagination" id="listPag" >
                        <li class="page-active" id="0">
                            <a href="javascript:loadResults(0);" >0 </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="historico/search.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN PERSONAL SCRIPTS -->
<script src="historico/historico.js"></script>
<script src="assets/sweetalert/sweetalert2.min.js" type="text/javascript"></script>
<!-- END PERSONAL SCRIPTS -->
</html>