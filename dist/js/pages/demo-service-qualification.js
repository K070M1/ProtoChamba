// VARIABLES GLOBALES
var isDeleteImage = false;
var isLoadImages = true;
var uploadedImages = [];  // Almacenar todos los archivos subidos

// Resetear formularios del modal
$(".btn-publication").click(clearFormPublication);

// Limpiar formulario de publicación
function clearFormPublication(){
  $("#form-publication")[0].reset();
  $("#form-upload-file")[0].reset();
  $("#input-new-image").val(null);
  $("#input-new-video").val(null);
  $("#container-video").hide();
  $("#titulo").focus();
  deleteAllImagespreview();
  deleteVideoPreview();
  changeInterfaceToImages(true);
}

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
  if(uploadedImages.length == 0){
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
// Cargado con ajax
$("#data-publication-works").on("click", ".btn-show-config", function(){
  $(this).next("ul.list-public-config").toggle();
});

/**
 * CALIFICACIÓN - TRABAJOS
 */

// Abir contenido de calificaciones
$("#data-publication-works").on("click", ".qualify", function(){
  $(this).children(".content-reactions-qualify").toggleClass("reactions-show");
});

// Aplicar la clase active al estar sobre el elemento - start
$("#data-publication-works").on("mouseover", ".reactions span", function(){
  // Activar los elementos anteriores
  $(this).prevAll().addClass("active");
  let numberPoint = $(this).attr("data-code");
  $(this).parent(".reactions").next(".number-points").html(numberPoint + " Punto");
});

// Quitar clase active al sacar el mouse del elemento
$("#data-publication-works").on("mouseleave", ".reactions span", function(){
  $(".reactions span").removeClass("active");
  $(this).parent(".reactions").next(".number-points").html("0 Punto");
});




/**
 * BLOQUEAR CONTENTEDITABLE
 */
// Bloquear el Maximo de caracteres
$("#data-publication-works").on("keypress", ".contenteditable", function(){
  var maxlength = $(this).attr('maxlength');
  
  if ($(this).html().length == maxlength) {
    return false;
  } else {
    return true;
  }
});


// Bloquear el pegar contenido dentro del contenteditable
$("#data-publication-works").on("paste", ".contenteditable", function(e){
  e.preventDefault();
  sweetAlertWarning("No pegar contenido", "Acción prohibida");
});

// Bloquear el copiar contenido dentro del contenteditable
$("#data-publication-works").on("copy", ".contenteditable", function(e){
  e.preventDefault();
  sweetAlertWarning("No copiar contenido", "Acción prohibida");
});


/**
 * COMENTARIOS
 */

// Evento keydown de la caja de comentario - evitar salto de linea
$("#data-publication-works").on("keydown", ".text-input-auto", function(e){
  if (e.keyCode == 13) {
    e.preventDefault();
  }
});


// Detectar ENTER en la caja de comentario
$("#data-publication-works").on("keydown", ".write-text-comment", function(e){
  if (e.keyCode == 13) {
    e.preventDefault()
    var valueComment = $(this).html().trim();
    console.log(valueComment);
  }
});

// Evento click en la caja de comentario para MOSTRAR LOS COMENTARIOS REALIZADOS
$("#data-publication-works").on("click", ".write-text-comment", function(){
  $(this).parent().parent(".write-comment").prev(".collapse").show("slow");
});

// Botón enviar comentario
$("#data-publication-works").on("click", ".btn-send", function(){
  var valueComment = $(this).prev(".text-auto-height").children(".write-text-comment").html().trim();
  console.log(valueComment);
});


/**
 * EDITAR COMENTARIOS
 */
// Convierte la etiqueta P en una sección editable 
$("#data-publication-works").on("click", ".edit-comment", function(){
  // Habilitar campo editable
  var isEditable = $(this).prev('p.comment-text').attr('contenteditable', true);
  
  // habilitar botones
  $(this).next('.cancel-edit-comment').removeClass('d-none');
  $(this).next('.cancel-edit-comment').next('.delete-comment').addClass('d-none');
  $(this).html('Actualizar');
});

// Cancela la edición del comentario
$("#data-publication-works").on("click", ".cancel-edit-comment", function(){
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
/* var reproductor = videojs('fm-video', {
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
}) */
// video player

/**
 * ALTERNAR ENTRE IAMGENES O VIDEO (Cargar y eliminar)
 */
// Llamar al evento change
$("#btn-add-file").click(function () {

  if(isLoadImages){
    uploadedImages = [];
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
  var files = this.files;     // Archivos cargados
  var element;                // Almacenar cada archivo
  var nameElement;            // Almacenar nombre de cada archivo   
  var supportedImages = ["image/jpeg", "image/jpg", "image/png", "image/gif"];
  var isValid = true;

  // validar que no exceda el maximo permitido
  if (files.length > max) {
    sweetAlertInformation("5 Imagenes como maximo", "Se excedio el maximo de archivo permitido");
  } else {

    // recorrer y mostrar los archivos subidos
    for (var i = 0; i < files.length && uploadedImages.length <= 4; i++) {
      element = files[i];   // Obtener cada imagen del array

      // Validar si son imagenes permitidos
      if (supportedImages.indexOf(element.type) == -1) {
        let index = element.type.indexOf('/');
        let ext = element.type.substr(index + 1);	
        sweetAlertWarning("Archivo " + ext.toUpperCase() + " no permitido", "Permitidos: jpeg, jpg, png, gif");

      } else {                    
        nameElement = files[i]['name'];                 // Obtener el nombre del archivo
        uploadedImages.push(files[i]);                  // Almacenar en el nuevo array
        createPreviewImages(element, nameElement);      // Crear previsualizacion de imagenes

        // Condición para permitir subir imagenes
        if(uploadedImages.length >= 5){
          $("#btn-add-file").prop('disabled', true);
        }
        else {
          $("#btn-delete-files").removeClass("d-none");
        }
      }
    }
  }
});

// Eliminar previsualizaciones de imagenes uno por uno
$(document).on("click", ".image-new figure figcaption i", function () {
  $(this).parent("figcaption").parent("figure").parent(".image-new").remove();
  let image = $(this).parent("figcaption").parent("figure").parent(".image-new").attr("data-img");

  // Encontrar coincidencia
  for(let i = 0; i < uploadedImages.length; i++){
    if(uploadedImages[i]['name'] == image){
      uploadedImages.splice(uploadedImages[i], 1); // Eliminar el elemnto encontrado
    }
  }

  if (uploadedImages.length == 0) {
    $("#btn-delete-files").addClass("d-none");
  }
  else if(uploadedImages.length > 0 && uploadedImages.length < 5) {
    $("#btn-add-file").prop('disabled', false); // Mostrar boton para subir imagen
  }
});

// Eliminar todas las imagenes
function deleteAllImagespreview(){
  $(".image-new").remove();
  uploadedImages = [];
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
  $(".progress .progress-bar").html('0 %');
  $(".progress .progress-bar").addClass("progress-bar-animated").addClass("progress-bar-striped");

  var fileVideo = this.files[0]; 
  
  // Validar archivo
  if(supportedVideo.indexOf(fileVideo.type) == -1){
    sweetAlertWarning("Archivo no permitido", "Permitido: mp4");
  }
  else{
    // Validar tamaño del archivo
    if (valueSize < sizeMegabyte) {
      alert("Supera el tamaño maximo permitido (" + valueSize + " MB)");
    } else {
      // es aceptable
      if (event.target.files && event.target.files[0]) {
        var reader = new FileReader();      // instancia Objeto reader
        var file = event.target.files[0];   // leer el video subido
  
        // Leer contenido
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
          $(".progress .progress-bar").html('Carga completa ' + percentLoad + ' %');
          $(".progress .progress-bar").removeClass("progress-bar-animated").removeClass("progress-bar-striped");
  
          $("#btn-add-file").prop('disabled', true);
          $("#btn-delete-files").removeClass("d-none");
        }
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
 * LISTAR ESPECIALIDADES EN EL MODAL DE PUBLICACIÓN
 */
function loadSpecialtySelect(){
  $.ajax({
    url: 'controllers/specialty.controller.php',
    type: 'GET',
    data: 'op=getSpecialtyByUser',
    success: function(result){

      if(result != ""){
        $("#especialidad").html(result);
      }
    }
  });
}


/**
 * LISTAR TRABAJOS REALIZADOS
 */
function loadPublicationWorks(){
  $.ajax({
    url: 'controllers/work.controller.php',
    type: 'GET',
    data: 'op=getWorksByUser',
    success: function(result){
      console.log(result);
      $("#data-publication-works").html(result);
    }
  });
}


/**
 * REALIZAR PUBLICACIÓN
 */
$("#btn-add-publication").click(function(){

  // Validar datos
  if(dataFormPublicationIsEmpty()){
    sweetAlertWarning("Datos incorrectos", "Por avor complete los campos");
  }
  else{

    // Confirmar
    sweetAlertConfirmQuestionSave("¿Estas seguro de hacer la publicación?").then((confirm) => {
      if(confirm.isConfirmed){
        console.log(uploadedImages)

        var formData = new FormData();
        formData.append("op", "registerWork");
        formData.append("idespecialidad", $("#especialidad").val());
        formData.append("titulo", $("#titulo").val());
        formData.append("descripcion", $("#descripcion").val());
      
        // Comprobar si son imagenes o video
        if(isLoadImages){
          // Imagenes
          for(let i = 0; i < uploadedImages.length; i++){
            formData.append("images[]", uploadedImages[i]);
          }
        }
        else{
          formData.append("video", $("#input-new-video")[0].files[0]);
        }
      
        $.ajax({
          url: 'controllers/work.controller.php',
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          cache: false,
          success: function(result){
            console.log(result);
            clearFormPublication();
            $("#modal-publication").modal('hide');
            loadPublicationWorks();
          }
      
        }); // Fin ajax
      }
    }); // Fin Sweet alert
  }
});

// Validar campo obligatorios
function dataFormPublicationIsEmpty(){
  return $("#especialidad").val() == "" || $("#titulo").val() == "" || $("#descripcion").val() == "";
}


/**
 * MODAL REPORTE
 */
// Abrir modal
$("#data-publication-works").on("click", ".report-comment", function(){
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

// Cargar imagen
function uploadImage() {
  $("#input-img-portada").click();
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

// EJECUTANDO LA FUNCIÓN LISTAR
loadSpecialtySelect();
loadPublicationWorks(); // cargar trabajos