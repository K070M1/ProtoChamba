//Genera las previsualizaciones
function createPreviewImages(file) {
    var imgCodified = URL.createObjectURL(file);
    var img = $('<div class="image-new"> <figure> <img src="' + imgCodified + '"> <figcaption title="Eliminar"> <i class="fas fa-ban"></i> </figcaption> </figure> </div>');
    $(img).insertBefore("#content-load-file");
}

// Crear previsualizador de videos
function createPreviewVideo(file, id) {
    var videoCodified = URL.createObjectURL(file);

    var style = "fm-video video-js vjs-16-9 vjs-big-play-centered";
    var video = "<video class='" + style + "' ";
    video += "data-setup='{}' controls id='fm-video-" + id + "' class='play-video'> ";
    video += "<source src='" + videoCodified + "' type='video/mp4'> ";
    video += "</video> ";

    $(video).insertBefore("#content-load-file");
}