<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Learning Analytics - Eina experimental - UOC - Versió 2.0</title>
<link rel="stylesheet" href="estilosInicio.css" />

</head>

<body style="background-color:#FFF;">

<?php

$contadorMensajesValidos=0;
$contadorMensajesAnteriores=0;
$contadorMensajesPosteriores=0;

$fichero=$_POST["fichero"];
$fechaInicio=strtotime(str_replace('-', '/',$_POST["fecha1"]));
$fechaFin=strtotime(str_replace('-', '/',$_POST["fecha2"]));

function limpiarDir($dir)
{
foreach(glob("debates/seleccionado/*") as $archivos_carpeta)
{
//si no es un directorio lo eliminamos 
if (!is_dir($archivos_carpeta))
unlink($archivos_carpeta);
} 
return 0;
}


?>

<div align="center">

<p style="font-size:12px;"><br/>
<strong>DESCOMPRIMINT MISSATGES</strong><br/>
Arxiu: <?php echo $fichero; ?>

</p>


<?php

limpiarDir($fichero);

//Creamos un objeto de la clase ZipArchive()
$enzipado = new ZipArchive();
 
//Abrimos el archivo a descomprimir
$enzipado->open("./debates/".$fichero);

//Extraemos el contenido del archivo dentro de la carpeta especificada
$extraido = $enzipado->extractTo("./debates/seleccionado/");

if($extraido == FALSE){
 echo '- Ocurrió un error y el archivo no se pudo descomprimir -';
}


$contador=0;
$directorio = opendir("./debates/seleccionado/"); // Cargamos el directorio

while ($archivos = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
{
	if (!is_dir($archivos)) //Verificamos si es o no un directorio
    {
	   $mensaje= fopen("./debates/seleccionado/".$archivos, "r");
	   
	   $linea = fgets($mensaje);
	   // Cogemos la fecha de envío del mensaje
	   while ((utf8_encode(substr($linea,0,5))!="Date:") && (!feof($mensaje))) {
		    $linea = fgets($mensaje);
	   }
	   $fecha=utf8_encode(substr($linea,6,strlen($linea)-8));
	   $fecha=strtotime($fecha);

	   if (($fecha<$fechaInicio) || ($fecha>($fechaFin)+86400)){
		   unlink("./debates/seleccionado/".$archivos);
		   $contador++;
		   if ($fecha<$fechaInicio) {
			   $contadorMensajesAnteriores++;
		   } else {
			   $contadorMensajesPosteriores++;
		   }
	   } else {
		   $contadorMensajesValidos++;
	   }
	   fclose($mensaje);

	}
}


echo "<img src=\"http://chart.apis.google.com/chart?chs=400x100&amp;chd=t:".$contadorMensajesAnteriores.",".$contadorMensajesValidos.",".$contadorMensajesPosteriores."&amp;cht=p3&amp;chl=".$contadorMensajesAnteriores."|".$contadorMensajesValidos."|".$contadorMensajesPosteriores."&amp;&chco=FFFF00CC,00FF00,FF0000CC&chdl=Missatges anteriors descartats|Missatges vàlids|Missatges posteriors descartats&chdlp=r\" width=\"400\" height=\"100\">";

?>

<p>
<a href="http://www.paucasals.com/missatgesUOC" target="_top"><input type="button" value="Cancel·lar"></a>

<?php

echo "<a href=\"http://www.paucasals.com/missatgesUOC/analisis.php?carpeta=debates/seleccionado&fecha1=".$fechaInicio."&fecha2=".$fechaFin."\" target=\"_top\"><input type=\"button\" value=\"Mostrar anàlisis\">";
?>
</p>

</div>

</body>
</html>