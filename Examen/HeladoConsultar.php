<?php
include "Helado.php";

$sabor = $_POST["sabor"];
$precio = $_POST["precio"];
$tipo = $_POST["tipo"];
$vaso = $_POST["vaso"];
$stock = $_POST["stock"];

if($sabor != null && $precio != null && $tipo != null && $stock)
{
    $helado = new Helado($sabor,$precio,$tipo,$vaso,$stock);

    $arrayHelado = Helado::cargarJson("helados.json");

    echo Helado::existeHelado($arrayHelado,$helado);
}
?>