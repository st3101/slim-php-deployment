<?php
include "venta.php";
include "Helado.php";

$mail = $_POST["mail"];
$usuario = $_POST["usuario"];
$sabor = $_POST["sabor"];
$tipo = $_POST["tipo"];
$vaso =$_POST["vaso"];
$stock = $_POST["stock"];

if($mail != null && $usuario != null && $sabor != null && $tipo != null && $stock != null && $vaso)
{
   
    $venta =new venta ($mail,$usuario);
    $arrayHelados= Helado::cargarJson("helados.json");

    if(Helado::venta($arrayHelados,$sabor,$tipo,$stock))
    {  
        $ArrayVenta = Venta::cargarJson("ventas.json");
        array_push($ArrayVenta,$venta);
        Venta::guardarArrayJson("ventas.json",$ArrayVenta);
        Helado::guardarArrayJson("helados.json",$arrayHelados);
        Venta::guardarImagen("ImagenesDeHelados/2023/",$sabor,$tipo,$vaso,$mail);
        echo "Venta exitosa"; 
    }
    else
    {
        echo "Stock insuficiente"; 
    }
    
}
?>