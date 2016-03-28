/**
 * Created by jcev on 1/20/2016.
 */
$(document).ready(function(){
    $('.page-title').html('<h1>Histórico</h1>');
    $('#page-breadcrumb').text('Histórico');
    $('#menu-historico').addClass('active');
    array = [];
});
$("#searchWord").keypress(function(e){
    // Enter pressed?
    if(e.which == 13) {
        $("#searchbtn").click();
    }
});
$("#searchbtn").click(function(){
   // alert(1);
    if($("#searchWord").val() == ''){
        return;
    }
    $.post( "web_service/data_historia.php",{word:$("#searchWord").val()}, function(data) {
        // alert( "success" );
    }, "json")
        .done(function(data) {
            console.log(data);
            if(data == null){
                alert('no hay resultados');
                return;
            }
            array = data;
            console.log(data.length);
            var save0 = $('#listRow #baseRow').detach();
            $('#listRow').empty().append(save0);
            $("#countPosts").html('<i class="font-blue-hoki fa fa-archive"></i>Resultados Busqueda: ' + data.length);
            for (i = 0; i < data.length; i++){
                cloneTR = $("#baseRow").clone().removeAttr('id').css('display','block').show();
                cloneTR.attr('id', data[i]['id_post']);
                if(data[i]['api'] == 'twitter'){
                    cloneTR.find('#urlpic').attr('href', 'https://twitter.com/' + data[i]['screen_name']);
                    if(data[i]['id_tweet'] != '' && data[i]['id_tweet'] != null && data[i]['id_tweet'] != 'null'){
                        cloneTR.find('#iconPost').html('<a href="https://twitter.com/' + data[i]['screen_name'] + '/status/' + data[i]['id_tweet'] + '" target="_blank"><img src="historico/twitter.png" width=30/></a>&nbsp;<img src="historico/klout.png" width=35/>' + data[i]['Klout']);
                        cloneTR.find('#sentimentEdit').attr('href','javascript:changeSentiment("'+ data[i]['id_tweet'] +'","'+ data[i]['sentiment'] +'");');
                        cloneTR.find('#refreshPic').attr('href','javascript:refreshPic("'+ data[i]['id_tweet'] +'","'+ data[i]['screen_name'] +'","twitter");');
                    }else if(data[i]['id_post'] != '' && data[i]['id_post'] != null && data[i]['id_post'] != 'null'){
                        cloneTR.find('#iconPost').html('<a href="https://twitter.com/' + data[i]['screen_name'] + '/status/' + data[i]['id_post'] + '" target="_blank"><img src="historico/twitter.png" width=30/></a>&nbsp;<img src="historico/klout.png" width=35/>' + data[i]['Klout']);
                        cloneTR.find('#sentimentEdit').attr('href','javascript:changeSentiment("'+ data[i]['id_post'] +'","'+ data[i]['sentiment'] +'");');
                        cloneTR.find('#refreshPic').attr('href','javascript:refreshPic("'+ data[i]['id_post'] +'","'+ data[i]['screen_name'] +'","twitter");');
                    }else{
                        cloneTR.find('#iconPost').html('');
                    }
                    if(data[i]['nombre_usuario'] != '' && data[i]['nombre_usuario'] != null && data[i]['nombre_usuario'] != 'null'){
                        cloneTR.find('#user').html(data[i]['nombre_usuario']);
                    }else{
                        cloneTR.find('#user').html(data[i]['screen_name']);
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
                }else if(data[i]['api'] == 'instagram'){
                    cloneTR.find('#urlpic').attr('href', 'https://www.instagram.com/' + data[i]['nombre_usuario']);
                    cloneTR.find('#sentimentEdit').attr('href','javascript:changeSentiment("'+ data[i]['id_post'] +'","'+ data[i]['sentiment'] +'");');
                    cloneTR.find('#refreshPic').attr('href','javascript:refreshPic("'+ data[i]['id_post'] +'","'+ data[i]['nombre_usuario'] +'","instagram");');
                    if(data[i]['url'] != '' && data[i]['url'] != null && data[i]['url'] != 'null'){
                        cloneTR.find('#iconPost').html('<a href="' + data[i]['url'] + '" target="_blank"><img src="historico/instagram.png" width=30/></a>');
                    }else{
                        cloneTR.find('#iconPost').html('');
                    }
                    if(data[i]['screen_name'] != '' && data[i]['screen_name'] != null && data[i]['screen_name'] != 'null'){
                        cloneTR.find('#user').html(data[i]['screen_name']);
                    }else{
                        cloneTR.find('#user').html(data[i]['nombre_usuario']);
                    }
                    if( data[i]['likes'] != null &&  data[i]['likes'] != 'null' &&  data[i]['likes'] != ''){
                        cloneTR.find('#likes').html('<img src="historico/like.png" width="30/"> ' + data[i]['likes']);
                    }
                    cloneTR.find('#pic').attr('src', data[i]['foto_perfil']);
                }

                cloneTR.find('#post').html(data[i]['text_clean']);

                if(data[i]['sentiment'] == 'P' || data[i]['sentiment'] == 'P+'){
                    cloneTR.find('#sentiment').html('<i class="font-green-soft fa fa-smile-o"></i>');
                }else if(data[i]['sentiment'] == 'N' || data[i]['sentiment'] == 'N+'){
                    cloneTR.find('#sentiment').html('<i class="font-red-soft fa fa-frown-o"></i>');
                }else{
                    cloneTR.find('#sentiment').html('<i class="font-gray-soft fa fa-meh-o"></i>');
                }
               // cloneTR.find('#datepic').html('<img src="historico/date.png" width=30  />' + data[i]['created_at']);
                if(data[i]['location'] != null && data[i]['location'] != '' &&  data[i]["location"]["latitude"] != undefined && data[i]["location"]["longitude"] != undefined &&  data[i]["location"]["latitude"] != '' && data[i]["location"]["longitude"] != ''){
                    cloneTR.find('#map').html('<a href="http://maps.google.com/maps?q=loc:' + data[i]["location"]["latitude"] + '+' + data[i]["location"]["longitude"] + '" target="_blank"><img src="historico/map.png" width=35/></a>');
                }else{
                    cloneTR.find('#map').html('');
                }
                /*
                cloneTR.find('#address').html(a + '.- ' + json['dir'][i]['calle'] + ', ' + json['dir'][i]['ciudad']);
                cloneTR.find('#map').attr('href',json['dir'][i]['map']);
                cloneTR.find('#optAddress').attr('value',i);
                cloneTR.find('#time').html(json['dir'][i]['week'] + ' ' + json['dir'][i]['weekend'] );


                a++;*/
                $('#listRow').append(cloneTR).show();
            }
            $("#divResults").css('display','block');
        })
        .fail(function(data) {
            console.log(data);
            alert( "Estamos revisando la situación..." );
            // sweetAlert('Intente más tarde.', '', 'error');
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

    /*$.post( "web_service/exportData.php",{data: array}, function(data) {
             // alert( "success" );
        }, "json")
            .done(function(data) {
                console.log(data);

            })
            .fail(function(data) {
                console.log(data);
                alert( "Estamos revisando la situación..." );
                // sweetAlert('Intente más tarde.', '', 'error');
            });*/
});