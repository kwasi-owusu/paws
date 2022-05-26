<?php

class Connection{
  public static function connect(){
    try {
        $PDO = new PDO("mysql:host=localhost;dbname=emsquare", "square_user", "@@rails_usr+-H+pwd!@@");
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $PDO->exec("set names utf8");

      return $PDO;
    }
    catch(PDOException $e)
    {
      echo "No Connection to Database";
      exit();
    }

  }

}
