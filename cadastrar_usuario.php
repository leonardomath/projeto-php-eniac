<?php require_once 'app/templates/dash_nav_open.php'; ?>
<title>Cadastrar Problema</title>
<?php require_once 'app/templates/dash_nav_close.php'; ?>

<?php
require_once 'app/classes/Usuarios.php';
Usuarios::verifica_sessao();
require_once 'app/templates/nav.php';

if (isset($_POST['nome_cliente'])) {
    $nome_usuario = addslashes($_POST['nome_cliente']);
    $login = addslashes($_POST['login']);
    $tipo_usuario = addslashes($_POST['tipo_usuario']);
    $senha = md5(addslashes($_POST['senha']));
    Usuarios::cadastra_usuario($nome_usuario,$login,$senha,$tipo_usuario);
}
?>
<?php if(isset($_GET['success'])): ?>
    <div class="notification is-success">
        Usúario cadastrado
    </div>
<?php endif; ?>
<div class="container">
    <form method="post">
        <h1 class="title">Novo usúario</h1>
        <input class="input" type="text" name="nome_cliente" placeholder="Nome completo" required>
        <input class="input" type="text" name="login" placeholder="Login" required>
        <select class="input" name="tipo_usuario" required>
            <option value="" selected disabled>Selecione o tipo de conta</option>
            <option value="0">Administrador</option>
            <option value="1">Tecnico</option>
        </select>
        <input class="input" type="password" name="senha" placeholder="Senha" required>
        <button class="button is-info" type="submit">Cadastrar</button>
    </form>
</div>
