<?php

    class Home extends Controller
    {
        public function index($name="")
        {
          $user =  $this->model('User');
          $user->name = $name;
          //echo $user->name;
            //var_dump($user->studenr_one);
          $this->view('home/employee-portal', ['name'=>$user->name]);
        }

    }
