<?php
session_start();
include '../views/home/base.php';
//require_once($_SERVER['localhost']."../models/DbConfiguration.php");
//require_once ('../models/DbConfiguration.php');
//namespace controllers;
use models\DbConfiguration;


class Home extends Controller
{
    protected $user;

    protected $employee;

    public function __construct()
    {
        $this->user = $this->model('User');
        $this->employee = $this->model('Employee');
    }

    public function index()
    {

        if (isset($_SESSION['developer'])) {
            $this->view('home/employee-portal', ['name' => "nnn"]);
        } elseif (isset($_SESSION['hr'])) {
            $this->view('home/hr-portal', ['name' => "nnn"]);
        } elseif (isset($_SESSION['ceo'])) {
            $this->view('home/ceo-portal', ['name' => "nnn"]);
        } else {
            $this->view('home/index', ['name' => "nnn"]);
        }
    }

    public function login()
    {

        if (isset($_REQUEST['login'])) {
            $user_name = $_POST['userName'];
            $password = $_POST['password'];


            $con = Controller::connectionDB();
            $sql = "SELECT * from cshr.employee where use_name = '$user_name' and password = '$password'";

            $result = $con->query($sql);
            $num = $result->num_rows;
            $row = $result->fetch_assoc();

            if ($num > 0) {
                if ($row['designation'] == "HR") {
                    $_SESSION['hr'] = $user_name;
                    $this->view('home/hr-portal', ['name' => 'faisal']);
                } elseif ($row['designation'] == "Developer") {
                    $_SESSION['developer'] = $user_name;
                    $this->view('home/employee-portal', ['name' => 'faisal']);
                } elseif ($row['designation'] == "Ceo") {
                    $_SESSION['ceo'] = $user_name;
                    $this->view('home/ceo-portal', ['name' => 'faisal']);
                }
            } else {
                $this->view('home/index', ['error' => "Invalid Credentials", 'userName' => $user_name]);
            }
        }
    }

    public function addEmp()
    {
        if (isset($_REQUEST['addEmp'])) {

            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $dept = $_POST['dept'];
            $salary = $_POST['salary'];
            $designation = $_POST['designation'];
            echo $name . "<br>";
            echo $email . "<br>";
            echo $password . "<br>";
            echo $dept . "<br>";
            echo $salary . "<br>";
            echo $designation . "<br>";

            $emp = new $this->employee;
            $emp->name = $name;
            $emp->email = $email;
            $emp->password = $password;
            $emp->dept = $dept;
            $emp->salary = $salary;
            $emp->boss = "Ahsan";
            $emp->designation = $designation;
            $emp->profile_pic = "pic/faisal.jpg";
            $emp->save();

        }

        $this->view('home/index', ['name' => 'faisal']);
    }

    public function emp()
    {
        if (isset($_SESSION['developer'])) {
            $this->view('home/employee-portal', ['name' => "nnn"]);
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: /attendance-system/public/home/index/');
        // $this->view('home/index', ['name' => "nnn"]);
    }

    public function addEmpCeo()
    {
        $this->view('home/empForm', ['name' => "nnn"]);
    }
}

