$(document).ready(function(){
    
    var disabledSelector = true;
    var modificarAlbum = false;
    var añdAlbm = true;
    var ElementSubidos = [];
    /* var files; */

    var idalbum;
    var idgaleria;

    // Previsualizaciones
    function createPreview(file, dataname) {
        var imgCod = URL.createObjectURL(file);
        var img = $('<div class="col-md-4"><div class="image-sub-despz" dataimg="'+ dataname +'"> <figure> <img src="' + imgCod+ '" alt="Foto del usuario" width="100%"> <figcaption><i class="fas fa-trash-alt"></i></figcaption> </figure> </div></div>');
        $(img).insertBefore(".img-upd-container");
    }

    // Fin de los modales
    $("#add-new-photo").on("change", function(){

        var archivoCargados = this.files;
        /* ElementSubidos = archivoCargados; */
        var elementos;
        var namelement;

        for (var i = 0; i < archivoCargados.length; i++) {
            elementos = archivoCargados[i];
            namelement = archivoCargados[i]['name'];
            ElementSubidos.push(archivoCargados[i]);
            createPreview(elementos, namelement);
        }
    
    });

    /*Cargar album */
    function loadAlbum(){
        $.ajax({
          url: 'controllers/album.controller.php',
          type: 'GET',
          data: 'op=loadAlbum&idusuario=1',
          success: function(e) {
            $("#load-album").html(e);
          }
        });
    }

    /*Registrar Album */
    $("#load-album").on("click", "#agr-albm", function(){
        $("#md-album-cd-img").modal("toggle");
        $("#añadir-albm").html("Añadir");
        $("#t-md-albm").html("Crear nuevo álbum");
        $("#nmb-album-add").val("");
        modificarAlbum = false;
    });
    
    /* Agregar album */
    $("#añadir-albm").click(function(){
    let nalbum = $("#nmb-album-add").val();
        
        var formData = new FormData();

        if(modificarAlbum == false){
            formData.append("op", "registerAlbum");
        }else{
            formData.append("op", "updateAlbum");
            formData.append("idalbum", idalbum);
        }
        
        formData.append("nombrealbum", nalbum);

        $.ajax({
            url: 'controllers/album.controller.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            success: function(e) {
                console.log(e);
                loadAlbum();
                $("#md-album-cd-img").modal("hide");
                $("#añadir-albm").html("Añadir");
                $("#t-md-albm").html("Crear nuevo álbum");
                modificarAlbum = false;
            }
        });
    });

    /* Eliminar album */
    $("#load-album").on("click", ".btn-elim",function(){
        $idalbum = $(this).attr("data-alb-eli");
        $.ajax({
            url: 'controllers/album.controller.php',
            type: 'GET',
            data: 'op=deleteAlbum&idalbum=' + $idalbum,
            success: function(e) {
                loadAlbum();
            }
        });
    });

    /* Abrir album */
    $("#load-album").on("click", ".btn-abr",function(){
        $idalbum = $(this).attr("data-alb-open");
        $namealbum = $(this).attr("data-alb-open-name");
        $.ajax({
            url: 'controllers/gallery.controller.php',
            type: 'GET',
            data: 'op=listGalleryFromAlbum&idalbum=' + $idalbum,
            success: function(e) {
                $("#content-collapse-albm").html(e);
                $("#img-album-open-collap").collapse("toggle");
                $("#tittle-collapse").html("Álbum: " + $namealbum);
            }
        });
    });

    /* Modificar album */
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
                $("#añadir-albm").html("Actualizar");
                $("#t-md-albm").html("Modificar álbum");
                $("#md-album-cd-img").modal("toggle");
            }
            });
        
    });
    

    /*Cargar galeria */
    function loadGallery(){
        $.ajax({
          url: 'controllers/gallery.controller.php',
          type: 'GET',
          data: 'op=listGallery&idusuario=1',
          success: function(e) {
            $("#load-Gallery").html(e);
          }
        });
    }

    /* Abrir modal de subir imagen */
    $("#load-Gallery").on("click", "#agr-gal", function(){
        $("#md-add-img").modal("toggle");
        loadAlbumSlcModalAddGallery();
    });
    
    // Eliminar previsualizacion
    $(".img-container-upt").on("click", ".image-sub-despz", function(){
        $(this).parent().remove();
        var data =  $(this).attr('dataimg');
        for (var i = 0; i < ElementSubidos.length; i++){
            if(ElementSubidos[i]['name'] == data){
                ElementSubidos.splice( ElementSubidos[i], 1 );
            };
        }
        console.log(ElementSubidos);
    });

    /* Subir imagen temporales*/
    $("#btn-up-cnt-img").on("click", function(){
        $("#add-new-photo").click();
    });

    /* Eliminar fotos cargadas */
   /*  $("#btn-cnl-img").on("click", function(){
        $(".image-sub-despz").parent().remove();
    }); */

    /* Ver fotografia*/
    $("#load-Gallery").on("click", ".btn-vw", function(){
        var idgal = $(this).attr("data-gal-open");
        var idalbm = $(this).attr("data-gal-albm");

        $("#modal-view-img").modal("toggle");
        $("#slc-album-md").addClass("view-only-img");
        añdAlbm = false;
        loadGalleryModal(idgal, idalbm, false);
        
    });

    /* Eliminar galeria*/
    $("#load-Gallery").on("click", ".btn-elim", function(){
        $idgaleria = $(this).attr("data-gal-eli");
        $.ajax({
            url: 'controllers/gallery.controller.php',
            type: 'GET',
            data: 'op=deleteGallery&idgaleria=' + $idgaleria,
            success: function() {
                loadGallery();
            }
        });
        
    });

    /* Modificar Galleria */
    $("#load-Gallery").on("click", ".btn-modif", function(){
        var idgaleGl = $(this).attr("data-gal-act");
        var idalbm =  $(this).attr("data-gal-albm");
        idgaleria = idgaleGl;
        
        $("#btn-cmb-alb").removeClass("btn-ocult-md");
        $("#modal-view-img").modal("toggle");
        $("#slc-album-md").addClass("view-only-img");
        
        añdAlbm = false;
        loadGalleryModal(idgaleGl, idalbm, true);
        $("#btn-cmb-alb").html("Cambiar"); 
    });

    /*Modificaciones en el modal */
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
                success: function(e) {
                    console.log(e);
                    loadGallery();
                }
            });
        }
    });

    $("#btn-add-gal-md").click(function(){
        let idalbum = $("#alb-add-gal").val();
        var formData = new FormData();

        formData.append("op", "registerGalleryPhotos");
        formData.append("idalbum", idalbum);

        for (var i = 0; i < ElementSubidos.length; i++){
            formData.append("archivo", ElementSubidos[i]);
            formData.append("tipoarchivo", ElementSubidos[i]['type'])

            $.ajax({
                url: 'controllers/gallery.controller.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                success: function(e) {
                    console.log(e);
                    loadGallery();
                }
            });
        }

    }); 


    /*Cargar galeria en el modal */
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

    /*Cagar select de modal de la galeria */
    function loadAlbumSlcModalGallery(idalbm){
        $.ajax({
            url: 'controllers/album.controller.php',
            type: 'GET',
            data: 'op=loadAlbumSlcModal&idusuario=1',
            success: function(e) {
              $("#slc-album-md").html(e);
              if(añdAlbm == false){
                  $("#slc-album-md").val(idalbm);
              }else{
                  $("#alb-add-gal").html(e);
              }
            }
          });
    }

    /*Cargar select del modal de añadir galeria */
    function loadAlbumSlcModalAddGallery(){
        $.ajax({
            url: 'controllers/album.controller.php',
            type: 'GET',
            data: 'op=loadAlbumSlcModal&idusuario=1',
            success: function(e) {
                $("#alb-add-gal").html(e);
            }
          });
    }


    

    loadAlbum();
    loadGallery();
});
