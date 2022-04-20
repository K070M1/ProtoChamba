
   var datosNuevos = true; 
   var idusuario;
   var idpersona;
   var idredSocial;
   var idespecialidad;

  function createPerfil(file) {
    var imgCodified = URL.createObjectURL(file);
    var img = $("<img src='"+imgCodified+"' alt=''><a href='#' class='cambiar-foto' id='idfoto'><i class='fas fa-camera'></i> <span>Cambiar foto</span></a>");
    $("#preview").html(img);
  }
      
  $("#fileFotografia").on("change", function(){
    console.log(this.files);
    console.log("Se cargo una vez");
    var files = this.files;
    var element = files[0];

    createPerfil(element);
  });

  function createPortada(file) {
    var imgCodified = URL.createObjectURL(file);
    var img = $("<img src='"+imgCodified+"' alt=''><a href='#' class='cambiar-Portada'><button type='' id='btn-Por'><i class='fas fa-camera'></i></button></a>");
    $("#visual").html(img);
  }

  $("#fileImagen").on("change", function(){
    console.log(this.files);
    console.log("Se cargo una vez");
    var files = this.files;
    var element = files[0];

    createPortada(element);
  });


  $(".profile-der").on("click",".edit-come", function(){

    $("#text-descripcion").attr('contenteditable', true);
    $(this).next('.edit-come-cancel').removeClass('d-none');
    $(".edit-come").hide();
  });

  $(".profile-der").on("click",".edit-come-cancel", function(){
    $("#text-descripcion").attr('contenteditable', false);
    // $(this).addClass('d-none');
    $(".edit-come").hide();
  });
  
  $(".edit-come").click(function(){
    let text = $("#text-descripcion").text();
    // let text =  $('div').attr('data-value');;
    console.log(text);
  });

  //DESCRIPCION
  $(".edit-come-cancel").click(function (){

    let descripcion;

    var formData = new FormData();
    descripcion = $("#text-descripcion").text();

    formData.append("op", "updateDescrip");
    formData.append("descripcion", descripcion);

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
            console.log(e);
            Descripcion();
            $("#text-descripcion").attr('contenteditable', false);
            $(this).addClass('d-none');
            $(".edit-come").show();
            $(".edit-come-cancel").hide();
            sweetAlertSuccess("Realizado", "Descripcion guardada");
          }
        });
      }else{
        $("#text-descripcion").attr('contenteditable', true);
        $(this).next('.edit-come-cancel').removeClass('d-none');
        $(".edit-come").hide();
        $(".edit-come-cancel").show();
      }
    }); 
  });


  $(".edit-come").click(function(){
    let text = $("#text-descripcion").text();
    // let text =  $('div').attr('data-value');;
    console.log(text);
  });



  // HABILITA SER EDITABLE
  $("#personas").on("click",".edit-nombre", function(){

    $("#no").attr('contenteditable', true);
    $(this).next('.cancel-nombre').removeClass('d-none');
  });

  $("#personas").on("click",".edit-te", function(){
    $("#te").attr('contenteditable', true);
    $(this).next('.cancel-te').removeClass('d-none');
  });

  $("#personas").on("click",".edit-fe", function(){
    $("#fe").attr('contenteditable', true);
    $(this).next('.cancel-fe').removeClass('d-none');
  });

  $("#personas").on("click",".edit-ti", function(){
    $("#ti").attr('contenteditable', true);
    $(this).next('.cancel-ti').removeClass('d-none');
  });

  // DESABILITA SER EDITABLE
  $("#personas").on("click",".cancel-nombre", function(){
    $("#no").attr('contenteditable', false);
    $(this).addClass('d-none');
  });
  $("#personas").on("click",".cancel-te", function(){
    $("#te").attr('contenteditable', false);
    $(this).addClass('d-none');
  });
  $("#personas").on("click",".cancel-fe", function(){
    $("#fe").attr('contenteditable', false);
    $(this).addClass('d-none');
  });
  $("#personas").on("click",".cancel-ti", function(){
    $("#ti").attr('contenteditable', false);
    $(this).addClass('d-none');
  });


  
  function Descripcion(){
    $.ajax({
      url: 'controllers/user.controller.php',
      type: 'GET',
      data: 'op=getUsersDescrip',
      success: function(e){
        $("#text-descripcion").html(e);
      }
    });
  }

  function listEspeciality(){
    $.ajax({
      url: 'controllers/specialty.controller.php',
      type: 'GET',
      data: 'op=listSpecialtyUser',
      success: function(e){
        $("#especiality").html(e);
      }
    });
  }

  function listRedSocial(){
    $.ajax({
      url: 'controllers/redsocial.controller.php',
      type: 'GET',
      data: 'op=getRedesSociales',
      success: function(e){
        $("#redsocial").html(e);
      }
    });
  }

  function listEstablishment(){
    $.ajax({
      url: 'controllers/establishment.controller.php',
      type: 'GET',
      data: 'op=getEstablishmentsByUser',
      success: function(e){
        $("#empresas").html(e);
      }
    });
  }

  function listInfo(){
    $.ajax({
      url: 'controllers/establishment.controller.php',
      type: 'GET',
      data: 'op=getEstablishmentsInfo',
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
      data: 'op=getServicesUser',
      success: function(e){
        $("#serviciosUsuario").html(e);
      }
    });
  }

  function listPerson(){
    $.ajax({
      url:'controllers/person.controller.php',
      type: 'GET',
      data: 'op=getPersona',
      success: function(e){
        $("#per").html(e);
      }
    });
  }

  function listDatosPerson(){
    $.ajax({
      url: 'controllers/person.controller.php',
      type: 'GET',
      data: 'op=getPerson',
      success: function(e){
        $("#personas").html(e);
      }
    });
  }

  function listFollower(){
    $.ajax({
      url: 'controllers/follower.controller.php',
      type: 'GET',
      data: 'op=getFollowersByUser',
      success: function(e){
        $("#seguidores").html(e);
      }
    });
  }

  function listFollowing(){
    $.ajax({
      url: 'controllers/follower.controller.php',
      type: 'GET',
      data: 'op=getFollowedByUser',
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

      Swal.fire({
        title: '¿Estas seguro agregar la especialidad?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#808B96',
        confirmButtonText: 'Agregar'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: 'controllers/specialty.controller.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            success: function(e) {
              console.log(e);
              $("#idservices").val('');
              $("#descripcionEsp").val('');
              $("#tarifa").val('');
              listEspeciality();
              datosNuevos = true;
            }
          });
          Swal.fire(
              'Proceso Realizado',
              'Especialidad registrada',
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


  $("#especiality").on("click", ".modificarEsp", function(){
    idespecialidad = $(this).attr("data-idespecialidad");

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
        console.log(datos);

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

  });


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
              listDatosPerson();
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

      Swal.fire({
        title: '¿Estas seguro agregar la red social?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#808B96',
        confirmButtonText: 'Agregar'
      }).then((result) => {
        if (result.isConfirmed) {

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
          Swal.fire(
              'Proceso Realizado',
              'Red social registrado',
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
        // $(".collapse").collapse("toggle");

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

    let idfollowing;

    var formData = new FormData();
    idfollowing = $(this).attr("data-idfollowing");
    
    formData.append("op", "deleteFoller");
    formData.append("idfollower", "idusuario");
    formData.append("idfollowing", idfollowing);

    Swal.fire({
        title: '¿Estas seguro dejar de seguir a la persona?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#808B96',
        confirmButtonText: 'Dejar de Seguir'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: 'controllers/follower.controller.php',
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          cache: false,
          success: function(e) {
            console.log(e);
            listFollowing();
            countFollowing();
          }
        });
        Swal.fire(
            'Proceso Realizado',
            'Dejaste de seguir a la persona',
            'error'
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

  });


  function countFollower(){
    $.ajax({
      url:'controllers/follower.controller.php',
      type: 'GET',
      data: 'op=getCountFollowersByUser',
      success: function(e){
        let datos = JSON.parse(e);
        $("#conteosegui").html(datos);
      }
    });
  }

  function countFollowing(){
    $.ajax({
      url:'controllers/follower.controller.php',
      type: 'GET',
      data: 'op=getCountFollowedByUser',
      success: function(e){
        let datos1 = JSON.parse(e);
        $("#conteoseguid").html(datos1);
      }
    });
  }




  //ABRIR IMAGEN PERFIL
  function abrirImagen(){
    $("input[name='archivoImagen']").trigger("click");
  }

  $("#preview").on("click", "#idfoto", function (){
    $("input[name='archivoImagen']").trigger("click");
  }); 

  //ABRIR IMAGEN PORTADA
  function abrirFoto(){
    $("input[name='archivoFoto']").trigger("click");
  }

  $("#visual").on("click", "#btnPort", function (){
    $("input[name='archivoFoto']").trigger("click");
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
          success: function (){
            listEspeciality();
            sweetAlertSuccess("Realizado", "La especialidad ha sido eliminada");
          }
        });
      }
    }); 
  });


  $("#idfoto").click(abrirImagen);
  $("#idfotoPrt").click(abrirFoto);

  $("#agregarEsp").click(RegisterSpecialtyUser);
  $("#agregarred").click(RegisterRedSocial);
  $("#btnServices").click(RegisterServices);
  $("#actualizarPer").click(RegistrarPersonas);

  listFollower();
  listFollowing();
  listDatosPerson();
  listEstablishment();
  listInfo();
  Descripcion();
  countFollower();
  countFollowing();
  listPerson();
  listServicesUser();
  listServices();
  listRedSocial();
  listEspeciality();

