<?php
class Koneksi
{
    public static function get_connection() 
    {
        try 
        {
            $db_handler = new PDO("mysql:host=localhost;dbname=skripsi", "root", "");
            $db_handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db_handler;
        } 
        catch (PDOException $e) 
        {
            echo $e -> getMessage();
            die();
        }	
    }
}
?>
