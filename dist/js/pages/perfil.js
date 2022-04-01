$(document).ready(function(){

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


});