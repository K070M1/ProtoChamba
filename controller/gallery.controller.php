<?php 

require_once '../model/Gallery.php';

$gallery = new Gallery();

if (isset($_GET['op'])) {
    
    function loadGallery($data){
        if(count($data) > 0){
            foreach($data as $row){
                echo
                "
                <div class='col-md-3 user-cd-img'>
                    <div class='image-container'>
                        <figure>
                            <img src='./dist/img/User/{$row['archivo']}'>
                            <figcaption>
                                <ul>
                                <li>
                                    <i class='fas fa-pen-square'></i>
                                </li>
                                <li>
                                    <i class='fas fa-trash-alt'></i>
                                </li>
                                <li>
                                    <i class='fas fa-eye'></i>
                                </li>
                                </ul>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                ";
            }
        }
        echo
        "
            <div class='col-md-3'>
              <div class='add-img-cd' title='Subir una imágen a mi galería'>
                <i class='fas fa-camera'></i>
              </div>
            </div>
        ";
    }


    if ($_GET['op'] == 'listGallery') {
        $data = $gallery->getGalleriesByUser(["idusuario" => $_GET['idusuario']]);
        loadGallery($data);
    }

    
    if ($_GET['op'] == 'listGalleryFromAlbum') {
        $data = $gallery->getGalleriesByAlbum(["idalbum" => $_GET['idalbum']]);
        loadGallery($data);
    }
}


?>