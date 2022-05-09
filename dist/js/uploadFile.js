//Genera previsualización de ancho auto
function createAPreviewImage(container, file) {
    var imgCodified = URL.createObjectURL(file);
    var nameImage = file['name'];
    var img = $('<div class="image-new col-auto mb-3 h-350" data-img="' +  nameImage + '"> <figure> <img src="' + imgCodified + '"> <figcaption title="Eliminar"> <i class="fas fa-trash-alt"></i> </figcaption> </figure> </div>');
    $(container).append(img);
}

//Genera las previsualizaciones de imagenes cargadas
function createPreviewImages(container, file) {
    var imgCodified = URL.createObjectURL(file);
    var nameImage = file['name'];
    var img = $('<div class="image-new col-md-4 mb-3 form-group" data-img="' +  nameImage + '"> <figure> <img src="' + imgCodified + '"> <figcaption title="Eliminar"> <i class="fas fa-trash-alt"></i> </figcaption> </figure> </div>');
    $(container).append(img);
}

// Crear previsualizacion con las imagenes traidas del servidor
function createPreviewImagesController(container, file, idimage) {
    var img = $('<div class="image-new col-md-4 mb-3 form-group" data-code="' +  idimage + '" data-img="' +  file + '"> <figure> <img src="dist/img/user/' + 
        file + '"> <figcaption title="Eliminar"> <i class="fas fa-trash-alt"></i> </figcaption> </figure> </div>');
    $(container).append(img);
}

// Crear previsualización de video
function createPreviewVideo(container, file){
    let videoTag = "<video class='video-js new-video fm-video vjs-big-play-centered' controls data-setup='{}' preload='auto' > ";
    videoTag += "<source src='dist/video/" + file + "' type='video/mp4'>";
    videoTag += "</video>";

    $(container).append(videoTag);
}