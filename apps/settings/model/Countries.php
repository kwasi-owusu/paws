<?php

require_once '../../template/statics/conn/connection.php';
class Countries
{
    public static function allCountries()
    {
            try {

                $stmt =  Connection::connect()->prepare("SELECT * FROM countries ORDER BY name ASC");
                $stmt->execute();
                
                return $stmt->fetchAll();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
    }
}
