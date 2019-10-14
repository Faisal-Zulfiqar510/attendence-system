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
    <button id="btnLogout" onclick="window.location.replace('../../home/logout/')" class="btn btn-primary">Logout</button>
</div>

<div>

    <div class="row">
   <label for="name" class="col-3">Name  </label>
        <p id="emp-name" class="col-3"><?php echo $data['book']['name'];?></p></div>
    <div class="row">
    <label for="dept" class="col-3">Dept </label>
    <p id="emp-dept" class="col-3"><?php echo $data['book']['dept'];?></p></div>
    <div class="row">
    <label for="designation" class="col-3">Designation </label>
    <p id="emp-designation" class="col-3"><?php echo $data['book']['designation']; ?></p></div>

</div>

<div id="time-in-out-div" class="text-center">
    <form action="#">
        <div id="time-in-div">
            <input name="time-in" id="time-in" type="text" class="form-control time" placeholder="Time in" readonly>
            <button type="button" class="btn btn-time-in btn-light" onclick="getTimeIn()"><i class="fa fa-clock-o"></i></button>
        </div>
        <div id="time-out-div">
            <input name="time-in" id="time-out" type="text" class="form-control time" placeholder="Time out" readonly>
            <button type="button" class="btn btn-time-in btn-light" onclick="getTimeOut()"><i class="fa fa-clock-o"></i></button>
        </div>
        <button type="submit" id="btn-save" name="save-btn" class="btn btn-outline-primary">Save</button>
    </form>
</div>
<script>
    function getTimeIn() {
        let d = new Date($.now());
        $('#time-in').val(d.getHours()+":"+d.getMinutes());
    }
    function getTimeOut() {
        let d = new Date($.now());
        $('#time-out').val(d.getHours()+":"+d.getMinutes());
    }
</script>
</body>
</html>
