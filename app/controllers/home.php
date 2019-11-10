<?php
session_start();
include '../views/home/base.php';
require '../../PHPMailer/class.phpmailer.php';
require '../../PHPMailer/class.smtp.php';
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
        /*$this->user = $this->model('User');
        $this->employee = $this->model('Employee')*/;
    }

    public function index()
    {
        //var_dump($emp);
       // var_dump(23);
        $con = Controller::connectionDB();
        //var_dump(23);die;
        $sql1 = "SELECT * FROM cshr.employee where status =1";
        $result1 = $con->query($sql1);
        $rows = mysqli_fetch_all($result1,MYSQLI_ASSOC);

        if (isset($_GET['id'])){
            $id =  $_GET['id'];
            $sql = "SELECT * FROM cshr.employee where id = '$id'";
            $result = $con->query($sql);
            $row = $result->fetch_assoc();

            $date = date('Y/m/d');
            $sql2 = "SELECT * FROM cshr.attendance where emp_id = '$id' and date = '$date'";
            $result2 = $con->query($sql2);
            $row2 = $result2->fetch_assoc();

        }

        if (isset($_SESSION['developer'])) {
            $this->view('home/employee-portal', ['book' => $row , 'book1' => $row2]);
        } elseif (isset($_SESSION['hr'])) {
            $this->view('home/hr-portal', ['book' => $rows]);
        } elseif (isset($_SESSION['ceo'])) {
            $this->view('home/ceo-portal', ['book' => $rows]);
        } else {
            $this->view('home/index', ['name' => "nnn"]);
        }
    }

    public function login()
    {

        if (isset($_REQUEST['login'])) {
            $user_name = $_POST['username'];
            $password = $_POST['password'];


            $con = Controller::connectionDB();
            $sql = "SELECT * from cshr.employee where username = '$user_name' and password = '$password' and status = 1";
            $result = $con->query($sql);
            $num = $result->num_rows;
            $row = $result->fetch_assoc();


            $sql1 = "SELECT * FROM cshr.employee where status =1";
            $result1 = $con->query($sql1);
            $num1 = $result1->num_rows;
            $rows = mysqli_fetch_all($result1,MYSQLI_ASSOC);

            $userId = $row['id'];

            $date = date('Y/m/d');
            $sql2 = "SELECT * FROM cshr.attendance where date = '$date' and emp_id = '$userId'";
            $result2 = $con->query($sql2);
            $num2 = $result2->num_rows;
            $row2 = $result2->fetch_assoc();

            if ($num > 0) {
                if ($row['designation'] == "HR") {
                    $_SESSION['hr'] = $user_name;
                    $this->view('home/hr-portal', ['book' => $rows]);
                } elseif ($row['designation'] == "Developer") {
                    $_SESSION['developer'] = $user_name;
                    $this->view('home/employee-portal', ['book'=>$row,'book1' =>$row2]);
                } elseif ($row['designation'] == "Ceo") {
                    $_SESSION['ceo'] = $user_name;
                    $this->view('home/ceo-portal', ['book'=>$rows]);
                }
            } else {
                $this->view('home/index', ['error' => "Invalid Credentials", 'userName' => $user_name]);
            }
        }
    }

    public function addEmp()
    {
        $con = Controller::connectionDB();
        if (isset($_REQUEST['addEmp'])) {

            $name = $_POST['name'];
            $username = $_POST['user_name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $dept = $_POST['dept'];
            $salary = $_POST['salary'];
            $designation = $_POST['designation'];
            $manager = $_POST['manager'];
            echo $name . "<br>";
            echo $email . "<br>";
            echo $password . "<br>";
            echo $dept . "<br>";
            echo $salary . "<br>";
            echo $designation . "<br>";

            $file_name = $_FILES['image']['name'];
            $ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $image = strtotime("now") . $username .".". $ext;

            $target = "../app/uploadedPic/".basename($image );
            move_uploaded_file($_FILES['image']['tmp_name'], $target);


            $sql = "INSERT INTO cshr.employee (username, name, password, email, dept, salary, manager, designation, profile_pic)
            VALUES ('$username', '$name', '$password' , '$email' , '$dept' , '$salary' ,  '$manager' , '$designation' , '$image')";

            if (mysqli_query($con, $sql)) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }

            header('Location: /attendance-system/public/home/index/');
        }


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
        $con = Controller::connectionDB();
        $sql = "SELECT * FROM cshr.employee where status =1 and designation = 'Manager'";
        $result = $con->query($sql);
        $manager = mysqli_fetch_all($result,MYSQLI_ASSOC);

        $this->view('home/empForm', ['col'=>$manager]);
    }

    public function delEmp($val)
    {

        $id = $val;
        $con = Controller::connectionDB();
        $sql1 = "UPDATE cshr.employee
        SET status = 0
        WHERE id = '$id'";
        mysqli_query($con, $sql1);

        header('Location: /attendance-system/public/home/index/');

    }

    public function editEmp($val)
    {

        $con = Controller::connectionDB();
        $sql1 = "SELECT * FROM cshr.employee where id = $val and status =1";
        $result1 = $con->query($sql1);
        $rows = $result1->fetch_assoc();

        $sql = "SELECT * FROM cshr.employee where status =1 and designation = 'Manager'";
        $result = $con->query($sql);
        $manager = mysqli_fetch_all($result,MYSQLI_ASSOC);

        $_SESSION['status'] = 'yes';
        $this->view('home/empForm', ['column'=>$rows,'col'=>$manager]);
    }


    public function updateEmp()
    {
        $con = Controller::connectionDB();

        if (isset($_REQUEST['updateEmp'])) {

            $id = $_POST['id'];
            $name = $_POST['name'];
            $username = $_POST['user_name'];
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

            $file_name = $_FILES['image']['name'];
            $ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $image = strtotime("now") . $username .".". $ext;

            $target = "../app/uploadedPic/".basename($image );
            //move_uploaded_file($_FILES['image']['tmp_name'], $target);


            if(isset($file_name) and $file_name !="") {
                move_uploaded_file($_FILES['image']['tmp_name'], $target);

                $sql = "UPDATE cshr.employee
            SET username = '$username' , name = '$name' , password = '$password' , profile_pic = '$image' , email = '$email' 
            , dept = '$dept' , salary = '$salary' , manager = 'khan' , designation = '$designation'
            Where id = '$id'";
                if (mysqli_query($con, $sql)) {
                    echo "Record updated successfully";
                    header('Location: /attendance-system/public/home/index/');
                } else {
                    echo "Error updating record: " . mysqli_error($con);
                }


            }
            else{
                $sql = "UPDATE cshr.employee
            SET name = '$name' , username = '$username' , password = '$password' , email = '$email' 
            , dept = '$dept' , salary = '$salary' , manager = 'khan' , designation = '$designation'
            Where id = '$id'";
                if (mysqli_query($con, $sql)) {
                    echo "Record updated successfully";
                    header('Location: /attendance-system/public/home/index/');
                } else {
                    echo "Error updating record: " . mysqli_error($con);
                }
            }
        }
    }

    public function saveAttendance()
    {
        if (isset($_POST['save-btn'])) {
            $con = Controller::connectionDB();
            $time_in = $_POST['time-in'];
            $time_out = $_POST['time-out'];
            $date = date('Y.m.d');
            $id_row = $_POST['id'];
            $status = 1;
            $getHour = explode(":",$time_in);

            if ($getHour[0]>11) {

                $status = 2;
            }

            if (empty($time_out)) {
                $sql = "INSERT INTO cshr.attendance (Time_in, Time_out, status, emp_id , date)
            VALUES ('$time_in', '$time_out', '$status' , '$id_row' , '$date')";
                mysqli_query($con, $sql);
                header("Location: /attendance-system/public/home/index/?id=".$id_row);

            } elseif (!(empty($time_out))) {


               // echo "hello";die();
                $con1 = Controller::connectionDB();
                $sql2 = mysqli_query("select Time_in from cshr.attendance WHERE emp_id='$id_row' and date ='$date'");

                if ($sql2->num_rows>0) {
                    $sql1 = "UPDATE cshr.attendance SET Time_out='$time_out' WHERE emp_id='$id_row' and date ='$date'";
                    mysqli_query($con1, $sql1);
                    header("Location: /attendance-system/public/home/index/?id=" . $id_row);
                } else {
                    $sql = "INSERT INTO cshr.attendance (Time_in, Time_out, status, emp_id , date)
                VALUES ('$time_in', '$time_out', '$status' , '$id_row' , '$date')";
                    mysqli_query($con1, $sql);
                    header("Location: /attendance-system/public/home/index/?id=" . $id_row);
                }

            }

        }
    }

    public function mail()
    {
        $con = Controller::connectionDB();
        $sql = "select cshr.employee.email from employee where employee.id not in (select cshr.attendance.emp_id from attendance where attendance.date = curdate()) and status=1 and employee.designation = 'Developer'";
        $result1 = $con->query($sql);
        $num1 = $result1->num_rows;
        $rows = mysqli_fetch_all($result1,MYSQLI_ASSOC);
       // print_r($rows);

        foreach ($rows as $rows_email) {
            $reciever = $rows_email['email'];
            $mail = new PHPMailer;
            $mail->setFrom('admin@example.com');
            $mail->addAddress($reciever);
            $mail->Subject = 'Mark Attendance';
            $mail->Body = 'Hello! Kindly mark your Attendance';
            $mail->IsSMTP();
            $mail->SMTPSecure = 'ssl';
            $mail->Host = 'ssl://smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Port = 465;

            //Set your existing gmail address as user name
            $mail->Username = 'faisalch43@gmail.com';

            //Set the password of your gmail address here
            $mail->Password = 'f20433947Z';
            if (!$mail->send()) {
                echo 'Email is not sent.';
                echo 'Email error: ' . $mail->ErrorInfo;
            } else {
                echo 'Email has been sent.';
            }
        }
    }


    public function markAbsent()
    {
        $con = Controller::connectionDB();
        $sql = "select cshr.employee.id from employee where employee.id not in (select cshr.attendance.emp_id from attendance where attendance.date = curdate()) and status=1 and employee.designation = 'Developer'";
        $result1 = $con->query($sql);
        $num1 = $result1->num_rows;
        $rows = mysqli_fetch_all($result1,MYSQLI_ASSOC);
        //print_r($rows);
        foreach ($rows as $row_id)
        {
            $id = $row_id['id'];
            $date = date('Y/m/d');
            $sql1 = "INSERT INTO cshr.attendance (emp_id, status, date)
VALUES ('$id', 0, '$date')";

            if (mysqli_query($con, $sql1)) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
        }
    }

    public function viewReport()
    {

        $con = Controller::connectionDB();
        $sql = "select * from cshr.attendance where status = 0 or status = 2 ";
        $result = $con->query($sql);
        $num1 = $result->num_rows;
        $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
        $i=0;
        foreach ($rows as $row)
        {
            $id = $row['emp_id'];
            //echo $id;
            $sql1 = "select * from cshr.employee where employee.id = '$id'";
            $result1 = $con->query($sql1);
            $num = $result1->num_rows;
            $rows1 = mysqli_fetch_all($result1,MYSQLI_ASSOC);
            foreach ($rows1 as $r)
            {
                $data[$r['id']] =  $r['name'];
            }
        }
        $this->view('home/viewReport', ['att'=>$rows,'emp'=>$data]);
    }
}

