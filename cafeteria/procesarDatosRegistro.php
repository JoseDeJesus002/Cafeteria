<?php 
// $resultadoBDado = $_POST['valorCaja1'] + $_POST['valorCaja2']; 

include("conexion.php");
$conexionBD=conectar();

$sqlOcupacion = "";
$sqlOcupacion2 = "";
$idTipoPersona = 1;

switch($_POST['ocupacion']){
    case "alumno":
        $idTipoPersona = 1;
        $sqlOcupacion = "INSERT INTO alumno (idAlumno, matricula, idCarrera) VALUES (";
        $sqlOcupacion2 = "'" . $_POST['matricula'] . "'," . $_POST['carrera'] . ");";
        unset($_POST['matricula']);
        unset($_POST['carrera']);
        break;
    case "docente":
        $idTipoPersona = 2;
        $sqlOcupacion = "INSERT INTO docente (idDocente, issemym) VALUES (";
        $sqlOcupacion2 = "'" . $_POST['issemym'] . "'" . ");";
        unset($_POST['issemym']);
        break;
    case "trabajador":
        $idTipoPersona = 3;
        $sqlOcupacion = "INSERT INTO trabajador (idTrabajador, curp) VALUES (";
        $sqlOcupacion2 = "'" . $_POST['curp'] . "'" . ");";
        unset($_POST['curp']);
        break;
}

unset($_POST['ocupacion']);

$sql = "INSERT INTO persona (" . "idTipoPersona,";
        $valores = ") VALUES (" . $idTipoPersona . ",";

foreach ($_POST as $columna => $valor) {
    $sql = $sql . $columna . ",";
    $valores = $valores . "'" . $valor . "'" . ",";
}
$sql = rtrim($sql, ",");
$valores = rtrim($valores, ",");

$sqlPersona = $sql . $valores . ");";

$resultadoBD = $conexionBD->query($sqlPersona);
if($resultadoBD){
    $resultadoBD = $conexionBD->query("SELECT MAX(idPersona) as id FROM persona;");
    $idPersona = 0;
    while($col = $resultadoBD->fetch_array()) {
        $idPersona = $col[0];
    }
    if($resultadoBD){
        $resultadoBD = $conexionBD->query($sqlOcupacion . $idPersona . ',' . $sqlOcupacion2);

        if(!$resultadoBD){
            echo "El registro falló";
        }else{
            echo "El registro ha sido exitoso";
        }
    }
}
?>
