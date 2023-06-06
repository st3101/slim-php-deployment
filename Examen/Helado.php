<?php
include_once "id.php";
class Helado
{
    public $_id;
    public $_sabor;
    public $_precio;
    public $_tipo;
    public $_vaso;
    public $_stock;

    public function __construct($sabor,$precio,$tipo,$vaso,$stock,$id = -1)
    {
        $this->_sabor = $sabor;
        $this->_precio = (int)$precio;
        $this->_tipo = $tipo;
        $this->_vaso = $vaso;
        $this->_stock = (int)$stock;

        if($id == -1)
        {
            $this->_id = Id::LastId("idHelado.txt",0);
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

                    foreach ($arrayJson as $helado)
                    {                        
                       array_push($array,new Helado($helado["_sabor"],$helado["_precio"],$helado["_tipo"],$helado["_vaso"],$helado["_stock"],$helado["_id"]));                               
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
    public function actualizarHelado($precio, $stock)
    {
        $retorno = false;

        if($precio  != null && $stock != null)
        {
            $this->_precio = $precio;
            $this->_stock += $stock;
            $retorno = true;
            //echo "$this->_precio";
            echo "$this->_stock";
        }
        return $retorno;
    }

    public function saborIgual($helado)
    {
        if($helado != null)
        {
            if($this->_sabor == $helado->_sabor)
            {
                return true;
            }
        }
        return false;
    }

    public function saborIgualSabor($sabor)
    {
        if($sabor != null)
        {
            if($this->_sabor == $sabor)
            {
                return true;
            }
        }
        return false;
    }
    public function tipoIgualTipo($tipo)
    {
        if($tipo != null)
        {
            if($this->_tipo == $tipo)
            {
                return true;
            }
        }
        return false;
    }
    public function tipoIgual($helado,)
    {
        if($helado != null)
        {
            if($this->_tipo == $helado->_tipo)
            {
                return true;
            }
        }
        return false;
    }

    public static function add($array, $helado)
    {
        $retorno = null;
        if($helado != null)
        {          
            for ($i=0; $i < count($array); $i++) 
            { 
                if($array[$i]->saborIgual($helado) && $array[$i]->tipoIgual($helado))
                {        
                    if($array[$i]->actualizarHelado($helado->_precio,$helado->_stock))
                    {                       
                        $retorno = $array;   
                    }
                }
            }
            if($retorno == null)
            {
                array_push($array,$helado);
                $retorno = $array;   
            }
        }

        return $retorno;
    }

    public static function guardarImagen($path,$sabor,$tipo)
    {
        $destino =$path.$sabor.$tipo.".jpg";
        $imagen = "uploads/" .$_FILES["imagen"]["name"];
        move_uploaded_file($_FILES["imagen"]["tmp_name"],$destino);
    }

    public static function existeHelado($array,$helado)
    {
        $retorno = "No existe el sabor ni el tipo";
        for ($i=0; $i < count($array); $i++) 
        { 
            if($array[$i]->saborIgual($helado) && $array[$i]->tipoIgual($helado))
            {        
                $retorno = "existe";
                break;
            }

            if($array[$i]->saborIgual($helado))
            {
                $retorno = "No existe el tipo";
            }

            if($array[$i]->tipoIgual($helado))
            {
                $retorno = "No existe el Sabor";
            }
        }
        return $retorno;
    }

    public static function venta($array,$sabor,$tipo,$stock)
    {
        if($sabor != null && $tipo != null && null != $stock)
        {
            for ($i=0; $i < count($array); $i++) 
            { 
                if($array[$i]->saborIgualSabor($sabor) && $array[$i]->tipoIgualTipo($tipo))
                {        
                    $cueta = $array[$i]->_stock - $stock;

                    if($cueta >= 0)
                    {
                        $array[$i]->_stock = $array[$i]->_stock - $stock;
                        return true;
                    }
                }
            }
        }
        return false;

    }
}



?>