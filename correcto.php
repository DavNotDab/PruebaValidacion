<?php session_start(); $datos = $_SESSION["datos_formulario"];?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserci&oacute;n de vivienda</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <h1>Inserci&oacute;n de vivienda</h1>

    <p>Estos son los datos introducidos:</p>

    <ul>
        <li>Tipo: <?php echo $datos[0];?></li>
        <li>Zona: <?php echo $datos[1];?></li>
        <li>Direcci&oacute;n: <?php echo $datos[2];?></li>
        <li>N&uacute;mero de dormitorios: <?php echo $datos[3];?></li>
        <li>Precio: <?php echo $datos[4];?> €</li>
        <li>Tama&ntilde;o: <?php echo $datos[5];?> metros cuadrados</li>
        <li>Extras: <?php echo $datos[6];?></li>
        <li>Foto: <a href="fotos/<?php echo $datos[7];?>" target="_blank"><?php echo $datos[7];?></a></li>
        <li>Observaciones: <?php echo $datos[8];?></li>
        <li>Beneficio: <?php echo $datos[9];?> €</li>
    </ul>

    <p>[ <a href="./formularioCasa.php">Insertar otra vivienda</a> ]</p>

</body>
</html>

