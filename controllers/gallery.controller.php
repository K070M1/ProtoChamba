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
                                    <i class='fas fa-pen-square btn-modif'  data-gal-act='{$row['idgaleria']}' data-gal-albm='{$row['idalbum']}' ></i>
                                </li>
                                <li>
                                    <i class='fas fa-trash-alt btn-elim'  data-gal-eli='{$row['idgaleria']}' ></i>
                                </li>
                                <li>
                                    <i class='fas fa-eye btn-vw' data-gal-open='{$row['idgaleria']}' data-gal-albm='{$row['idalbum']}'></i>
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
              <div class='add-img-cd' title='Subir una imágen a mi galería' id='agr-gal'>
                <i class='fas fa-camera'></i>
              </div>
            </div>
        ";
    }

    function loadGalleryView($data){
        $fechaalta = $data[0]['fechaalta'];
        $cambio = strtotime($fechaalta);
        $nuevaFecha = date("Y-m-d", $cambio);
        
        echo
        "
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class= 'modal-body'>
                <div id= 'md-contain-img'>
                    <img src='./dist/img/User/{$data[0]['archivo']}'>
                </div>
            </div>
            <div class='md-footer'>
                <form class='row'>
                    <div class='col-md-2 text-right'>
                        <label>Album:</label>
                    </div>
                    <div class='btn-group col-md-6'>
                        <select id='slc-album-md' class='form-control view-only-img'>
                           
                        </select>
                        <button type='button' class='btn btn-outline-secondary' id='btn-cmb-alb' data-id-gal='{$data[0]['idgaleria']}'>Cambiar</button>
                    </div>
                    <div class='col-md-4 text-right'>
                        <h7 class='font-weight-bold'>$nuevaFecha</h7>
                    </div>
                </form>
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

    if ($_GET['op'] == 'getGalleryModal') {
        $data = $gallery->getAGallery(["idgaleria" => $_GET['idgaleria']]);
        if(count($data) > 0){
           loadGalleryView($data);
        }
    }

    
    if ($_GET['op'] == 'deleteGallery') {
        $data = $gallery->deleteGallery(["idgaleria" => $_GET['idgaleria']]);
    }
    
}

if (isset($_POST['op'])){

    if($_POST['op'] == "registerGalleryPhotos"){

        $idtypefile = $_POST['tipoarchivo'];

        if($idtypefile == 'image/png'){
            $extension = date('YmdhGs') . ".png";
        }else if($idtypefile == 'image/jpeg'){
            $extension = date('YmdhGs') . ".jpg";
        }else{
            $extension = date('YmdhGs') . ".gif";
        }

        $enviard =   
        [   
            "idalbum"       => $_POST['idalbum'],
            "idusuario"     => '1',
            "idtrabajo"     => " ",
            "tipo"          => "F",
            "archivo"       => $extension
        ];

        $data = $gallery->registerGallery($enviard);
        move_uploaded_file($_FILES['archivo']['tmp_name'], "../dist/img/User/" . $extension);
        echo $_FILES['archivo']['tmp_name'];
        echo $extension;
    }

    if($_POST['op'] == "updateGallery"){

        $enviard =   
        [   
            "idgaleria"     => $_POST['idgaleria'],
            "idalbum"       => $_POST['idalbum']
        ];

        $data = $gallery->updateGallery($enviard);
    }
}


?>