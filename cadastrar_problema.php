<?php require_once 'app/templates/dash_nav_open.php'; ?>
<title>Cadastrar Problema</title>
<?php require_once 'app/templates/dash_nav_close.php'; ?>
<?php
require_once 'app/classes/Usuarios.php';
require_once 'app/classes/SmartPhone.php';
Usuarios::verifica_sessao();
require_once 'app/templates/nav.php';

if (isset($_POST['nome_cliente'])) {
    $nome_cliente = addslashes($_POST['nome_cliente']);
    $numero_cliente = addslashes($_POST['numero_cliente']);
    $cpf = addslashes($_POST['cpf']);
    $marca_smarthpone = addslashes($_POST['marca_smarthpone']);
    $marca_smarthpone = addslashes($_POST['marca_smarthpone']);
    $tipo_problema = addslashes($_POST['tipo_problema']);
    $descricao_problema = addslashes($_POST['descricao_problema']);
    SmartPhone::novo_relatorio($nome_cliente,$numero_cliente,$cpf,$marca_smarthpone,$tipo_problema,$descricao_problema);
}
?>
<?php if(isset($_GET['success'])): ?>
    <div class="notification is-success">
        Relatório cadastrado
    </div>
<?php endif; ?>
<div class="container">
    <form method="post">
        <h1 class="title">Novo relatório</h1>
        <input class="input" type="text" name="nome_cliente" placeholder="Nome do cliente" required>
        <input class="input phone_with_ddd" type="text" name="numero_cliente" placeholder="Número do telefone" required>
        <input class="input cpf" type="text" name="cpf" placeholder="CPF" required>
        <input class="input" type="text" name="marca_smarthpone" placeholder="Marca do Smartphone" required>
        <input class="input" type="text" name="tipo_problema" placeholder="Tipo do problema" required>
        <textarea class="textarea text-capitalize" name="descricao_problema" placeholder="Descrição do problema" required></textarea>
        <button class="button is-info" type="submit">Cadastrar</button>
    </form>
</div>

<script src="app/templates/js/jquery.js"></script>
<script src="app/templates/js/jquery.mask.min.js"></script>
<script src="app/templates/js/formatar_inputs.js"></script>