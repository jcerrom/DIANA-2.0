<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Learning Analytics - Eina experimental - UOC - Versió 2.0</title>
<link rel="stylesheet" href="estilosInicio.css" />
</head>

<body>

<div id="contenedorPrincipal">

<div id="cabecera"><strong>- Learning Analytics - <br />Eina experimental per a l'anàlisi de la interacció comunicativa (Versió: 2.0)<br />Adaptat a les bústies de missatges del campus de la UOC</strong>
</div>

<br />

<div align="center" id="titulo">
<p><strong>- GRUP DE RECERCA -</strong><br />
<img src="img/cabecera.png"  width="150" alt="" align="center" style="border:1px solid black; border-color:#000; -webkit-box-shadow: 5px 5px 10px 0px rgba(0, 0, 255, 0.36);
-moz-box-shadow:    5px 5px 10px 0px rgba(0, 0, 255, 0.36);
box-shadow:         5px 5px 10px 0px rgba(0, 0, 255, 0.36);"/>
</p>

<p>Investigadors/es: Cerro, J.P.; Guitert, M.; Romeu, T.<br />
&copy; 2015-2016 Edul@b. Tots els drets reservats pels autors.<br />
Resolució mínima recomanada: 1.366 x 768 píxels.</p>
</div>

<table id="rejillaPantalla" cols="2" cellpadding="5px" align="center">
<tr>
<td>

<form action="guardarConfiguracion.php" method="post" accept-charset="utf-8" enctype="multipart/form-data">

<div class="solapa" style="width:600px;">
<strong>CONFIGURACIÓ DE L'EINA</strong> - <input type="image" src="img/disco.png" width="20px" style="vertical-align:middle;"> Desar
</div>

<div class="cuadroInferior" style="width:600px;">
<table id="tablaConfiguracion" cols="2" cellpadding="5px">
<tr>
<td><strong>Llista de paraules clau (1 per línia)<br/>o camp semàntic de la conversa:</strong>
<br/>
<textarea name="palabrasClave" cols="30" rows="9" style="resize:none"  />
<?php
$ficheroConfiguracion=fopen("conf.txt","r"); 
$severidad=fgets($ficheroConfiguracion);
$minimo=fgets($ficheroConfiguracion);
$maximo=fgets($ficheroConfiguracion);
$dispersion=fgets($ficheroConfiguracion);
$linea=fgets($ficheroConfiguracion);
while (!feof($ficheroConfiguracion)) {
	echo $linea;
	$linea=fgets($ficheroConfiguracion);
}
fclose($ficheroConfiguracion);
?>
</textarea>
</td>

<td>
- Grau de severitat al control semàntic: <input name="severidad" type="text" maxlength="3" size="3" <?php echo "value='$severidad'"; ?> > %.<br/><br/>
- Mínim de participació: <input name="minimo" type="text" maxlength="2" size="2" <?php echo "value='$minimo'"; ?> > missatges.<br/><br/>
- Màxim de participació: <input name="maximo" type="text" maxlength="2" size="2" <?php echo "value='$maximo'"; ?> > missatges.<br/><br/>
- Grau màxim de dispersió de la conversa: <input name="dispersion" type="text" maxlength="3" size="3" <?php echo "value='$dispersion'"; ?> > %.
</td>

</tr>
</table>
</div>
</form>

</td>

<td style="vertical-align:top;">

<form action="guardarEstudiantes.php" method="post" accept-charset="utf-8" enctype="multipart/form-data">

<div class="solapa" style="width:300px;">
<strong>LLISTAT D'ESTUDIANTS</strong> - <input type="image" src="img/disco.png" width="20px" style="vertical-align:middle;"> Desar</div>

<div class="cuadroInferior" style="width:300px; height:181px; alignment-adjust:central">
<textarea name="estudiantes" cols="39" rows="11" style="resize:none; font-size:12px;"  />
<?php
$ficheroEstudiantes=fopen("estudiantes.txt","r"); 
$linea=fgets($ficheroEstudiantes);
while (!feof($ficheroEstudiantes)) {
	echo $linea;
	$linea=fgets($ficheroEstudiantes);
}
fclose($ficheroEstudiantes);
?>
</textarea>
</div>
</form>


</td>
</tr>

<tr>
<td>

<div class="solapa" style="width:600px;">
<strong>SELECCIÓ DE LA CONVERSA A ANÀLITZAR</strong></div>

<div class="cuadroInferior" style="width:600px; font-size:12px;">

<br />
    <form action="upload.php" method="post" accept-charset="utf-8" enctype="multipart/form-data">
         <strong><em>PUJADA DE CONVERSES:</em></strong><br/><blockquote>
         1.- Selecciona el fitxer comprimit amb els missatges<br />
        <blockquote><input type="file" name="userfile[]" /></blockquote>
        2.- i prem el botó 
        <input type="submit" value="Carregar al servidor" /></blockquote>
    </form>

<strong><em>CONVERSES CARREGADES:</em> (Selecciona una conversa per ser analitzada)</strong><br/><br/>

<form action="descomprimir.php" method="post" enctype="application/x-www-form-urlencoded" name="debates" target="precarga">

<table style="margin:0px 0px 10px 20px;">

<?php 

$directorio = opendir("./debates/"); // Cargamos el directorio

// VAMOS A INSPECCIONAR LOS DIRECTORIOS CON LOS DEBATES CARGADOS

while ($archivos = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
{
	if (!is_dir($archivos)  && (strtolower(end(explode(".",$archivos)))=="zip")) //Verificamos si es o no un directorio y un ZIP
    {
		echo "<tr><td style=\"width:auto; font-size:12px;\"> <input style=\"vertical-align:middle; margin:4px 4px 4px 4px;\" type=\"radio\" name=\"fichero\" value=\"".$archivos."\" required> ".$archivos."</td><td style=\"width:100px;\">&nbsp;<a href=\"eliminar_fichero.php?fichero=".$archivos."\"><img src=\"img/papelera.png\" width=\"20\"></a></td></tr>";
	}
}
?>

</table>

</td>

<td style="vertical-align:top;">


<div class="solapa" style="width:300px;">
<strong>PARÁMETRES DE L'ANÀLISI</strong></div>

<div class="cuadroInferior" style="width:300px; height:auto;  font-size:12px;">
<table width="300" cols="2" style="font-size:12px;">
<tr>
<td align="center" width="50%"><img src="img/calendario.png"><br />Data d'inici<input type="date" name="fecha1" placeholder="dd/mm/aaaa" required /></td>
<td align="center" width="50%"><img src="img/calendario.png"><br />Data de finalització<input type="date" name="fecha2" placeholder="dd/mm/aaaa" required /></td>
</tr>
<tr>
<td align="center" colspan="2" height="150"><br/><input type="image" src="img/play.png" onClick="document.getElementById('contenedorPrecarga').style.visibility='visible';"><br/><strong>ANALITZAR</strong></td>
</tr>
</table>

</div>
</form>


</td>


</tr>
</table>


</div>

<div id="contenedorPrecarga" style="visibility:hidden;" >
<iframe name="precarga" width="500" height="200" style="background-color:#FFF;" marginwidth="0" marginheight="0" frameborder="0" scrolling="no">

</iframe>

</div>


</body>
</html>