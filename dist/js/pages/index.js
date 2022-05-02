
var dejarIr = false;

// Cargar contenido de restablecimiento paso 1
function updtRes1(){
    $.ajax({
        url: 'controllers/user.controller.php',
        type: 'GET',
        data: 'op=modalsRest&paso=1&estado=false',
        success: function(e) {
            $("#m-res-lod").html(e);
        }   
    });
}

// Cargar datos de departamentos
function slclstDepartm() {
    $.ajax({
        url: 'controllers/ubigeo.controller.php',
        type: 'GET',
        data: 'op=getDepartments',
        success: function(e) {
        $("#slcDepartReg").html(e);
        }
    });
}

// Registrar nuevo usuario
function registerUser() {

    var formData = new FormData();
    
    let apellidos = $("#inApellidos").val();
    let nombres = $("#inNombres").val();
    let fechanac = $("#inFechaNac").val();
    let telefono = $("#inTelef").val();
    let iddistrito = $("#slcDistrReg").val();
    let tipocalle = $("#inTipoC").val();
    let nombrecalle = $("#inNCalle").val();
    let numerocalle = $("#inNC").val();
    let pisodepa = $("#inPiso").val();
    let email = $("#inCorreoE").val();
    let clave = $("#inPass1").val();
    
    formData.append("op", "registerUser");
    formData.append("apellidos", apellidos);
    formData.append("nombres", nombres);
    formData.append("fechanac", fechanac);
    formData.append("telefono", telefono);
    formData.append("iddistrito", iddistrito);
    formData.append("tipocalle", tipocalle);
    formData.append("nombrecalle", nombrecalle);
    formData.append("numerocalle", numerocalle);
    formData.append("pisodepa", pisodepa);
    formData.append("email", email);
    formData.append("clave", clave);
    
    $.ajax({
        url: 'controllers/user.controller.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        cache: false,
        success: function(e) {
        console.log(e);
        }
    });
}

// Cargar contenido de restablecimiento con email de respaldo

$("#m-res-lod").on("click", "#secondEmailMd", function(){
    $.ajax({
        url: 'controllers/user.controller.php',
        type: 'GET',
        data: 'op=modalsRest&paso=2&estado=false',
        success: function(e) {
            $("#m-res-lod").html(e);
        }   
    });
});

// Cargar contenido de restablecimiento desde ambos email

            /* Principal */
$("#m-res-lod").on("click", "#btnRes1", function(){
    $.ajax({
        url: 'controllers/user.controller.php',
        type: 'GET',
        data: 'op=modalsRest&paso=3&estado=false',
        success: function(e) {
            $("#m-res-lod").html(e);
        }   
    });
});

            /* Respaldo */
$("#m-res-lod").on("click", "#btnRes2", function(){
    $.ajax({
        url: 'controllers/user.controller.php',
        type: 'GET',
        data: 'op=modalsRest&paso=3&estado=true',
        success: function(e) {
            $("#m-res-lod").html(e);
        }   
    });
});

// Cargar contenido de restablecimiento paso 2

            /* Principal */
$("#m-res-lod").on("click", "#btnRes3", function(){
    $.ajax({
        url: 'controllers/user.controller.php',
        type: 'GET',
        data: 'op=modalsRest&paso=4&estado=false',
        success: function(e) {
            $("#m-res-lod").html(e);
        }   
    });
});

//Envio de codigo al correo
$("#m-res-lod").on("click", "#btnRes3", function(){
    var formData = new FormData();
    formData.append("op", "sendEmailPassword");
    formData.append("emailbackup", "false");
    $.ajax({
        url: 'controllers/mailer.controller.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        cache: false,
        success: function(e) {
            console.log(e);
        }   
    });
});

            /* Respaldo */
$("#m-res-lod").on("click", "#btnRes4", function(){
    $.ajax({
        url: 'controllers/user.controller.php',
        type: 'GET',
        data: 'op=modalsRest&paso=4&estado=true',
        success: function(e) {
            $("#m-res-lod").html(e);
        }   
    });
});

//Envio al correo de respaldo
$("#m-res-lod").on("click", "#btnRes4", function(){
    var formData = new FormData();
    formData.append("op", "sendEmailPassword");
    formData.append("emailbackup", "true");
    $.ajax({
        url: 'controllers/mailer.controller.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        cache: false,
        success: function(e) {
            console.log(e);
        }   
    });
});

// Cargar contenido de restablecimiento paso 3


            /* Principal */
$("#m-res-lod").on("click", "#btnRes5", function(){
    if(dejarIr == true){
        $.ajax({
            url: 'controllers/user.controller.php',
            type: 'GET',
            data: 'op=modalsRest&paso=5&estado=false',
            success: function(e) {
                $("#m-res-lod").html(e);
                dejarIr = false;
            }   
        });
    }
});

//Verificacion de codigo al correo
$("#m-res-lod").on("click", "#btnRes5", function(){
    $code =$("#code-send1").val();
    $("#btnRes5").html('Siguiente');
    var formData = new FormData();

    formData.append("op", "autentificationCode");
    formData.append("code", $code);
    $.ajax({
        url: 'controllers/mailer.controller.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        cache: false,
        success: function(e) {
            console.log(e);
            if(e == 'Expirado'){
                dejarIr = false;
                $.ajax({
                    url: 'controllers/user.controller.php',
                    type: 'GET',
                    data: 'op=modalsRest&paso=4&estado=false',
                    success: function(e) {
                        $("#m-res-lod").html(e)
                    }   
                });
            }else if(e == 'Acceso'){
                dejarIr = true;
                $("#btnRes5").html('Siguiente');
            }else if (e == 'Intente'){
                $("#btnRes5").html('Validar');
                dejarIr = false;
            }else{
                alert("Error");
            }
                
        }   
    });
});


            /* Respaldo */
$("#m-res-lod").on("click", "#btnRes6", function(){
    $.ajax({
        url: 'controllers/user.controller.php',
        type: 'GET',
        data: 'op=modalsRest&paso=5&estado=true',
        success: function(e) {
            $("#m-res-lod").html(e);
        }   
    });
});

//Verificacion de codigo al correo de respaldo
$("#m-res-lod").on("click", "#btnRes6", function(){
    $code =$("#code-send2").val();
    $("#btnRes6").html('Siguiente');
    var formData = new FormData();

    formData.append("op", "autentificationCode");
    formData.append("code", $code);
    $.ajax({
        url: 'controllers/mailer.controller.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        cache: false,
        success: function(e) {
            console.log(e);
            if(e == 'Expirado'){
                dejarIr = false;
                $.ajax({
                    url: 'controllers/user.controller.php',
                    type: 'GET',
                    data: 'op=modalsRest&paso=4&estado=true',
                    success: function(e) {
                        $("#m-res-lod").html(e)
                    }   
                });
            }else if(e == 'Acceso'){
                dejarIr = true;
                $("#btnRes6").html('Siguiente');
            }else if (e == 'Intente'){
                $("#btnRes6").html('Validar');
                dejarIr = false;
            }else{
                alert("Error");
            }
                
        }   
    });
});



// Manejo de retroceso de modales 

// 5 > 4 - true
$("#m-res-lod").on("click", "#backi-8", function(){
    $.ajax({
        url: 'controllers/user.controller.php',
        type: 'GET',
        data: 'op=modalsRest&paso=4&estado=true',
        success: function(e) {
            $("#m-res-lod").html(e);
        }   
    });
});

// 5 > 4 - false
$("#m-res-lod").on("click", "#backi-7", function(){
    $.ajax({
        url: 'controllers/user.controller.php',
        type: 'GET',
        data: 'op=modalsRest&paso=4&estado=false',
        success: function(e) {
            $("#m-res-lod").html(e);
        }   
    });
});

// 4 > 3 - true
$("#m-res-lod").on("click", "#backi-6", function(){
    $.ajax({
        url: 'controllers/user.controller.php',
        type: 'GET',
        data: 'op=modalsRest&paso=3&estado=true',
        success: function(e) {
            $("#m-res-lod").html(e);
        }   
    });
});

// 4 > 3 - false
$("#m-res-lod").on("click", "#backi-5", function(){
    $.ajax({
        url: 'controllers/user.controller.php',
        type: 'GET',
        data: 'op=modalsRest&paso=3&estado=false',
        success: function(e) {
            $("#m-res-lod").html(e);
        }   
    });
});

// 3 > 2 - true
$("#m-res-lod").on("click", "#backi-4", function(){
    $.ajax({
        url: 'controllers/user.controller.php',
        type: 'GET',
        data: 'op=modalsRest&paso=2&estado=false',
        success: function(e) {
            $("#m-res-lod").html(e);
        }   
    });
});

// 3 > 1 - falso
$("#m-res-lod").on("click", "#backi-3", function(){
    $.ajax({
        url: 'controllers/user.controller.php',
        type: 'GET',
        data: 'op=modalsRest&paso=1&estado=true',
        success: function(e) {
            $("#m-res-lod").html(e);
        }   
    });
});

// 2 > 1
$("#m-res-lod").on("click", "#backi-2", function(){
    $.ajax({
        url: 'controllers/user.controller.php',
        type: 'GET',
        data: 'op=modalsRest&paso=1&estado=false',
        success: function(e) {
            $("#m-res-lod").html(e);
        }   
    });
});

// 1 -> fin
$("#m-res-lod").on("click", "#backi-1", function(){
    $("#modal-res-contra1").modal("toggle");
});

//Cambio de contraseña v1 - Principal
$("#m-res-lod").on("click", "#btnRes7", function(){
    var pass1 = $("#pass-n-1").val();
    var pass2 = $("#pass-n-1").val();
    var formData = new FormData();

    if(pass1 != pass2){
        alert("No coinciden");
    }else{
        formData.append("op", "updatePasswordRest");
        formData.append("clave", pass1);

        $.ajax({
            url: 'controllers/user.controller.php',
            type: 'GET',
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            success: function(e) {
                console.log('Salio bien');
            }   
        });
    }
});

//Cambio de contraseña v2 -Respaldo
$("#m-res-lod").on("click", "#btnRes8", function(){
    var pass3 = $("#pass-n-3").val();
    var pass4 = $("#pass-n-4").val();
    var formData = new FormData();

    if(pass3 != pass4){
        alert("No coinciden");
    }else{
        formData.append("op", "updatePasswordRest");
        formData.append("clave", pass3);

        $.ajax({
            url: 'controllers/user.controller.php',
            type: 'GET',
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            success: function(e) {
                console.log('Salio bien');
            }   
        });
    }
});

// Cargar datos de provincias
$("#slcDepartReg").change(function() {
let iddepart = $(this).val();

$.ajax({
    url: 'controllers/ubigeo.controller.php',
    type: 'GET',
    data: 'op=getProvinces&iddepartamento=' + iddepart,
    success: function(e) {
    $("#slcProvinReg").html(e);
    }
});

});

//Cargar datos de distritos
$("#slcProvinReg").change(function() {
let idprovin = $(this).val();

$.ajax({
    url: 'controllers/ubigeo.controller.php',
    type: 'GET',
    data: 'op=getDistricts&idprovincia=' + idprovin,
    success: function(e) {
    $("#slcDistrReg").html(e);
    }
});
});



/************** LLAMADO DE LAS FUNCIONES ******************/
$("#btn-regist-opn").click(registerUser);
slclstDepartm();
updtRes1();
