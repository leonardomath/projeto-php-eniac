<?php
require_once 'app/classes/Usuarios.php';

if(!isset($_GET['id'])) {
    header('Location: usuarios_sistema.php');
}

$id = addslashes($_GET['id']);
Usuarios::remover_usuario($id);

