<?php

namespace models;

class DbConfiguration
{
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