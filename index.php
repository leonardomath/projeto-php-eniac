<?php require_once 'app/templates/head.php' ?>
<?php
	if(isset($_POST['login']) && isset($_POST['senha'])) {
        require_once('app/classes/Usuarios.php');

        $login = addslashes($_POST['login']);
        $senha = md5(addslashes($_POST['senha']));

        if (!Usuarios::login($login, $senha)) {
            echo '<h1 class="notification is-danger">Usúario ou senha errada.</h1>';
		}
    }
	?>

<div class="box-login">
	<form method="POST">
		<h1 class="title">PhoneTech</h1>
		<h2>Entrar no sistema</h2>
		<input class="input" type="text" name="login" placeholder="Usúario">
		<input class="input" type="password" name="senha" placeholder="Senha">
		<button class="button is-info" type="submit">Entrar</button>
	</form>
</div>

<?php require_once 'app/templates/footer.php' ?>

