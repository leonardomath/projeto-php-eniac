<?php require_once 'app/templates/dash_nav_open.php'; ?>
<title>Cadastrar Problema</title>
<?php require_once 'app/templates/dash_nav_close.php'; ?>
<?php
require_once 'app/classes/Usuarios.php';
require_once 'app/classes/SmartPhone.php';
Usuarios::verifica_sessao();
require_once 'app/templates/nav.php';
$ralatorio = SmartPhone::procurar_relatorio_por_id($_GET['id']);

if (isset($_POST['teve_solucao'])) {
    $teve_solucao = addslashes($_POST['teve_solucao']);
    $id_relatorio = addslashes($_POST['id_relatorio']);
    $id_tecnico = addslashes($_POST['id_tecnico']);
    $valor_concerto = addslashes($_POST['valor_concerto']);
    $comentario_tecnico = addslashes($_POST['comentario_tecnico']);
    SmartPhone::finalizar_relatorio($id_relatorio,$id_tecnico,$teve_solucao, $valor_concerto, $comentario_tecnico);
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
        <?php foreach ($ralatorio as $key => $value): ?>
        <input class="input" type="text" name="nome_cliente" placeholder="Nome do cliente" required
               value="<?=$value["nome_cliente"]?>" disabled>
        <input class="input phone_with_ddd" type="text" name="numero_cliente" placeholder="Número do telefone"
               value="<?=$value["numero_telefone"]?>" disabled>
        <input class="input cpf" type="text" name="cpf" placeholder="CPF" value="<?=$value["cpf"]?>" disabled>
        <input class="input" type="text" name="marca_smarthpone" placeholder="Marca do Smartphone" value="<?=$value["marca"]?>" disabled>
        <input class="input" type="text" name="tipo_problema" placeholder="Tipo do problema" value="<?=$value["tipo_problema"]?>" disabled>
        <textarea class="textarea text-capitalize" name="descricao_problema" placeholder="Descrição do
        problema" disabled><?=$value["descricao_problema"]?></textarea>
        <input class="input" type="hidden" name="id_relatorio" required
               value="<?=$value["id"]?>">
        <?php endforeach; ?>
        <input class="input" type="hidden" name="id_tecnico" required
               value="<?=$_SESSION["id"]?>">
        <select name="teve_solucao" class="input" style="margin-top: 10px">
            <option value="" disabled selected>Teve solução?</option>
            <option value="1">Sim</option>
            <option value="0">Não</option>
        </select>
        <input class="input money" type="text" placeholder="Valor do concerto"
               name="valor_concerto">
        <textarea class="textarea" name="comentario_tecnico" placeholder="Comentário tecnico"></textarea>
        <button class="button is-success" type="submit">Finalizar chamado</button>
    </form>
</div>

<script src="app/templates/js/jquery.js"></script>
<script src="app/templates/js/jquery.mask.min.js"></script>
<script src="app/templates/js/formatar_inputs.js"></script>