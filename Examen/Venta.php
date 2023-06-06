<?php
include_once "id.php";
class Venta
{
    public $_id;
    public $_mail;
    public $_usuario;

    public $_fecha;
    
    public function __construct($mail,$usuario,$id = -1)
    {
        $this->_mail = $mail;
        $this->_usuario = $usuario;
        $this->_fecha =date("d-m-Y");
        if($id == -1)
        {
            $this->_id = ID::LastId("IdVenta.txt",1000);
        }
        else
        {
            $this->_id = $id;
        }
    }

    public static function guardarArrayJson($path,$array)
    {
        try
        {
            $retorno = false;
            $archivo = fopen($path,"w"); 

            if($archivo != null)
            {
                $datosJson = json_encode($array);
    
                if($datosJson != null)
                {
                    fwrite($archivo,$datosJson);
                    $retorno = true;
                }
            }
        }
        catch (Exception $e)
        {
            throw new Exception($e);
        }
        finally
        {
            fclose($archivo);
        }
        return $retorno;
    }

    public static function cargarJson($path)
    {
        try
        {
            $array = array();
            $archivo = fopen($path,"r");
    
            if($archivo != null)
            {
                $datosJson= fread($archivo,filesize($path));
                   
                if($datosJson != null)
                {              
                    $arrayJson = json_decode($datosJson,true);

                    foreach ($arrayJson as $venta)
                    {                        
                       array_push($array,new Venta($venta["_mail"],$venta["_usuario"],$venta["_id"]));                               
                    } 
                }
            }     
        }
        catch(Exception $e)
        {
            echo $e;
        }
        finally
        {
            fclose($archivo);
            return $array;
        }       
    }

    public static function guardarImagen($path,$sabor,$tipo,$vaso,$mail)
    {
        $a = explode('@',$mail);
        $destino =$path.$sabor.$tipo.$vaso.$a[0].".jpg";
        $imagen = "uploads/" .$_FILES["imagen"]["name"];
        move_uploaded_file($_FILES["imagen"]["tmp_name"],$destino);
    }

}


?>