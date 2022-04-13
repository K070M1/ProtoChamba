<?php 

require_once '../model/Album.php';

$album = new Album();


if (isset($_GET['op'])){

<<<<<<< HEAD
    function loadAlbum($data){
        if(count($data) > 0){
            foreach($data as $row){
                echo
                "
                  <div class='col-md-3 user-cd-img user-cd-albm'>
                        <div class='image-container'>
                            <figure>
                            <img src='./dist/img/photo1.png'>
                            <h4>{$row['nombrealbum']}</h4>
                            <figcaption>
                                <ul>
                                <li>
                                    <i class='fas fa-pen'></i>
                                </li>
                                <li>
                                    <i class='fas fa-trash'></i>
                                </li>
                                <li>
                                    <i class='fas fa-folder-open'></i>
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
              <div class='add-album-cd' title='Crear nuevo album'>
                <i class='fas fa-plus'></i>
              </div>
            </div>
        
        ";
    }

    if($_GET['op'] == 'loadAlbum'){
        $data = $album->getAlbumsByUser(["idusuario" => $_GET['idusuario']]);
        loadAlbum($data);
=======
    if($_GET['op'] == 'loadAlbum'){
        
>>>>>>> ba49a435931508c78705b3942299eda8f2e4aff2
    }

}

?>