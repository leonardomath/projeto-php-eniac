<?php require_once 'app/templates/dash_nav_open.php'; ?>
<title>Usúarios do sistema</title>
<?php require_once 'app/templates/dash_nav_close.php'; ?>

<?php
require_once 'app/classes/Usuarios.php';
require_once 'app/classes/SmartPhone.php';
Usuarios::verifica_sessao();
require_once 'app/templates/nav.php';

$usuarios = Usuarios::usuarios_sistema();
?>

<div class="container">
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <td>Login</td>
                <td>Nome</td>
                <td>Tipo usúario</td>
                <td>Ações</td>
            </tr>
        </thead>
        <tbody>
    <?php
    if($usuarios):
        foreach($usuarios as $key => $value):
    ?>

            <tr>
                <td><?=$value['login']?></td>
                <td><?=$value['nome']?></td>
                <td><?=$value['tipo_usuario'] == 0 ? 'Admistrador' : 'Técnico' ?></td>
                <td>
                    <a href="editar_usuario.php?id=<?=$value['id']?>"><button class="button is-warning">Editar</button></a>
                    <a href="remover_usuario.php?id=<?=$value['id']?>"><button class="button is-danger">Remover</button></a>
                </td>
            </tr>
    <?php
    endforeach;
    endif;
    ?>
        </tbody>
    </table>
</div>
