/**
 * Created by jcev on 1/20/2016.
 */
var twt, fb, inst, tmblr, lkin, blgr, rd, yt, pint, gg;
twt = fb = inst = tmblr = lkin = blgr = rd = yt = pint = gg = true;
var numResults = 30;
var dataArray;
$(document).ready(function(){
    $('.page-title').html('<h1>Hist�rico</h1>');
    $('#page-breadcrumb').text('Hist�rico');
    $('#menu-historico').addClass('active');
    array = [];

    selectSocial();
});

$("#searchWord").keypress(function(e){
    // Enter pressed?
    if(e.which == 13) {
        $("#searchbtn").click();
    }
});
$("#searchbtn").click(function(){
   // alert(1);
    console.log($("#apis").val());
    if($.trim($("#searchWord").val()) == ''){
        swal('Coloque un t�rmino a buscar.');
        return;
    }
    if($("#apis").val() == ''){
        swal('Seleccione al menos una red social para buscar.');
        return;
    }
    /*console.log($("#startDate").val());
    console.log($("#endDate").val());
    console.log($("#startDate").text());
    console.log($("#endDate").text());*/
    $.post( "web_service/data_historia.php",{word:$("#searchWord").val(), apis:$("#apis").val(), idate:$("#startDate").val(),fdate:$("#endDate").val()}, function(data) {
         //alert( "success" );
        console.log('INTER: ' + data);
    }, "json")
        .done(function(data) {
            if(data == null){
                swal('No hay resultados');
                return;
            }

            dataArray = data;
            renderResults(data, 0, numResults);

            $("#divResults").css('display','block');
            $("#arrayExport").val(data);
        })
        .fail(function(data) {
            console.log(data);
        //-->   swal( "Estamos revisando la situacion..." );
        });
});

function changeSentiment(id, sent) {
    if(sent == 'P' || sent == 'P+'){
        img = '<span class="label label-success">Positivo</span>';
        sentStr = 'pos';
    }else if(sent == 'N' || sent == 'N+'){
        img = '<span class="label label-danger">Negativo</span>';
        sentStr = 'neg';
    }else{
        img = '<span class="label label-default">Neutro</span>';
        sentStr = 'neu';
    }
    swal({
        title: 'Cambiar Sentimiento',
        html: 'Sentimiento Actual: ' + img + '<br/><br/>' +
            '<input type="radio" name="sentim" value="pos">&nbsp;<span class="label label-success">Positivo</span><br/><br/>' +
            '<input type="radio" name="sentim" value="neu">&nbsp;<span class="label label-default">Neutro</span><br/><br/>' +
            '<input type="radio" name="sentim" value="neg">&nbsp;<span class="label label-danger">Negativo</span><br/><br/>' +
            '<button type="button" class="btn btn-default" id="btnConfirm">Change Sentiment</button>',
        showConfirmButton:false
    });
    $("#btnConfirm").click(function(){
        if($("input[name=sentim]:checked").val() == undefined){
            swal('No selecciono ningun valor.');
            return;
        }

        console.log($("input[name=sentim]:checked").val());
        console.log(id);
        if($("input[name=sentim]:checked").val() == 'pos'){
            sentStrNew = 'P';
            newSent = '<i class="font-green-soft fa fa-smile-o"></i>';
        }else if($("input[name=sentim]:checked").val() == 'neg'){
            sentStrNew = 'N';
            newSent = '<i class="font-red-soft fa fa-frown-o"></i>';
        }else{
            sentStrNew = 'NEU';
            newSent = '<i class="font-gray-soft fa fa-meh-o"></i>';
        }
        $.post( "web_service/changeSentiment.php",{id:id, sentiment:sentStrNew}, function(data) {
            // alert( "success" );
        }, "json")
            .done(function(data) {
                console.log(data);

                $('#listRow').find('#' + id).find("#sentiment").html(newSent);
            })
            .fail(function(data) {
                console.log(data);
                alert( "problema." );
            });
    });
}

function refreshPic(id, name, api){
    console.log(id);
    console.log(name);
    console.log(api);
    $.post( "web_service/profilePic.php",{user:name, type: api}, function(data) {
        // alert( "success" );
    }, "json")
        .done(function(data) {
            console.log(data);

            $('#listRow').find('#' + id).find("#sentiment").html(newSent);
        })
        .fail(function(data) {
            console.log(data);
            alert( "problema." );
        });
};

$("#exportResults").click(function(data){
    console.log(array);

   //-- PENDING $("#formExport").submit();
   /* var form = document.createElement("form");
    form.method = "POST";
    form.action = "/ssma/web_service/exportData.php";
    form.target = "_blank";
    var input = document.createElement("input");
    input.name = 'data';
    input.value= array;
    document.body.appendChild(input);
    document.body.appendChild(form);
    form.submit();*/
    /*$.post( "web_service/exportData.php",{data: array}, function(data) {
             // alert( "success" );
        }, "json")
            .done(function(data) {
                console.log(data);

            })
            .fail(function(data) {
                console.log(data);
                alert( "Estamos revisando la situaci�n..." );
                // sweetAlert('Intente m�s tarde.', '', 'error');
            });*/
});

function selectSocial(){
    var socialMediaSearch = {};
    $('.socicons').on('click', 'a', function(){
        socialMediaSearch = {};
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
        apis = '';
        if(socialMediaSearch.Twitter){
            apis += 't';
        }
        if(socialMediaSearch.Instagram){
            apis += 'i';
        }
        $("#apis").val(apis);
    });
}

function loadResults(page){

    var listItems = $("#listPag li");
    a = 0;
    listItems.each(function(li) {
        $("#"+a).removeClass('page-active').addClass('page-inactive');
        a++;
    });
    console.log(page);
    $("#"+page).removeClass('page-inactive').addClass('page-active');
    renderResults(dataArray, page*numResults, (page + 1) * numResults);
}

function renderResults(data, init, end){
    console.log("tamaño-> "+data.length);

    if(data.length > numResults){
        if(end > data.length){
            $("#countPosts").html('<i class="font-blue-hoki fa fa-archive"></i>Resultados B&uacute;squeda: ' + init + ' a ' + data.length);
        }else{
            $("#countPosts").html('<i class="font-blue-hoki fa fa-archive"></i>Resultados B&uacute;squeda: ' + init + ' a ' +  end + ' de ' + data.length);
        }

    }else{
        $("#countPosts").html('<i class="font-blue-hoki fa fa-archive"></i>Resultados B&uacute;squeda: ' + data.length);
    }

    // Limpiar la paginaci�n previa
    var pagBase = $("#listPag #0").detach();
    $('#listPag').empty().append(pagBase);

    // Generar los botones de paginaci�n.
    var showResults = numResults;
    var b = 1;
    while(showResults < data.length){
        var cloneBtn = $("#0").clone().removeAttr('id').css('display','inline').show();
        cloneBtn.attr('id', b);
        cloneBtn.attr('class', "page-inactive");
        cloneBtn.html('<a href="javascript:loadResults('+b+');" > ' + b + ' </a>');
        $('#listPag').append(cloneBtn).show();
        b++;
        showResults = showResults + numResults;
    }

    // Limpiar pagina de resultados previos
    var save0 = $('#listRow #baseRow').detach();
    $('#listRow').empty().append(save0);
    console.log("data"+data);
    console.log(init);
    console.log(end);
    for (var i = init; i < end; i++){
        if(i > data.length){
            break;
        }
        //console.log(data[i]['collection']);
        console.log(data[i]['id_post']);

        var cloneTR = $("#baseRow").clone().removeAttr('id').css('display','block').show();
        cloneTR.attr('id', data[i]['id_post']);
        if(data[i]['api'] == 'twitter'){
            cloneTR.find('#urlpic').attr('href', 'https://twitter.com/' + data[i]['screen_name']);
            if(data[i]['id_tweet'] != '' && data[i]['id_tweet'] != null && data[i]['id_tweet'] != 'null'){
                cloneTR.find('#iconPost').html('<a href="https://twitter.com/' + data[i]['screen_name'] + '/status/' + data[i]['id_tweet'] + '" target="_blank"><img src="historico/twitter.png" width=30/></a><br><img src="historico/klout.png" width=35/>' + data[i]['Klout']);
                cloneTR.find('#sentimentEdit').attr('href','javascript:changeSentiment("'+ data[i]['id_tweet'] +'","'+ data[i]['sentiment'] +'");');
                cloneTR.find('#refreshPic').attr('href','javascript:refreshPic("'+ data[i]['id_tweet'] +'","'+ data[i]['screen_name'] +'","twitter");');
            }else if(data[i]['id_post'] != '' && data[i]['id_post'] != null && data[i]['id_post'] != 'null'){
                cloneTR.find('#iconPost').html('<a href="https://twitter.com/' + data[i]['screen_name'] + '/status/' + data[i]['id_post'] + '" target="_blank"><img src="historico/twitter.png" width=30/></a><br><img src="historico/klout.png" width=35/>' + data[i]['Klout']);
                cloneTR.find('#sentimentEdit').attr('href','javascript:changeSentiment("'+ data[i]['id_post'] +'","'+ data[i]['sentiment'] +'");');
                cloneTR.find('#refreshPic').attr('href','javascript:refreshPic("'+ data[i]['id_post'] +'","'+ data[i]['screen_name'] +'","twitter");');
            }else{
                cloneTR.find('#iconPost').html('');
            }
            if(data[i]['nombre_usuario'] != '' && data[i]['nombre_usuario'] != null && data[i]['nombre_usuario'] != 'null'){
                cloneTR.find('#user').html(decodeURIComponent(escape(data[i]['nombre_usuario'])));
            }else{
                cloneTR.find('#user').html(decodeURIComponent(escape(data[i]['screen_name'])));
            }
            if( data[i]['cant_retweet'] != null &&  data[i]['cant_retweet'] != 'null' &&  data[i]['cant_retweet'] != ''){
                cloneTR.find('#likes').html('<img src="historico/retweet.png" width="32" /> ' + data[i]['cant_retweet']);
            }
            foto = data[i]['foto_perfil'];
            n = foto.indexOf(".jpg");
            if(n > 0){
                normal = foto.indexOf("_normal");
                foto = foto.substring(0, normal);
                foto = foto.concat('.jpg');
            }else{
                n = foto.indexOf(".jpeg");
                if(n > 0){
                    normal = foto.indexOf("_normal");
                    foto = foto.substring(0, normal);
                    foto = foto.concat('.jpeg');
                }else{
                    n = foto.indexOf(".gif");
                    if(n > 0){
                        normal = foto.indexOf("_normal");
                        foto = foto.substring(0, normal);
                        foto = foto.concat('.gif');
                    }else{
                        n = foto.indexOf(".png");
                        if(n > 0){
                            normal = foto.indexOf("_normal");
                            foto = foto.substring(0, normal);
                            foto = foto.concat('.png');
                        }
                    }
                }
            }
            cloneTR.find('#pic').attr('src', foto);
        }
        else if(data[i]['api'] == 'instagram'){
            cloneTR.find('#urlpic').attr('href', 'https://www.instagram.com/' + data[i]['nombre_usuario']);
            cloneTR.find('#sentimentEdit').attr('href','javascript:changeSentiment("'+ data[i]['id_post'] +'","'+ data[i]['sentiment'] +'");');
            cloneTR.find('#refreshPic').attr('href','javascript:refreshPic("'+ data[i]['id_post'] +'","'+ data[i]['nombre_usuario'] +'","instagram");');
            if(data[i]['url'] != '' && data[i]['url'] != null && data[i]['url'] != 'null'){
                cloneTR.find('#iconPost').html('<a href="' + data[i]['url'] + '" target="_blank"><img src="historico/instagram.png" width=30/></a>');
            }else{
                cloneTR.find('#iconPost').html('');
            }
            if(data[i]['screen_name'] != '' && data[i]['screen_name'] != null && data[i]['screen_name'] != 'null'){
                cloneTR.find('#user').html(decodeURIComponent(escape(data[i]['screen_name'])));
            }else{
                cloneTR.find('#user').html(decodeURIComponent(escape(data[i]['nombre_usuario'])));
            }
            if( data[i]['likes'] != null &&  data[i]['likes'] != 'null' &&  data[i]['likes'] != ''){
                cloneTR.find('#likes').html('<img src="historico/like.png" width="30/"> ' + data[i]['likes']);
            }
            cloneTR.find('#pic').attr('src', data[i]['foto_perfil']);
        }

        cloneTR.find('#post').html(decodeURIComponent(escape(data[i]['text_clean'])));

        if(data[i]['sentiment'] == 'P' || data[i]['sentiment'] == 'P+'){
            cloneTR.find('#sentiment').html('<i class="font-green-soft fa fa-smile-o"></i>');
        }
        else if(data[i]['sentiment'] == 'N' || data[i]['sentiment'] == 'N+'){
            cloneTR.find('#sentiment').html('<i class="font-red-soft fa fa-frown-o"></i>');
        }
        else{
            cloneTR.find('#sentiment').html('<i class="font-gray-soft fa fa-meh-o"></i>');
        }
        // cloneTR.find('#datepic').html('<img src="historico/date.png" width=30  />' + data[i]['created_at']);
        if(data[i]['location'] != null && data[i]['location'] != '' &&  data[i]["location"]["latitude"] != undefined && data[i]["location"]["longitude"] != undefined &&  data[i]["location"]["latitude"] != '' && data[i]["location"]["longitude"] != ''){
            cloneTR.find('#map').html('<a href="http://maps.google.com/maps?q=loc:' + data[i]["location"]["latitude"] + '+' + data[i]["location"]["longitude"] + '" target="_blank"><img src="historico/map.png" width=35/></a>');
        }
        else{
            cloneTR.find('#map').html('');
        }
        $('#listRow').append(cloneTR).show();
    }
}