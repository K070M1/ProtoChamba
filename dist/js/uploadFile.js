//Genera las previsualizaciones
function createPreviewImages(file) {
    var imgCodified = URL.createObjectURL(file);
    var img = $('<div class="image-container"> <figure> <img src="' + imgCodified + '"> <figcaption> <i class="fas fa-ban"></i> </figcaption> </figure> </div>');
    $(img).insertBefore("#add-photo-container");
}

// Crear previsualizador de videos
function createPreviewVideo(file, id) {
    var videoCodified = URL.createObjectURL(file);

    var style = "fm-video video-js vjs-16-9 vjs-big-play-centered";
    var video = "<video class='" + style + "' ";
        video += "data-setup='{}' controls id='fm-video-"+ id +"' class='play-video'> ";
        video += "<source src='" + videoCodified + "' type='video/mp4'> ";
        video += "</video> ";

    $(video).insertBefore("#add-photo-container");
    initVideo('fm-video-' + id);
    console-console.log(id);

}

// Inicializar los videos cargados
function initVideo(video){
    var reproductor = videojs(video, {
      fluid: true,
      //autoplay: false,
      muted: true,
      aspectRatio: '16:9',
      responsive: true,
      playbackRates: [0.5, 1, 1.5, 2],
      fullscreen: {options: {navigationUI: 'hide'}},
      userActions: {
        click: true
      }
    });
}