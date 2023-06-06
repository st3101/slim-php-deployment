<?php
include "Helado.php";

$sabor = $_POST["sabor"];
$precio = $_POST["precio"];
$tipo = $_POST["tipo"];
$vaso = $_POST["vaso"];
$stock = $_POST["stock"];

if($sabor != null && $precio != null && $tipo != null && $stock)
{
    $arrayHelado = Helado::cargarJson("helados.json");

    $helado = new Helado($sabor,$precio,$tipo,$vaso,$stock);
    
    $arrayHelado = Helado::add($arrayHelado,$helado);

    if(Helado::guardarArrayJson("helados.json",$arrayHelado))
    {
        Helado::guardarImagen("ImagenesDeHelados/2023/",$sabor,$tipo);
    }
}
?>