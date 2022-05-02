//Genera previsualización de ancho auto
function createAPreviewImage(container, file) {
    var imgCodified = URL.createObjectURL(file);
    var nameImage = file['name'];
    var img = $('<div class="image-new col-auto mb-3 " data-img="' +  nameImage + '"> <figure> <img src="' + imgCodified + '"> <figcaption title="Eliminar"> <i class="fas fa-trash-alt"></i> </figcaption> </figure> </div>');
    container.append(img);
}

//Genera las previsualizaciones
function createPreviewImages(container, file) {
    var imgCodified = URL.createObjectURL(file);
    var nameImage = file['name'];
    var img = $('<div class="image-new col-md-4 mb-3 form-group" data-img="' +  nameImage + '"> <figure> <img src="' + imgCodified + '"> <figcaption title="Eliminar"> <i class="fas fa-trash-alt"></i> </figcaption> </figure> </div>');
    container.append(img);
}

// Crear previsualizacion con las imagenes traidas del servidor
function createPreviewImagesController(container, file, idimage) {
    var img = $('<div class="image-new col-md-4 mb-3 form-group" data-code="' +  idimage + '" data-img="' +  file + '"> <figure> <img src="dist/img/user/' + 
        file + '"> <figcaption title="Eliminar"> <i class="fas fa-trash-alt"></i> </figcaption> </figure> </div>');
    container.append(img);
}