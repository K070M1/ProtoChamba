$(document).ready(function(){
    
    var disabledSelector = true;
    var modificarAlbum = false;
    var idalbum;
    // Previsualizaciones
    function createPreview(file) {
        var imgCodified = URL.createObjectURL(file);
        var img = $('<div class="col-md-4"><div class="image-sub-despz"> <figure> <img src="' + imgCodified + '" alt="Foto del usuario" width="100%">  <figcaption><i class="fas fa-trash-alt"></i></figcaption> </figure> </div></div>');
        $(img).insertBefore(".img-upd-container");
    }
      
    /*function showMessage(message) {
        $("#Message .tag").text(message);
        showModal("Message");
    }*/

    // Fin de los modales
    $("#add-new-photo").on("change", function(){
        console.log(this.files);
        console.log("Se cargo una vez");
        var files = this.files;
        var element;
        var supportedImages = ["image/jpeg", "image/png", "image/gif"];
        var seEncontraronElementoNoValidos = false;

        for (var i = 0; i < files.length; i++) {
            element = files[i];
            
            if (supportedImages.indexOf(element.type) != -1) {
                createPreview(element);
            }
            else {
                seEncontraronElementoNoValidos = true;
            }
        }

        /* Cambio parental de datos (Abrir con POP UPS) */
        
        /*if (seEncontraronElementoNoValidos) {
            showMessage("Se encontraron archivos no validos.");
        }
        else {
            showMessage("Todos los archivos se subieron correctamente.");
        }*/
    
    });
    
    $(document).on("click", ".img-container-upt .image-sub-despz", function(){
        $(this).parent().remove();
    });
   
    /*Modales de galeria*/
    $("#btn-up-cnt-img").on("click", function(){
        $("#add-new-photo").click();
    });

    $(".add-img-cd").on("click",function(){
        $("#md-add-img").modal("toggle");
    });

    $("#btn-cnl-img").on("click", function(){
        $(".image-sub-despz").parent().remove();
    });

    $(".fa-eye").on("click", function(){
        $("#modal-view-img").modal("toggle");
        $("#slc-album-md").addClass("view-only-img");
        $(".btn-cmb-alb").addClass("ocult-btn");
    });

    $(".fa-pen-square").on("click", function(){
        $(".btn-cmb-alb").removeClass("ocult-btn");
        $("#modal-view-img").modal("toggle");
        $("#slc-album-md").addClass("view-only-img");
        $(".btn-cmb-alb").html("Cambiar");
    });

    $(".btn-cmb-alb").on("click", function(){
        $("#slc-album-md").addClass("view-only-img");
        if(disabledSelector == true){
            $(this).html("Guardar");
            disabledSelector = false;
            $("#slc-album-md").removeClass("view-only-img");
        }else{
            $(this).html("Cambiar");
            disabledSelector = true;
            $("#slc-album-md").addClass("view-only-img");
        }
    });
    /*./Modales de galeria*/

    /*Album*/
    $(".fa-pen").on("click", function(){
        $("#md-album-cd-img").modal("toggle");
    });

    $(".add-album-cd").on("click", function(){
        $("#md-album-cd-img").modal("toggle");
    });

    /*Cargar album */
    function loadAlbum(){
        $.ajax({
          url: 'controller/album.controller.php',
          type: 'GET',
          data: 'op=loadAlbum&idusuario=1',
          success: function(e) {
            $("#load-album").html(e);
          }
        });
    }

    /*Fin de cargar album */

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
            url: 'controller/album.controller.php',
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

    /*Cargar galeria */

    function loadGallery(){
        $.ajax({
          url: 'controller/gallery.controller.php',
          type: 'GET',
          data: 'op=listGallery&idusuario=1',
          success: function(e) {
            $("#load-Gallery").html(e);
          }
        });
    }

    /*Fin de cargar galeria */
    
    /* Eliminar album */
    $("#load-album").on("click", ".btn-elim",function(){
        $idalbum = $(this).attr("data-alb-eli");
        $.ajax({
            url: 'controller/album.controller.php',
            type: 'GET',
            data: 'op=deleteAlbum&idalbum=' + $idalbum,
            success: function(e) {
              loadAlbum();
            }
          });
    });

    $("#load-album").on("click", ".btn-abr",function(){
        $idalbum = $(this).attr("data-alb-open");
        $namealbum = $(this).attr("data-alb-open-name");
        $.ajax({
            url: 'controller/gallery.controller.php',
            type: 'GET',
            data: 'op=listGalleryFromAlbum&idalbum=' + $idalbum,
            success: function(e) {
              $("#content-collapse-albm").html(e);
              $("#img-album-open-collap").collapse("toggle");
              $("#tittle-collapse").html("Álbum: " + $namealbum);
            }
          });
    });

    $("#load-album").on("click", ".btn-modif",function(){
        $idalbum = $(this).attr("data-alb-act");
        idalbum = $idalbum;
        $.ajax({
            url: 'controller/album.controller.php',
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



    loadAlbum();
    loadGallery();
});
