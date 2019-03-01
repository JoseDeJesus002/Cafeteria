<?php

session_start();//Si hay una sesión activa mediante inicio de sesión, la activa
unset($_SESSION['session_username']);
session_destroy();//Si hay una sesión activa mediante inicio de sesión, la termina
header("Location: ../index.php");

?>