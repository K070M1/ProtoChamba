
  var idusuarioActivo = localStorage.getItem("idusuarioActivo");
  idusuarioActivo = idusuarioActivo != null? idusuarioActivo: -1;

  var datosNuevos = true; 
  var idusuario;
  var idpersona;
  var idredSocial;
  var idespecialidad;
  var idestablecimiento;
  var imgUpdtP = [];

  if(idusuarioActivo != -1){
    disabledButtons();
  } else {
    enabledButtons();
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
    $("#btnsbtnEstd").show();
    $("#btnrs").show();
    $("#btn-edit-description").show();
    $("#btnEditPrivilegedData").show();
  }

   

  function createPerfil(file, estado = true) {
    var imgCodified = URL.createObjectURL(file);
    if(estado == true){
      console.log(imgUpdtP);
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
                loadPicturePerfil();
                $("#refer-perf-img").click();
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
            descripcion();
            $("#text-descripcion").attr('contenteditable', false);
            $('#btn-cancel-edit-description').addClass('d-none');
            $("#btn-update-description").addClass('d-none');
            $("#btn-edit-description").removeClass('d-none');

            sweetAlertSuccess("Realizado", "Descripcion guardada");
          }
        });
      }
    }); 
  });

  
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

  function listEspeciality(){
    $.ajax({
      url: 'controllers/specialty.controller.php',
      type: 'GET',
      data: 'op=getServicesUser&idusuarioactivo=' + idusuarioActivo,
      //data: 'op=listSpecialtyUser&idusuarioactivo=' + idusuarioActivo,
      success: function(e){
        $("#especiality").html(e);
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

  function listServicesUser(){
    $.ajax({
      url:'controllers/service.controller.php',
      type: 'GET',
      data: 'op=getServicesUser&idusuarioactivo=' + idusuarioActivo,
      success: function(e){
        $("#serviciosUsuario").html(e);
      }
    });
  }

  /* function listDatosPerson(){
    $.ajax({
      url: 'controllers/person.controller.php',
      type: 'GET',
      data: 'op=getPerson&idusuarioactivo=' + idusuarioActivo,
      success: function(e){
        $("#personas").html(e);
      }
    });
  } */
  
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


  function RegisterSpecialtyUser(){

    var formData = new FormData();

    let idservicio = $("#services").val();
    let descripcion = $("#descripcionEsp").val();
    let tarifa = $("#tarifa").val();

    if(datosNuevos == true){
      formData.append("op", "registerSpecialtyUser");
    }else{
      formData.append("op", "updateSpecialty");
      formData.append("idespecialidad", idespecialidad);
    }

    formData.append("idservicio", idservicio);
    formData.append("descripcion", descripcion);
    formData.append("tarifa", tarifa);


    if(idservicio == "" || descripcion == "" || tarifa == ""){
      Swal.fire({
          position: 'top',
          icon: 'warning',
          title: 'Falta completar algunas casillas',
          showConfirmButton: false,
          timer: 1000
      });
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
              $("#idservices").val('');
              $("#descripcionEsp").val('');
              $("#tarifa").val('');
              listEspeciality();
              datosNuevos = true;
            }
          });
        }
      });
    } 
  }

  // Editar establecimiento
  $("#empresas").on("click", ".btn-edit-est", function(){
    idestablecimiento = $(this).attr("data-idest");
    //alert(idestablecimiento)

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

  // Actualizar
  $("#btn-update-est").click(function(){
    let data = {
      op: 'updateEstablishment', 
      idestablecimiento: idestablecimiento,
      iddistrito: $("#estDistrito").val(),
      establecimiento: $("#establecimiento").val(),
      ruc: $("#ruc").val(),
      tipocalle: $("#estTipoC").val(),
      nombrecalle: $("#estNomCalle").val(),
      numerocalle: $("#estNC").val(),
      referencia: $("#estReferencia").val(),
      latitud: $("#estLatitud").val(),
      longitud: $("#estLongitud").val()
    };

    sweetAlertConfirmQuestionSave("¿Estas seguro de actualizar datos del establecimiento?").then(confirm => {
      if(confirm.isConfirmed){
        $.ajax({
          url: 'controllers/establishment.controller.php',
          type: 'GET',
          data: data,
          success: function(e){
            console.log(e)
            $("#content-establecimiento").collapse('hide');
            listEstablishment();
          }
        });
      }
    });

  });


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
        datosNuevos = false;
      }
    });
  });


  $("#btnP").click(function(){
    $(".modificarPerson").click();
    $(".collapse").collapse("toggle");
  });

  $("#personas").on("click", ".modificarPerson", function(){
    idpersona = $(this).attr("data-idpersona");

    $.ajax({
      url: 'controllers/person.controller.php',
      type: 'GET',
      data: 'op=getDataPerson&idpersona=' + idpersona,
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

        datosNuevos = false;
      }
    });

    $.ajax({
      url: 'controllers/user.controller.php',
      type: 'GET',
      data: 'op=getDataUser',
      success: function(result){
        var datos = JSON.parse(result);
        //console.log(datos[0])
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

    if(nombres == "" || apellidos == "" || fechanac == "" || telefono == "" || tipocalle == "" || nombrecalle == "" || numerocalle == "" || pisodepa == ""){
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
                listDataUser();
                $("#containerDatePerson").collapse("hide");
                //listDatosPerson();
                $("#nombres").val('');
                $("#apellidos").val('');
                $("#fechanaci").val('');
                $("#telefono").val('');
                $("#inTipoC").val('');
                $("#inNCalle").val('');
                $("#inNC").val('');
                $("#inPiso").val('');
                $("#horarioatencion").val('');
              }
            }
          });
        }
      });
    }
  }

  function RegistrarPersonas(){  
    let nombres = $("#nombres").val();
    let apellidos = $("#apellidos").val();
    let fechanac = $("#fechanaci").val();
    let telefono = $("#telefono").val();
    let tipocalle = $("#inTipoC").val();
    let nombrecalle = $("#inNCalle").val();
    let numerocalle = $("#inNC").val();
    let pisodepa = $("#inPiso").val();

    var formData = new FormData();

    formData.append("op", "updatePerson");
    formData.append("idpersona", idpersona);
    formData.append("apellidos", apellidos);
    formData.append("nombres", nombres);
    formData.append("fechanac", fechanac);
    formData.append("telefono", telefono);
    formData.append("tipocalle", tipocalle);
    formData.append("nombrecalle", nombrecalle);
    formData.append("numerocalle", numerocalle);
    formData.append("pisodepa", pisodepa);


    if(nombres == "" || apellidos == "" || fechanac == "" || telefono == "" || tipocalle == "" || nombrecalle == "" || numerocalle == "" || pisodepa == ""){
      Swal.fire({
          position: 'top',
          icon: 'warning',
          title: 'Falta completar algunas casillas',
          showConfirmButton: false,
          timer: 1000
      });
    }else{

      Swal.fire({
        title: '¿Estas seguro de actualizar los datos?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#808B96',
        confirmButtonText: 'Agregar'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: 'controllers/person.controller.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            success: function(e) {
              //listDatosPerson();
              $("#nombres").val('');
              $("#apellidos").val('');
              $("#fechanaci").val('');
              $("#telefono").val('');
              $("#inTipoC").val('');
              $("#inNCalle").val('');
              $("#inNC").val('');
              $("#inPiso").val('');
            }
          });
          Swal.fire(
              'Proceso Realizado',
              'Datos actualizados',
              'success'
          )
        }else{
          Swal.fire({
            position: 'center',
            icon: 'info',
            title: 'Operación Cancelada',
            showConfirmButton: false,
            timer: 2500
          });
        }
      })
    } 
  }

  //Registrar RedSocial
  function RegisterRedSocial(){

    var formData = new FormData();

    let redsocial = $("#nombrered").val();
    let vinculo = $("#vinculo").val();
 
    if(datosNuevos == true){
      formData.append("op", "registerRedSocial");
    }else{
      formData.append("op", "updateRedSocial");
      formData.append("idredsocial", idredSocial);
    }
    
    formData.append("redsocial", redsocial);
    formData.append("vinculo", vinculo);


    if(redsocial == "" || vinculo == ""){
      Swal.fire({
          position: 'top',
          icon: 'warning',
          title: 'Falta completar algunas casillas',
          showConfirmButton: false,
          timer: 1000
      });
    }else{
      sweetAlertConfirmQuestionSave("¿Estas seguro agregar la red social?").then(confirm => {
        if(confirm.isConfirmed){
          $.ajax({
            url: 'controllers/redsocial.controller.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            success: function(e) {
              console.log(e);
              $("#nombrered").val('');
              $("#vinculo").val('');
              listRedSocial();
              datosNuevos = true;
            }
          });
        }
      });
    } 
  }

  //Modificar RedSocial
  $("#redsocial").on("click", ".modificarRed", function(){
    idredSocial = $(this).attr("data-idredSocial");

    $.ajax({
      url: 'controllers/redsocial.controller.php',
      type: 'GET',
      data: 'op=getRedSocial&idredsocial=' + idredSocial,
      success: function(e) {
        var datos = JSON.parse(e);
        $("#nombrered").val(datos[0].redsocial);
        $("#vinculo").val(datos[0].vinculo);
        $("#collapseRed").collapse("toggle");

        datosNuevos = false;
      }
    });

  });



  function RegisterServices(){

    var formData = new FormData();
    let servicio = $("#nombreservicio").val();

    formData.append("op", "registerServicesUser");
    formData.append("nombreservicio", servicio);


    if(servicio == ""){
      Swal.fire({
          position: 'top',
          icon: 'warning',
          title: 'Falta completar algunas casillas',
          showConfirmButton: false,
          timer: 1000
      });
    }else{

      Swal.fire({
        title: '¿Estas seguro agregar el sevicio?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#808B96',
        confirmButtonText: 'Agregar'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: 'controllers/service.controller.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            success: function(e) {
              console.log(e);
              $("#nombreservicio").val('');
              listServices();
            }
          });
          Swal.fire(
              'Proceso Realizado',
              'Servicio registrado',
              'success'
          )
        }else{
          Swal.fire({
            position: 'center',
            icon: 'info',
            title: 'Operación Cancelada',
            showConfirmButton: false,
            timer: 2500
          });
        }
      })
    } 

  }


  $("#seguidos").on("click",".modificar", function(){

    let idfollowing = $(this).attr("data-idfollowing");

    sweetAlertConfirmQuestionDelete("¿Estas seguro dejar de seguir a la persona?")
    .then((confirm) => {
      if(confirm.isConfirmed){
        deleteFollower(idfollowing);
      }
    });
  
  });

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
        listFollower();
        listFollowing();
        countFollower();
        countFollowing();
      }
    });
  }

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
            listRedSocial();
            sweetAlertSuccess("Realizado", "La red a sido eliminada");
          }
        });
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
            sweetAlertSuccess("Realizado", "La especialidad ha sido eliminada");
            listEspeciality();
            loadPublicationWorks(); // Vista Publicaciones
          }
        });
      }
    }); 
  });

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

      $("#btnseguir").removeClass("btn-info").addClass("btn-success");
      $("#btnseguir").html("Seguido");
      
    } else {
      deleteFollower(idusuarioActivo);
      $("#btnseguir").removeClass("btn-success").addClass("btn-info");
      $("#btnseguir").html("Seguir");
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
          countFollower();
          countFollowing();
          listFollower();
          listFollowing();          
        } else {
          sweetAlertWarning(result, "Iniciar sesión o crearse una cuenta");
        }
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

  $("#btnEditPrivilegedData").click(function(){
    $.ajax({
      url: 'controllers/user.controller.php',
      type: 'GET',
      data: 'op=getDataUser',
      success: function(result){
        var datos = JSON.parse(result);
        //console.log(datos[0])
        $("#email").val(datos[0].email);
        $("#emailrespaldo").val(datos[0].emailrespaldo);
      }
    });
  });

  $("#btnUpdatePrivilegedData").click(function(){
    let email = $("#email").val();
    let emailrespaldo = $("#emailrespaldo").val();
    let clave1 = $("#clave1").val();
    let clave2 = $("#clave2").val();

    if(email == "" || clave1 == "" || clave2 == ""){
      sweetAlertWarning("Invalido", "Ingrese su Email y  Password");
    } else {
      if( clave1 !== clave2){
        sweetAlertWarning("Contraseña incorrecta", "Las contraseñas no coinciden");
      } else {
        sweetAlertConfirmQuestionSave("¿Estas seguro de actualizar sus credenciales?").then(confirm => {
          if(confirm.isConfirmed){
            var data = {
              op: 'updateUserCredentials',
              email: email,
              emailrespaldo: emailrespaldo,
              clave: clave1
            }
        
            $.ajax({
              url: 'controllers/user.controller.php',
              type: 'GET',
              data: data,
              success: function(result){
                sweetAlertInformation("Realizado", "Credenciales actualizados");
                $("#form-credentials")[0].reset();
                $("#contentainerCredentials").collapse("hide");
              }
            });
          }
        });
      }
    }
  });

  $("#agregarEsp").click(RegisterSpecialtyUser);
  $("#agregarred").click(RegisterRedSocial);
  $("#btnServices").click(RegisterServices);
  $("#actualizarPer").click(updateDataUser);

  listDepartments();
  validateFollower();
  listFollower();
  listFollowing();
  //listDatosPerson();
  listDataUser();
  listEstablishment();
  listInfo();
  descripcion();
  countFollower();
  countFollowing();
  listServicesUser();
  listServices();
  listRedSocial();
  listEspeciality();
  loadPicturePort();
  loadPicturePerfil();
  loadNameUser();
  scoreUser();