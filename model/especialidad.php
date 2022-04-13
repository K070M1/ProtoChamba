<?php

require_once '../core/model.master.php';

class Especialidad extends ModelMaster{

    //Listar los usuarios con especialidades para generar el card
    public function getSpecialty (){
        try{
            return parent::getRows("spu_especialidades_listar");
          }
        catch(Exception $error){
            die($error->getMessage());
        }
    }



}

?>