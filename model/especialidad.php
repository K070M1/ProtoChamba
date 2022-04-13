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

    /* //Funcion para listar las redes sociales de los usuarios y asiganrles cada uno 
    public function getSocialNetwork(array $data){
        try{
           return parent::execProcedure($data,"spu_redessociales_filtrar_usuario",true);
        }
        catch(Exception $error){
            die($error->getMessage());
        }
    } */



}

?>