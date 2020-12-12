<?php
require_once 'app/classes/Conexao.php';

class SmartPhone {
    static function novo_relatorio($nome_cliente, $numero_telefone, $cpf, $marca, $tipo_problema, $descricao_problema) {
        $data = date('Y-m-d');
        try {
            $sql = Conexao::conectar()->prepare("INSERT INTO relatorios_abertos (nome_cliente, numero_telefone, cpf, marca, tipo_problema, descricao_problema, data_criado) values (?,?,?,?,?,?,?)");
            $sql->execute(array($nome_cliente, $numero_telefone, $cpf, $marca, $tipo_problema, $descricao_problema, $data));
            header("Location: cadastrar_problema.php?success");
        } catch (Exception $error) {
            echo $error;
        }
    }

    static function historico_relatorio() {
        try {
            $sql = Conexao::conectar()->prepare("SELECT * FROM relatorios_abertos as abertos LEFT JOIN relatorios_finalizados as finalizados on abertos.id = finalizados.id ORDER BY abertos.id DESC");
            $sql->execute();
            if ($sql->rowCount() > 0) {
                $relatorios = $sql->fetchAll();
            } else {
                $relatorios = false;
            }
            return $relatorios;
        } catch (Exception $error) {
            echo $error;
        }
    }

    static function relatorios_concluidos() {
        try {
            $sql = Conexao::conectar()->prepare("SELECT * FROM relatorios_abertos as abertos INNER JOIN relatorios_finalizados as finalizados on abertos.id = finalizados.id ORDER BY abertos.id DESC");
            $sql->execute();
            if ($sql->rowCount() > 0) {
                $relatorios = $sql->fetchAll();
            } else {
                $relatorios = false;
            }
            return $relatorios;
        } catch (Exception $error) {
            echo $error;
        }
    }

    static function procurar_relatorio($cpf) {
        try {
            $sql = Conexao::conectar()->prepare("SELECT * FROM relatorios_abertos as abertos LEFT JOIN relatorios_finalizados as finalizados on abertos.id = finalizados.id WHERE abertos.cpf = ?");
            $sql->execute(array($cpf));
            if ($sql->rowCount() > 0) {
                $relatorio = $sql->fetchAll();
            } else {
                $relatorio = false;
            }
            return $relatorio;
        } catch (Exception $error) {
            echo $error;
        }
    }

    static function procurar_relatorio_por_id($id) {
        try {
            $sql = Conexao::conectar()->prepare("SELECT * FROM relatorios_abertos WHERE id = ?");
            $sql->execute(array($id));
            if ($sql->rowCount() > 0) {
                $relatorio = $sql->fetchAll();
            } else {
                $relatorio = false;
            }
            return $relatorio;
        } catch (Exception $error) {
            echo $error;
        }
    }

    static function finalizar_relatorio($id_relatorio, $id_tecnico, $teve_solucao, $valor_concerto,
                                        $comentario_tecnico) {
        try {
            $data_finalizado = date('Y-m-d');
            $sql = Conexao::conectar()->prepare("INSERT INTO relatorios_finalizados SET id_relatorio = ?, id_tecnico = ?, teve_solucao = ?, valor_concerto = ?, comentarios_tecnico = ?, data_finalizado = ?");
            $sql->execute(array($id_relatorio, $id_tecnico, $teve_solucao, $valor_concerto, $comentario_tecnico, $data_finalizado));

            header("Location: ralatorios_finalizados.php?success");
        } catch (Exception $error) {
            echo $error;
        }
    }

    static function contatar_cliente($id_finalizado) {
        try {
            $sql = Conexao::conectar()->prepare("UPDATE relatorios_finalizados SET cliente_contatado = 1 WHERE id = ?");
            $sql->execute(array($id_finalizado));
            header("Location: historico_relatorios.php?success");
        } catch (Exception $error) {
            echo $error;
        }
    }

}