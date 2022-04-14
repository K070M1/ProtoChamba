<?php 

require_once '../model/Album.php';

$album = new Album();


if (isset($_GET['op'])){

    function loadAlbum($data){
        if(count($data) > 0){
            foreach($data as $row){
                echo
                "
                  <div class='col-md-3 user-cd-img user-cd-albm' >
                        <div class='image-container' >
                            <figure >
                                <img src='./dist/img/photo1.png' >
                                <h4>{$row['nombrealbum']}</h4>
                                <figcaption >
                                    <ul>
                                        <li>
                                            <i class='fas fa-pen btn-modif' data-alb-act='{$row['idalbum']}'></i>
                                        </li>
                                        <li>
                                            <i class='fas fa-trash btn-elim' data-alb-eli='{$row['idalbum']}'></i>
                                        </li>
                                        <li>
                                            <i class='fas fa-folder-open btn-abr' data-alb-open='{$row['idalbum']}' data-alb-open-name='{$row['nombrealbum']}'></i>
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
            <div class='col-md-3' >
              <div class='add-album-cd' title='Crear nuevo album' id='agr-albm' >
                <i class='fas fa-plus' ></i>
              </div>
            </div>
        
        ";
    }

    if($_GET['op'] == 'loadAlbum'){
        $data = $album->getAlbumsByUser(["idusuario" => $_GET['idusuario']]);
        loadAlbum($data);
    }

    if($_GET['op'] == 'deleteAlbum'){
        $data = $album->deleteAlbum(["idalbum" => $_GET['idalbum']]);
    }

    if($_GET['op'] == 'getAlbumDat'){
        $data = $album->getAnAlbum(["idalbum" => $_GET['idalbum']]);
        echo json_encode($data);
    }

}

if(isset($_POST['op'])){
    if($_POST['op'] == "registerAlbum"){
        $enviard =   
        [
            "idusuario"     => '1',
            "nombrealbum"   => $_POST['nombrealbum']
        ];

        $data = $album->registerAlbum($enviard);
    }
}

if(isset($_POST['op'])){
    if($_POST['op'] == "updateAlbum"){
        $enviard =   
        [
            "idalbum"     => $_POST['idalbum'],
            "nombrealbum"   => $_POST['nombrealbum']
        ];

        $data = $album->updateAlbum($enviard);
    }
}

?>