<?php
require_once 'app/classes/SmartPhone.php';

$id_relatorio = addslashes($_GET['id']);
SmartPhone::contatar_cliente($id_relatorio);
