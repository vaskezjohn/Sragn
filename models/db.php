<?php
class Database
{

	private static $dbHost = 'localhost';
    public static $dbUsername = 'root';
    public static $dbPassword = '';
    public static $dbName = 'sragn';

    public static function Conectar()
    {
        $pdo = new PDO('mysql:host='.self::$dbHost.';dbname='.self::$dbName.';charset=utf8',self::$dbUsername, '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        return $pdo;
    }
}
?>