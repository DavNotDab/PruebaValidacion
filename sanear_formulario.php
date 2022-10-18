<?php 
    
    function VALIDAR_DIRECCION($cadena) {
        if (strlen($cadena) < 4 || strlen($cadena) > 80) return false;

        $patron= "/^[a-zA-Z0-9\/º.,\s]+$/";
        return preg_match($patron, $cadena) ;

        //if (preg_match("/[^(A-Za-z0-9\./º )]/", $cadena)) return false; // Este preg_match es el que no funciona bien

    }

    function VALIDAR_OBSERVACIONES($cadena) {
        if (strlen($cadena) < 5 || strlen($cadena) > 250)
            return false;

        if (preg_match("[^a-zA-Z0-9\.,-¡!¿? ]", $cadena))
            return false;

        return true;
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Vivienda y zona son checkbox por lo que no hace falta validarlos.

        $vivienda = $_POST["vivienda"];
        $zona = $_POST["zona"];

    // Validamos la dirección.

        if ($_POST["direccion"] != "") {
            $direccion = $_POST["direccion"];
            $direccion_s = filter_var($direccion, FILTER_SANITIZE_STRING);
            $direccion_s = filter_var($direccion_s, FILTER_SANITIZE_SPECIAL_CHARS);
            if (!VALIDAR_DIRECCION($direccion_s))
                $direccion_error = "¡Dirección no válida!";
        }
        else
            $direccion_error = "¡Se requiere la dirección de la vivienda!";
            
    // Validamos el número de dormitorios.

        if (isset($_POST["dormitorios"])) 
            $dormitorios = $_POST["dormitorios"];
        else 
            $dormitorios_error = "¡Selecciona un número de dormitorios!";

    // Validamos el precio de la vivienda.

        if (isset($_POST["precio"])) {
            $precio = $_POST["precio"];
            $precio_s = filter_var($precio, FILTER_SANITIZE_NUMBER_INT);
            if (!filter_var($precio_s, FILTER_VALIDATE_INT) || $precio_s < 1)
                $precio_error = "¡El precio debe ser un valor numérico entero positivo!";
        }
        else
            $precio_error = "¡Se requiere el precio de la vivienda!";

    // Validamos el tamaño de la vivienda.

        if (isset($_POST["tamanio"])) {
            $tamanio = $_POST["tamanio"];
            $tamanio_s = filter_var($tamanio, FILTER_SANITIZE_NUMBER_INT);
            if (!filter_var($tamanio_s, FILTER_VALIDATE_INT) || $tamanio_s < 1)
                $tamanio_error = "¡El tamaño debe ser un valor numérico entero positivo!";
        }
        else
            $tamanio_error = "¡El tamaño debe ser especificado!";
            
    // Tratamos los extras de la vivienda. Se meten en un array y si no hay ninguno el array se machaca con un string.

        $extras = array();
        if (isset($_POST["piscina"])) array_push($extras, $_POST["piscina"]);
        if (isset($_POST["jardin"])) array_push($extras, $_POST["jardin"]);
        if (isset($_POST["garaje"])) array_push($extras, $_POST["garaje"]);

        if (count($extras) != 0) {
            $texto = "";
            foreach ($extras as $extra) {
                $texto.=$extra." ";
            }
            $extras = $texto;
        }
        else
            $extras = "No se ha marcado nigún extra";

    // Validamos la imagen. Comprobamos el tamaño y el tipo y si son correctos la guardamos en nuestra carpeta fotos.

        if (!empty($_FILES["img"]["name"])) {
            $tipos_validos = array("image/png", "image/jpg", "image/jpeg", "image/gif");

            if (in_array($_FILES["img"]["type"], $tipos_validos)) {
                if ($_FILES["img"]["size"] > 100000) header("Location: errorImagen.html");

                else {
                    $img = $_FILES["img"]["name"];

                    if (!is_dir("fotos")) mkdir("fotos", 0777);
                    move_uploaded_file($_FILES["img"]["tmp_name"], "./fotos/".$img);
                }
            }
            else
                $img_error = "El archivo debe ser una imagen!";
        }
        else
            $img_error = "No se ha añadido ninguna imagen!";

    // Validamos las observaciones.

        if($_POST["observaciones"] != "") {
            $observaciones = $_POST["observaciones"];
            $observaciones_s = trim($observaciones);
            $observaciones_s = filter_var($observaciones_s, FILTER_SANITIZE_STRING);
            $observaciones_s = filter_var($observaciones_s, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        else
            $observaciones_s = "No hay observaciones";

    // Si todos los datos son correctos, los guardamos y los mostramos junto al beneficio obtenido.

        if (!isset($direccion_error) && !isset($dormitorios_error) && !isset($precio_error) && !isset($tamanio_error) && !isset($img_error)) {

            $ganancias = array("Centro" => array(30, 35), "Zaidin" => array(25, 28), "Chana" => array(22, 25), 
            "Albaicin" => array(20, 35), "Sacromonte" => array(22, 25), "Realejo" => array(25, 28));

            $tamanio_s <= 100 ? $indice = 0 : $indice = 1;

            $porcentaje_beneficio = $ganancias[$zona][$indice];

            $beneficio = $precio * $porcentaje_beneficio / 100;

            $datos_formulario = array($vivienda, $zona, $direccion_s, $dormitorios, $precio_s, $tamanio_s, $extras, $img, $observaciones_s, $beneficio);

            session_start();

            $_SESSION["datos_formulario"] = $datos_formulario;

            header("Location: correcto.php");

            if (!is_file("datos.txt"))
                touch("datos.txt");
            $archivo = fopen("datos.txt", "a");

            foreach($datos_formulario as $dato) {
                fwrite($archivo, $dato."\n");
            }
        }
            
    }

?>