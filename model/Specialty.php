<?php

require_once '../core/model.master.php';

class Specialty extends ModelMaster{

    //Listar los usuarios con especialidades para generar el card
    public function getSpecialty (){
        try{
            return parent::getRows("spu_especialidades_listar");
          }
        catch(Exception $error){
            die($error->getMessage());
        }
    }

    // Listar por servicio
    public function getSpecialtyByService(array $data){
        try{
           return parent::execProcedure($data,"spu_especialidades_listar_servicio",true);
        }
        catch(Exception $error){
            die($error->getMessage());
        }
    }

    // Listar por id de usuario
    public function getSpecialtyByUser(array $data){
        try{
           return parent::execProcedure($data,"spu_especialidades_listar_usuario",true);
        }
        catch(Exception $error){
            die($error->getMessage());
        }
    }


    //Filtrar por los servicios dentro de las especialidades
    public function filterSpecialty(array $data){
        try{
            return parent::execProcedure($data,"spu_filtrar_especialidadynombres",true);
         }
         catch(Exception $error){
             die($error->getMessage());
         }
    }

    public function filterService(array $data){
        try{
            return parent::execProcedure($data,"spu_filtrar_nombresservice",true);
         }
         catch(Exception $error){
             die($error->getMessage());
         }
    }

    public function filterTarifas(array $data){
        try{
            return parent::execProcedure($data,"spu_filtrar_tarifas",true);
         }
         catch(Exception $error){
             die($error->getMessage());
         }
    }
}

?>