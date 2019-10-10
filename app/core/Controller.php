<?php
 class Controller
 {
    public function model($model)
    {

        require_once '/var/www/html/attendance-system/app/models/' . $model . '.php';
        return new $model();
    }

    public function view($view , $data = [])
    {
        require_once '/var/www/html/attendance-system/app/views/' . $view . '.php';
    }

     public static function connectionDB()
     {
         $dbhost = "localhost";
         $dbuser = "root";
         $dbpass = "coeus123";
         $db = "cshr";

         $con = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n" . $con->error);
         //echo "<script>console.log('Connection Created')</script>";
         return $con;
     }

 }
