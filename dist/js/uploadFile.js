//Genera las previsualizaciones
function createPreviewImages(file, nameImage) {
    var imgCodified = URL.createObjectURL(file);
    var img = $('<div class="image-new col-md-4 mb-3 form-group" data-img="' +  nameImage + '"> <figure> <img src="' + imgCodified + '"> <figcaption title="Eliminar"> <i class="fas fa-trash-alt"></i> </figcaption> </figure> </div>');
    $("#container-images").append(img);
}