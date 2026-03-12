<?php
class databaseConnection
{
    private static ?PDO $db = null;

    public static function getDB(array $dbconfig): PDO {
        if(!isset(self::$db)){
            try {
                self::$db = new PDO(
                    $dbconfig["dsn"],
                    $dbconfig["username"],
                    $dbconfig["password"],
                    $dbconfig["options"]
                );
            } catch (PDOException $e){
                die("<div class='content'><div class='error-message'>Connessione fallita: " . $e->getMessage() . "</div></div>");
            }
        }
        return self::$db;
    }
}
?>