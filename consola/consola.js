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

$(document).ready(function(){
    $('#page-breadcrumb').html('Consola');
    $('#menu-consola').addClass('active');

    addMainTerms();
    removeTerms();

});

//type=insert, word=valor -> agregar una palabra
//type=get -> Obtener la lista de palabras
//type=update, id=valor, word=newValor, active=newValor -> eliminar active=0, editar word=newValor
$.post( "web_service/word.php",{type:'get'}, function(data) {
    // alert( "success" );
}, "json")
    .done(function(data) {

        for (i = 0; i < data['palabras'].length; i++) {
            cloneTR = $("#plantillaTermino").clone().removeAttr('id').css('display','inline-block').show();
            id = data['palabras'][i]['id'];
            cloneTR.attr('id',id);
            cloneTR.children('div').text(data['palabras'][i]['word']).append('&nbsp;<a class="fa fa-pencil" href="javascript:editWord('+id+');"></a>').append('&nbsp;<a class="fa fa-times" href="javascript:delWord('+id+');"></a>');
            cloneTR.data('id',id);
            cloneTR.data('txt',data['palabras'][i]['word']);
            //console.log(cloneTR.data('id'));
            tableToAppend = $("#termsList");

            tableToAppend.append(cloneTR).show();
        }
    })
    .fail(function() {
        alert( "Intente más tarde." );
        // sweetAlert('Intente más tarde.', '', 'error');
    });

function editWord(id){
    txt = $('#'+id).data('txt');

    $.post( "web_service/word.php",{type:'update', id:id, active:'0'}, function(data) {
        // alert( "success" );
    }, "json")
        .done(function(data) {
            $('#' + id).remove();
            $("#wordToAdd").val(txt);

        })
        .fail(function(data) {
            alert( "Estamos revisando el problema." );
            // sweetAlert('Intente más tarde.', '', 'error');
        });
};
// type=update, id=valor, word=newValor, active=newValor -> eliminar active=0, editar word=newValor
function delWord(id){
    //console.log(id);
    if(id == ''){
        return;
    }
    $.post( "web_service/word.php",{type:'update', id:id, active:'0'}, function(data) {
        // alert( "success" );
    }, "json")
        .done(function(data) {
            console.log(data);
            $('#' + id).remove();
            $("#wordToAdd").val('');
            //$("#termsList");

            // tableToAppend.append(cloneTR).show();
        })
        .fail(function(data) {
            console.log(data);
            alert( "Estamos revisando el problema." );
            // sweetAlert('Intente más tarde.', '', 'error');
        });
};
$("#addWord").click(function(){
    //alert($("#wordToAdd").val());
    if($("#wordToAdd").val() == ''){
        return;
    }
    $.post( "web_service/word.php",{type:'insert',word:$("#wordToAdd").val()}, function(data) {
        // alert( "success" );
    }, "json")
        .done(function(data) {
            console.log(data);
            id =  data['id'];
            tr = $("#termsList").find($("#"+id)[0]);
            if(tr[0] != undefined){
                return;
            }
            cloneTR = $("#plantillaTermino").clone().removeAttr('id').css('display','inline-block').show();
            cloneTR.attr('id',id);
            cloneTR.children('div').text($("#wordToAdd").val()).append('&nbsp;<a class="fa fa-pencil" href="javascript:editWord('+id+');"></a>').append('&nbsp;<a class="fa fa-times" href="javascript:delWord('+id+');"></a>');
            cloneTR.data('id',id);
            cloneTR.data('txt',$("#wordToAdd").val());
            //console.log(cloneTR.data('id'));
            tableToAppend = $("#termsList");
            tableToAppend.append(cloneTR).show();
            $("#wordToAdd").val('');
        })
        .fail(function(data) {
            alert( "Intente más tarde." );
            // sweetAlert('Intente más tarde.', '', 'error');
        });

});

