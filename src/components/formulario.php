<?php
$nombres = $_POST['nombres'];
$paterno = $_POST['paterno'];
$materno = $_POST['materno'];
$rut = $_POST['rut'];
$edad = $_POST['edad'];
$sexo = $_POST['sexo'];
$medico = $_POST['medico'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$email = $_POST['email'];

if (!empty($nombres) || !empty($paterno) || !empty($materno) || !empty($rut) || !empty($edad) || !empty($nombres) || !empty($sexo) || !empty($medico) || !empty($fecha) || !empty($hora) || !empty($email)) {
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "bddpractica";

    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

    if (mysqli_connect_error()) {
        die('Connect Error(' . mysqli_connect_errno() . ')' . mysqli_connect_error());
    } else {
        $SELECT = "SELECT email FROM consultas WHERE email = ? Limit 1";
        $INSERT = "INSERT INTO consultas (nombres, paterno, materno, rut, edad, sexo, medico, fecha, hora, email) values(?,?,?,?,?,?,?,?,?,?)";

        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if ($rnum == 0) {
            $stmt->close();

            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("ssssisssss", $nombres, $paterno, $materno, $rut, $edad, $sexo, $medico, $fecha, $hora, $email);
            $stmt->execute();
            echo "Se ha insertado correctamente";
        } else {
            echo "Alguien ya existe con este correo";
        }
        $stmt->close();
        $conn->close();
    }
} else {
    echo "Todos los campos son necesarios";
    die();
}
