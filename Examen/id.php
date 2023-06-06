<?php
class Id
{
     public static function LastId($path,$firstId)
     {  
        $retorno = -1;

        $lastId = ID::leerId($path);

        if($lastId != null && file_exists($path))
        {
            $lastId ++;
            
            if(Id::guardarId($path,$lastId))
            {
                $retorno = $lastId;
            }
        }
        else
        {       
            Id::guardarId($path,$firstId);
            $retorno = 0;
            
        }
        return $retorno;
     }

    private static function guardarId($path,$id)
    {
           $retorno = false;

           if($id >= 0)
           {
               
               $archivo = fopen($path, "w"); //borrar lo previo y escribir lo nuevo
                      
               if($archivo != null)
               {
               
                    fwrite($archivo,$id);      
                    $retorno = true;
               }              
               fclose($archivo);
            }
           return $retorno;
    }

    private static function leerId($path)
    {
        $retorno = null;

        if(file_exists($path))
        {
            $archivo = fopen($path,"r");
    
            if($archivo != null)
            {
                while(!feof($archivo))
                {
                    $retorno = fread($archivo,1000);                
                }    
            }     
            fclose($archivo);
        }
        return $retorno;    
    }
}


?>