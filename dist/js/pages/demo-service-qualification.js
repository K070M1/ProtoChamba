
/**
 * COMENTARIOS
 */

// evento keydown de la caja de comentario
$("#text-input-1").keydown(function (event){
  if (event.keyCode == 13) { 
    event.preventDefault()
    var value = $("#text-input-1").html().trim();
    console.log(value);
  }

})

// evento click de la caja de comentario
$("#text-input-1").click(function (){
  if ($("#comentario1").hide()){
    $("#comentario1").show()
    //$("#btn-collapse1").addClass('active')
  }
})

// evento click del boton comentarios
$("#btn-collapse1").click(function (){
  $("#comentario1").toggle('slow')
})

// evento click del boton enviar comentario
$("#btn-send-1").click(function (){
  var value = $("#text-input-1").html().trim();
  console.log(value);
})

// Evento hover de la opción de reacciones
$(".reactions").hover(function (){
  removeClassActive()
})

function removeClassActive(){
  for (let i = 0; i < 5; i++){
    $('.reactions span i.fa-star').removeClass('active')
  }
}

/**
 * VIDEO PLAYER iNICIAR
 */
var reproductor = videojs('fm-video', {
  fluid: false,
  autoplay: false
})


/**
 * MODAL REPORTE
 */
var isDeleteImage = false;
$("#btn-subir-imagen").click(function (){
  toggleBetweenUploadAndDelete(isDeleteImage)
});

// se debe indicar la acción (true o false)
function toggleBetweenUploadAndDelete(isDelete = false){
  if(!isDelete)
    uploadImage()
  else
    deleteImage()
}

function uploadImage(){
  $("#input-img-portada").click()
}

// Mostrar imagen previa a registrar
$("#input-img-portada").change(function (e){
  var ext = this.value.match(/\.([^<\.]+)$/)[1];
  switch (ext){
      case 'jpg':
      case 'jpeg':
      case 'png':
      case 'bmp':
      case 'tif':
        // Cargando imagen previa
        loadPreviewImage(e, $("#preview-image"))
        // Mostrar boton elimanar
        toggleLayout(false)
        isDeleteImage = true;
        break;
      default:
      // Mostrar error
      alert("Error")
      this.value = ''
  }
});

function loadPreviewImage(event, idImage){
  // Creando el objeto de la clase FileReader
  var reader = new FileReader();

  // Leemos el archivo subido y se lo pasamos a nuestro filereader
  reader.readAsDataURL(event.target.files[0]);

  // Le decimos que cuando este listo ejecute el código interno
  reader.onload = function (){
    idImage.attr('src', reader.result);
  }
}

function toggleLayout(isDelete){
  if(!isDelete){
    // Mostrar icono de eliminar imagen
    $("#btn-subir-imagen").removeClass("btn-primary")
    $("#btn-subir-imagen").addClass("btn-delete-image")
    $("#btn-subir-imagen span").html("Eliminar imagen")
    $("#btn-subir-imagen i").removeClass()
    $("#btn-subir-imagen i").addClass("fa").addClass("fa-solid").addClass("fa-ban")

    // mostrar contenido de la imagen
    $(".container-image ").removeClass("d-none")
  }
  else{
    // Mostrar icono de subir imagen
    $("#btn-subir-imagen").removeClass("btn-delete-image")
    $("#btn-subir-imagen").addClass("btn-primary")
    $("#btn-subir-imagen span").html("Subir imagen")
    $("#btn-subir-imagen i").removeClass()
    $("#btn-subir-imagen i").addClass("fa").addClass("fas").addClass("fa-camera-retro")

    // Ocultar contenido de la imagen
    $(".container-image ").addClass("d-none")
  }
}

function deleteImage(){
  // Resetear formulario que contiene la img subida
  $("#formulario-image")[0].reset()

  // Mostrar boton de subir imagen 
  toggleLayout(true)
  isDeleteImage = false;
}






