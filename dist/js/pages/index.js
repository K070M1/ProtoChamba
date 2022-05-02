
var dejarIr = false;
var NewUserImg = [];

// Cargar contenido de restablecimiento paso 1
function updtRes1(){
    $.ajax({
        url: 'controllers/user.controller.php',
        type: 'GET',
        data: 'op=modalsRest&paso=1',
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
    let clave2 = $("#inPass2").val();

    if(apellidos == '' || nombres == '' || fechanac == '' || telefono == '' || iddistrito == null || nombrecalle == '' || numerocalle == '' || pisodepa == '' || email == '' || clave == ''){
        sweetAlertWarning('Q tal Chamba', 'Faltan completar algunas casillas');
    }else{
        if(clave != clave2){
            sweetAlertWarning('Q tal Chamba', 'Las contraseñas no coinciden');
        }else{
            formData.append("op", "registerUser");
            formData.append("apellidos", apellidos);
            formData.append("nombres", nombres);
            formData.append("fechanac", fechanac);
            formData.append("telefono", '51'+ telefono);
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
                    if(e == '.'){
                        sweetAlertError('Q tal Chamba', 'Correo ya registrado');
                    }else{
                        $("#modalRegister").modal('hide');
                        $("#modal-perfil-img-new").modal('toggle');
                        sweetAlertSuccess('Q tal Chamba', 'Usuario registrado correctamente');
                    }
                }
            });
        
        }
    }
    

}

// Registrar foto de perfil de nuevo usuario
function newProfileUser(){
    var formData = new FormData();
    formData.append("op", "newUserProfile");
    formData.append("archivo", NewUserImg[0]);
    $.ajax({
        url: 'controllers/user.controller.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        cache: false,
        success: function(e) {
            $("#modal-perfil-img-new").modal('hide');
            window.location.reload();
        }
    });
}

//Cargar foto de perfil
function loadPicturePerfil(){
    $.ajax({
        url: 'controllers/gallery.controller.php',
        type: 'GET',
        data: 'op=getAPicturePerfil',
        success: function(e){
            if(e == '.' || e == '[]' || e == ' ' || e === null){
                $("#userImageIndexNav").attr('src', 'dist/img/user/userdefault.jpg');
                $("#userImageIndexNav1").attr('src', 'dist/img/user/userdefault.jpg');
                $("#imgQuestI").attr('src', 'dist/img/user/userdefault.jpg');
            }else{
                var img = JSON.parse(e);
                $("#userImageIndexNav").attr('src', 'dist/img/user/' + img[0]['archivo']);
                $("#userImageIndexNav1").attr('src', 'dist/img/user/' + img[0]['archivo']);
                $("#imgQuestI").attr('src', 'dist/img/user/' + img[0]['archivo']);
            }
        }
    });
}

//Foto de perfil de nuevo usuario
$("#btn-omt-prf").click(function(){
    $("#modal-perfil-img-new").modal('hide');
    window.location.reload();
});

$("#newUserFile").change(function(){
    var datos = this.files;
    if(datos.length == 0){
        sweetAlertWarning('Q tal Chamba', 'Ningun archivo seleccionado');    
    }else{
        var element = datos[0];
        NewUserImg.push(element);
        var img = URL.createObjectURL(element);
        $("#File-imgUserNew").attr('src', img);
        sweetAlertConfirmQuestionSave("¿Estas seguro de asignar esta foto de perfil?").then((confirm) => {
            if(confirm.isConfirmed){
              sweetAlertSuccess('Realizado', 'Imagen de perfil registrado');
              newProfileUser();
            }
        });
    }
});

// Cargar contenido de un select 

function loadSlcQuestions(){

    $.ajax({
        url: 'controllers/user.controller.php',
        type: 'GET',
        data: 'op=questionLogin',
        success: function(e) {
            $("#slcQuestAl").html(e);
        }
    });
}

$("#btnOpenModalRegisterIN").click(function(){
    $("#modalRegister").modal('toggle');
    $("#inApellidos").val('');
    $("#inNombres").val('');
    $("#inFechaNac").val('');
    $("#inTelef").val('');
    $("#slcProvinReg").val('');
    $("#slcDepartReg").val('');
    $("#slcDistrReg").val('');
    $("#inTipoC").val("AV");
    $("#inNCalle").val('');
    $("#inNC").val('');
    $("#inPiso").val('');
    $("#inCorreoE").val('');
    $("#inPass1").val('');
    $("#inPass2").val('');
});

// Verificar respuestas
$("#checkQuestion").click(function(){
    let quest = $("#slcQuestAl").val();
    let answer = $("#answerSlc").val();

    var data = {
        'op'        : 'answerQuest',
        'quest'     : quest,
        'answer'    : answer
    };

    if(answer == ''){
        sweetAlertWarning('Q tal Chamba', 'Coloque su respuesta');
    }else{
        $.ajax({
            url: 'controllers/user.controller.php',
            type: 'GET',
            data: data,
            success: function(e) {
                if(e == '1'){
                    $("#modal-perfil-img-new").modal('hide');
                    $("#modal-question").modal('hide');
                    sweetAlertSuccess('Q tal Chamba', 'Acceso exitoso');
                    window.location.reload();
                }else{
                    loadSlcQuestions();
                }
            }
        });
    }

});   

// Cargar contenido de restablecimiento 
$("#m-res-lod").on("click", "#btnRes1", function(){
    var email = $("#inptEmailRes").val();
    localStorage.clear();
    
    if(email == ''){
        sweetAlertWarning('Q tal Chamba', 'Debes colocar tu correo');
    }else{
        $.ajax({
            url: 'controllers/user.controller.php',
            type: 'GET',
            data: 'op=modalsRest&paso=2&email=' + email,
            success: function(e) {
                if(e == 'No permitido'){
                    sweetAlertError('Q tal Chamba', 'Este correo no esta registrado');
                }else{
                    localStorage.setItem('email', email);
                    $("#m-res-lod").html(e);
                }
            }   
        });
    }

});

// Cargar contenido de restablecimiento paso 2
$("#m-res-lod").on("click", "#btnRes2", function(){
    $.ajax({
        url: 'controllers/user.controller.php',
        type: 'GET',
        data: 'op=modalsRest&paso=3',
        success: function(e) {
            $("#m-res-lod").html(e);
        }   
    });
});


//Envio de codigo al correo
$("#m-res-lod").on("click", "#btnRes2", function(){
    var formData = new FormData();
    var emailenv = localStorage.getItem('email');
    formData.append("op", "sendEmailPassword");
    formData.append("email", emailenv);
    $.ajax({
        url: 'controllers/mailer.controller.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        cache: false,
        success: function(e) {
            sweetAlertSuccess('Q tal Chamba', 'Código enviado');
            console.log(e);
        }   
    });
});


// Cargar contenido de restablecimiento paso 3

$("#m-res-lod").on("click", "#btnRes3", function(){
    if(dejarIr == true){
        $.ajax({
            url: 'controllers/user.controller.php',
            type: 'GET',
            data: 'op=modalsRest&paso=4',
            success: function(e) {
                $("#m-res-lod").html(e);
                dejarIr = false;
            }   
        });
    }
});

//Verificacion de codigo al correo
$("#m-res-lod").on("click", "#btnRes3", function(){
    var emailenv = localStorage.getItem('email');
    var code =$("#code-send1").val();
    $("#btnRes3").html('Siguiente');
    var formData = new FormData();

    formData.append("op", "autentificationCode");
    formData.append("code", code);
    formData.append("email", emailenv);

    if(code == ''){
        sweetAlertWarning('Q tal Chamba', 'Debe colocar el código');
    }else{
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
                    sweetAlertError('Q tal Chamba', 'Código expirado, se enviará otro código');
                    dejarIr = false;
                    $.ajax({
                        url: 'controllers/user.controller.php',
                        type: 'GET',
                        data: 'op=modalsRest&paso=3',
                        success: function(e) {
                            $("#m-res-lod").html(e)
                        }   
                    });
                }else if(e == 'Acceso'){
                    dejarIr = true;
                    $("#btnRes3").html('Siguiente');
                }else if (e == 'Intente'){
                    sweetAlertWarning('Q tal Chamba', 'Código equivocado');
                    $("#btnRes3").html('Validar');
                    dejarIr = false;
                }else{
                    sweetAlertError('Q tal Chamba', 'ERROR');
                    dejarIr = false;
                }
                    
            }   
        });
    }
});

// Manejo de retroceso de modales 
// 5 > 4 
$("#m-res-lod").on("click", "#backi-5", function(){
    $.ajax({
        url: 'controllers/user.controller.php',
        type: 'GET',
        data: 'op=modalsRest&paso=1',
        success: function(e) {
            $("#m-res-lod").html(e);
        }   
    });
});

// 4 > 3
$("#m-res-lod").on("click", "#backi-4", function(){
    $.ajax({
        url: 'controllers/user.controller.php',
        type: 'GET',
        data: 'op=modalsRest&paso=1',
        success: function(e) {
            $("#m-res-lod").html(e);
        }   
    });
});

// 3 > 2 
$("#m-res-lod").on("click", "#backi-3", function(){
    $.ajax({
        url: 'controllers/user.controller.php',
        type: 'GET',
        data: 'op=modalsRest&paso=1',
        success: function(e) {
            $("#m-res-lod").html(e);
        }   
    });
});

// 1 -> fin
$("#m-res-lod").on("click", "#backi-1", function(){
    $("#modal-res-contra1").modal("toggle");
});

// Cambio de contraseña 
$("#m-res-lod").on("click", "#btnRes4", function(){
    var pass1 = $("#pass-n-1").val();
    var pass2 = $("#pass-n-2").val();
    var emailres = localStorage.getItem('email');
    var formData = new FormData();

    if(pass1 == '' || pass2 == ''){
        sweetAlertWarning('Q tal Chamba', 'Falta completar las casillas');
    }else{
        if(pass1 != pass2){
            sweetAlertWarning('Q tal Chamba', 'Las contraseñas no coinciden');
        }else{
            sweetAlertConfirmQuestionSave("¿Estas seguro de asignar esta foto de perfil?").then((confirm) => {
                if(confirm.isConfirmed){
                    formData.append("op", "updatePasswordRest");
                    formData.append("clave", pass1);
                    formData.append("email", emailres);
                    
                    $.ajax({
                        url: 'controllers/user.controller.php',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        cache: false,
                        success: function(e) {
                            console.log(e);
                            sweetAlertSuccess('Q tal Chamba', 'Contraseña cambiada correctamente');
                            $("#modal-res-contra1").modal("toggle");
                            localStorage.removeItem('email');
                        }   
                    });
                }
            });
            
        }
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

// Cargar datos de distritos
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

// Login
$("#btnLogin").click(function(){
    let email = $("#emailInpt").val();
    let pass = $("#passwordInpt").val();

    if($("#rememberUser").prop('checked')){
        var remember = true;
    }else{
        var remember = false;
    }

    var data = 
    {
        'op' : 'loginUser',
        'email' : email,
        'password' : pass,
        'remember'  : remember
    };

    if(email == "" || pass == ""){
        sweetAlertWarning('Q tal Chamba', 'Faltan completar algunas casillas');
    }else{
        $.ajax({
            url: 'controllers/user.controller.php',
            type: 'GET',
            data: data,
            success: function(e) {
                if(e == 'Inexistente'){
                    sweetAlertWarning('Q tal Chamba', 'Este correo no existe');
                }else if (e == 'Acceso'){
                    $("#modal-question").modal('toggle');
                    loadPicturePerfil();
                    loadNameUserIndex();
                }else if(e  == 'Incorrecto'){
                    sweetAlertError('Q tal Chamba', 'Contraseña incorrecta');
                }else{
                    sweetAlertError('Q tal Chamba', 'ERROR EN EL SISTEMA');
                }
            }
        });
    }
    
});

// Salir de los sistemas
function logoutSystem(){
    $.ajax({
        url: 'controllers/user.controller.php',
        type: 'GET',
        data: 'op=logout',
        success: function() {
            window.location.reload();
        }
    });
}

//Nombre del usuario
function loadNameUserIndex(){
    $.ajax({
      url: 'controllers/user.controller.php',
      type: 'GET',
      data: 'op=getUserName',
      success: function(e){
        $("#nameUserIndex").html(e);
        $("#nameUserIndex2").html(e);
        $("#questNameI").html(e);
      }
    });
}

//Contador de seguidores
function countFollower(){
    $.ajax({
      url:'controllers/follower.controller.php',
      type: 'GET',
      data: 'op=getCountFollowersByUser',
      success: function(e){
          if(e != ''){
              let datos = JSON.parse(e);
              $("#countSeguidoresIndex").html("Seguidores:" + " " +  datos);
          }
      }
    });
}

//Contador de seguidos
function countFollowing(){
$.ajax({
    url:'controllers/follower.controller.php',
    type: 'GET',
    data: 'op=getCountFollowedByUser',
    success: function(e){
        if(e != ''){
            let datos1 = JSON.parse(e);
            $("#countSeguidosIndex").html("Seguidos:" + " "+  datos1);
        }
    }
});
}


/************** LLAMADO DE LAS FUNCIONES ******************/
$("#btn-regist-opn").click(registerUser);
$("#btn-logout-user").click(logoutSystem);
slclstDepartm();
updtRes1();
loadPicturePerfil();
loadNameUserIndex();
countFollower();
countFollowing();
loadSlcQuestions();