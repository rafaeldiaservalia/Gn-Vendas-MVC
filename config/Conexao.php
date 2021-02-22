<?php

class Conexao
{
    protected static $conn;

    private function __construct()
    {
        $db_host = "localhost";
        $db_nome = "GN_VENDAS";
        $db_usuario = "root";
        $db_senha = "";
        $db_driver = "mysql";
        
        try
        {
            self::$conn = new PDO("$db_driver:host=$db_host; dbname=$db_nome", $db_usuario, $db_senha);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$conn->exec('SET NAMES utf8');
        }
        catch (PDOException $e)
        {
            die("Connection Error: " . $e->getMessage());
        }
    }
    
    public static function conectar()
    {
        if (!self::$conn)
        {
            new Conexao();
        }
        return self::$conn;
    }

}