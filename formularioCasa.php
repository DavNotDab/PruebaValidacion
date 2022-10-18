<?php include "sanear_formulario.php"?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inmobiliaria</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
    Introduzca los datos de la vivienda:
        <fieldset>
            <!--Tipo de vivienda-->

            <label for="vivienda" class="izquierda">Tipo de vivienda:</label>
            <select name="vivienda" id="vivienda">
                <option value="Piso" <?php if(isset($vivienda) && $vivienda == "Piso") echo "selected";?>>Piso</option>
                <option value="Adosado" <?php if(isset($vivienda) && $vivienda == "Adosado") echo "selected";?>>Adosado</option>
                <option value="Chalet" <?php if(isset($vivienda) && $vivienda == "Chalet") echo "selected";?>>Chalet</option>
                <option value="Casa" <?php if(isset($vivienda) && $vivienda == "Casa") echo "selected";?>>Casa</option>
            </select>

            <br>
            <!--Zona de la vivienda-->

            <label for="zona"  class="izquierda">Zona: </label>
            <select name="zona" id="zona">
                <option value="Centro" <?php if(isset($zona) && $zona == "Centro") echo "selected";?>>Centro</option>
                <option value="Zaidin" <?php if(isset($zona) && $zona == "Zaidin") echo "selected";?>>Zaid&iacute;n</option>
                <option value="Chana" <?php if(isset($zona) && $zona == "Chana") echo "selected";?>>Chana</option>
                <option value="Albaicin" <?php if(isset($zona) && $zona == "Albaicin") echo "selected";?>>Albaic&iacute;n</option>
                <option value="Sacromonte" <?php if(isset($zona) && $zona == "Sacromonte") echo "selected";?>>Sacromonte</option>
                <option value="Realejo" <?php if(isset($zona) && $zona == "Realejo") echo "selected";?>>Realejo</option>
            </select>

            <br>
            <!--Dirección de la vivienda-->

            <label for="direccion"  class="izquierda">Direcci&oacute;n: </label>
            <input type="text" name="direccion" value="<?php if(isset($direccion_s) && !isset($direccion_error)) echo strval($direccion_s);?>">

            <br>
            <span class="error"><?php if(isset($direccion_error)) echo strval($direccion_error)."<br>";?></span>

            <!--Dormitorios de la vivienda-->

            <span  class="izquierda"> N&uacute;mero de dormitorios: </span>
            <input type="radio" value="1" name="dormitorios"<?php if(isset($dormitorios) && $dormitorios == "1") echo "checked";?>>
            <label for="1">1</label>
            <input type="radio" value="2" name="dormitorios"<?php if(isset($dormitorios) && $dormitorios == "2") echo "checked";?>>
            <label for="2">2</label>
            <input type="radio" value="3" name="dormitorios"<?php if(isset($dormitorios) && $dormitorios == "3") echo "checked";?>>
            <label for="3">3</label>
            <input type="radio" value="4" name="dormitorios"<?php if(isset($dormitorios) && $dormitorios == "4") echo "checked";?>>
            <label for="4">4</label>
            <input type="radio" value="5" name="dormitorios"<?php if(isset($dormitorios) && $dormitorios == "5") echo "checked";?>>
            <label for="5">5</label>

            <br>
            <span class="error"><?php if(isset($dormitorios_error)) echo strval($dormitorios_error)."<br>";?></span>

            <!--Precio de la vivienda-->

            <label for="precio"  class="izquierda">Precio: </label>
            <input type="text" name="precio" value="<?php if(isset($precio_s) && !isset($precio_error)) echo intval($precio_s);?>"> € 
            
            <br>
            <span class="error"><?php if(isset($precio_error)) echo strval($precio_error)."<br>";?></span>

            <!--Tamaño de la vivienda-->
            
            <label for="tamanio"  class="izquierda">Tama&ntilde;o: </label>
            <input type="text" name="tamanio" value="<?php if(isset($tamanio_s) && !isset($tamanio_error)) echo intval($tamanio_s);?>"> metros Cuadrados 
    
            <br>
            <span class="error"><?php if(isset($tamanio_error)) echo strval($tamanio_error)."<br>";?></span>

            <!--Extras de la vivienda-->
            
            <span  class="izquierda">Extras (marque los que procedan):</span>
            <input type="checkbox" value="piscina" name="piscina" <?php if(isset($_POST["piscina"])) echo "checked";?>>
            <label for="piscina">Piscina</label>

            <input type="checkbox" value="jardin" name="jardin" <?php if(isset($_POST["jardin"])) echo "checked";?>>
            <label for="jardin">Jardin</label>

            <input type="checkbox" value="garaje" name="garaje" <?php if(isset($_POST["garaje"])) echo "checked";?>>
            <label for="garaje">Garaje</label>
            
            <br>
            <!--Imagen de la vivienda-->

            <label for="img" class="izquierda">Foto: </label>
            <input type="file" name="img">
            
            <br>
            <span class="error"><?php if(isset($img_error)) echo strval($img_error)."<br>";?></span>

            <!--Observaciones de la vivienda-->
            
            <div class="observaciones">
                <label for="observaciones" class="izquierda">Observaciones: </label>
                <textarea name="observaciones" cols="50" rows="6"><?php if(isset($observaciones_s) && (!isset($observaciones_error)))echo strval($observaciones_s);?></textarea>
            </div>
            
            <br>
            <span class="error"><?php if(isset($observaciones_error)) echo strval($observaciones_error)."<br>";?></span>

            
            <input type="submit" name="Enviar" value="Insertar Vivienda">
        </fieldset>
    </form>
</body>
</html>