var idusuarioActivo = localStorage.getItem("idusuarioActivo");
idusuarioActivo = idusuarioActivo != null? idusuarioActivo: -1;

// Variables generales
var disabledSelector = true;
var modificarAlbum = false;
var addAlbm = true;
var elementSubidos = [];

var idalbum;
var idgaleria;

// Previsualizaciones
function createPreview(file, dataname) {
    var imgCod = URL.createObjectURL(file);
    var img = $('<div class="col-md-4" id="capImgindex"><div class="image-sub-despz" dataimg="'+ dataname +'"> <figure> <img src="' + imgCod+ '" alt="Foto del usuario" width="100%"> <figcaption><i class="fas fa-trash-alt"></i></figcaption> </figure> </div></div>');
    $(".img-container-upt").append(img);
}   

// Cargar album 
function loadAlbum(){
    $.ajax({
        url: 'controllers/album.controller.php',
        type: 'GET',
        data: 'op=loadAlbum&idusuarioactivo=' + idusuarioActivo,
        success: function(e) {
            $("#load-album").html(e);
        }
    });
}

// Cargar galeria 
function loadGallery(){
    $.ajax({
      url: 'controllers/gallery.controller.php',
      type: 'GET',
      data: 'op=listGallery&idusuarioactivo=' + idusuarioActivo,
      success: function(e) {
        $("#load-Gallery").html(e);
      }
    });
}

// Cargar galeria en el modal
function loadGalleryModal(idgaleria, idalbm, estado){
    var idmalbm = idalbm;
    $.ajax({
        url: 'controllers/gallery.controller.php',
        type: 'GET',
        data: 'op=getGalleryModal&idgaleria=' + idgaleria,
        success: function(e) {
            $("#loadGalleryModal").html(e);
            loadAlbumSlcModalGallery(idmalbm);
            if(estado == false){
                $ ("#btn-cmb-alb"). attr ("style", "display: none;");
            }else{
                $ ("#btn-cmb-alb"). attr ("style", "display: block;");
            }
        }
    });
}

// Cagar select de modal de la galeria
function loadAlbumSlcModalGallery(idalbm){
    $.ajax({
        url: 'controllers/album.controller.php',
        type: 'GET',
        data: 'op=loadAlbumSlcModal',
        success: function(e) {
          $("#slc-album-md").html(e);
          if(addAlbm == false){
              $("#slc-album-md").val(idalbm);
          }else{
              $("#alb-add-gal").html(e);
          }
        }
      });
}

// Cargar select del modal de añadir galeria
function loadAlbumSlcModalAddGallery(){
    $.ajax({
        url: 'controllers/album.controller.php',
        type: 'GET',
        data: 'op=loadAlbumSlcModal',
        success: function(e) {
            $("#alb-add-gal").html(e);
        }
      });
}

// Cargado de las imagenes
$("#add-new-photo").on("change", function(){

    var archivoCargados = this.files;
    var elementos;
    var namelement;

    for (var i = 0; i < archivoCargados.length; i++) {
        elementSubidos.push(archivoCargados[i]);
        elementos = archivoCargados[i];
        namelement = archivoCargados[i]['name'];
        createPreview(elementos, namelement);
    }

});

// Registrar Album
$("#load-album").on("click", "#agr-albm", function(){
    $("#md-album-cd-img").modal("toggle");
    $("#add-albm").html("Añadir");
    $("#t-md-albm").html("Crear nuevo álbum");
    $("#nmb-album-add").val("");
    modificarAlbum = false;
});

// Agregar album 
$("#add-albm").click(function(){
    let nalbum = $("#nmb-album-add").val().trim();
    
    var formData = new FormData();

    if(modificarAlbum == false){
        formData.append("op", "registerAlbum");
    }else{
        formData.append("op", "updateAlbum");
        formData.append("idalbum", idalbum);
    }
    
    formData.append("nombrealbum", nalbum);

    if(nalbum == ''){
        sweetAlertWarning("Q tal chamba", "Debes escribir el nombre del álbum");
    }else{
        if(nalbum == 'Perfil' || nalbum == 'Portada' || nalbum == 'Publicaciones'){
            sweetAlertError("Q tal chamba", "Album ya existente");
        }else{
            sweetAlertConfirmQuestionSave("¿Estas seguro de realizar esta operación ?").then((confirm) => {
                if(confirm.isConfirmed){
                    $.ajax({
                        url: 'controllers/album.controller.php',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        cache: false,
                        success: function(e) {                            
                            socket.send("gallery"); // Operación enviada al servidor
                            loadAlbum();
                            $("#md-album-cd-img").modal("hide");
                            $("#add-albm").html("Añadir");
                            $("#t-md-albm").html("Crear nuevo álbum");
                            modificarAlbum = false;
                            sweetAlertSuccess("Q tal chamba", "Operación realizada correctamente");
                        }
                    });
                }
            });
        }
    }
});

// Eliminar album 
$("#load-album").on("click", ".btn-elim",function(){
    $idalbum = $(this).attr("data-alb-eli");

    sweetAlertConfirmQuestionSave("¿Estas seguro de eliminar este album ?").then((confirm) => {
        if(confirm.isConfirmed){
            $.ajax({
                url: 'controllers/album.controller.php',
                type: 'GET',
                data: 'op=deleteAlbum&idalbum=' + $idalbum,
                success: function(e) {
                    socket.send("gallery"); // Operación enviada al servidor
                    loadAlbum();
                    sweetAlertSuccess("Q tal chamba", "Eliminado correctamente");
                }
            });
        }
    });

});

// Abrir album
$("#load-album").on("click", ".btn-abr",function(){
    var idalbum = $(this).attr("data-alb-open");
    var namealbum = $(this).attr("data-alb-open-name");
    $.ajax({
        url: 'controllers/gallery.controller.php',
        type: 'GET',
        data: 'op=listGalleryFromAlbum&idalbum=' + idalbum + '&idusuarioactivo=' + idusuarioActivo,
        success: function(e) {
            $("#content-collapse-albm").html(e);
            $("#img-album-open-collap").collapse("show");
            $("#tittle-collapse").html("Álbum: " + namealbum);
        }
    });
});

// Modificar album
$("#load-album").on("click", ".btn-modif",function(){
    $idalbum = $(this).attr("data-alb-act");
    idalbum = $idalbum;
    $.ajax({
        url: 'controllers/album.controller.php',
        type: 'GET',
        data: 'op=getAlbumDat&idalbum=' + $idalbum,
        success: function(e) {
            var datos = JSON.parse(e);
            modificarAlbum = true;
            $("#nmb-album-add").val(datos[0].nombrealbum);
            $("#add-albm").html("Actualizar");
            $("#t-md-albm").html("Modificar álbum");
            $("#md-album-cd-img").modal("toggle");
        }
        });
    
});

// Abrir modal de subir imagen
$("#load-Gallery").on("click", "#agr-gal", function(){
    $("#md-add-img").modal("toggle");
    elementSubidos = [];
    $(".img-container-upt").empty();
    loadAlbumSlcModalAddGallery();
});

// Eliminar previsualizacion
$(".img-container-upt").on("click", ".image-sub-despz", function(){
    $(this).parent().remove();
    var data =  $(this).attr('dataimg');
    removeItemFromArrayObject(elementSubidos, data);
});

// Subir imagen temporales
$("#btn-up-cnt-img").on("click", function(){
    $("#add-new-photo").click();
});

// Ver fotografia
$("#load-Gallery").on("click", ".btn-vw", function(){
    var idgal = $(this).attr("data-gal-open");
    var idalbm = $(this).attr("data-gal-albm");

    $("#modal-view-img").modal("toggle");
    $("#slc-album-md").addClass("view-only-img");
    addAlbm = false;
    loadGalleryModal(idgal, idalbm, false);
    
});

// Eliminar galeria
$("#load-Gallery").on("click", ".btn-elim", function(){
    $idgaleria = $(this).attr("data-gal-eli");
    sweetAlertConfirmQuestionSave("¿Estas seguro de eliminar este archivo ?").then((confirm) => {
        if(confirm.isConfirmed){
            $.ajax({
                url: 'controllers/gallery.controller.php',
                type: 'GET',
                data: 'op=deleteGallery&idgaleria=' + $idgaleria,
                success: function() {
                    socket.send("gallery"); // Operación enciada al servidor
                    loadGallery();
                    sweetAlertSuccess("Q tal chamba", "Eliminado correctamente");
                }
            });
        }
    });
    
});

// Modificar Galleria
$("#load-Gallery").on("click", ".btn-modif", function(){
    var idgaleGl = $(this).attr("data-gal-act");
    var idalbm =  $(this).attr("data-gal-albm");
    idgaleria = idgaleGl;
    
    $("#btn-cmb-alb").removeClass("btn-ocult-md");
    $("#modal-view-img").modal("toggle");
    $("#slc-album-md").addClass("view-only-img");
    
    addAlbm = false;
    loadGalleryModal(idgaleGl, idalbm, true);
    $("#btn-cmb-alb").html("Cambiar"); 
});

// Modificar en galeria
$("#loadGalleryModal").on("click", "#btn-cmb-alb" , function(){
    $("#slc-album-md").addClass("view-only-img");
    if(disabledSelector == true){
        $(this).html("Guardar");
        disabledSelector = false;
        $("#slc-album-md").removeClass("view-only-img");
    }else{
        $(this).html("Cambiar");
        disabledSelector = true;
        $("#slc-album-md").addClass("view-only-img");

        var formData = new FormData();
        let idalbumm =  $("#slc-album-md").val();

        
        sweetAlertConfirmQuestionSave("¿Estas modificar este archivo ?").then((confirm) => {
            if(confirm.isConfirmed){

                formData.append("op", "updateGallery");
                formData.append("idgaleria", idgaleria);
                formData.append("idalbum", idalbumm );

                $.ajax({
                    url: 'controllers/gallery.controller.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function() {
                        socket.send("gallery"); // Operación enviada al servidor
                        loadGallery();
                        sweetAlertSuccess("Q tal chamba", "Archivo modificado correctamente");
                    }
                });
            }
        });
        
       
    }
});

// Registrar varias fotos
$("#btn-add-gal-md").click(function(){
    let idalbum = $("#alb-add-gal").val();
    var formData = new FormData();

    if(elementSubidos.length == ''){
        sweetAlertWarning("Q tal Chamba", "No hay archivos para subir");
    }else{
        sweetAlertConfirmQuestionSave("¿Estas seguro de registrar estos  archivos ?").then((confirm) => {
            if(confirm.isConfirmed){
                formData.append("op", "registerGalleryPhotos");
                formData.append("idalbum", idalbum);
                for(let i = 0; i < elementSubidos.length; i++){
                    formData.append("archivo[]", elementSubidos[i]);
                }
    
                $.ajax({
                    url: 'controllers/gallery.controller.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function() {
                        elementSubidos = [];
                        $("#md-add-img").modal("hide");
                        sweetAlertSuccess("Q tal Chamba", "Archivos subidos correctamente");
                        socket.send("gallery"); // Operación enciada al servidor
                        loadGallery();
                    }
                });
            }
        });
    }

});

// Comprobar no espacios
$("#nmb-album-add").keyup(function(){              
    var valor =   this.value;
    letras =   valor.replace(/ /g, "");
    this.value = letras;
}); 

/************** LLAMADO DE LAS FUNCIONES ******************/
loadAlbum();
loadGallery();