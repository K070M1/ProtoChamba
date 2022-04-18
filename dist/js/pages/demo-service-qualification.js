// VARIABLES GLOBALES
var isDeleteImage = false;
var isLoadImages = true;
var countImages = 0;

// Resetear formularios del modal
$(".btn-publication").click(function(){
  $("#form-publication")[0].reset();
  $("#input-new-image").val(null);
  $("#input-new-video").val(null);
  $("#titulo").focus();
  deleteAllImagespreview();
  deleteVideoPreview();
  $("#container-video").hide();
  changeInterfaceToImages(true);
});

/**
 * ALTERNAR ENTRE LA INTERFAZ DE CARGA DE IMAGENES O VIDEO
 */
// MOSTRAR CONTENIDO DE CARGAR IMAGENES
$("#btn-image").click(function () {
  if($("#input-new-video").val() == ''){
    changeInterfaceToImages(true);
  }
  else{
    sweetAlertConfirmQuestionSave("¿Si cambias de opcion se borrara el video?").then((confirm) => {
      if(confirm.isConfirmed){
        deleteVideoPreview();
        changeInterfaceToImages(true);
      }
    });
  }
});

// MOSTRAR CONTENIDO DE CARGAR VIDEO
$("#btn-video").click(function () {
  // validar si existen datos subidos
  if(countImages == 0){
    changeInterfaceToImages(false);
  }
  else{
    sweetAlertConfirmQuestionSave("¿Si cambias de opcion se borraran las imagenes?").then((confirm) => {
      if(confirm.isConfirmed){
        deleteAllImagespreview();
        changeInterfaceToImages(false);
      }
    });
  }
});

// Cambiar de interfaz de carga de archivos (imagenes o video)
function changeInterfaceToImages(isImages){
  if(isImages){
    if ($("#container-video").is(':visible')) $("#container-video").hide();
    $("#container-images").show('slow');
    $("#title-options").html("Imagenes");
    $("#btn-add-file span").html("Cargar imagenes");
    isLoadImages = true;
  }
  else{
    if ($("#container-images").is(':visible')) $("#container-images").hide();
    $("#container-video").show('slow');
    $("#title-options").html("Video");
    $("#btn-add-file span").html("Cargar video");
    isLoadImages = false;
  }
}

/**
 * MENU DE OPCIONES POR CADA PUBLICACIÓN
 */
// Mostrar el menu
$(".btn-show-config").click(function () {
  $(this).next("ul.list-public-config").toggle();
});

/**
 * CALIFICACIÓN - TRABAJOS
 */

// Abir contenido de calificaciones
$(".qualify").click(function () {
  $(this).children(".content-reactions-qualify").toggleClass("reactions-show");
});

// Aplicar la clase active al estar sobre el elemento - start
$(".reactions span").mouseover(function () {
  // Activar los elementos anteriores
  $(this).prevAll().addClass("active");
  let numberPoint = $(this).attr("data-code");
  $(this).parent(".reactions").next(".number-points").html(numberPoint + " Punto");
});

// Quitar clase active al sacar el mouse del elemento
$(".reactions span").mouseleave(function () {
  $(".reactions span").removeClass("active");
  $(this).parent(".reactions").next(".number-points").html("0 Punto");
});

/**
 * BLOQUEAR CONTENTEDITABLE
 */
// Bloquear el Maximo de caracteres
$(".contenteditable").keypress(function (event) {
  var maxlength = $(this).attr('maxlength');

  if ($(this).html().length == maxlength) {
    return false;
  } else {
    return true;
  }
});

// Bloquear el pegar contenido dentro del contenteditable
$(".contenteditable").on('paste', function (e) {
  e.preventDefault();
});

// Bloquear el copiar contenido dentro del contenteditable
$(".contenteditable").on('copy', function (e) {
  e.preventDefault();
  alert('Esta acción está prohibida');
});


/**
 * COMENTARIOS
 */

// Evento keydown de la caja de comentario
$(".text-input-auto").keydown(function (event) {
  if (event.keyCode == 13) {
    event.preventDefault();
  }
});

// Detectar ENTER en la caja de comentario
$(".write-text-comment").keydown(function (event) {
  if (event.keyCode == 13) {
    event.preventDefault()
    var valueComment = $(this).html().trim();
    console.log(valueComment);
  }
})

// Evento click en la caja de comentario para MOSTRAR LOS COMENTARIOS REALIZADOS
$(".write-text-comment").click(function () {
  $(this).parent().parent(".write-comment").prev(".collapse").show("slow");
})

// Botón enviar comentario
$(".btn-send").click(function () {
  var valueComment = $(this).prev(".text-auto-height").children(".write-text-comment").html().trim();
  console.log(valueComment);
})

/**
 * EDITAR COMENTARIOS
 */
// Convierte la etiqueta P en una sección editable 
$('.edit-comment').click(function () {
  // Habilitar campo editable
  var isEditable = $(this).prev('p.comment-text').attr('contenteditable', true);

  // habilitar botones
  $(this).next('.cancel-edit-comment').removeClass('d-none');
  $(this).next('.cancel-edit-comment').next('.delete-comment').addClass('d-none');
  $(this).html('Actualizar');
});

// Cancela la edición del comentario
$('.cancel-edit-comment').click(function () {
  // Desabilitar campo editable
  $(this).prevAll('p.comment-text').attr('contenteditable', false);

  // habilitar botones
  $(this).next('.delete-comment').removeClass('d-none');
  $(this).addClass('d-none');
  $(this).prev('.edit-comment').html('Editar');
});


/**
 * VIDEO PLAYER iNICIAR 
 */
var reproductor = videojs('fm-video', {
  fluid: false,
  autoplay: false,
  muted: false,
  aspectRatio: '16:9',
  responsive: true,
  playbackRates: [0.5, 1, 1.5, 2],
  fullscreen: { options: { navigationUI: 'hide' } },
  userActions: {
    click: true
  }
})
// video player

/**
 * ALTERNAR ENTRE IAMGENES O VIDEO (Cargar y eliminar)
 */
// Llamar al evento change
$("#btn-add-file").click(function () {

  if(isLoadImages){
    countImages = 0;
    $("#input-new-image").click();
  }
  else{
    $("#input-new-video").click();
  }
});

// Eliminar imagenes o video (todos)
$("#btn-delete-files").click(function(){
  if(isLoadImages){
    sweetAlertConfirmQuestionDelete("¿Estas seguro de borrar todas las imagenes?").then(confirm => {
      if(confirm.isConfirmed){
        deleteAllImagespreview();      
      }
    });
  }
  else{
    sweetAlertConfirmQuestionDelete("¿Estas seguro de borrar el video?").then(confirm => {
      if(confirm.isConfirmed){    
        deleteVideoPreview();
      }
    });
  }

});

/**
 * CARGAR IMAGENES EN EL MODAL PUBLICACIÓN
 */
// Ejecutar el evento change de images
$("#input-new-image").change(function (e) {
  var max = $(this).attr('max');
  var files = this.files;
  var element;
  var supportedImages = ["image/jpeg", "image/jpg", "image/png", "image/gif"];
  var isValid = true;

  if (files.length > max) {
    sweetAlertInformation("5 Imagenes como maximo", "Se excedio el maximo de archivo permitido");
  } else {
    // recorrer y mostrar los archivos subidos
    for (var i = 0; i < files.length && countImages <= 4; i++) {
      element = files[i]; // Obtener cada iamgen subida

      if (supportedImages.indexOf(element.type) == -1) {
        isValid = false;
      } else {
        createPreviewImages(element); // Crear imagenes previas
        countImages = $(".image-new").toArray().length; // actualizar valor del contador

        if(countImages >= 5){
          $("#btn-add-file").prop('disabled', true);
        }
        else if(countImages <= 5 && countImages > 0) {
          $("#btn-delete-files").removeClass("d-none");
        }
      }
    }
  }

  if (!isValid) {
    sweetAlertWarning("1 Archivo no permitido", "Permitidos: jpeg, jpg, png, gif");
  }
});

// Eliminar previsualizaciones de imagenes uno por uno
$(document).on("click", ".image-new figure figcaption i", function (e) {
  $(this).parent("figcaption").parent("figure").parent(".image-new").remove();
  countImages--;

  if (countImages <= 0) {
    $("#btn-delete-files").addClass("d-none");
  }
  else if(countImages > 0 && countImages < 5) {
    $("#btn-add-file").prop('disabled', false); // Mostrar boton para subir imagen
  }
});

// Eliminar todas las imagenes
function deleteAllImagespreview(){
  $(".image-new").remove();
  countImages = 0;
  changeInterfaceToDelete(true);
}

// cambiar los elementos a mostrar
function changeInterfaceToDelete(isDelete){
  if(isDelete){
    $("#btn-delete-files").addClass("d-none");
    $("#btn-add-file").prop('disabled', false);    
  }
  else{
    $("#btn-delete-files").removeClass("d-none");
    $("#btn-add-file").prop('disabled', true);    
  }
}

/**
 * CARGAR VIDEO EN EL MODAL PUBLICACIONES
 */
// Evento change para subir video
$("#input-new-video").change(function (event) {
  let videoSrc = document.querySelector("#video-source");
  var supportedVideo = ["video/mp4"];

  // Obtener el tamaño del archivo subido
  var sizeByte = event.target.files[0].size;
  var sizeKilobyte = parseInt(sizeByte / 1024);
  var sizeMegabyte = parseInt(sizeKilobyte / 1024);

  // Valor del atributo size
  var valueSize = $(this).attr("size");

  // Iniciar en 0 el progressbar
  var percentLoad = 0;
  $("#label-video-size").html('0 MB');
  $("#label-video-maxsize").html("  (" + valueSize + " MB)");
  $(".progress .progress-bar").html('0 %');
  $(".progress .progress-bar").addClass("progress-bar-animated").addClass("progress-bar-striped");

  var fileVideo = this.files[0]; 
  
  // Validar archivo
  if(supportedVideo.indexOf(fileVideo.type) == -1){
    sweetAlertWarning("Archivo no permitido", "Permitido: mp4");
  }
  else{

  }

  // Validar tamaño del archivo
  if (valueSize < sizeMegabyte) {
    alert("Supera el tamaño maximo permitido (" + valueSize + " MB)");
  } else {
    // es aceptable
    if (event.target.files && event.target.files[0]) {
      var reader = new FileReader(); // instancia Objeto reader
      var file = event.target.files[0]; // leer el video subido

      reader.onload = function (e) {
        videoSrc.src = e.target.result
        videoSrc.parentElement.load()
      }.bind(this)

      // Leer el contenido de file
      reader.readAsDataURL(file);

      // progreso de carga
      reader.onprogress = function (e) {
        percentLoad = Number.parseInt(e.loaded * 100 / e.total); // calculando porcentaje
        $(".progress .progress-bar").html('Cargando...' + percentLoad + ' %');
        $(".progress .progress-bar").css('width', percentLoad + '%');
      }

      // carga completa
      reader.onloadend = function (e) {
        $("#label-video-size").html(sizeMegabyte + ' MB');
        $("#label-video-maxsize").html("  (" + valueSize + " MB)");
        $(".progress .progress-bar").html('Carga completa ' + percentLoad + ' %');
        $(".progress .progress-bar").removeClass("progress-bar-animated").removeClass("progress-bar-striped");

        $("#btn-add-file").prop('disabled', true);
        $("#btn-delete-files").removeClass("d-none");
      }
    }
  }
});

// Eliminar video
function deleteVideoPreview(){
  let videoSrc = document.querySelector("#video-source");
  videoSrc.src = '';
  videoSrc.parentElement.load();
  $("#input-new-video").val('');
  changeInterfaceToDelete(true);
}

/**
 * MODAL REPORTE
 */
// Abrir modal
$(".report-comment").click(function () {
  $("#modal-report").modal("show");
});

// Cargar imagen en el formulario reporte
$("#btn-subir-imagen").click(function () {
  toggleBetweenUploadAndDelete(isDeleteImage)
});

// POR MEJORAR...
// Cambia a cargar o eliminar
function toggleBetweenUploadAndDelete(isDelete = false) {
  if (!isDelete)
    uploadImage()
  else
    deleteImage()
}

// Cargar iamgen
function uploadImage() {
  $("#input-img-portada").click();
}

// Mostrar imagen previa a registrar
$("#input-img-portada").change(function (e) {
  var ext = this.value.match(/\.([^<\.]+)$/)[1];
  switch (ext) {
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

// Función cargar iamgen previa
function loadPreviewImage(event, idImage) {
  // Creando el objeto de la clase FileReader
  var reader = new FileReader();

  // Leemos el archivo subido y se lo pasamos a nuestro filereader
  reader.readAsDataURL(event.target.files[0]);

  // Le decimos que cuando este listo ejecute el código interno
  reader.onload = function () {
    idImage.attr('src', reader.result);
  }
}

// Cambiar de interfaz (Eliminar o no eliminar)
function toggleLayout(isDelete) {
  if (!isDelete) {
    // Mostrar icono de eliminar imagen
    $("#btn-subir-imagen").removeClass("btn-primary")
    $("#btn-subir-imagen").addClass("btn-delete-image")
    $("#btn-subir-imagen span").html("Eliminar imagen")
    $("#btn-subir-imagen i").removeClass()
    $("#btn-subir-imagen i").addClass("fa").addClass("fa-solid").addClass("fa-ban")

    // mostrar contenido de la imagen
    $(".container-image ").removeClass("d-none")
  } else {
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

// Función eliminar
function deleteImage() {
  // Resetear formulario que contiene la img subida
  $("#formulario-image")[0].reset()

  // Mostrar boton de subir imagen 
  toggleLayout(true)
  isDeleteImage = false;
}

// POR MEJORAR... END