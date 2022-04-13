$(document).ready(function(){


  function per(){
    $.ajax({
      url:'controller/person.controller.php',
      type: 'GET',
      data: 'op=getPersona',
      success: function(e){
        // console.log(datos1);
        $("#per").html(e);
      }
    });
  }
  function conteoSeguidos(){
    $.ajax({
      url:'controller/follower.controller.php',
      type: 'GET',
      data: 'op=getCountFollowedByUser',
      success: function(e){
        let datos1 = JSON.parse(e);
        // console.log(datos1);
        $("#conteoseguid").html(datos1);
      }
    });
  }
  function conteoSeguidores(){
    $.ajax({
      url:'controller/follower.controller.php',
      type: 'GET',
      data: 'op=getCountFollowersByUser',
      success: function(e){
        let datos = JSON.parse(e);
        // console.log(datos);
        $("#conteosegui").html(datos);
      }
    });
  }

  function listarEstablecimiento(){
    $.ajax({
      url: 'controller/establishment.controller.php',
      type: 'GET',
      data: 'op=getAEstablishment',
      success: function(e){
        // console.log(e);
        $("#empresas").html(e);
      }
    });
  }
  function listDatosPerson(){
    $.ajax({
      url: 'controller/person.controller.php',
      type: 'GET',
      data: 'op=getPerson',
      success: function(e){
        // console.log(e);
        $("#personas").html(e);
      }
    });
  }

  function listarSeguidores(){
    $.ajax({
      url: 'controller/follower.controller.php',
      type: 'GET',
      data: 'op=getFollowersByUser',
      success: function(e){
        // console.log(e);
        $("#seguidores").html(e);
      }
    });
  }

  function listarSeguidos(){
    $.ajax({
      url: 'controller/follower.controller.php',
      type: 'GET',
      data: 'op=getFollowedByUser',
      success: function(e){
        // console.log(e);
        $("#seguidos").html(e);
      }
    });
  }



  //ABRIR IMAGEN PERFIL
  function abrirImagen(){
    $("input[name='archivoImagen']").trigger("click");
  }


  $("#btnborrar").click(function(){
    Swal.fire({
        icon: 'question',
        title: 'Q´ Tal Chamba',
        text: '¿Estas seguro de guardar los cambios?',
        showCancelButton: true,
        cancelButtonText: 'No, volver',
        confirmButtonText: 'Si, Guardar',
        confirmButtonColor: '#21B0AE',
        cancelButtonColor: '#B2B6B6'
      }).then((result) => {
        if (result.isConfirmed) {

          
            // $("#A").hide();
            $("#trabajo").attr("readonly",true);
            $("#trabajo").css("border","none");            //desabilitar borde
            $("#btncancelar").hide(); 
            $("#btnborrar").hide(); 
            $("#btneditar").show(); 
            $("#btneditar").css("margin-left","24.5em"); 
              

            // $("#A").hide(1000);
          

          Swal.fire(
            'Datos Guardados',
            'Guardado',
            'success'
          )
        }
    })
  });



  $("#btneditar").click(function(){
    $("#trabajo").attr("readonly",false);
    // $("#btncancelar").hide("");
    $("#trabajo").css("border","1px solid #000");  //habilitar borde
    $("#btncancelar").css("display","inline-flex");      //visible btncancelar
    $("#btncancelar").css("margin-left","17.5em");     
    $("#btneditar").css("margin-left","1em");   
    $("#btneditar").hide();  
    $("#btnborrar").css("display","inline-flex");
    // $("#btneditar").html("guardar")

  });


  $("#btncancelar").click(function(){

    Swal.fire({
      icon: 'question',
      title: 'Q´ Tal Chamba',
      text: '¿Estas seguro de cancelar el proceso?',
      showCancelButton: true,
      cancelButtonText: 'No, volver',
      confirmButtonText: 'Si, Cancelar',
      confirmButtonColor: '#21B0AE',
      cancelButtonColor: '#B2B6B6'
    }).then((result) => {
      if (result.isConfirmed) {

        $("#trabajo").val( placeholder="Trabajos de electricidad");
        $("#trabajo").attr("readonly",true);
        $("#trabajo").css("border","none");           //desabilitar borde
        $("#btncancelar").css("display","none");     //ocultar btn cancelar
        $("#btneditar").css("margin-left","25em");   
        $("#btneditar").show();   
        $("#btnborrar").hide(); 
        // $("#btneditar").html();

        Swal.fire(
          'Proceso cancelado',
          'Cancelado',
          'error'
        )
      }
    })
  
  });


  $("#dej").click(function(){
    
    Swal.fire({
      icon: 'question',
      title: 'Q´ Tal Chamba',
      text: '¿Estas seguro de dejar de seguir a esta persona?',
      showCancelButton: true,
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Dejar de seguir',
      confirmButtonColor: '#21B0AE',
      cancelButtonColor: '#B2B6B6'
    }).then((result) => {
      if (result.isConfirmed) {

        Swal.fire(
          'Dejaste de seguir a la persona',
          'Proceso ',
          'error'
        )
      }
    })

  });


  $("#fileSelector").click(abrirImagen);

  listarSeguidores();
  listarSeguidos();
  listDatosPerson();
  listarEstablecimiento();
  conteoSeguidores();
  conteoSeguidos();
  per();

});