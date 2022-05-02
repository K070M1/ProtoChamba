// VARIABLES GLOBALES
var idusuarioActivo = localStorage.getItem("idusuarioActivo");
idusuarioActivo = idusuarioActivo != null? idusuarioActivo: -1;

var isDeleteImage = false;
var isLoadImages = true;
var isNewPublication = true;
var idtrabajo = -1;
var uploadedImages = [];  // Almacenar todos los archivos subidos (Temporales)
var deletedImages = [];  // Almacenar los archivosELIMINADOS  QUE SE ENVIARAN AL SERVIDOR

// validar usuario activo
if(idusuarioActivo != -1){
  disabledButtons();
} else {
  enabledButtons();
}

// Esta función desdabilita los botones de modificación o agregación
function disabledButtons(){
  $("#container-add-publication").hide();  
}

// Esta función habilita los botones de modificación o agregación
function enabledButtons(){
  $("#container-add-publication").show();
}


// Resetear formularios del modal
$(".btn-publication").click(openFormPublicationAdd);

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

// Abrir formulario para editar publicación
function openFormPublicationEdit(){
  clearFormPublication();
  $("#title-modal-publication").html();                 // Titulo del modal
  $("#btn-add-publication").addClass("d-none");         // Ocultar botón agregar
  $("#btn-modify-publication").removeClass("d-none");   // Mostrar botón modificar
}

// Abrir formulario para registrar
function openFormPublicationAdd(){
  clearFormPublication();
  $("#title-modal-publication").html();                 // Titulo del modal
  $("#btn-modify-publication").addClass("d-none");      // Ocultar botón modificar
  $("#btn-add-publication").removeClass("d-none");      // Mostrar botón agregar
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
// Mostrar el menu  de opciones
$("#data-publication-works").on("click", ".btn-show-config", function(){
  $(this).next("ul.list-public-config").toggle();
});

// Editar publicación (traer datos del servidor y mostrarlo en panatalla)
$("#data-publication-works").on("click", ".btn-edit-publication", function(){
  
  $(this).parent("li.item-public-config").parent("ul.list-public-config").toggle(); // Cerrar opciones
  openFormPublicationEdit();

  idtrabajo = $(this).attr("data-code");

  $.ajax({
    url: 'controllers/work.controller.php',
    type: 'GET',
    data: 'op=getAtWork&idtrabajo=' + idtrabajo,
    success: function(result){
      if(result != ""){
        let dataController = JSON.parse(result);

        $("#especialidad").val(dataController.idespecialidad);
        $("#titulo").val(dataController.titulo);
        $("#descripcion").val(dataController.descripcion);

        getImagesPublication(dataController.idtrabajo); // Listar imagenes
        
        $("#modal-publication").modal('show');
      }
    }
  });
});


// Obtener imagenes por cada publicación
function getImagesPublication(idtrabajo){

  $.ajax({ 
    url: 'controllers/gallery.controller.php',
    type: 'GET',
    data: 'op=getGalleriesByWork&idtrabajo=' + idtrabajo,
    success: function(result){

      if(result !== ""){
        let dataController = JSON.parse(result);
  
        dataController.forEach(value => {
          if(value.tipo == 'F'){
            createPreviewImagesController($("#container-images"), value.archivo, value.idgaleria);
          }
          else{
            $("#video-tag").addClass("video-js fm-video");
            $("#video-source").attr("src", "dist/video/" + value.archivo);
          }
  
        });
  
        // Mostrar boton de eliminación
        $("#btn-delete-files").removeClass("d-none");   
  
        // Desactivar boton para subir imagenes
        if(dataController.length == 5){
          $("#btn-add-file").prop('disabled', true); 
        }
      } // Fin del if
    }
  });
}

// Actualizar publicación
$("#btn-modify-publication").click(function(){

  // Validar datos
  if(dataFormPublicationIsEmpty()){
    sweetAlertWarning("Datos incorrectos", "Por avor complete los campos");
  }
  else{

    // Confirmar
    sweetAlertConfirmQuestionSave("¿Estas seguro de actualizar la publicación?").then((confirm) => {
      if(confirm.isConfirmed){

        var formData = new FormData();
        formData.append("op", "updateWork");
        formData.append("idtrabajo",  idtrabajo);
        formData.append("idespecialidad", $("#especialidad").val());
        formData.append("titulo", $("#titulo").val());
        formData.append("descripcion", $("#descripcion").val());
        //formData.append("eliminados", deletedImages);
      
        // Comprobar si son imagenes o video
        /* if(isLoadImages){
          // Imagenes
          for(let i = 0; i < uploadedImages.length; i++){
            formData.append("images[]", uploadedImages[i]);
          }
        }
        else{
          formData.append("video", $("#input-new-video")[0].files[0]);
        } */
      
        $.ajax({
          url: 'controllers/work.controller.php',
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          cache: false,
          success: function(result){
            
            if(result == ""){
              idtrabajo = -1;
              clearFormPublication();
              $("#modal-publication").modal('hide');
              loadPublicationWorks();
            }
          }
      
        }); // Fin ajax
      }
    }); // Fin Sweet alert
  }
});

// Eliminar publicación
$("#data-publication-works").on("click", ".btn-delete-publication", function(){
  let idtrabajo = $(this).attr("data-code");

  sweetAlertConfirmQuestionDelete("¿Estas seguro de eliminar esta publicación?").then(confirm => {
    if(confirm.isConfirmed){
      deletePublication(idtrabajo);
    }
  });

  // Cerrar menu de opciones
  $(this).parent("li.item-public-config").parent("ul.list-public-config").toggle(); 
});

function deletePublication(idtrabajo){
  $.ajax({
    url: 'controllers/work.controller.php',
    type: 'GET',
    data: 'op=deleteWork&idtrabajo=' + idtrabajo,
    success: function(result){
      if(result == ""){
        loadPublicationWorks(); // actualiza los datos
      }
    }
  });
}

/**
 * CALIFICACIÓN - TRABAJOS
 */

// Abrir contenido de calificaciones
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

// Obtener la puntuación
$("#data-publication-works").on("click", ".reactions span", function(){
  let idtrabajo = $(this).parent(".reactions").attr("data-code-work");
  let idreaccion =$(this).parent(".reactions").attr("data-code-reaction"); // id
  let reaccion = $(this).parent(".reactions").attr("data-reaction");        // Puntaje anterior
  let puntuacion = $(this).attr("data-code");

  let dataSend = {
    op          : 'registerQualify',
    idtrabajo   : idtrabajo,
    puntuacion  : puntuacion
  };

  if(idreaccion > 0){
    dataSend['op'] = 'updateQualify';
    dataSend['idcalificacion'] = idreaccion;
  }

  qualifyService(dataSend);
});

// Asignar o quitar reacción
function qualifyService(dataSend){
  $.ajax({
    url: 'controllers/qualify.controller.php',
    data: dataSend,
    success: function(result){
      if(result != ""){
        sweetAlertWarning(result, 'Debe iniciar sesión o registrarse');
      } else {
        loadPublicationWorks();
      }
    }
  });
}

/**
 * BLOQUEAR CONTENTEDITABLE
 */
// Bloquear el Maximo de caracteres
$("#data-publication-works").on("keypress", ".contenteditable", function(e){
  return disableLineBreaksInContEditable($(this), e); 
});

// Inabilitar saltos de linea (CONTENTEDITABLE) y permitir el maximo de caracteres indicado en su atributo (MAXLENGTH)
function disableLineBreaksInContEditable(element, event){
  let maxlength = element.attr('maxlength');
 
  // Bloquear salto de linea
  if(event.keyCode == 13){
    event.preventDefault();
  }

  // Maximo de caracteres pemitido
  if (element.html().length == maxlength || element.val().length == maxlength) {
    return false;
  } else {
    return true;
  }
}

// Bloquear el pegar contenido dentro del contenteditable
$("#data-publication-works").on("paste", ".contenteditable", function(e){
  e.preventDefault();
  var text = (e.originalEvent || e).clipboardData.getData('text/plain');
  document.execCommand("insertHTML", false, text);
});

// Bloquear el copiar contenido dentro del contenteditable
$("#data-publication-works").on("copy", ".contenteditable", function(e){
  e.preventDefault();
  sweetAlertWarning("No copiar contenido", "Acción prohibida");
});


/**
 * COMENTARIOS
 */

// MOSTRAR LOS COMENTARIOS REALIZADOS
$("#data-publication-works").on("click", ".open-comments", function(){
  let containerComments = $(this).parent().parent(".option-menu").next(".content-comments");
  if(containerComments.is(":hidden")){
    containerComments.show('slow');
  }
});

// Evento click en la caja de comentario para MOSTRAR LOS COMENTARIOS REALIZADOS
$("#data-publication-works").on("click", ".write-text-comment", function(){
  $(this).parent().parent(".write-comment").prev(".collapse").show("slow");
});

// Detectar ENTER en la caja de comentario (Enviar datos al servidor)
$("#data-publication-works").on("keydown", ".write-text-comment", function(e){
  if (e.keyCode == 13) {
    e.preventDefault();
    let comentario = $(this).html().trim();
    let idtrabajo = $(this).attr("data-code");

    if(comentario == ""){
      sweetAlertWarning("Texto invalido", "Por favor escriba algo...");
    }
    else{
      registerComment({
        op          : 'registerComment',
        idtrabajo   : idtrabajo,
        comentario  : comentario
      });
    }

    // Enfoque
    $(this).focus();
  }
});

// Botón enviar comentario al servidor (REGISTRAR)
$("#data-publication-works").on("click", ".btn-send", function(){
  let comentario = $(this).prev(".text-auto-height").children(".write-text-comment").html().trim();
  let idtrabajo = $(this).prev(".text-auto-height").children(".write-text-comment").attr("data-code");
  
  if(comentario == ""){
    sweetAlertWarning("Texto invalido", "Por favor escriba algo...");
  }
  else{
    registerComment({
      op          : 'registerComment',
      idtrabajo   : idtrabajo,
      comentario  : comentario
    });
  }

  // Enfoque
  $(this).prev(".text-auto-height").children(".write-text-comment").focus();
});

// Registrar comentario
function registerComment(dataSend){
  $.ajax({
    url: 'controllers/comment.controller.php',
    type: 'GET',
    data: dataSend,
    success: function(result){      
      if(result != ""){
        sweetAlertWarning(result, "Debe iniciar sesión o registrase");
      } else {
        // Limpiar caja
        $(".write-text-comment").html('');
        loadPublicationWorks(); // Actualizar datos en la vista
      }
    }
  });
}

/**
 * EDITAR COMENTARIOS
 */
// Convierte la etiqueta P en una sección editable 
$("#data-publication-works").on("click", ".edit-comment", function(){
  hideOptionsCommentModify();

  // Habilitar campo editable
  $(this).prev('p.comment-text').attr('contenteditable', true);
  
  // habilitar botones
  $(this).addClass('d-none');
  $(this).next('.delete-comment').addClass('d-none');
  $(this).next('.delete-comment').next('.update-comment').removeClass('d-none');
  $(this).next('.delete-comment').next('.update-comment').next('.cancel-edit-comment').removeClass('d-none');
 
});

// Cancela la edición del comentario
$("#data-publication-works").on("click", ".cancel-edit-comment", function(){
  // Desabilitar campo editable
  $(this).prevAll('p.comment-text').attr('contenteditable', false);
  
  // habilitar botones
  $(this).addClass('d-none');
  $(this).prev('.update-comment').addClass('d-none');
  $(this).prev('.update-comment').prev('.delete-comment').removeClass('d-none');
  $(this).prev('.update-comment').prev('.delete-comment').prev('.edit-comment').removeClass('d-none');
});

// Ocultar botones
function hideOptionsCommentModify(){
  // Desactivar campo editable
  $('p.comment-text').attr('contenteditable', false);

  $(".edit-comment").removeClass("d-none");
  $(".delete-comment").removeClass("d-none");

  $(".cancel-edit-comment").addClass("d-none");
  $(".update-comment").addClass("d-none");
}

// Actualizar comentario de trabajos publicados
$("#data-publication-works").on("click", ".update-comment", function(){
  
  let idcomentario = $(this).attr('data-code');
  let comentario = $(this).prev(".delete-comment").prev(".edit-comment").prev("p.comment-text").html().trim();
  
  updateCommentPublication({
    op            : 'updateComment',
    idcomentario  : idcomentario,
    comentario    : comentario
  });
});

// actualizar
function updateCommentPublication(dataSend){
  $.ajax({
    url: 'controllers/comment.controller.php',
    type: 'GET',
    data: dataSend,
    success: function(result){

      if(result == ""){
        loadPublicationWorks(); // Actualizar datos
      }
    }
  });
}

// Eliminar comentario
$("#data-publication-works").on("click", ".delete-comment", function(){
  
  let idcomentario = $(this).attr('data-code');

  sweetAlertConfirmQuestionDelete("¿Estas seguro de eliminar el comentario?").then(confirm => {
    if(confirm.isConfirmed){
      deleteComment(idcomentario);
    }
  });
});

function deleteComment(idcomentario){
  $.ajax({
    url: 'controllers/comment.controller.php',
    type: 'GET',
    data: 'op=deleteComment&idcomentario='+ idcomentario,
    success: function(result){
      if(result == ""){
        loadPublicationWorks();
      }
    }
  });
}

/**
 * FORO DE CONSULTAS
 */

// Bloquear saltos de linea
$(".content-forum .contenteditable").keypress(function (e){
  return disableLineBreaksInContEditable($(this), e); 
});

// Evitar copiar en la caja de comentario
$(".content-forum .contenteditable").on("copy", function (e){
  e.preventDefault();
});

// Evitar pegar en la caja de comentario
$(".content-forum .contenteditable").on("paste", function (e){
  e.preventDefault();
  var text = (e.originalEvent || e).clipboardData.getData('text/plain');
  document.execCommand("insertHTML", false, text);
});

// Convierte la etiqueta P en una sección editable 
$("#content-data-forum").on("click", ".edit-comment", function(){
  hideOptionsCommentModify();

  // Habilitar campo editable
  $(this).prev('p.comment-text').attr('contenteditable', true);
  
  // habilitar botones
  $(this).addClass('d-none');
  $(this).next('.delete-comment').addClass('d-none');
  $(this).next('.delete-comment').next('.update-comment').removeClass('d-none');
  $(this).next('.delete-comment').next('.update-comment').next('.cancel-edit-comment').removeClass('d-none');
 
});

// Cancela la edición del comentario
$("#content-data-forum").on("click", ".cancel-edit-comment", function(){
  // Desabilitar campo editable
  $(this).prevAll('p.comment-text').attr('contenteditable', false);
  
  // habilitar botones
  $(this).addClass('d-none');
  $(this).prev('.update-comment').addClass('d-none');
  $(this).prev('.update-comment').prev('.delete-comment').removeClass('d-none');
  $(this).prev('.update-comment').prev('.delete-comment').prev('.edit-comment').removeClass('d-none');
});

// Detectar ENTER en la caja de consulta (Enviar datos al servidor)
$(".content-forum .contenteditable").keydown(function(e){
  if (e.keyCode == 13) {
    e.preventDefault();
    let consulta = $(this).html().trim();

    if(consulta == ""){
      sweetAlertWarning("Texto invalido", "Por favor escriba algo...");
    }
    else{
      registerCommentForum({
        op        : 'commentForum',
        idusuario : 2,
        consulta  : consulta
      });
    }

    // Enfoque
    $(this).focus();
  }
});

// Boton publicar consulta
$(".content-forum .btn-send").click(function (){
  let consulta = $(this).prev(".text-auto-height").children(".write-text-comment").html().trim();
 
  if(consulta == ""){
    sweetAlertWarning("Texto invalido", "Por favor escriba algo...");
  } else {
    registerCommentForum({
      op        : 'commentForum',
      idusuario : 2,
      consulta: consulta
    });
  }
});

// Registrar onsultas
function registerCommentForum(dataSend){
  $.ajax({
    url: 'controllers/forum.controller.php',
    type: 'GET',
    data: dataSend,
    success: function(result){
      
      if(result != ""){
        sweetAlertWarning(result, "Debe iniciar sesión o registrarse");
      } else {
        loadQueriesForumToUser(idusuarioForum);
      }
    }
  });
}

// Actualizar comentario
$("#content-data-forum").on("click", ".update-comment", function(){
  
  let idforo = $(this).attr('data-code-forum');
  let consulta = $(this).prev(".delete-comment").prev(".edit-comment").prev("p.comment-text").html().trim();

  updateQueryForum({
    op      : 'updateCommentForum',
    idforo  : idforo,
    consulta: consulta
  });

});

// actualizar
function updateQueryForum(dataSend){
  $.ajax({
    url: 'controllers/forum.controller.php',
    type: 'GET',
    data: dataSend,
    success: function(result){
      console.log(result)
      if(result == ""){
        loadQueriesForumToUser(idusuarioForum);
      }
    }
  });
}

// Eliminar consulta
$("#content-data-forum").on("click", ".delete-comment", function(){
  
  let idforo = $(this).attr('data-code-forum');

  sweetAlertConfirmQuestionDelete("¿Estas seguro de eliminar el comentario?").then(confirm => {
    if(confirm.isConfirmed){
      deleteQueryForum(idforo);
    }
  });

});

function deleteQueryForum(idforo){
  $.ajax({
    url: 'controllers/forum.controller.php',
    type: 'GET',
    data: 'op=deleteForum&idforo=' + idforo,
    success: function(result){
      if(result == ""){
        loadQueriesForumToUser(idusuarioForum);
      }
    }
  });
}

// Listar consultas del foro
function loadQueriesForumToUser(){
  $.ajax({
    url: 'controllers/forum.controller.php',
    type: 'GET',
    data: 'op=getQueriesToUser&idusuarioactivo=' + idusuarioActivo,
    success: function(result){
      if(result != ""){
        $("#content-data-forum").html(result);
      }
    }
  });
}

// ejecutar la carga de consultas
loadQueriesForumToUser();

/**
 * VIDEO PLAYER iNICIAR 
 */
/* var reproductor = videojs('video-tag', {
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
 * ALTERNAR ENTRE IMAGENES O VIDEO (Cargar y eliminar)
 */
// Llamar al evento change
$("#btn-add-file").click(function () {

  if(isLoadImages){
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
 * CARGAR IMAGENES PREVIAS EN EL MODAL PUBLICACIÓN
 */

// Ejecutar el evento change de images
$("#input-new-image").change(function (e) {
  let totalImgPreview = $(".image-new").toArray().length;
  let max = $(this).attr('max');  // Maximo de imagenes permnitidos
  let files = this.files;         // Archivos cargados
  let element;                    // Almacenar cada archivo
  let supportedImages = ["image/jpeg", "image/jpg", "image/png", "image/gif"];

  // validar que no exceda el maximo permitido
  if (files.length > max || totalImgPreview >= max) {
    sweetAlertInformation("5 Imagenes como maximo", "Se excedio el maximo de archivo permitido");
  } else {

    // recorrer y mostrar los archivos subidos
    for (var i = 0; i < files.length && uploadedImages.length < max; i++) {
      element = files[i];   // Obtener cada imagen del array

      // Validar si son imagenes permitidos
      if (supportedImages.indexOf(element.type) == -1) {
        let index = element.type.indexOf('/');
        let ext = element.type.substr(index + 1);	
        sweetAlertWarning("Archivo " + ext.toUpperCase() + " no permitido", "Permitidos: jpeg, jpg, png, gif");

      } else {                    
        uploadedImages.push(element);                               // Almacenar en el nuevo array
        createPreviewImages($("#container-images"), element);      // Crear previsualizacion de imagenes DENTRO de (container images)
      }

      // si existe imagenes mostrar botón de eliminación
      if(uploadedImages.length > 0 || totalImgPreview > 0){
        $("#btn-delete-files").removeClass("d-none");
      }

    } // fin del for    

  }
  // Condición para impedir subir imagenes
  if(uploadedImages.length == max || totalImgPreview == max){
    $("#btn-add-file").prop('disabled', true);
  }
});

// Eliminar previsualizaciones de imagenes uno por uno
$(document).on("click", ".image-new figure figcaption i", function () {
  // Renover la imagen previa 
  $(this).parent("figcaption").parent("figure").parent(".image-new").remove();
  let image = $(this).parent("figcaption").parent("figure").parent(".image-new").attr("data-img");
  let idimage = $(this).parent("figcaption").parent("figure").parent(".image-new").attr("data-code");
  let totalImgPreview = $(".image-new").toArray().length;

  // Comprobar si son datos por modificar
  if(idimage != undefined){
    deletedImages.push({
      "idgaleria": idimage,
      "archivo": image
    });
  }

  // Eliminar la imagen del arreglo 
  removeItemFromArrayObject(uploadedImages, image);

  // Ocultar botón de eliminación
  if (uploadedImages.length == 0 && totalImgPreview == 0) {
    $("#btn-delete-files").addClass("d-none");   
  } // Mostrar boton para subir imagen
  else if(uploadedImages.length >= 0 && totalImgPreview >= 0) {
    $("#btn-add-file").prop('disabled', false); 
  }
});


// Eliminar elemento del array object
function removeItemFromArrayObject(arrayObject, item){
  // Buscar dentro del arr
  let indexResult = arrayObject.findIndex((element) => {
    return element.name === item;
  });

  // Eliminar si existe el elemento buscado
  indexResult !== -1 && arrayObject.splice( indexResult, 1 );     
}

// Encontrar coincidencia de objeto
function getIndexArrayObject(arrayObject, item){
  let index = arrayObject.findIndex((element) => {
    return element.name === item;
  });

  // Devolver el indice obtenido (-1 si no se encuentra)
  return index;
}

// función Find demo
function findFunctionDemo(arrObject){
  arrObject.find((element, index, array) => {
    console.log(index)
    console.log(element)
    console.log(array)
  });
}

// Eliminar un elemento del array
function removeItemFromArray (arr, item ) {
  var i = arr.indexOf( item );        // Indice    
  i !== -1 && arr.splice( i, 1 );     // Eliminar si existe
  console.log(i)
}

// Eliminar todas las imagenes
function deleteAllImagespreview(){
  $(".image-new").remove();
  uploadedImages = [];
  changeInterfaceToDelete(true);
}

// cambiar los botones (Agregar o Eliminar)
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
  let supportedVideo = ["video/mp4"];

  // Obtener el tamaño del archivo subido
  let sizeByte = event.target.files[0].size;
  let sizeKilobyte = parseInt(sizeByte / 1024);
  let sizeMegabyte = parseInt(sizeKilobyte / 1024);

  // Valor del atributo size (Maximo en MB permitido)
  let valueSize = $(this).attr("size");

  // Iniciar en 0 el progressbar
  let percentLoad = 0;
  $("#label-video-size").html('0 MB');
  $(".progress .progress-bar").html('0 %');
  $(".progress .progress-bar").addClass("progress-bar-animated").addClass("progress-bar-striped");

  let fileVideo = this.files[0]; 
  
  // Validar archivo
  if(supportedVideo.indexOf(fileVideo.type) == -1){
    sweetAlertWarning("Archivo no permitido", "Permitido: mp4");
  }
  else{
    // Validar tamaño del archivo
    if (valueSize < sizeMegabyte) {
      sweetAlertWarning("Supera el tamaño maximo permitido ", " (" + valueSize + " MB)");
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
  $("#form-upload-file")[0].reset();
  $("#input-new-video").val('');
  $("#label-video-size").html('0 MB');
  $(".progress .progress-bar").html('0 %');
  $(".progress .progress-bar").css('width', 0 + '%');
  changeInterfaceToDelete(true);
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

        var formData = new FormData();
        formData.append("op", "registerWork");
        formData.append("idespecialidad", $("#especialidad").val());
        formData.append("titulo", $("#titulo").val());
        formData.append("descripcion", $("#descripcion").val());
      
        // Comprobar si son imagenes o video
        if(isLoadImages){
          // pasar las imagenes al array images[]
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
    data: 'op=getWorksByUser&idusuarioactivo=' + idusuarioActivo,
    success: function(result){
      $("#data-publication-works").html(result);
    }
  });
}


/**
 * MODAL REPORTE
 */
// Abrir modal desde publicación de trabajos
$("#data-publication-works").on("click", ".report-comment", function(){
  $("#modal-report").modal("show");
});

// Abrir modal desde el foro de consultas
$("#content-data-forum").on("click", ".report-comment", function(){
  $("#modal-report").modal("show");
});

// Restringir el maximo de caracteres del texto de comentario (atributo maxlength)
$("#comentario").keydown(function(e){
  disableLineBreaksInContEditable($(this), e);
});

// Cargar imagen en el formulario reporte
$("#btn-load-image-report").click(function () {
  $(".image-new").remove();
  $("#input-load-image-report").val('');
  $("#input-load-image-report").click();
});

$("#input-load-image-report").change(function (e) {
  let file = this.files[0];   
  let supportedImages = ["image/jpeg", "image/jpg", "image/png", "image/gif"];

   // Validar si son imagenes permitidos
   if (supportedImages.indexOf(file.type) == -1) {
    let index = file.type.indexOf('/');
    let ext = file.type.substr(index + 1);	
    sweetAlertWarning("Archivo " + ext.toUpperCase() + " no permitido", "Permitidos: jpeg, jpg, png, gif");
  } else {                    
    createAPreviewImage($("#container-image-report"), file);      // Crear previsualizacion
  }
});


// EJECUTANDO LA FUNCIÓN LISTAR
loadSpecialtySelect();
loadPublicationWorks(); // cargar trabajos