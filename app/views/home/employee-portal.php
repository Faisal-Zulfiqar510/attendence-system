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
    <form action="../../home/saveAttendance" method="post">
        <input type="hidden" name="id" value="<?php echo $data['book']['id']; ?>">
        <div id="time-in-div">
            <input name="time-in" id="time-in" type="text"  value="<?php echo $data['book1']['Time_in']; ?>" class="form-control time" placeholder="Time in" readonly>
            <button type="button" class="btn btn-time-in btn-light" onclick="getTimeIn()"><i class="fa fa-clock-o"></i></button>
        </div>
        <div id="time-out-div">
            <input name="time-out" id="time-out" type="text" onchange="validate()" value="<?php echo $data['book1']['Time_out']; ?>"  class="form-control time" placeholder="Time out" readonly>
            <button type="button" class="btn btn-time-out btn-light" onclick="getTimeOut()" ><i class="fa fa-clock-o"></i></button>
        </div>
        <button type="submit"  id="btn-save" name="save-btn"  class="btn btn-outline-primary" disabled>Save</button>
        <button type="button" id="mailBtn" onclick="window.location.replace('../../home/mail')" >Mail</button>
    </form>
</div>
<script>


    function getTimeIn() {
        let d = new Date($.now());
        $('#time-in').val(d.getHours()+":"+d.getMinutes());
        $('.btn-time-in').attr('disabled',true);
        $('.btn-time-out').removeAttr('disabled',true);
        $('#btn-save').removeAttr('disabled',true);
    }
    function getTimeOut() {
        let d = new Date($.now());
        $('#time-out').val(d.getHours()+":"+d.getMinutes());
        $('.btn-time-out').attr('disabled',true);
    }

</script>
<?php if (!(empty($data['book1']['Time_in'])) and !(empty($data['book1']['Time_out']))) {
    echo "<script> $('.btn-time-in').attr('disabled',true);
          $('.btn-time-out').attr('disabled',true);
          $('#btn-save').attr('disabled',true);
            </script>";
    } elseif(!(empty($data['book1']['Time_in'])) and empty($data['book1']['Time_out'])) {
        echo "<script> $('.btn-time-in').attr('disabled',true);
          $('.btn-time-out').removeAttr('disabled',true);
          $('#btn-save').removeAttr('disabled',true);
            </script>";
    }elseif ((empty($data['book1']['Time_in'])) and empty($data['book1']['Time_out'])) {
    echo "<script> $('.btn-time-in').removeAttr('disabled',true);
          $('.btn-time-out').attr('disabled',true);
          $('#btn-save').attr('disabled',true);
            </script>";
}
?>

</body>
</html>
