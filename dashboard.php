<?php require_once 'app/templates/dash_nav_open.php'; ?>
<title>Cadastrar Problema</title>
<?php require_once 'app/templates/dash_nav_close.php'; ?>

<?php
require_once 'app/classes/Usuarios.php';
require_once 'app/classes/SmartPhone.php';
Usuarios::verifica_sessao();
require_once 'app/templates/nav.php';

if (isset($_POST['cpf'])) {
    $cpf = addslashes($_POST['cpf']);
    $relatorio = SmartPhone::procurar_relatorio($cpf);
}
?>

<div class="search-container">
    <form method="post">
        <input class="cpf input" name="cpf" type="text" placeholder="Procurar relatório com CPF">
        <button class="button is-info" type="submit">Procurar</button>
    </form>
</div>

<div class="container">
    <?php if(isset($relatorio) && !empty($relatorio)): ?>
        <?php foreach ($relatorio as $key => $value) : ?>
            <div class="card">
                <div class="card-header relative" id="headingTwo">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#relatorio<?=$value['0']?>" aria-expanded="false" aria-controls="collapseTwo">
                            <strong>Dono:</strong> <span><?=$value['nome_cliente']?>,</span> <strong>celular:</strong>
                            <span><?=$value['marca']?>,</span> <strong>Data:</strong>
                            <span><?=date("d/m/Y", strtotime($value['data_criado']))?></span>
                        </button>
                        <span class="fl-right"><?= $value['cliente_contatado'] == 1 ? '<button class="button" disabled>Cliente contatado</button>' :
                                '' ?><?= $_SESSION['tipo_usuario'] == '1' ? '<a href="finalizar_chamado.php?id='
                                .$value['0'].'"><button class="button is-success is-outlined">Finalizar</button></a>'
                                : ''
                            ?> <?= $value['data_finalizado'] == 0 ? '<button class="alert alert-warning">Não concluido</button>' : '<button class="alert alert-success">Concluido</button>'?></span>
                    </h5>
                </div>
                <div id="relatorio<?=$value['0']?>" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                        <strong>Descrição do problema:</strong>
                        <p><?=$value['descricao_problema']?></p>

                        <?php if ($value['data_finalizado']): ?>
                            <strong>Teve solução?</strong>
                            <p><?=$value['teve_solucao'] ? '<button class="button is-success is-light">Sim</button>' : '<button class="button is-danger is-light">Não</button>' ?></p>

                            <strong>Comentário do tecnico:</strong>
                            <p><?=$value['comentarios_tecnico']?></p>

                            <strong>Valor concerto:</strong>
                            <p>R$ <?=$value['valor_concerto']?></p>

                            <strong>Data finalizado:</strong>
                            <p><?=date("d/m/Y", strtotime($value['data_finalizado']))?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<script src="app/templates/js/jquery.js"></script>
<script src="app/templates/js/jquery.mask.min.js"></script>
<script src="app/templates/js/bootstrap.min.js"></script>
<script src="app/templates/js/formatar_inputs.js"></script>