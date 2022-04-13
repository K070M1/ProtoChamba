// VARIABLES GLOBALES
var isDeleteImage = false;
var countImages = 0;

// Ocultar contenido por defecto
$("#container-video").hide();

// MOSTRAR CONTENIDO DE CARGAR IMAGENES
$("#btn-image").click(function() {
    if ($("#container-video").is(':visible')) $("#container-video").hide();

    if ($("#container-images").is(':hidden')) {
        $("#container-images").show('slow');
    } else {
        $("#container-images").hide('slow');
    }
});

// MOSTRAR CONTENIDO DE CARGAR VIDEO
$("#btn-video").click(function() {

    if ($("#container-images").is(':visible')) $("#container-images").hide();

    if ($("#container-video").is(':hidden')) {
        $("#container-video").show('slow');
    } else {
        $("#container-video").hide('slow');
    }
});

/**
 * MENU DE OPCIONES POR CADA PUBLICACIÓN
 */
// Mostrar el menu
$(".btn-show-config").click(function() {
    $(this).next("ul.list-public-config").toggle();
});

/**
 * CALIFICACIÓN - TRABAJOS
 */

// Abir contenido de calificaciones
$(".qualify").click(function() {
    $(this).children(".content-reactions-qualify").toggleClass("reactions-show");
});

// Aplicar la clase active al estar sobre el elemento - start
$(".reactions span").mouseover(function() {
    // Activar los elementos anteriores
    $(this).prevAll().addClass("active");
    let numberPoint = $(this).attr("data-code");
    $(this).parent(".reactions").next(".number-points").html(numberPoint + " Punto");
});

// Quitar clase active al sacar el mouse del elemento
$(".reactions span").mouseleave(function() {
    $(".reactions span").removeClass("active");
    $(this).parent(".reactions").next(".number-points").html("0 Punto");
});

/**
 * BLOQUEAR CONTENTEDITABLE
 */

// Bloquear el Maximo de caracteres
$(".contenteditable").keypress(function(event) {
    var maxlength = $(this).attr('maxlength');

    if ($(this).html().length == maxlength) {
        return false;
    } else {
        return true;
    }
});

// Bloquear el pegar contenido dentro del contenteditable
$(".contenteditable").on('paste', function(e) {
    e.preventDefault();
});

// Bloquear el copiar contenido dentro del contenteditable
$(".contenteditable").on('copy', function(e) {
    e.preventDefault();
    alert('Esta acción está prohibida');
});


/**
 * COMENTARIOS
 */

// Evento keydown de la caja de comentario
$(".text-input-auto").keydown(function(event) {
    if (event.keyCode == 13) {
        event.preventDefault();
    }
});

// Detectar ENTER en la caja de comentario
$(".write-text-comment").keydown(function(event) {
    if (event.keyCode == 13) {
        event.preventDefault()
        var valueComment = $(this).html().trim();
        console.log(valueComment);
    }
})

// Evento click en la caja de comentario para MOSTRAR LOS COMENTARIOS REALIZADOS
$(".write-text-comment").click(function() {
    $(this).parent().parent(".write-comment").prev(".collapse").show("slow");
})

// Botón enviar comentario
$(".btn-send").click(function() {
    var valueComment = $(this).prev(".text-auto-height").children(".write-text-comment").html().trim();
    console.log(valueComment);
})

/**
 * EDITAR COMENTARIOS
 */
// Convierte la etiqueta P en una sección editable 
$('.edit-comment').click(function() {
    var isEditable = $(this).prev('p.comment-text').attr('contenteditable', true);

    // habilitar botones
    $(this).next('.cancel-edit-comment').removeClass('d-none');
    $(this).next('.cancel-edit-comment').next('.delete-comment').addClass('d-none');
    $(this).html('Actualizar');
});

// Cancela la edición del comentario
$('.cancel-edit-comment').click(function() {
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
 * CARGAR IMAGENES EN EL MODAL PUBLICACIÓN
 */
// Llamar al evento change
$("#add-file").click(function() {
    countImages = 0;
    $("#input-new-image").click();
});

// Ejecutar el evento change
$("#input-new-image").change(function(e) {
    var max = $(this).attr('max');
    var files = this.files;
    var element;
    var supportedImages = ["image/jpeg", "image/jpg", "image/png", "image/gif"];
    var isValid = true;

    if (files.length > max) {
        alert("Se excedio el maximo de archivo permitido");
    } else {
        // recorrer y mostrar los archivos subidos
        for (var i = 0; i < files.length && countImages <= 4; i++) {
            element = files[i];

            if (supportedImages.indexOf(element.type) != -1) {
                createPreviewImages(element);
                //console.log(supportedImages.indexOf(element.type));

                countImages = $(".image-new").toArray().length; // actualizar valor del contador
                if (countImages >= 5) {
                    $("#content-load-file").hide();
                }
            } else {
                isValid = false;
            }
        }
    }

    if (!isValid) {
        alert("1 Archivo no permitido");
    }
});

// Eliminar previsualizaciones
$(document).on("click", ".image-new", function(e) {
    $(this).remove();
    countImages--;
    if (countImages < 5) {
        $("#content-load-file").show(); // Mostrar icono para subir imagen
    }
});


/**
 * CARGAR VIDEO EN EL MODAL PUBLICACIONES
 */
// cargar video
$(document).on("click", "#btn-add-video", function() {
    $("#input-new-video").click();

});

// Evento change de subir video
$("#input-new-video").change(function(event) {
    let videoSrc = document.querySelector("#video-source");

    // Obtener el tamaño del archivo subido
    var sizeByte = event.target.files[0].size;
    var sizeKilobyte = parseInt(sizeByte / 1024);
    var sizeMegabyte = parseInt(sizeKilobyte / 1024);

    // Valor del atributo size
    var valueSize = $(this).attr("size");

    // Iniciar en 0
    var percentLoad = 0;
    $("#label-video-size").html('0 MB');
    $("#label-video-maxsize").html("  (" + valueSize + " MB)");
    $(".progress .progress-bar").html('0 %');
    $(".progress .progress-bar").addClass("progress-bar-animated").addClass("progress-bar-striped");

    // Validar tamaño del archivo
    if (valueSize < sizeMegabyte) {
        alert("Supera el tamaño maximo permitido (" + valueSize + " MB)");
    } else {
        // es aceptable
        if (event.target.files && event.target.files[0]) {
            var reader = new FileReader(); // instancia Objeto reader
            var file = event.target.files[0]; // leer el video subido

            reader.onload = function(e) {
                videoSrc.src = e.target.result
                videoSrc.parentElement.load()
            }.bind(this)

            // Leer el contenido de file
            reader.readAsDataURL(file);

            // progreso de carga
            reader.onprogress = function(e) {
                percentLoad = Number.parseInt(e.loaded * 100 / e.total); // calculando porcentaje
                $(".progress .progress-bar").html('Cargando...' + percentLoad + ' %');
                $(".progress .progress-bar").css('width', percentLoad + '%');
            }

            // carga completa
            reader.onloadend = function(e) {
                $("#label-video-size").html(sizeMegabyte + ' MB');
                $("#label-video-maxsize").html("  (" + valueSize + " MB)");
                $(".progress .progress-bar").html('Carga completa ' + percentLoad + ' %');
                $(".progress .progress-bar").removeClass("progress-bar-animated").removeClass("progress-bar-striped");
            }
        }
    }
});

// Eliminar video
$("#btn-delete-video").click(function() {
    let videoSrc = document.querySelector("#video-source");
    videoSrc.src = '';
    videoSrc.parentElement.load();
    $("#input-new-video").val('');
});

/**
 * MODAL REPORTE
 */
// Abrir modal
$(".report-comment").click(function() {
    $("#modal-report").modal("show");
});

// Cargar imagen en el formulario reporte
$("#btn-subir-imagen").click(function() {
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
$("#input-img-portada").change(function(e) {
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
    reader.onload = function() {
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