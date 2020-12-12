<?php

require_once('conexao.php');

class Usuarios {
	static function login($login, $senha) {
		$sql = Conexao::conectar()->prepare("SELECT * FROM usuarios WHERE login = ? AND senha = ?");
		$sql->execute(array($login, $senha));

		if ($sql->rowCount() > 0) {
			$usuario = $sql->fetch();
			session_start();
			$_SESSION['nome_usuario'] = $usuario['nome'];
			$_SESSION['id'] = $usuario['id'];
			$_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];
			header('Location: Dashboard.php');
		} else {
			return false;
		}
	}

	static function cadastra_usuario($nome_usuario, $login, $senha, $tipo_usuario) {
        try {
            $sql = Conexao::conectar()->prepare("INSERT INTO usuarios (nome, login, senha, tipo_usuario) values (?,?,?,?)");
            $sql->execute(array($nome_usuario, $login, $senha, $tipo_usuario));
            header("Location: cadastrar_usuario.php?success");
        } catch (Exception $error) {
            echo $error;
        }

    }

    static function usuarios_sistema() {
	    $id = $_SESSION['id'];
	    $sql = Conexao::conectar()->prepare("SELECT * FROM usuarios WHERE id != ? ORDER BY id ASC");
	    $sql->execute(array($id));
	    if ($sql->rowCount() > 0) {
	        $usuarios = $sql->fetchAll();
        } else {
	        $usuarios = false;
        }
	    return $usuarios;
    }

    static function remover_usuario($id) {
	    $sql = Conexao::conectar()->prepare("DELETE FROM usuarios WHERE id = ?");
	    $sql->execute(array($id));
	    header("Location: usuarios_sistema.php");
    }

    static function atualizar_usuario($id, $nome, $tipo_usuario, $senha) {
        try {
            $sql = Conexao::conectar()->prepare("UPDATE usuarios SET nome = ?, tipo_usuario = ?, senha = ? WHERE id = ?");
            $sql->execute(array($nome, $tipo_usuario, $senha, $id));
            header("Location: editar_usuario.php?id=2&success");
        } catch (Exception $error) {
            echo $error;
        }
    }

    static function dados_de_um_usuarios($id) {
	    $sql = Conexao::conectar()->prepare("SELECT * FROM usuarios WHERE id = ?");
	    $sql->execute(array($id));
	    if($sql->rowCount() > 0) {
	        $usuario = $sql->fetch();
	        return $usuario;
        } else {
	        header("Location: usuarios_sistema.php");
        }
    }

	static function verifica_sessao() {
	    @session_start();
	    if (!$_SESSION['nome_usuario']) {
	        session_destroy();
	        header('Location: index.php');
        }
    }

    static function sair_da_conta() {
	    @session_start();
	    session_destroy();
	    self::verifica_sessao();
    }
}