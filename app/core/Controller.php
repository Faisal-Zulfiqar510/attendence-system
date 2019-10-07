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
 }
