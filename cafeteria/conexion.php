
<?php
function conectar(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cafeteria";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("La conexión falló: " . $conn->connect_error);
    }else{
        //echo "La conexión a la base de datos ha sido exitosa <br><br><br>";
        return $conn;
    }
}
?>