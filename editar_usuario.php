<?php require_once 'app/templates/dash_nav_open.php'; ?>
    <title>Cadastrar Problema</title>
<?php require_once 'app/templates/dash_nav_close.php'; ?>

<?php
require_once 'app/classes/Usuarios.php';
Usuarios::verifica_sessao();
require_once 'app/templates/nav.php';

$usuario = Usuarios::dados_de_um_usuarios(addslashes($_GET['id']));
if(isset($_POST['nome_usuario'])) {
    $nome_cliente = addslashes($_POST['nome_usuario']);
    $senha = addslashes($_POST['senha']);
    $tipo_usuario = addslashes($_POST['tipo_usuario']);
    Usuarios::atualizar_usuario($_GET['id'], $nome_cliente, $tipo_usuario, $senha);
}
?>
<?php if(isset($_GET['success'])): ?>
    <div class="notification is-success">
        Usúario atualizado
    </div>
<?php endif; ?>
    <div class="container">
        <form method="post">
            <h1>Atualizar usúario</h1>
            <input class="input" type="text" name="nome_usuario" placeholder="Nome completo" value="<?=$usuario['nome']?>" required>
            <input class="input" type="text" name="login" placeholder="Login" value="<?=$usuario['login']?>" disabled>
            <select class="input" name="tipo_usuario">
                <option value="" selected disabled>Selecione o tipo de conta</option>
                <option value="0" <?=$usuario['tipo_usuario'] == 0 ? 'selected' : '' ?>>Administrador</option>
                <option value="1" <?=$usuario['tipo_usuario'] == 1 ? 'selected' : '' ?>>Tecnico</option>
            </select>
            <input class="input" type="password" name="senha" placeholder="Senha" required>
            <button class="button is-info" type="submit">Cadastrar</button>
        </form>
    </div><?php
