/**
 * Created by Luis Ángel on 14/03/2016.
 */
$(document).ready(function() {
    $('.page-title').html('<h1>Settings</h1>');
    $('#page-breadcrumb').text('Settings');
});

// Clic sobre el boton
document.getElementById("add-btn").onclick = function () {
    // alert('Llamada a funcion revisaCampos');
    if (revisaCampos() == true){
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
                    sweetAlert('Usuario registrado exitosamente.');
                    alert('Usuario registrado exitosamente.');
                }else{
                    //alert( "usuario no registrado" );

                }
            })
            .fail(function() {
                //alert( "Intente más tarde." );
                sweetAlert('No fue posible registrar el usuario.');
            })

    } else {
        alert("Hay datos pendientes por llenar.");
    }
};

function revisaCampos(){
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
    if (!validateEmail(document.getElementById("nuevoMail").value)){
        completos = false;
        alert("Mail no valido.");
    }
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