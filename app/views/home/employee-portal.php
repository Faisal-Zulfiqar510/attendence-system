<?php
session_start();
include "base.php";
if (!isset($_SESSION['developer'])) {
    header('Location: /public/home/index');
}
?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="../../../public/css/style-for-employee.css">

    <title>Employee</title>

</head>
<body>
<div class="header_emp">
   <h3>Welcome to Employee portal</h3>
</div>

<div>
    <div style="display: inline">
   <label for="name" whit>Name  </label>
    <p>Faisal Zulfiqar</p></div>
    <label for="dept">Dept </label>
    <p>IT</p>
    <label for="designation">Designation </label>
    <p>ASE</p>
</div>

<div id="time-in-out-div" class="text-center">
    <form action="#">
        <div id="time-in-div">
            <input name="time-in" id="time-in" type="time" class="form-control time" >
            <button class="btn btn-time-in btn-light "><i class="fa fa-clock-o"></i></button>
        </div>
        <div id="time-out-div">
            <input name="time-in" id="time-out" type="time" class="form-control time" >
            <button class="btn btn-time-in btn-light "><i class="fa fa-clock-o"></i></button>
        </div>
        <button type="submit" id="btn-save" class="btn btn-outline-primary">Save</button>
    </form>
</div>
</body>
</html>
