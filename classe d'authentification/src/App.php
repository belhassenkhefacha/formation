<?php
namespace App;
class App 
{
    public static $pdo;
    public static $auth;
    public static function getPDO(): \PDO 
    {
        if (!self::$pdo) {
            self::$pdo = new \PDO('mysql:host=localhost;dbname=exercice', 'root', '', [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            ]);
        }
    return self::$pdo;
    }


    public  static function getAuth():Auth 
    {
        if(!self::$auth)
        {
            self::$auth=new Auth(self::getPDO(),'/login.php');
        }
        return self::$auth;
    }
}
?>