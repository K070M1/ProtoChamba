
  var idusuarioActivo = localStorage.getItem("idusuarioActivo");
  var idusuarioSession = localStorage.getItem("idusuarioSession");
  idusuarioActivo = idusuarioActivo != null? idusuarioActivo: -1;

  var especialidadNuevo = true;
  var establecimientoNuevo = true;
  var redsocialNuevo = true;
  var idusuario;
  var idpersona;
  var idredSocial;
  var idespecialidad;
  var idestablecimiento;
  var imgUpdtP = [];
  var oldEmail = "";
  var typeUpdate = "email";
  
  if(idusuarioActivo != -1 && idusuarioActivo != idusuarioSession){
    disabledButtons();
  } else {
    enabledButtons();
    localStorage.removeItem("idusuarioActivo");
    idusuarioActivo = -1;
  }
 
  
  // Esta función desdabilita los botones de modificación o agregación
  function disabledButtons(){
    $("#btnseguir").show();
    $("#idfoto").hide();
    $("#idfotoPerf").hide();
    $("#idfotoPrt").hide();
    $("#btnP").hide();
    $(".edit-come").hide();
    $("#btnS").hide();
    $("#btnsd").hide();
    $("#btnEst").hide();
    $("#btnrs").hide();
    $("#btn-edit-description").hide();
    $("#btnEditPrivilegedData").hide();
    $("#card-data-privileged").hide();
  }
  
  // Esta función habilita los botones de modificación o agregación
  function enabledButtons(){
    $("#btnseguir").hide();
    $("#idfoto").show();
    $("#idfotoPrt").show();
    $("#idfotoPerf").show();
    $("#btnP").show();
    $(".edit-come").show();
    $("#btnS").show();
    $("#btnsd").show();
    $("#btnEst").show();
    $("#btnrs").show();
    $("#btn-edit-description").show();
    $("#btnEditPrivilegedData").show();
    $("#card-data-privileged").show();
  }   

  // Navegación - GENERAL
  $("#nav-general-tab").click(function(){
    descripcion();
    listInfo();
  });
  
  // Navegación - INFORMACIÓN
  $("#nav-informacion-tab").click(function(){
    listDataUser();
    listEspeciality();
    listEstablishment();
    listRedSocial();
  });
  
  // Navegación - GALERIA
  $("#nav-galeria-tab").click(function(){
    loadAlbum();
    loadGallery();
    loadAlbumSlcModalAddGallery();
  });
  
  // Navegación - AMIGOS
  $("#nav-amigos-tab").click(function(){
    listFollower();
    listFollowing();
    countFollower();
    countFollowing();
  });
  
  // Navegación - SERVICIOS
  $("#nav-configuracion-tab").click(function(){
    loadSpecialtySelect();
    cleanContainerPublication();
    loadPublicationWorks();
  });
  
  // Navegación - FOROS
  $("#nav-forum-tab").click(function(){
    loadQueriesForumToUser();
  });


  function createPerfil(file, estado = true) {
    var imgCodified = URL.createObjectURL(file);
    if(estado){
      $("#refer-port-img").attr('src', imgCodified);
      sweetAlertConfirmQuestionSave("¿Estas seguro de actualizar tu foto de portada?").then((confirm) => {
        if(confirm.isConfirmed){
          sweetAlertSuccess('Realizado', 'Imagen de portada cambiado');
          var formData = new FormData();
          formData.append("op", "updateUserPerfilPort");
          formData.append("archivo", imgUpdtP[0]);
          formData.append("estado", true);
          
          $.ajax({
            url: 'controllers/gallery.controller.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            success: function(e){
              socket.send("imageport"); // Operación enviada al servidor
              loadPicturePort();
              imgUpdtP = [];
            }
          });

        }else{
          imgUpdtP = [];
          loadPicturePort();
        }
      });
    }else{
        $("#refer-perf-img").attr('src', imgCodified);
        sweetAlertConfirmQuestionSave("¿Estas seguro de actualizar tu foto de perfil?").then((confirm) => {
          if(confirm.isConfirmed){
            sweetAlertSuccess('Realizado', 'Imagen de perfil cambiado');
            var formData = new FormData();
            formData.append('op', 'updateUserPerfilPort');
            formData.append("archivo", imgUpdtP[0]);
            formData.append("estado", false);
            
            $.ajax({
              url: 'controllers/gallery.controller.php',
              type: 'POST',
              data: formData,
              contentType: false,
              processData: false,
              cache: false,
              success: function(e){
                $("#idfotoPerf").css("transform", "translateY(0%)");
                imgUpdtP = [];
                socket.send("imageprofile"); // Operación enviada al servidor
                loadPicturePerfil();
              }
            });
          }else{
            $("#idfotoPerf").css("transform", "translateY(0%)");
            imgUpdtP = [];
            loadPicturePerfil();
          }
        });
    }
  }
      
  $("#filePerfil").on("change", function(){
    var element = this.files[0];
    if(element !== undefined){
      imgUpdtP.push(element);
      createPerfil(element, false);
    }
  });

  $("#filePortada").on("change", function(){
    var element = this.files[0];
    if(element !== undefined){
      imgUpdtP.push(element);
      createPerfil(element, true);
    }
  });

  $("#idfotoPrt").click(function(){
    $("#filePortada").click();
  });

  $("#idfotoPerf").click(function(){
    $("#filePerfil").click();
  });

  function loadPicturePort(){
    $.ajax({
      url: 'controllers/gallery.controller.php',
      type: 'GET',
      data: 'op=getAPicturePort&idusuarioactivo=' + idusuarioActivo,
      success: function(e){
        var img = JSON.parse(e);
        if(img == ''){
          $("#refer-port-img").attr('src', 'dist/img/user/portdefault.gif');
          $("#refer-port-img").attr('data-img-por', '-1');
        }else{
          $("#refer-port-img").attr('src', 'dist/img/user/' + img[0]['archivo']);
          $("#refer-port-img").attr('data-img-por',  img[0]['idgaleria']);
        }
      }
    });
  }

  function loadPicturePerfil(){
    $.ajax({
      url: 'controllers/gallery.controller.php',
      type: 'GET',
      data: 'op=getAPicturePerfil&idusuarioactivo=' + idusuarioActivo,
      success: function(e){
        var img = JSON.parse(e);
        if(img == ''){
          $("#refer-perf-img").attr('src', 'dist/img/user/userdefault.jpg');
          $("#refer-perf-img").attr('data-img-per', '-1');
        }else{
          $("#refer-perf-img").attr('src', 'dist/img/user/' + img[0]['archivo']);
          $("#refer-perf-img").attr('data-img-per',  img[0]['idgaleria']);
        }
      }
    });
  }

  function loadNameUser(){
    $.ajax({
      url: 'controllers/user.controller.php',
      type: 'GET',
      data: 'op=getUserName&idusuarioactivo=' + idusuarioActivo,
      success: function(e){        
        $(".titulo-usuario").html(e);
      }
    });
  }


  $("#btn-edit-description").click(function(){
    $("#text-descripcion").attr('contenteditable', true);

    $('#btn-cancel-edit-description').removeClass('d-none');
    $("#btn-update-description").removeClass('d-none');
    $(this).addClass("d-none");
  });

  $("#btn-cancel-edit-description").click(function(){
    $("#text-descripcion").attr('contenteditable', false);

    $('#btn-edit-description').removeClass('d-none');
    $("#btn-update-description").addClass('d-none');
    $(this).addClass('d-none');
  });


  //DESCRIPCION
  $("#btn-update-description").click(function (){

    var formData = new FormData();
    let descrip = $("#text-descripcion").text();

    formData.append("op", "updateDescrip");
    formData.append("descripcion", descrip);

    sweetAlertConfirmQuestionSave("¿Estas seguro Guardar la descripcion?").then((confirm) => {
      if (confirm.isConfirmed){
        $.ajax({
          url: 'controllers/user.controller.php',
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          cache: false,
          success: function(e) {
            $("#text-descripcion").attr('contenteditable', false);
            $('#btn-cancel-edit-description').addClass('d-none');
            $("#btn-update-description").addClass('d-none');
            $("#btn-edit-description").removeClass('d-none');
            
            sweetAlertSuccess("Realizado", "Descripcion guardada");

            socket.send("description"); // operación enviada al servidor
            descripcion();
          }
        });
      }
    }); 
  });

  function levelUser(){
    $.ajax({
      url: 'controllers/user.controller.php',
      type: 'GET',
      data: 'op=getLevelUser&idusuarioactivo=' + idusuarioActivo,
      success: function(e){
        let level = "";
        if(e == "E"){
          level = "Estandar";
          $("#text-level-user").removeClass("intermedio").removeClass("avanzado").addClass("estandar");
        } else if (e == "I"){
          level = "Intermedio";          
          $("#text-level-user").removeClass("estandar").removeClass("avanzado").addClass("intermedio");
        } else if(e == "A"){
          level = "Avanzado";
          $("#text-level-user").removeClass("estandar").removeClass("intermedio").addClass("avanzado");
        }
        $("#text-level-user").html(level);
      }
    });
  }
  
  function descripcion(){
    $.ajax({
      url: 'controllers/user.controller.php',
      type: 'GET',
      data: 'op=getUsersDescrip&idusuarioactivo=' + idusuarioActivo,
      success: function(e){
        $("#text-descripcion").html(e);
      }
    });
  }

  function listRedSocial(){
    $.ajax({
      url: 'controllers/redsocial.controller.php',
      type: 'GET',
      data: 'op=getRedesSociales&idusuarioactivo=' + idusuarioActivo,
      success: function(e){
        $("#redsocial").html(e);
      }
    });
  }

  function listEstablishment(){
    $.ajax({
      url: 'controllers/establishment.controller.php',
      type: 'GET',
      data: 'op=getEstablishmentsByUser&idusuarioactivo=' + idusuarioActivo,
      success: function(e){
        $("#empresas").html(e);
      }
    });
  }

  // Información introductorio del usuario
  function listInfo(){
    $.ajax({
      url: 'controllers/establishment.controller.php',
      type: 'GET',
      data: 'op=getEstablishmentsInfo&idusuarioactivo=' + idusuarioActivo,
      success: function(e){
        $("#info-empresa").html(e);
      }
    });
  }

  function listDataUser(){
    $.ajax({
      url: 'controllers/user.controller.php',
      type: 'GET',
      data: 'op=getAUserProfile&idusuarioactivo=' + idusuarioActivo,
      success: function(e){
        $("#personas").html(e);
      }
    });
  }

  function listFollower(){
    $.ajax({
      url: 'controllers/follower.controller.php',
      type: 'GET',
      data: 'op=getFollowersByUser&idusuarioactivo=' + idusuarioActivo,
      success: function(e){
        $("#seguidores").html(e);
      }
    });
  }

  function listFollowing(){
    $.ajax({
      url: 'controllers/follower.controller.php',
      type: 'GET',
      data: 'op=getFollowedByUser&idusuarioactivo=' + idusuarioActivo,
      success: function(e){
        $("#seguidos").html(e);
      }
    });
  }

  // Cancelar edicion de especialidad
  $("#collapseEspecialidad .btn-cancel").click(function(){
    especialidadNuevo = true;
    $("#form-add-esp")[0].reset();
    $("#agregarEsp").removeClass("btn-outline-info").addClass("btn-outline-primary")
    .html("Agregar");    
  });

  // Editar establecimiento
  $("#empresas").on("click", ".btn-edit-est", function(){
    $("#btn-add-est").removeClass("btn-outline-primary").addClass("btn-outline-info").html("Actualizar");
    idestablecimiento = $(this).attr("data-idest");
    establecimientoNuevo = false;

    $.ajax({
      url: 'controllers/establishment.controller.php',
      type: 'GET',
      data: 'op=getAEstablishment&idestablecimiento=' + idestablecimiento,
      success: function(e){
        let data = JSON.parse(e);

        $("#content-establecimiento").collapse('show');        
        listProvinces(data.iddepartamento);
        listDistricts(data.idprovincia);
        
        $("#establecimiento").val(data.establecimiento);
        $("#estDepartamento").val(data.iddepartamento);
        $("#estProvincia").val(data.idprovincia);
        $("#estDistrito").val(data.iddistrito);
        $("#ruc").val(data.ruc);
        $("#estTipoC").val(data.tipocalle);
        $("#estNomCalle").val(data.nombrecalle);
        $("#estNC").val(data.numerocalle);
        $("#estReferencia").val(data.referencia);
        $("#estLatitud").val(data.latitud);
        $("#estLongitud").val(data.longitud);
      }
    });
  });

  // Eliminar establecimiento
  $("#empresas").on("click", ".btn-delete-est", function(){
    idestablecimiento = $(this).attr("data-idest");

    sweetAlertConfirmQuestionDelete("¿Estas seguro de eliminar el establecimiento?").then(confirm => {
      if(confirm.isConfirmed){
        $.ajax({
          url: 'controllers/establishment.controller.php',
          type: 'GET',
          data: 'op=deleteEstablishment&idestablecimiento=' + idestablecimiento,
          success: function(result){
            if(result == ""){
              socket.send("establishment"); // Operación enviada al servidor
              listEstablishment();
            }
          }
        });
      }
    });
  });

  // Cancelar edición
  $("#content-establecimiento .btn-cancel").click(function(){
    $("#btn-add-est").removeClass("btn-outline-info").addClass("btn-outline-primary").html("Agregar");
    $("#form-establecimiento")[0].reset();
    establecimientoNuevo = true;
  });

  // Agregar o Actualizar establecimiento
  $("#btn-add-est").click(function(){
    let establecimiento = $("#establecimiento").val();
    let ruc = $("#ruc").val();
    let iddistrito = $("#estDistrito").val();
    let tipocalle =  $("#estTipoC").val();
    let nombrecalle = $("#estNomCalle").val();
    let numerocalle = $("#estNC").val();
    let referencia = $("#estReferencia").val();
    let latitud = $("#estLatitud").val();
    let longitud = $("#estLongitud").val();
    let pregunta = "Agregar";

    if(establecimiento == "" || ruc == "" || iddistrito == "" || nombrecalle == "" || latitud == "" || longitud == ""){
        sweetAlertWarning("Datos invalido", "Por favor complete el formulario");
    } else {
      let data = {
        op                : 'registerEstablishment',
        iddistrito        : iddistrito,
        establecimiento   : establecimiento,
        ruc               : ruc,
        tipocalle         : tipocalle,
        nombrecalle       : nombrecalle,
        numerocalle       : numerocalle,
        referencia        : referencia,
        latitud           : latitud,
        longitud          : longitud
      };

      // Actualizar
      if(!establecimientoNuevo){
        data['op'] = 'updateEstablishment';
        data['idestablecimiento'] = idestablecimiento;
        pregunta = "Actualizar";
      }
  
      sweetAlertConfirmQuestionSave("¿Estas seguro de " + pregunta + "  el establecimiento?").then(confirm => {
        if(confirm.isConfirmed){
          $.ajax({
            url: 'controllers/establishment.controller.php',
            type: 'GET',
            data: data,
            success: function(result){
              if(result == ""){
                $("#btn-add-est").removeClass("btn-outline-info").addClass("btn-outline-primary").html("Agregar");
                $("#content-establecimiento").collapse('hide');

                establecimientoNuevo = true;
                socket.send("establishment"); // Operación enviada al servidor
                listEstablishment();
              } else {
                sweetAlertError("Error", "Revise los datos");
              }
            }
          });
        }
      });
    }

  });


  // Abrir modal - actualizar correo
  $("#btn-edit-email").click(function(){
    $("#form-content-credentials")[0].reset();
    $(".container-password").addClass("d-none");
    $(".container-emails").removeClass("d-none");
    $("#title-modal-account").html("Actualizar correo electrónico");
    $("#modalUpdateAccount .btn-update").removeClass("d-none");
    $("#modalUpdateAccount .btn-delete").addClass("d-none");

    typeUpdate = "email";

    $.ajax({
      url: 'controllers/user.controller.php',
      type: 'GET',
      data: 'op=getDataUser',
      success: function(result){
        var datos = JSON.parse(result);
        oldEmail = datos[0].email;
        $("#emailUser").val(datos[0].email);
        $("#emailBack").val(datos[0].emailrespaldo);
        $("#modalUpdateAccount").modal("show");
      }
    });
  });
  
  // Abrir modal - actualizar contraseña
  $("#btn-edit-password").click(function(){
    $("#form-content-credentials")[0].reset();
    $(".container-emails").addClass("d-none");
    $(".container-password").removeClass("d-none");
    $("#title-modal-account").html("Actualizar contraseña");
    $("#modalUpdateAccount .btn-update").removeClass("d-none");
    $("#modalUpdateAccount .btn-delete").addClass("d-none");
    $("#modalUpdateAccount").modal("show");

    typeUpdate = "password";
  });
  
  // Abrir modal - eliminar cuenta
  $("#btn-delete-account").click(function(){
    $("#form-content-credentials")[0].reset();
    $(".container-emails").addClass("d-none");
    $(".container-password").addClass("d-none");
    $("#title-modal-account").html("Eliminar cuenta");
    $("#modalUpdateAccount .btn-update").addClass("d-none");
    $("#modalUpdateAccount .btn-delete").removeClass("d-none");
    $("#modalUpdateAccount").modal("show");
  });

  // Ejecuta la acción actualizar
  $("#modalUpdateAccount .btn-update").click(function(){
    let emailUser = $("#emailUser").val().trim();
    let emailBack = $("#emailBack").val().trim();
    let password = $("#passwordVerify").val().trim();
    let newPassword1 = $("#newPassword1").val().trim();
    let newPassword2 = $("#newPassword2").val().trim();

    if(typeUpdate == "email"){
      if(emailUser == "" || password == ""){
        sweetAlertWarning("Complete los datos", "Complete los datos oblogatorios");
      } else {
        sweetAlertConfirmQuestionSave("¿estas seguro de actualizar tu correo electrónico?").then(confirm => {
          if(confirm.isConfirmed){  
            $.ajax({
              url: 'controllers/user.controller.php',
              type: 'GET',
              data: {
                op : 'updateEmailUser',
                email: emailUser,
                emailrespaldo: emailBack,
                password: password
              },
              success: function(result){
                if(result == ""){                  
                  $("#modalUpdateAccount").modal("hide");
                  sweetAlertSuccess("Correo actualizado", "");
                } else {
                  sweetAlertError("Error", result);
                }
              }
            });

          }
        });
      }
    } else {
      if(password == "" || newPassword1 == "" || newPassword2 == ""){
        sweetAlertWarning("Complete los datos", "Complete todos los datos");
      } else {
        if(newPassword1 != newPassword2){
          sweetAlertError("Contraseñas incorrectas", "verifique que su nueva contraseña sea el mismo");
        } else {
          // 
          sweetAlertConfirmQuestionSave("¿Estas seguro de actualizar tu contraseña?").then(confirm => {
            if(confirm.isConfirmed){
              $.ajax({
                url: 'controllers/user.controller.php',
                type: 'GET',
                data: {
                  op: 'updatePasswordUser',
                  password: password,
                  newpassword: newPassword1
                },
                success: function(result){
                  if(result == ""){                  
                    $("#modalUpdateAccount").modal("hide");
                    sweetAlertSuccess("Contraseña actualizada", "Cierre sesión y vuelva a iniciar");
                  } else {
                    sweetAlertError("Error", result);
                  }
                }
              });
            }
          });
        }
      }
    }
  });

  $("#modalUpdateAccount .btn-delete").click(function(){
    let password = $("#passwordVerify").val().trim();

    sweetAlertConfirmQuestionDelete("¿Estas seguro de eliminar tu cuenta de usuario?").then(confirm => {
      if(confirm.isConfirmed){
        $.ajax({
          url: 'controllers/user.controller.php',
          type: 'GET',
          data: 'op=deleteUser&password=' + password,
          success: function(result){
            if(result == ""){                  
              $("#modalUpdateAccount").modal("hide");
              window.location.href = "controllers/user.controller.php?op=logout";
            } else {
              sweetAlertError("Error", result);
            }
          }
        });
      }
    });
  });

  function listServices(){
    $.ajax({
      url:'controllers/service.controller.php',
      type: 'GET',
      data: 'op=getServices',
      success: function(e){
        $("#services").html(e);
      }
    });
  }


  function listEspeciality(){
    $.ajax({
      url: 'controllers/specialty.controller.php',
      type: 'GET',
      data: 'op=getServicesUser&idusuarioactivo=' + idusuarioActivo,
      success: function(e){
        $("#especiality").html(e);
      }
    });
  }

  
  function registerSpecialtyUser(){

    var formData = new FormData();

    let idservicio = $("#services").val();
    let descripcion = $("#descripcionEsp").val();
    let tarifa = $("#tarifa").val();

    if(especialidadNuevo == true){
      formData.append("op", "registerSpecialtyUser");
    }else{
      formData.append("op", "updateSpecialty");
      formData.append("idespecialidad", idespecialidad);
    }

    formData.append("idservicio", idservicio);
    formData.append("descripcion", descripcion);
    formData.append("tarifa", tarifa);


    if(idservicio == "" || descripcion == "" || tarifa == ""){
      sweetAlertWarning("Falta completar algunas casillas", "");
    }else{
      sweetAlertConfirmQuestionSave("¿Estas seguro agregar la especialidad?").then(confirm => {
        if(confirm.isConfirmed){
          $.ajax({
            url: 'controllers/specialty.controller.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            success: function(e) {
              especialidadNuevo = true;
              $("#idservices").val('');
              $("#descripcionEsp").val('');
              $("#tarifa").val('');
              $("#agregarEsp").removeClass("btn-outline-info").addClass("btn-outline-primary")
              .html("Agregar");
              
              // Enviando operación al socket
              socket.send("especialties");
              listEspeciality();
            }
          });
        }
      });
    } 
  }

  $("#especiality").on("click", ".modificarEsp", function(){
    idespecialidad = $(this).attr("data-idespecialidad");
    $("#collapseEspecialidad").collapse("show");

    $.ajax({
      url: "controllers/specialty.controller.php",
      type: 'GET',
      data: 'op=getDataSpecialty&idespecialidad=' + idespecialidad,
      success: function(e){
        var datos = JSON.parse(e);
        $("#services").val(datos[0].idservicio);
        $("#descripcionEsp").val(datos[0].descripcion);
        $("#tarifa").val(datos[0].tarifa);
        especialidadNuevo = false;
        $("#agregarEsp").removeClass("btn-outline-primary").addClass("btn-outline-info")
        .html("Actualizar");
      }
    });
  });

  //Eliminar Especialidad
  $("#especiality").on("click", ".eliminarEsp", function(){

    idespecialidad = $(this).attr("data-idespecialidad");

    sweetAlertConfirmQuestionDelete("¿Estas seguro eliminar la especialidad?").then((confirm) => {
      if (confirm.isConfirmed){
        $.ajax({
          url: 'controllers/specialty.controller.php',
          type: "GET",
          data: 'op=deleteSpecialty&idespecialidad=' + idespecialidad,
          success: function (e){
            if(e != ""){
              sweetAlertError("Error al eliminar", "");
            } else {
              // Enviando operación al socket
              socket.send("especialties");
              sweetAlertSuccess("Realizado", "La especialidad ha sido eliminada");
              listEspeciality();
              loadPublicationWorks(); // Vista Publicaciones
            }
          }
        });
      }
    }); 
  });

  $("#btnP").click(function(){
    $.ajax({
      url: 'controllers/person.controller.php',
      type: 'GET',
      data: 'op=getDataPerson',
      success: function(e) {
        var datos = JSON.parse(e);

        $("#nombres").val(datos[0].nombres);
        $("#apellidos").val(datos[0].apellidos);
        $("#fechanaci").val(datos[0].fechanac);
        $("#telefono").val(datos[0].telefono);
        $("#inTipoC").val(datos[0].tipocalle);
        $("#inNCalle").val(datos[0].nombrecalle);
        $("#inNC").val(datos[0].numerocalle);
        $("#inPiso").val(datos[0].pisodepa);
      }
    });

    $.ajax({
      url: 'controllers/user.controller.php',
      type: 'GET',
      data: 'op=getDataUser',
      success: function(result){
        var datos = JSON.parse(result);
        $("#horarioatencion").val(datos[0].horarioatencion);
      }
    });

  });

  function updateDataUser(){
    let nombres = $("#nombres").val();
    let apellidos = $("#apellidos").val();
    let fechanac = $("#fechanaci").val();
    let telefono = $("#telefono").val();
    let tipocalle = $("#inTipoC").val();
    let nombrecalle = $("#inNCalle").val();
    let numerocalle = $("#inNC").val();
    let pisodepa = $("#inPiso").val();
    let horarioatencion = $("#horarioatencion").val();

    var data = {
      op: 'updateUser',
      apellidos: apellidos,
      nombres: nombres,
      fechanac: fechanac,
      telefono: telefono,
      tipocalle: tipocalle,
      nombrecalle: nombrecalle,
      numerocalle: numerocalle,
      pisodepa: pisodepa,
      horarioatencion: horarioatencion
    }

    if(nombres == "" || apellidos == "" || fechanac == "" || telefono == "" || tipocalle == "" || nombrecalle == ""){
      sweetAlertWarning("Invalido", "Complete los datos");
    } else {
      sweetAlertConfirmQuestionSave("¿Estas seguro de actualizar los datos?").then(confirm => {
        if(confirm.isConfirmed){
          $.ajax({
            url: 'controllers/user.controller.php',
            type: 'GET',
            data: data,
            success: function(e) {
              if(e == ""){
                $("#containerDatePerson").collapse("hide");
                $("#nombres").val('');
                $("#apellidos").val('');
                $("#fechanaci").val('');
                $("#telefono").val('');
                $("#inTipoC").val('');
                $("#inNCalle").val('');
                $("#inNC").val('');
                $("#inPiso").val('');
                $("#horarioatencion").val('');
                
                // Operación enviada al servidor
                socket.send("loadDataPerson");
                listDataUser();
                loadNameUser();
                loadNameUserIndex();
              }
            }
          });
        }
      });
    }
  }

  //Registrar RedSocial
  function registerRedSocial(){

    var formData = new FormData();

    let redsocial = $("#nombrered").val();
    let vinculo = $("#vinculo").val();
    let pregunta = "agregar";
 
    if(redsocialNuevo){
      formData.append("op", "registerRedSocial");
    }else{
      formData.append("op", "updateRedSocial");
      formData.append("idredsocial", idredSocial);
      pregunta = "actualizar";
    }
    
    formData.append("redsocial", redsocial);
    formData.append("vinculo", vinculo);


    if(redsocial == "" || vinculo == ""){
      sweetAlertWarning("Falta completar algunas casillas", "");
    }else{
      sweetAlertConfirmQuestionSave("¿Estas seguro " + pregunta + " la red social?").then(confirm => {
        if(confirm.isConfirmed){
          $.ajax({
            url: 'controllers/redsocial.controller.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            success: function(e) {
              $("#nombrered").val('');
              $("#vinculo").val('');
              redsocialNuevo = true;

              socket.send("redsocial");
              listRedSocial();
            }
          });
        }
      });
    } 
  }

  //Modificar RedSocial
  $("#redsocial").on("click", ".modificarRed", function(){
    idredSocial = $(this).attr("data-idredSocial");
    $("#agregarred").removeClass("btn-outline-primary").addClass("btn-outline-info")
    .html("Actualizar");

    $.ajax({
      url: 'controllers/redsocial.controller.php',
      type: 'GET',
      data: 'op=getRedSocial&idredsocial=' + idredSocial,
      success: function(e) {
        var datos = JSON.parse(e);
        $("#nombrered").val(datos[0].redsocial);
        $("#vinculo").val(datos[0].vinculo);
        $("#collapseRed").collapse("show");

        redsocialNuevo = false;
      }
    });

  });
  
  //Eliminar RedSocial
  $("#redsocial").on("click", ".eliminarRed", function(){

    idredSocial = $(this).attr("data-idredsocial");
    sweetAlertConfirmQuestionDelete("¿Estas seguro eliminar la red?").then((confirm) => {
      if (confirm.isConfirmed){
        $.ajax({
          url: 'controllers/redsocial.controller.php',
          type: "GET",
          data: 'op=deleteRedSocial&idredsocial=' + idredSocial,
          success: function (){
            sweetAlertSuccess("Realizado", "La red a sido eliminada");
            socket.send("redsocial"); // Enviando operación al servidor
            listRedSocial();
          }
        });
      }
    }); 
  });

  // cancelar edición de redsocial
  $("#collapseRed .btn-cancel").click(function(){
    $("#agregarred").removeClass("btn-outline-info").addClass("btn-outline-primary")
    .html("Agregar");
    $("#formred")[0].reset();
    redsocialNuevo = true;
  });

  $("#seguidos").on("click",".modificar", function(){

    let idfollowing = $(this).attr("data-idfollowing");

    sweetAlertConfirmQuestionDelete("¿Estas seguro dejar de seguir a la persona?")
    .then((confirm) => {
      if(confirm.isConfirmed){
        socket.send("follower");
        deleteFollower(idfollowing);
      }
    });
  
  });

  // Redireccionar perfil - desde seguidores
  $("#seguidores").on("click",".link-user", function(){ 
    let idusuario = $(this).attr("data-idfollower");
    redirectProfile(idusuario);  
  });

  // Redireccionar perfil - desde la lista de seguidos
  $("#seguidos").on("click",".link-user", function(){ 
    let idusuario = $(this).attr("data-idfollowing"); 
    redirectProfile(idusuario);  
  });

  function countFollower(){
    $.ajax({
      url:'controllers/follower.controller.php',
      type: 'GET',
      data: 'op=getCountFollowersByUser&idusuarioactivo=' + idusuarioActivo,
      success: function(e){
        if(e != ""){
          let datos = JSON.parse(e);
          $("#conteosegui").html(datos);
        }
      }
    });
  }

  function countFollowing(){
    $.ajax({
      url:'controllers/follower.controller.php',
      type: 'GET',
      data: 'op=getCountFollowedByUser&idusuarioactivo=' + idusuarioActivo,
      success: function(e){
        if(e != ""){
          let datos1 = JSON.parse(e);
          $("#conteoseguid").html(datos1);
        }
      }
    });
  }

  function scoreUser(){
    $.ajax({
      url: 'controllers/qualify.controller.php',
      type: "GET",
      data: 'op=getScoreUser&idusuarioactivo=' + idusuarioActivo,
      success: function (result){
        $("#content-starts").html(result);
      }
    });
  };

  // Seguir
  $("#btnseguir").click(function(){

    let textButton = $(this).html();
    if(textButton == "Seguir"){
      registerFollower({
        op             : 'registerFollower',
        idusuarioactivo: idusuarioActivo
      });      
    } else {
      deleteFollower(idusuarioActivo);
    }
  });

  // Registrar seguidor
  function registerFollower(dataSend){
    $.ajax({
      url: 'controllers/follower.controller.php',
      type: 'GET',
      data: dataSend,
      success: function(result){
        if(result == ""){
          socket.send("follower"); // Operación enviada al servidor
          countFollower();
          countFollowing();
          validateFollower();
          listFollower();
          listFollowing();     
        } else {
          sweetAlertWarning(result, "Iniciar sesión o crearse una cuenta");
        }
      }
    });
  }
  
  // Dejar de seguir
  function deleteFollower(idfollowing){
    $.ajax({
      url: 'controllers/follower.controller.php',
      type: 'GET',
      data: {
        op: 'deleteFollower',
        idfollowing: idfollowing 
      },
      success: function(e) {
        socket.send("follower"); // Operación enviada al servidor
        validateFollower();
        listFollower();
        listFollowing();
        countFollower();
        countFollowing();
      }
    });
  }

  // validar seguidor
  function validateFollower(){
    $.ajax({
      url: 'controllers/follower.controller.php',
      type: 'GET',
      data: 'op=validateFollower&idusuarioactivo=' + idusuarioActivo,
      success: function(result){
        if(result == "Seguido"){
          $("#btnseguir").removeClass("btn-info").addClass("btn-success");
          $("#btnseguir").html("Seguido");
        } else {
          $("#btnseguir").removeClass("btn-success").addClass("btn-info");
          $("#btnseguir").html("Seguir");
        }
      }
    });
  }

  function listDepartments(){
    $.ajax({
      url: 'controllers/ubigeo.controller.php',
      type: 'GET',
      data: 'op=getDepartments',
      success: function(e){
        $("#estDepartamento").html(e);
      }
    });
  }

  $("#estDepartamento").change(function(){
    let iddepartamento = $(this).val();

    listProvinces(iddepartamento);
  });

  function listProvinces(iddepartamento){
    $.ajax({
      url: 'controllers/ubigeo.controller.php',
      type: 'GET',
      data: 'op=getProvinces&iddepartamento=' + iddepartamento,
      success: function(e){
        $("#estProvincia").html(e);
      }
    });
  }

  $("#estProvincia").change(function(){
    let idprovincia = $(this).val();

    $.ajax({
      url: 'controllers/ubigeo.controller.php',
      type: 'GET',
      data: 'op=getDistricts&idprovincia=' + idprovincia,
      success: function(e){
        $("#estDistrito").html(e);
      }
    });
  });

  function listDistricts(idprovincia){
    $.ajax({
      url: 'controllers/ubigeo.controller.php',
      type: 'GET',
      data: 'op=getDistricts&idprovincia=' + idprovincia,
      success: function(e){
        $("#estDistrito").html(e);
      }
    });
  }


  /*  */
  $("#btnEditPrivilegedData").click(function(){
    $.ajax({
      url: 'controllers/user.controller.php',
      type: 'GET',
      data: 'op=getDataUser',
      success: function(result){
        var datos = JSON.parse(result);
        $("#email").val(datos[0].email);
        $("#emailrespaldo").val(datos[0].emailrespaldo);
      }
    });
  });

  $("#agregarEsp").click(registerSpecialtyUser);
  $("#agregarred").click(registerRedSocial);
  $("#actualizarPer").click(updateDataUser);

  levelUser();
  listDepartments();
  validateFollower();
  listFollower();
  listFollowing();
  listDataUser();
  listEstablishment();
  listInfo();
  descripcion();
  countFollower();
  countFollowing();
  listRedSocial();
  listServices();
  listEspeciality();
  loadPicturePort();
  loadPicturePerfil();
  loadNameUser();
  scoreUser();