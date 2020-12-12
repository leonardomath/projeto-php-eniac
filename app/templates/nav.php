<?php @session_start() ?>
<nav class="is-danger">
    <ul>
        <div class="usuario-logado">
            <li class="badge badge-light">Logado no usúario <?=$_SESSION['nome_usuario']?></li>
        </div>
        <div class="opcoes">
            <?php if($_SESSION['tipo_usuario'] == 0): ?>
                <a href="dashboard.php"><li>Procurar relatório</li></a>
                <a href="cadastrar_problema.php"><li>Cadastrar novo relatório</li></a>
            <?php endif; ?>
            <a href="historico_relatorios.php"><li>Histórico de relatórios</li></a>
            <a href="ralatorios_finalizados.php"><li>Relatórios finalizados</li></a>
            <?php if($_SESSION['tipo_usuario'] == 0): ?>
                <a href="usuarios_sistema.php"><li>Usúarios do sistemas</li></a>
                <a href="cadastrar_usuario.php"><li>Cadastrar novo usúario</li></a>
            <?php endif; ?>

            <a href="sair.php"><li>Sair</li></a>
        </div>
    </ul>
</nav>