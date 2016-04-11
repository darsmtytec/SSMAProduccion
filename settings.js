/**
 * Created by Luis Ángel on 14/03/2016.
 */
var userSelected = false;
var actualUsername;

$(document).ready(function() {
    $('.page-title').html('<h1>Settings</h1>');
    $('#page-breadcrumb').text('Settings');
});

// Clic al boton de añadir
document.getElementById("add-btn").onclick = function () {
    // alert('Llamada a funcion revisaCampos');
    if (revisaCamposNuevo() == true && validateEmail(document.getElementById("nuevoMail").value)){
        // alert("Datos completos")
        // Añadir el usuario
        var rol;
        if (document.getElementById("role-select").value == 0){
            rol = 'admin';
        } else {
            rol = 'usuario';
        }
        $.post( "settings/nuevoUsuario.php",{username:document.getElementById("nuevoUsername").value,
                                             password:document.getElementById("nuevoPwd").value,
                                             email:document.getElementById("nuevoMail").value,
                                             nombre:document.getElementById("nuevoNombre").value,
                                             perfil:rol }, function() {

            })

            .done(function(data) {
                if(data == 'true'){
                    // window.location.replace("dashboard.php");
                    // sweetAlert('Usuario registrado exitosamente.');
                    alert('Usuario registrado exitosamente.');
                    document.getElementById("nuevoUsername").value = "";
                    document.getElementById("nuevoNombre").value = "";
                    document.getElementById("nuevoPwd").value = "";
                    document.getElementById("nuevoMail").value = "";
                    document.getElementById("role-select").value = 1;
                }else{
                    //alert( "usuario no registrado" );
                    //sweetAlert('Usuario');
                    alert("No es posible registrar el usuario.");
                }
            })
            .fail(function() {
                //alert( "Intente más tarde." );
                alert('No fue posible registrar el usuario.');
            })

    } else {
        if (!validateEmail(document.getElementById("nuevoMail").value)){
            alert("Mail no valido.");
        } else {
            alert("Hay datos pendientes por llenar.");
        }
    }
};

// Clic al botón de borrar usuario
document.getElementById("del-btn").onclick = function () {
    if (revisaCamposBorrar() == true){
        // Revisar que el usuario y la confirmacion sean iguales
        if(document.getElementById("borrarUser").value == document.getElementById("borrarUserConf").value) {
            $usuario = document.getElementById("borrarUser").value;
            $.post( "settings/deleteUsuario.php",{username:document.getElementById("borrarUser").value}, function() {})
                .done(function(data) {
                    if(data == 'true'){
                        // window.location.replace("dashboard.php");
                        // sweetAlert('Usuario registrado exitosamente.');
                        alert('Usuario eliminado exitosamente.');
                        document.getElementById("borrarUserConf").value = "";
                        document.getElementById("borrarUser").value = "";
                    }else{
                        //alert( "usuario no registrado" );
                        //sweetAlert('Usuario');
                        alert("El usuario no existe en la base de datos.");
                    }
                })
                .fail(function() {
                    //alert( "Intente más tarde." );
                    alert('No fue posible eliminar el usuario.');
                })
        } else {
            alert("Los campos no coinciden.");
        }
    } else {
        alert("Hay campos sin llenar.");
    }
};

function revisaCamposBorrar(){
    var completos = true;
    if (!document.getElementById("borrarUser").value) {
        completos = false;
    }
    if (!document.getElementById("borrarUserConf").value){
        completos = false;
    }
    return completos;
}

function revisaCamposNuevo(){
    var completos = true;
    if (!document.getElementById("nuevoUsername").value) {
        completos = false;
    }
    // Para obtener el contenido del campo es document.getElementById("nuevoUsername").value
    if (!document.getElementById("nuevoPwd").value) {
        completos = false;
    }
    if (!document.getElementById("nuevoMail").value) {
        completos = false;
    }
    /*
    if (!validateEmail(document.getElementById("nuevoMail").value)){
        completos = false;
        alert("Mail no valido.");
    }
    */
    if (!document.getElementById("nuevoNombre").value) {
        completos = false;
    }
    return completos;
}

function validateEmail(email)
{
    // var re = /\S+@\S+\.\S+/;
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

// Clic al boton de modificar
document.getElementById("search-btn").onclick = function () {
    if (revisaCamposSelecciona() == true){
        // var info = $.getJSON( "settings/buscaUsuario.php", { "username" : document.getElementById("modificaUsuario").value })
        // document.getElementById("modificaUser").value = info[0].username;

        $.post( "settings/buscaUsuario.php",{"username" : document.getElementById("modificaUsuario").value}, function() {})
            .done(function(data) {
                if (data != "false"){
                    var values = data.split('#');
                    document.getElementById("modificaUser").value = values[0];
                    document.getElementById("modificaNombre").value = values[1];
                    document.getElementById("modificaMail").value = values[2];
                    document.getElementById("modificaPwd").value = "****";
                    var rol = values[3];
                    if (rol == 'admin'){
                        rol = 0;
                    } else {
                        rol = 1;
                    }
                    document.getElementById("selecciona-rol").value = rol;
                    userSelected = true;
                    actualUsername = values[0];
                } else {
                    alert("El usuario no se encuentra en la base de datos.");
                    document.getElementById("modificaUser").value = "";
                    document.getElementById("modificaNombre").value = "";
                    document.getElementById("modificaMail").value = "";
                    document.getElementById("modificaPwd").value = "";
                    document.getElementById("selecciona-rol").value = 1;
                    userSelected = false;
                }
            })
            .fail(function() {
                alert('El usuario no se encuentra en la base de datos.');

            })
    } else {
        alert("No se ha escrito el nombre de usuario a modificar.");
    }
};

document.getElementById("modificar-btn").onclick = function () {
    if (revisaCamposModifica() == true && userSelected){
        var usuario = document.getElementById("modificaUser").value;
        var nombre = document.getElementById("modificaNombre").value;
        var mail = document.getElementById("modificaMail").value;
        var pwd = document.getElementById("modificaPwd").value;
        var rol;
        if (document.getElementById("selecciona-rol").value == 0){
            rol = 'admin';
        } else {
            rol = 'usuario';
        }
        $.post( "settings/modificaUsuario.php",{username : usuario,
                                                nombre : nombre,
                                                email : mail,
                                                password : pwd,
                                                rol : rol,
                                                actual : actualUsername
                                                }, function() {})
            .done(function(data) {
                alert(data);
                document.getElementById("modificaUser").value = "";
                document.getElementById("modificaNombre").value = "";
                document.getElementById("modificaMail").value = "";
                document.getElementById("modificaPwd").value = "";
                document.getElementById("selecciona-rol").value = 1;
                userSelected = false;
            })
            .fail(function() {
                alert('No se ha podido modificar el usuario.');

            })
    } else {
        if (userSelected){
            if (!revisaCamposModifica())
                alert("No están los campos llenos");
        } else {
            alert("No se ha seleccionado un usuario.");
        }

    }
};

function revisaCamposModifica(){
    var completos = true;
    if (!document.getElementById("modificaUser").value)
        completos = false;
    if (!document.getElementById("modificaNombre").value)
        completos = false;
    if (!document.getElementById("modificaMail").value)
        completos = false;
    if (!document.getElementById("modificaPwd").value)
        completos = false;
    return completos;
}

function revisaCamposSelecciona(){
    var completos = true;
    if (!document.getElementById("modificaUsuario").value) {
        completos = false;
    }
    return completos;
}
