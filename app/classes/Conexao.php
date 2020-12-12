<?php

const HOST = 'localhost';
const USER = 'root';
const PASS = '';
const DBNAME = 'phonetech';

class Conexao {

  private static $conexao;

  public static function conectar() {
    if(self::$conexao == null) {
      try {
        self::$conexao = new PDO('mysql:host='.HOST.';dbname='.DBNAME,USER,PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
      } catch (Exception $e) {
      	echo 'Banco de dados Offline.';
      }
    }
    return self::$conexao;
  }

}
