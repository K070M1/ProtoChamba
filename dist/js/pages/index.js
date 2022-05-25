var question = localStorage.getItem('QuestionLogin');
if(question == null){
    question = false;
}

var idusuarioActivo = localStorage.getItem("idusuarioActivo");
idusuarioActivo = idusuarioActivo != null? idusuarioActivo: -1;

var dejarIr = false;
var newUserImg = [];

var remember = localStorage.getItem('remember');
if(remember == null){
    remember = false;
}

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
    let tipEmail = $("#inTipEmail").val();
    let clave = $("#inPass1").val();
    let clave2 = $("#inPass2").val();

    if(apellidos == '' || nombres == '' || fechanac == '' || telefono == '' || iddistrito == null || nombrecalle == '' ||  email == '' || clave == ''){
        sweetAlertWarning('Q tal Chamba', 'Faltan completar algunas casillas');
    }else{
        if(clave != clave2){
            sweetAlertWarning('Q tal Chamba', 'Las contraseñas no coinciden');
        }else{
            sweetAlertConfirmQuestionSave("¿Deseas registrar esta nueva cuenta?").then((confirm) => {
                if(confirm.isConfirmed){
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
                    formData.append("email", email + tipEmail);
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
                            if(e == '.'){
                                sweetAlertError('Q tal Chamba', 'Correo ya registrado');
                            }else{
                                $("#modalRegister").modal('hide');
                                $("#modal-perfil-img-new").modal('toggle');
                                socket.send("users"); // Operación enviada al servidor
                                sweetAlertSuccess('Q tal Chamba', 'Usuario registrado correctamente');
                                //window.location.reload();
                            }
                        }
                    });
                }
            });
        
        }
    }
    

}

// Registrar foto de perfil de nuevo usuario
function newProfileUser(){
    var formData = new FormData();
    formData.append("op", "newUserProfile");
    formData.append("archivo", newUserImg[0]);
    $.ajax({
        url: 'controllers/user.controller.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        cache: false,
        success: function(e) {
            $("#modal-perfil-img-new").modal('hide');
            //window.location.reload();
        }
    });
}

//Cargar foto de perfil
function loadPicturePerfil(){
    $.ajax({
        url: 'controllers/gallery.controller.php',
        type: 'GET',
        data: 'op=getAPicturePerfil&idusuarioactivo=-1',
        success: function(e){
            if(e == '.' || e == '[]' || e == ' ' || e === null){
                $("#imgQuestI").attr('src', 'dist/img/user/userdefault.jpg');
            }else{
                var img = JSON.parse(e);
                $("#imgQuestI").attr('src', 'dist/img/user/' + img[0]['archivo']);
            } 
        }
    });
}

//Foto de perfil de nuevo usuario
$("#btn-omt-prf").click(function(){
    $("#modal-perfil-img-new").modal('hide');
    loadPicturePerfil();
    //window.location.reload();
});

$("#newUserFile").change(function(){
    var datos = this.files;
    if(datos.length == 0){
        sweetAlertWarning('Q tal Chamba', 'Ningun archivo seleccionado');    
    }else{
        var element = datos[0];
        newUserImg.push(element);
        var img = URL.createObjectURL(element);
        $("#File-imgUserNew").attr('src', img);
        setTimeout(() => {
            sweetAlertConfirmQuestionSave("¿Estas seguro de asignar esta foto de perfil?").then((confirm) => {
                if(confirm.isConfirmed){
                  sweetAlertSuccess('Realizado', 'Imagen de perfil registrado');
                  newProfileUser();
                  newUserImg = [];
                }else{
                    newUserImg = [];
                    $("#File-imgUserNew").attr('src', 'dist/img/user2-160x160.jpg');
                }
            });
        }, 500);
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
                    localStorage.removeItem("idusuarioActivo");
                    window.location.reload();
                }else{
                    sweetAlertInformation("Q tal chamba", "Respuesta equivocada");
                    loadSlcQuestions();
                }
            }
        });
    }

});   

// Cargar contenido de restablecimiento 
$("#m-res-lod").on("click", "#btnRes1", function(){
    var email = $("#inptEmailRes").val();
    localStorage.removeItem("email");
    
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
        }   
    });
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
                    $("#btnRes3").html('Siguiente...');
                    $("#btnRes3").click();
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
            sweetAlertConfirmQuestionSave("¿Estas seguro de cambiar tu contraseña?").then((confirm) => {
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
    var email = $("#emailInpt").val();
    var pass = $("#passwordInpt").val();

    var data = 
    {
        'op' : 'loginUser',
        'email' : email,
        'password' : pass
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
                    if(question == 'true'){
                        $("#modal-question").modal('toggle');
                        loadNameUserIndex();
                        loadPicturePerfil();
                    }else{
                        loadNameUserIndex();
                        localStorage.removeItem("idusuarioActivo");
                        window.location.reload();
                        
                    }
                    
                    if(remember){
                        localStorage.setItem('uEmailCas', email);
                        localStorage.setItem('uPassCas', pass);
                    }else{
                        localStorage.removeItem('uEmailCas', email);
                        localStorage.removeItem('uPassCas', pass);   
                    }
                    loadRememberData();
                }else if(e  == 'Incorrecto'){
                    sweetAlertError('Q tal Chamba', 'Contraseña incorrecta');
                }else{
                    sweetAlertError('Q tal Chamba', 'ERROR EN EL SISTEMA');
                }
            }
        });
    }
    
});

//Nombre del usuario
function loadNameUserIndex(){
    $.ajax({
      url: 'controllers/user.controller.php',
      type: 'GET',
      data: 'op=getUserName&idusuarioactivo=' + -1,
      success: function(e){
        $("#nameUserIndex").html(e);
        $("#nameUserIndex2").html(e);
        $("#questNameI").html(e);
      }
    });
}


//Cargar checkbox de Question
function loadQuestionCheck(){
    if(question == 'true'){
        $("#questionLoginHab").prop('checked', true);
    }else{
        $("#questionLoginHab").prop('checked', false);
    }
}

// Solo letras y numeros
$("#inApellidos").on('keypress', function(e){
    var condicional = new RegExp("^[a-zA-Z ]+$");
    var valor = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (!condicional.test(valor)) {
        e.preventDefault();
    }
    
});

$("#inNombres").on('keypress', function(e){
    var condicional = new RegExp("^[a-zA-Z ]+$");
    var valor = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (!condicional.test(valor)) {
        e.preventDefault();
    }
    
});

$("#inTelef").on('keypress', function(e) {
    var condicional = new RegExp("^[0-9]+$");
    var valor = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (!condicional.test(valor)) {
      e.preventDefault();
    }
});

// Maxlength limitada
$("#inNC").on('input', function(){
    if(this.value.length > this.maxLength){
        this.value = this.value.slice(0, this.maxLength);
    }
    if(this.value < 1){
        this.value = '';
    }
});

$("#inPiso").on('input', function(){
    if(this.value.length > this.maxLength){
        this.value = this.value.slice(0, this.maxLength);
    }

    if(this.value < 1){
        this.value = '';
    }
});

// Detectar Arroba
$("#inCorreoE").on('keypress', function(e){
    if(e.charCode == 64){
        e.preventDefault();
    }
});

// Restringir fecha de nacimiento
$("#inFechaNac").on('blur', function(){
    var date = new Date();
    var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear();
    
    var newDate = new Date((y-18) + "-" + (m+1) + "-" + d);
    var nDate = newDate.toISOString();
    var fechaconv = nDate.split("T")[0];
    
    var olDate = new Date((y-100) + "-" + (m+1) + "-" + d );
    var oDate = olDate.toISOString();
    var oldConv = oDate.split("T")[0];

    var fecharecibida = new Date(this.value);
    var fechalimite = new Date(fechaconv);
    var fechaantes = new Date(oldConv);
    if(fecharecibida.getTime() > fechalimite.getTime()){
        sweetAlertWarning('Q tal Chamba', 'Debes ser mayor de edad');
        this.value = '';
    }else if(fecharecibida.getTime() < fechaantes.getTime()){
        sweetAlertWarning('Q tal Chamba', 'Fecha Inválida');
        this.value = '';
    }   
});

//Habilitar pregunta de seguridad
$("#questionLoginHab").change(function(){
    
    if($("#questionLoginHab").prop('checked')){
        localStorage.setItem('QuestionLogin', true);
    }else{
        localStorage.setItem('QuestionLogin', false);
    }
});

//Cargar datos de remember
$("#rememberUser").change(function(){
    if($("#rememberUser").prop('checked')){
        localStorage.setItem('remember', true);
        remember = true;
    }else{
        localStorage.setItem('remember', false);
        remember = false;
    }
});

//Cargar datos de remember
function loadRememberData(){
    var email = localStorage.getItem('uEmailCas');
    var pass = localStorage.getItem('uPassCas');

    if(remember == 'true'){
        $("#rememberUser").prop('checked', true);
        $("#emailInpt").val(email);
        $("#passwordInpt").val(pass);
    }else{
        $("#rememberUser").prop('checked', false);
        $("#emailInpt").val();
        $("#passwordInpt").val();
    }
}

/************** LLAMADO DE LAS FUNCIONES ******************/
$("#btn-regist-opn").click(registerUser);
slclstDepartm();
updtRes1();
loadNameUserIndex();
loadSlcQuestions();
loadQuestionCheck();
loadRememberData();